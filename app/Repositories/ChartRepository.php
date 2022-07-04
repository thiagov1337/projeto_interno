<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PDO;

class ChartRepository
{
    private $pdoOracle;
    private $pdoMysql2;
    public function __construct()
    {
        $this->pdoOracle = DB::connection('oracle')->getPdo();
        $this->pdoMysql2 = DB::connection('mysql2')->getPdo();
    }
    
    public function chartUser()
    {
        $users = User::all();
        $actived = $users->where('status', 'actived')->count();
        $inactived = $users->where('status', 'inactived')->count();
        $preRegistred = $users->where('status', 'pre_registred')->count();
        return response()->json(['actived' => $actived, 'inactived' => $inactived, 'preRegistred' => $preRegistred]);  
    }

    public function chartPCM()
    {
        $dataEnd = date('Y-m-d');
        $dataStart = date('Y-m-d', strtotime('-30 days', time()));
        
        $stmt =  $this->pdoOracle->prepare("SELECT Count (E900COP.QTDPRV) QTDMQN, E900COP.DTRFIM
                                    FROM sapprod.E900COP, sapprod.E900OOP
                                    WHERE E900OOP.CODEMP = E900COP.CODEMP
                                        AND E900OOP.CODORI = E900COP.CODORI
                                        AND E900OOP.NUMORP = E900COP.NUMORP
                                        AND E900COP.SITORP = 'F' 
                                        AND E900COP.DTRFIM BETWEEN '$dataStart' AND '$dataEnd'
                                        AND E900OOP.CODCRE = '08'
                                        GROUP BY E900COP.DTRFIM ORDER BY E900COP.DTRFIM ASC");
        $result = $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $key => $value) {
            $stmt =  $this->pdoMysql2->prepare("SELECT QtdPrv FROM noticias.PrevisaoPCM WHERE DatPrv = '{$value['dtrfim']}'");
            $previsao = $stmt->execute();
            $previsao = $stmt->fetch(PDO::FETCH_ASSOC);
            $result[$key]['qtdprv'] = $previsao['QtdPrv'] ?? 0;
            $result[$key]['dtrfim'] = Carbon::parse($value['dtrfim'])->format('d/m/Y');
        }
        return response()->json($result);
    }

    public function chartFaturado()
    {
        $data = date('Y-m-d');
        $stmt =  $this->pdoOracle->prepare("SELECT E140IPV.CODFAM CodFam, E012FAM.DESFAM DESFAM, 
                                    To_Char(E140NFV.DATEMI,'yyyy') DatEmi, Sum(E140IPV.QTDFAT) QtdFat
                                FROM sapprod.E140IPV, sapprod.E140NFV, sapprod.E001TNS, sapprod.E012FAM
                            WHERE E140IPV.CODEMP = E140NFV.CODEMP 
                                AND E140IPV.CODFIL = E140NFV.CODFIL 
                                AND E140IPV.CODSNF = E140NFV.CODSNF 
                                AND E140IPV.NUMNFV = E140NFV.NUMNFV
                                AND E001Tns.CODEMP = E140ipv.CODEMP
                                AND E001Tns.CODTNS = E140IPV.TnsPro
                                AND E012FAM.CODFAM = E140IPV.CODFAM
                                AND E012FAM.CODEMP = E140IPV.CODEMP
                                AND E001TNs.VENFAT = 'S'
                                AND E012FAM.CodOri IN('03','10')
                                AND E012FAM.CODFAM NOT IN ('03.08')
                                AND E140NFV.DATEMI = '$data'
                            GROUP BY E140ipv.CODFAM, E012FAM.DESFAM, To_Char(E140NFV.DATEMI,'yyyy')
                            ORDER BY To_Char(E140NFV.DATEMI,'yyyy'), Sum(E140IPV.QTDFAT) Desc");

        $result = $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return response()->json($result);
    }

    public function chartMensal()
    {  
        $stmt =  $this->pdoOracle->prepare("SELECT Sum(E120IPD.QTDPED) QTDPLN, TO_CHAR (PED.DATPRV,'MM/YYYY') MES_ANO
                            FROM sapprod.E120IPD, sapprod.E120PED PED
                            WHERE PED.CODEMP = E120IPD.CODEMP
                            AND PED.CODFIL = E120IPD.CODFIL
                            AND PED.NUMPED = E120IPD.NUMPED
                            AND PED.DATPRV BETWEEN '2022-01-01' AND '2022-12-01'
                            AND PED.SITPED <> '5'
                            AND PED.TNSPRO = 'VENDA'
                            AND PED.USU_CODCAR <> ' '
                            AND E120IPD.CODFAM LIKE '10%'
                            GROUP BY TO_CHAR (PED.DATPRV,'MM/YYYY')
                            ORDER BY TO_CHAR (PED.DATPRV,'MM/YYYY')");

        $result = $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return response()->json($result);    
    }

    public function chartMeta()
    {
        $stmt =  $this->pdoOracle->prepare("SELECT To_Char(E140NFV.DATEMI,'YYYY/MM') DATEMI, round((Sum(E140NFV.VLRLIQ) / 100000000) * 100) VLRLIQ 
            FROM sapprod.E140NFV, sapprod.E001TNS
            WHERE E140NFV.TNSPRO = E001TNS.CodTns
            AND E001TNS.VENFAT = 'S'
            AND E140NFV.DATEMI BETWEEN '2022-01-01' AND '2022-12-31'
            GROUP BY To_Char(E140NFV.DATEMI,'YYYY/MM')
            ORDER BY DATEMI");

        $result = $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $aux = 0;
        foreach ($result as $key => $value) {
            $aux += $value['vlrliq'];
            $result[$key]['vlrliq'] = $aux;
        }
        return response()->json($result);    
    }

}

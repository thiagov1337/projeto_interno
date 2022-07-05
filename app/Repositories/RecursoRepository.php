<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PDO;

class RecursoRepository
{
    private $pdoOracle;
    private $pdoMysql2;
    public function __construct()
    {
        $this->pdoOracle = DB::connection('oracle')->getPdo();
        $this->pdoMysql2 = DB::connection('mysql2')->getPdo();
    }
    
    public function loadView($recurso)
    {
        $select = "SELECT CodCre FROM noticias.ControleTurno WHERE CodCre = :recurso";
        $stmt = $this->pdoMysql2->prepare($select);
        $stmt->bindParam('recurso', $recurso);
        $recurso = $stmt->execute();
        $recurso = $stmt->fetch(PDO::FETCH_ASSOC);

        if($recurso){
            $select = "SELECT  COP.NUMPRI, COP.CODORI, COP.NUMORP, 
                                PRO.CODPRO, PRO.DESPRO,
                                OOP.QTDPRV, OOP.SEQROT
                            FROM sapprod.E900COP COP, sapprod.E900OOP OOP, sapprod.E075PRO PRO
                            WHERE OOP.DTRFIM = '1900-12-31'
                            AND OOP.CODEMP = COP.CODEMP
                            AND OOP.CODORI = COP.CODORI
                            AND OOP.NUMORP = COP.NUMORP
                            AND COP.CODEMP = PRO.CODEMP
                            AND OOP.QTDPRV > (OOP.QTDRE1 + OOP.QTDRFG)
                            AND COP.CODPRO = PRO.CODPRO
                            AND OOP.CODCRE IN ({$recurso['CodCre']})
                            AND COP.SITORP IN ('A','L')
                            ORDER BY OOP.DTRINI DESC, OOP.NUMPRI, OOP.NUMORP";

            $stmt = $this->pdoOracle->prepare($select);
            $ordens = $stmt->execute();
            $ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $recurso['descricao'] = 'DESCRIÇÃO RECURSO';
            $recurso['id'] = $recurso['CodCre'];
            return response(['ordens' => $ordens, 'recurso' => $recurso]);
        }
        
        echo "Recurso não encontrado"; die();
    
    }
}

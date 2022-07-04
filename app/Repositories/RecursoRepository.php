<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PDO;

class RecursoRepository
{
    private $pdoOracle;
    private $pdoMysql2;
    public $recurso;
    public function __construct()
    {
        $this->pdoOracle = DB::connection('oracle')->getPdo();
        $this->pdoMysql2 = DB::connection('mysql2')->getPdo();
    }
    
    public function listarOrdens($recurso)
    {
        $select = "SELECT  COP.NUMORP, COP.CODORI, OOP.SEQROT, OOP.CODCRE, OOP.NUMPRI, 
                            OOP.TMPPRP,PRO.CODPRO, PRO.DESPRO, OOP.CODOPR, OOP.QTDPRV,
                            OOP.QTDRFG, OOP.QTDRE1, OOP.CODETG, COP.OBSORP
                        FROM sapprod.E900COP COP, sapprod.E900OOP OOP, sapprod.E075PRO PRO
                        WHERE OOP.DTRFIM = '1900-12-31'
                        AND OOP.CODEMP = COP.CODEMP
                        AND OOP.CODORI = COP.CODORI
                        AND OOP.NUMORP = COP.NUMORP
                        AND COP.CODEMP = PRO.CODEMP
                        AND OOP.QTDPRV > (OOP.QTDRE1 + OOP.QTDRFG)
                        AND OOP.QTDPRV > OOP.QTDRE1 
                        AND COP.CODPRO = PRO.CODPRO
                        AND OOP.CODCRE IN ($recurso)
                        AND COP.SITORP IN ('A','L')
                        ORDER BY OOP.DTRINI DESC, OOP.NUMPRI, OOP.NUMORP";

        $stmt =  $this->pdoOracle->prepare($select);
        $ordens = $stmt->execute();
        $ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return response($ordens);
    }
}

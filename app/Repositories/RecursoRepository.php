<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PDO;

class RecursoRepository
{
    private $oracle;
    private $mysql2;
    public function __construct()
    {
        $this->oracle = DB::connection('oracle');
        $this->mysql2 = DB::connection('mysql2');
    }
    
    public function loadView($recurso)
    {
        
        $recurso = $this->mysql2->selectOne('SELECT CodCre FROM noticias.ControleTurno WHERE CodCre = ?', [$recurso]);
        if($recurso){
            $recurso->descricao = 'DESCRIÇÃO RECURSO'; // Criar coluna para descrição 
            $select = "SELECT COP.NUMPRI, COP.CODORI, COP.NUMORP, 
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
                            AND OOP.CODCRE IN ({$recurso->CodCre})
                            AND COP.SITORP IN ('A','L')
                            ORDER BY OOP.DTRINI DESC, OOP.NUMPRI, OOP.NUMORP";

            $ordens = $this->oracle->select($select);

            $select = "SELECT OCR.USU_NUMCAD, OPE.NOMOPE 
                        FROM sapprod.USU_T900OCR OCR, sapprod.E906OPE OPE
                            WHERE OCR.USU_CODCRE in ('{$recurso->CodCre}')
                            AND OCR.USU_SITOPR = 'A'	
                            AND OCR.USU_NUMCAD = OPE.NUMCAD
                            AND OCR.USU_CODEMP = OPE.CODEMP
                            ORDER BY USU_NUMCAD";

            $operadores = $this->oracle->select($select);
        
            return response(['ordens' => $ordens, 'recurso' => $recurso, 'operadores' => $operadores]);
        }
        
        echo "Recurso não encontrado"; die();
    
    }
}

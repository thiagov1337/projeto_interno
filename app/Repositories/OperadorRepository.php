<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OperadorRepository
{
    protected $oracle;
    
    public function __construct()
    {
        $this->oracle = DB::connection('oracle');
    }
 
   
    public function getOperadoresByRecurso($codcre)
    {
        return $this->oracle->select("SELECT OCR.USU_NUMCAD, OPE.NOMOPE 
                                        FROM sapprod.USU_T900OCR OCR, sapprod.E906OPE OPE
                                        WHERE OCR.USU_CODCRE in ('{$codcre}')
                                        AND OCR.USU_SITOPR = 'A'	
                                        AND OCR.USU_NUMCAD = OPE.NUMCAD
                                        AND OCR.USU_CODEMP = OPE.CODEMP
                                        ORDER BY USU_NUMCAD");

    }

}

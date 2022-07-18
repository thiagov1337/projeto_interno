<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class OrdemRepository
{
    protected $oracle;
    public function __construct()
    {
        $this->oracle = DB::connection('oracle');
    }
    
    public function getOrdem($numorp, $codori)
    {
            // return $this->ordem::where(['numorp' => $numorp, 'codori' => $codori])->get();
    }
    
    public function getOrdensByRecurso($codcre)
    {   
        return $this->oracle->table('sapprod.E900COP')
                    ->join('sapprod.E900OOP', 'E900OOP.numorp', '=', 'E900COP.numorp')
                    ->where(['E900OOP.codcre' => $codcre, 'E900OOP.dtrfim' => '1900-12-31'])
                    ->whereIn('E900COP.sitorp', ['A', 'L'])
                    ->orderBy('E900COP.numorp')
                    ->get(['E900COP.numorp', 'E900COP.numpri', 'E900COP.codori', 'E900COP.codpro', 'E900COP.qtdprv', 'E900OOP.seqrot']);
        

    }

}

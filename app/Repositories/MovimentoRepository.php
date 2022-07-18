<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class MovimentoRepository
{
    protected $oracle;

    public function __construct()
    {
        $this->oracle = DB::connection('oracle');
    }
 
   
    public function getTipoApontamento($numorp, $codori, $seqrot)
    {
        $movimentos = $this->oracle->table("sapprod.E900EOQ")
                            ->where(['numorp' => $numorp,
                                    'codori' => $codori, 
                                    'seqrot' => $seqrot])->count();

        if($movimentos % 2 == 0){
            return 'A';
        }else{
            // verificar se existe parada
            return 'M';
        }

    }

}

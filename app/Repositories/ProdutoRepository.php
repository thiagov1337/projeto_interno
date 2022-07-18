<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProdutoRepository
{
    protected $oracle;
    public function __construct()
    {
        $this->oracle = DB::connection('oracle');
    }
    
    public function getProduto($codpro, $columns)
    {
        return $this->oracle->table('sapprod.E075PRO')->where('codpro', $codpro)->first($columns);
    }

}

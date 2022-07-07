<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OrdemRepository
{
    private $oracle;
    public function __construct()
    {
        $this->oracle = DB::connection('oracle');
    }
    
    public function getOrdem($numorp, $codori)
    {
        $select = "SELECT CODORI, NUMORP FROM sapprod.E900COP WHERE NUMORP = ? AND CODORI = ?";
        return $this->oracle->selectOne($select, [$numorp, $codori]);
    }

}

<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordem extends Model
{
    protected $connection = 'oracle';
    protected $table = 'sapprod.E900COP';
    protected $primaryKey = 'numorp';

    public function operacoes()
    {
        return $this->hasMany(Operacao::class, 'numorp', 'numorp');
    }
    
    public function produto()
    {
        return $this->HasOne(Produto::class, 'codpro', 'codpro');
    }


}

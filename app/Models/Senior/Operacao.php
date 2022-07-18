<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacao extends Model
{
    protected $connection = 'oracle';
    protected $table = 'sapprod.E900OOP';
    protected $primaryKey = 'seqrot';

    public function movimentos()
    {
        return $this->hasMany(Movimentacao::class, 'seqrot', 'seqrot');
    }

    public function ordem()
    {
        return $this->belongsTo(Ordem::class, 'numorp', 'numorp');
    }
}

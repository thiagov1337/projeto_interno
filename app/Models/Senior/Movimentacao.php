<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $connection = 'oracle';
    protected $table = 'sapprod.E900EOQ';
    protected $primaryKey = 'seqeoq';

}

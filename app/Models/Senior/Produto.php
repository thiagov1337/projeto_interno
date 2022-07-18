<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $connection = 'oracle';
    protected $table = 'sapprod.E075PRO';
    protected $primaryKey = 'codpro';
    protected $keyType = 'string';
    use HasFactory;
}

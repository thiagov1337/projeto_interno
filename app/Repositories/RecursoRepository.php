<?php
namespace App\Repositories;
use App\Models\ControleRecurso;

class RecursoRepository 
{
    protected $controleRecurso;
    public function __construct(ControleRecurso $controleRecurso)
    {
        $this->controleRecurso = $controleRecurso;
    }
    
    public function find($codcre)
    {
        return $this->controleRecurso::find($codcre);
    }


}

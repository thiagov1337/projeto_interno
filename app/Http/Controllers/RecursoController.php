<?php

namespace App\Http\Controllers;

use App\Repositories\RecursoRepository;
use App\Repositories\OrdemRepository;
use App\Repositories\OperadorRepository;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    private $repositoryRecurso;
    private $repositoryOperador;
    private $repositoryOrdem;

    public function __construct(RecursoRepository $repositoryRecurso, OrdemRepository $repositoryOrdem, OperadorRepository $repositoryOperador)
    {
        $this->repositoryRecurso = $repositoryRecurso;
        $this->repositoryOrdem = $repositoryOrdem;
        $this->repositoryOperador = $repositoryOperador;
    }

    public function index(Request $request)
    {
        $recurso = ($this->repositoryRecurso->getRecurso($request->recurso));
        $operadores = ($this->repositoryOperador->getOperadoresByRecurso($request->recurso));
        $ordens = ($this->repositoryOrdem->getOrdensByRecurso($request->recurso));

        return view('piloto', ['recurso' => $recurso , 'operadores' => $operadores, 'ordens' => $ordens]);
    }
}

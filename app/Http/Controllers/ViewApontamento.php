<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ApontamentoService;

class ViewApontamento extends Controller
{
    protected $apontamentoService;

    public function __construct(ApontamentoService $apontamentoService)
    {
        $this->apontamentoService = $apontamentoService;
    }
    
    public function index(Request $request)
    {
        $recurso =  ($this->apontamentoService->getRecurso($request->recurso));
        $operadores = ($this->apontamentoService->getOperadoresByRecurso($request->recurso));

        $ordens = ($this->apontamentoService->getOrdensToView($request->recurso));

        return view('piloto', ['recurso' => $recurso , 'operadores' => $operadores, 'ordens' => $ordens]);
    }
}

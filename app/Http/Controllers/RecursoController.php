<?php

namespace App\Http\Controllers;

use App\Repositories\RecursoRepository;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    private $repository;
    public function __construct(RecursoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $ordens = $this->repository->listarOrdens($request->recurso);
        $ordens = json_decode($ordens->content());
        return view('piloto', ['ordens' => $ordens, 'recurso' => $request->recurso]);
    }
}

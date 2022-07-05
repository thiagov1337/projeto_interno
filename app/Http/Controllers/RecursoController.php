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
        $info = json_decode($this->repository->loadView($request->recurso)->content());
        return view('piloto', ['ordens' => $info->ordens, 'recurso' => $info->recurso]);
    }
}

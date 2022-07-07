<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrdemRepository;

class OrdemController extends Controller
{
    private $repository;
    public function __construct(OrdemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function showOrdem(Request $request)
    {   
        $ordem = $this->repository->getOrdem($request->numorp, $request->codori);
        return response()->json($ordem);
    }

    
}

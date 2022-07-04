<?php
namespace App\Http\Controllers;
use App\Repositories\ChartRepository;

class ChartController extends Controller
{
    private $repository;
    public function __construct(ChartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function chartUser()
    {
        return $this->repository->chartUser();
    }

    public function chartPCM()
    {
        return $this->repository->chartPCM();
    }

    public function chartFaturado()
    {
        return $this->repository->chartFaturado();
    }

    public function chartMensal()
    {
        return  $this->repository->chartMensal();
    }

    public function chartMeta()
    {
        return $this->repository->chartMeta();
    }

}

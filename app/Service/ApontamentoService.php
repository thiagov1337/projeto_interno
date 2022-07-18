<?php
namespace App\Service;

use App\Repositories\MovimentoRepository;
use App\Repositories\OperadorRepository;
use App\Repositories\OrdemRepository;
use App\Repositories\ProdutoRepository;
use App\Repositories\RecursoRepository;

class ApontamentoService
{
    private $repositoryRecurso;
    private $repositoryOperador;
    private $repositoryOrdem;
    private $repositoryProduto;
     

    public function __construct(RecursoRepository $repositoryRecurso, 
                                OrdemRepository $repositoryOrdem, 
                                OperadorRepository $repositoryOperador,
                                ProdutoRepository $repositoryProduto,
                                MovimentoRepository $repositoryMovimento)
    {
        $this->repositoryRecurso  = $repositoryRecurso;
        $this->repositoryOrdem    = $repositoryOrdem;
        $this->repositoryOperador = $repositoryOperador;
        $this->repositoryProduto = $repositoryProduto;
        $this->repositoryMovimento = $repositoryMovimento;
    }

    public function getRecurso($codcre)
    {
        return $this->repositoryRecurso->find($codcre) ?? abort(404);
    }

    public function getOrdensToView($codcre)
    {   
        $ordens = $this->repositoryOrdem->getOrdensByRecurso($codcre);
        foreach ($ordens as $ordem) {
           $ordem->produto = $this->repositoryProduto->getProduto($ordem->codpro, ['codpro','despro']);
           $ordem->tipoApontamento = $this->repositoryMovimento->getTipoApontamento($ordem->numorp, $ordem->codori, $ordem->seqrot);
          
        }
        
        return $ordens;
    }

    public function getOperadoresByRecurso($codcre)
    {
        return $this->repositoryOperador->getOperadoresByRecurso($codcre);
    }
    
   

}


@extends('layouts.app')

@section('content')
    <span class="float-right fa-solid h4 m-2 text-danger h4"> Pedir ajuda <i class="fa-solid fa-triangle-exclamation h4 text-danger"></i></span>
    <h1 style="font-family: Consolas;">{{$recurso}} - %descicao setor% </h1> 
    <div class="card" data-spy="scroll" id="inicio">
        <div class="card-header">
            Apontamento
        </div>
        @include('components/cabecalho')
        @include('components/lista_op', ['ordens' => $ordens])
    </div>
@endsection

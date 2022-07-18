<div class="card-body" style="padding: 0.0rem 0.9rem !important; background: #f7f7f7">
    <form action="" id="formAponta" method="POST" style="padding: 0 !important; margin: 0 !important">
        <div class="row">
        <div class="col-sm-8 border card p-2">
            <div class="row">
                <div class="col-md-2 mb-1">
                    <label for=""><strong>ORIGEM</strong></label>
                    <input type="text" class="form-control" id="CodOri" name="codori" required="" readonly="">
                </div>
                <div class="col-md-2 mb-1">
                    <label for=""><strong>OP</strong></label>
                    <input type="text" class="form-control" id="NumOrp" name="numorp" required="" readonly="" style="font-weight: bold;">
                </div>
                <div class="col-md-2 mb-1">
                    <label for=""><strong>APONTAR</strong></label>
                    <input type="number" min="0" class="form-control" id="QtdApo" name="qtdapo" value="0" required="" readonly="">
                </div>
                <div class="col-md-2 mb-1">
                    <label for=""><strong>REFUGAR</strong></label>
                    <input type="number" min="0" class="form-control" id="QtdRfo" name="qtdrfo" value="0" required="" readonly="">
                </div>
                <div class="col-md-4 mb-1">
                    <label for=""><strong>MOTIVO REFUGO</strong></label>
                    <select class="form-control" name="MtvRfo" id="selectMtvRfo" onchange="selectRefugo()" disabled="">
                        <option selected="" value="0">NÃO REFUGAR</option>
                        <option disabled="">---------------------------------</option>
                        <option value="1">SOLDA INCORRETA</option>
                        <option value="10">DOBRA INCORRETA</option>
                        <option value="11">PERDA NESTING</option>
                        <option value="12">DESCARTE DE OBSOLETOS</option>
                        <option value="2">DEFEITO PINTURA</option>
                        <option value="3">MONTAGEM INCORRETA</option>
                        <option value="4">DESENHO INCORRETO</option>
                        <option value="5">MATERIAL FORA DE ESPECIFICAÇÃO</option>
                        <option value="6">FUNDIDO COM POROS/TRINCAS</option>
                        <option value="7">USINAGEM INCORRETA</option>
                        <option value="8">FURAÇÃO INCORRETA</option>
                        <option value="9">CORTE INCORRETO</option>
                    </select>
                </div>
                <div class="col-md-3 mb-1">
                    <label for=""><strong>REALIZADOS</strong></label>
                    <input type="text" class="form-control" id="QtdRea" required="" readonly="">
                </div>
                <div class="col-md-3 mb-1">
                    <label for=""><strong>REFUGADOS</strong></label>
                    <input type="text" class="form-control" id="QtdRfg" readonly="">
                </div>
                <div class="col-md-3 mb-1">
                    <label for=""><strong>PREVISTA</strong></label>
                    <input class="form-control" id="QtdPrv" value="0" readonly="">
                </div>
                <div class="col-md-12">
                    <small id="UltOpr" style="font-family: Consolas; font-weight: bold;">ÚLTIMO MOVIMENTO: </small>
                </div>
            </div>
            <input type="text" id="SeqRot" name="seqrot" hidden="">
            <input type="text" id="CodEtg" name="codetg" hidden="">
            <input type="text" id="TipApo" name="tipapo" hidden="">
        </div>
        <div class="col-sm-4 card">
            <div class="row">
                <select class="form-control m-2" style="font-weight: bold;">
                    <option value="0" selected="true" disabled="">SELECIONE O OPERADOR</option>
                    @foreach ($operadores as $operador)
                        <option value="{{ $operador->usu_numcad }}">{{ $operador->usu_numcad }} - {{ $operador->nomope }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card my-2">
                    <button type="button" id="TipMsgBtn" onclick="apontar(51)" class="btn" disabled="true">
                    SELECIONAR OP
                    </button>
                    </div>
                    <div class="card my-2">
                    <button type="button" id="TrcOprBtn" class="btn btn-info" data-toggle="modal" data-target="#modalTrocaOpr" disabled="true">
                    TROCA OPER.
                    </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card my-2">
                    <button type="button" data-toggle="modal" data-target="#modalPausa" id="PausarBtn" class="btn" disabled="true">
                    SELECIONAR OP
                    </button>
                    </div>
                    <div class="card my-2">
                    <!-- <button type="button" id="TurnoBtn" class="btn btn-secondary" onclick="turno('F', '51', $('#selectNumCad').val())" disabled> -->
                    <button type="button" id="TurnoBtn" class="btn btn-secondary" data-toggle="modal" data-target="#modalFinalTurno">
                    FINALIZAR TURNO
                    </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
</div>
 
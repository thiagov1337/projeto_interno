<table class="table table-sm table-bordered table-hover">
   <thead class="">
      <tr>
         <th>Pri.</th>
         <th>OP</th>
         <th>Descrição</th>
         <th></th>
         <th>Estado</th>
         <th>Qtd Prev.</th>
         <th>Sequência</th>
         <th>Concluído %</th>
         <th>Dep.</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($ordens as $orden)
      <tr>
         <td class=""><strong>{{ $orden->numpri }}</strong></td>
         <td class=""><strong><a target="_blank" href="">{{ $orden->codori }} - {{ $orden->numorp }}</a></strong></td>
         <td class=""><strong>{{ $orden->codpro }}</strong> - {{ $orden->despro }}</td>
         <td class="text-center"><a a="" target="_blank" class="btn btn-sm btn-primary">ETIQUETA</a></td>
         <td class="">
            <span class="badge badge-success p-2 w-100">ABRIR </span>                                    
         </td>
         <td class="">{{ $orden->qtdprv }}</td>
         <td class="">{{ $orden->seqrot }}</td>
         <td class="">
            <div class="progress m-1">
               <div class="progress-bar bg-success " role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
         </td>
         <td class="">%coddep%</td>
      </tr>
      @endforeach
   </tbody>
</table>
 
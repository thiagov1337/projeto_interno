<table class="table table-sm table-bordered table-hover">
   <thead class="">
      <tr>
         <th>Pri.</th>
         <th>OP</th>
         <th>Descrição</th>
         <th></th>
         <th>Estado</th>
         <th>Qtd Prev.</th>
         <th>Seq.</th>
         <th>Dep.</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($ordens as $ordem)
      
      <tr onclick="selecionar({{ $ordem->numorp }}, '{{ $ordem->codori }}')">
         <td class=""><strong>{{ $ordem->numpri }}</strong></td>
         <td class=""><strong><a target="_blank" href="">{{ $ordem->codori }} - {{ $ordem->numorp }}</a></strong></td>
         <td class=""><strong>{{ $ordem->produto->codpro }}</strong> - {{ $ordem->produto->despro }}</td>
         <td class="text-center"><a a="" target="_blank" class="btn btn-sm btn-primary">ETIQUETA</a></td>
         <td class="">
            @if ($ordem->tipoApontamento == 'A')
               <span class="badge badge-success p-2 w-100">ABRIR</span>                                    
            @elseif ($ordem->tipoApontamento == 'M')
               <span class="badge badge-warning p-2 w-100">APONTAR</span> 
            @endif
         </td>
         <td class="">{{ $ordem->qtdprv }}</td>
         <td class="">
               {{$ordem->seqrot}}
         </td>
         <td class="">%coddep%</td>
      </tr>
      @endforeach
   </tbody>
</table>
 
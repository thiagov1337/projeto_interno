@extends('layouts.admin', ['title' => 'Dashboard'])

@section('main')

<div class="row">   
   <div class="col-lg-6 connectedSortable ui-sortable">
      <div class="card">
         <div class="card-header ui-sortable-handle" style="cursor: move;">
          
            <h3 class="card-title">
               <i class="fas fa-users mr-1"></i>
               Usuários Cadastrados
            </h3>
            <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
            <div class="card-tools mr-2">
               <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                     <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                  </li>
               </ul>
            </div>
            
         </div>
         <div class="card-body">
            <div class="tab-content p-0">
               <div class="chart tab-pane active" id="revenue-chart">
                  <canvas id="revenue-chart-canvas" class=""></canvas>
               </div>
               <div class="chart tab-pane" id="sales-chart">
                  <canvas id="sales-chart-canvas" class=""></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-lg-6 connectedSortable ui-sortable">
      <div class="card">
         <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
            <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i>
               Meta 2022
            </h3>
         </div>
         <div class="card-body">
            <div class="chart" id="bar-chart">
               <canvas id="bar-chart-meta" class=""></canvas>
            </div>
         </div>
      </div>
   </div>


   <div class="col-lg-12 connectedSortable ui-sortable">
      <div class="card">
         <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
            <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i>
               PCM
            </h3>
         </div>
         <div class="card-body">
            <div class="chart" id="bar-chart">
               <canvas id="bar-chart-canvas" class=""></canvas>
            </div>
         </div>
      </div>
   </div>

   <div class="col-lg-12 connectedSortable ui-sortable">
      <div class="card">
         <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
            <h3 class="card-title">
               <i class="fas fa-chart-bar mr-1"></i>
               Faturados Hoje
            </h3>
           
         </div>
         <div class="card-body">
            <div class="" id="bar-chart">
               <canvas height="80vh" id="bar-chart-canvas-faturado" class=""></canvas>
            </div>
         </div>
      </div>
   </div>
   
   <div class="col-lg-12 connectedSortable ui-sortable">
      <div class="card">
         <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
            <h3 class="card-title">
               <i class="fas fa-chart-bar mr-1"></i>
               Mensal 2022
            </h3>
           
         </div>
         <div class="card-body">
            <div class="" id="bar-chart">
               <canvas height="80vh" id="bar-chart-canvas-line" class=""></canvas>
            </div>
         </div>
      </div>
   </div>
   

</div>

@endsection

@section('chart')
<script>
   let ctx = document.getElementById('revenue-chart-canvas').getContext('2d');
   let pie = document.getElementById('sales-chart-canvas').getContext('2d');
   let bar = document.getElementById('bar-chart-canvas').getContext('2d');
   let barFat = document.getElementById('bar-chart-canvas-faturado').getContext('2d');
   let line = document.getElementById('bar-chart-canvas-line').getContext('2d');
   let meta = document.getElementById('bar-chart-meta').getContext('2d');
   let url = "";

   $(document).ready(function(){
      let Values = new Array(); 
      url = "{{url('/chartUser')}}";
      $.get(url, function(response){
         Values.push(response.actived);
         Values.push(response.preRegistred);
         Values.push(response.inactived);
         
         const data = {
            labels: ['Ativos', 'Inativos', 'Pré Registrados'],
            datasets: [{
               label: 'Usuarios',
               data: Values,
               backgroundColor: [
                  'rgba(255, 99, 132, 0.5)',
                  'rgba(255, 159, 64, 0.5)',
                  'rgba(153, 102, 255, 0.5)'
               ],
               borderColor: [
                  'rgb(255, 99, 132)',
                  'rgb(255, 159, 64)',
                  'rgb(153, 102, 255)'
               ],
               borderWidth: 1
            }],
         };

         let configCtx = {
            type: 'bar',
            data: data,
            options: {
               legend: {
                  display: false
               },
     
            }
         };
         
         let configPie = {
            type: 'pie',
            data: data,
         };

         new Chart(ctx, configCtx);
         new Chart(pie, configPie);
      });
      
      let QtdMon = new Array(); 
      let QtdPrv = new Array(); 
      let Labels  = new Array(); 
      url = "{{url('/chartPCM')}}";
      $.get(url, function(response){
         response.forEach(function(data){         
            QtdMon.push(data.qtdmqn);
            QtdPrv.push(data.qtdprv);
            Labels.push(data.dtrfim);
         });   

         const data = {
            labels: Labels,
            datasets: [{
               label: 'Quantidade PCM Montadas Diariamente',
               data: QtdMon,
               borderWidth: 1,
               backgroundColor: '#7cb5ec'
            },{
               label: 'Quantidade PCM Prevista',
               data: QtdPrv,
               borderWidth: 1,
               backgroundColor: '#ff7f27'
            },{
               label: 'Capacidade',
               data: new Array(Labels.length).fill(14),
               type: 'line',
               borderColor: '#343434', 
            }],
         };

         let configBar = {
            type: 'bar',
            data: data,
            // plugins: [ChartDataLabels],
            options: {
            scales: {
               y: {
                  beginAtZero: true
               }
            }
         }

         };

         new Chart(bar, configBar);
      });

      let Maquinas = new Array(); 
      let QtdFat  = new Array(); 
      url = "{{url('/chartFaturado')}}";
      $.get(url, function(response){
         response.forEach(function(data){         
            Maquinas.push(data.desfam);
            QtdFat.push(data.qtdfat);
         });   

         const data = {
            labels: Maquinas,
            datasets: [{
               label: 'Faturados Hoje',
               data: QtdFat,
               borderWidth: 1,
               backgroundColor: 'rgb(75, 192, 192)',
            }],
         };

         let configBarFat = {
            type: 'bar',
            data: data,
            // plugins: [ChartDataLabels],
            options: {
               indexAxis: 'y',
            }
         };


         new Chart(barFat, configBarFat);
      });

      let Mes = new Array(); 
      let QtdPln  = new Array(); 
      url = "{{url('/chartMensal')}}";
      $.get(url, function(response){
         response.forEach(function(data){         
            Mes.push(data.mes_ano);
            QtdPln.push(data.qtdpln);
         });   

         const data = {
            labels: Mes,
            datasets: [{
               label: 'Planejadas',
               data: QtdPln,
               backgroundColor: 'rgba(255, 99, 132, 0.2)', 
               borderColor: 'rgb(255, 99, 132)',
               borderWidth: 1,
            }],
         };

         let configLine = {
            type: 'bar',
            data: data,
            plugins: [ChartDataLabels],
            options: {
               plugins: {
                  datalabels: {
                     labels: {
                        title: {
                           font: {
                              weight: 'bold'
                           }
                        }
                     }
                  }
               }
            }
         };

         new Chart(line, configLine);
      });

      let MesMeta = new Array(); 
      let PrcLiq  = new Array(); 
      url = "{{url('/chartMeta')}}";
      $.get(url, function(response){
         response.forEach(function(data){         
            MesMeta.push(data.datemi);
            PrcLiq.push(data.vlrliq);
         });   

         const data = {
            labels: MesMeta,
            datasets: [{
               label: 'Porcentagem',
               data: PrcLiq,
               borderColor: 'rgb(75, 192, 192)',
               backgroundColor: 'rgb(75, 192, 192)',
               borderWidth: 1,
               tension: 0.1
            },
            {
               label: 'Meta',
               data: new Array(MesMeta.length).fill(100),
               borderColor: '#FA8072', 
               backgroundColor: '#FA8072', 
               borderWidth: 1,
            }],
         };

         let configMeta = {
            type: 'line',
            data: data,
            // plugins: [ChartDataLabels]
         };

         new Chart(meta, configMeta);
      });
   });

</script>
@endsection



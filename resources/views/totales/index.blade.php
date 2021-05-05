@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('totales') }}
@endsection
@section('contenido')

<div class="container-fluid mt-6">
    
    <div class="card">
        @if ( session('success'))
            <div class="alert alert-success" role="alert">{{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @elseif( session('error') )
            <div class="alert alert-danger" role="alert">{{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-header pt-3">

           <h2>Visualizador de Valores Totales</h2><br/>
            
        </div>
        <div class="card-body">
                 
         <div class="tab-content mb-2">
            <div class="tab-pane fade active show" id="datosFisicos" role="tabpanel" aria-labelledby="datosFisicos-tab">
                <ul class="todo-list"  style="overflow-x: hidden;">

                        <!-- ==============================
                            DATOS DE PARCELARIOS
                        ==============================-->
                        <li class="itemSlide" id="aco2">

                           <div class="box-group" id="accordion2">

                               <!--=====================================
                                   CAJA GESTOR 
                               ======================================-->                  

                               <div class="panel box box-info">

                                   <!--=====================================
                                           CABEZA DE LA CAJA GESTOR 
                                   ======================================-->  
                                   
                                   <div class="box-header with-border">

                                       <div class="row ">
                                           <div class="col-12"> 
                                              <span class="handle ">
                                                <h4 class="box-title text-catastro font-weight-bold "><a  class="text-catastro collapseParcelario" data-toggle="collapse" data-target="#collapseParcelario" href="#collapseParcelario">TOTALES PARCELARIOS</a></h4> 
                                              </span>
                                          
                                           </div>
                                       </div>
 
                                   </div>

                                   <!--=====================================
                                   MÓDULOS COLAPSABLES
                                   ======================================-->   
                                   
                                   <div id="collapseParcelario" class="panel-collapse collapse collapseSlide show" data-parent="#datosFisicos">
     
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="card">
                                                    
                                                    <div class="card-header bg-primary">
                                                        <label class="card-title h3">Gestionado de Parcelas</label>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="chart">
                                                        <canvas id="areaParcelario" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="card">
                                                    
                                                    <div class="card-header bg-primary">
                                                        <label class="card-title h3">Tipos de Nomenclaturas</label>
                                                    </div>
                                                    <div class="card-body mb-2" >
                                                        <canvas id="donutParcelarioTiposNomencla" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
    
                                                </div>
                                                    
                                            </div>
                                        </div>

                                
                                   </div>

                               </div>

                           </div>

                       </li>


                    <!-- ==============================
                            DATOS DE DIRECCIONES
                        ==============================-->
                        <li class="itemSlide" >

                            <div class="box-group" id="accordion">

                                <!--=====================================
                                    CAJA GESTOR 
                                ======================================-->                  

                                <div class="panel box box-info">

                                    <!--=====================================
                                            CABEZA DE LA CAJA GESTOR 
                                    ======================================-->  
                                    
                                    <div class="box-header with-border">

                                        <div class="row ">
                                            <div class="col-12"> 
                                               <span class="handle ">
                                                 <h4 class="box-title text-catastro font-weight-bold "><a  class="text-catastro collapsePersonas" data-toggle="collapse"  data-target="#collapsePersonas" href="#collapsePersonas">TOTALES PERSONAS</a></h4> 
                                               </span>
                                           
                                            </div>
                                        </div>
  
                                    </div>

                                    <!--=====================================
                                    MÓDULOS COLAPSABLES
                                    ======================================-->   
                                    
                                    <div id="collapsePersonas" class="panel-collapse collapse collapseSlide pb-1 pt-2 show" data-parent="#datosFisicos">
                                       <div class="row">
                                          <div class="col-sm-12 col-md-6 ">
                                             <div class="card">

                                                <div class="card-header bg-primary">
                                                  <label class="card-title h3">Estados de Personas</label>
                                                </div>
                                                <div class="card-body mb-2" >
                                                  <canvas id="barChartPersonas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
 
                                              </div>
                                          </div>
                                          <div class="col-sm-12 col-md-6">
                                             <div class="card">
                                                
                                                <div class="card-header bg-primary">
                                                  <label class="card-title h3">Gestionado de Personas</label>
                                                </div>
                                                <div class="card-body">
                                                  <div class="chart">
                                                    <canvas id="areaChartPersona" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                  </div>
                                                </div>
                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                </div>

                            </div>

                        </li>    
                        
                        <!-- ==============================
                            DATOS DE MEJORAS
                        ==============================-->
                        <li class="itemSlide">

                            <div class="box-group">

                                <!--=====================================
                                    CAJA GESTOR 
                                ======================================-->                  

                                <div class="panel box box-info">

                                    <!--=====================================
                                            CABEZA DE LA CAJA GESTOR 
                                    ======================================-->  
                                    
                                    <div class="box-header with-border">

                                        <div class="row ">
                                            <div class="col-12"> 
                                               <span class="handle ">
                                                 <h4 class="box-title text-catastro font-weight-bold "><a  class="text-catastro collapseMejoras" data-toggle="collapse" data-target="#collapseMejoras"  href="#collapseMejoras">TOTALES DE MEJORAS</a></h4> 
                                               </span>
                                           
                                            </div>
                                        </div>
  
                                    </div>

                                    <!--=====================================
                                    MÓDULOS COLAPSABLES
                                    ======================================-->   
                                    
                                    <div id="collapseMejoras" class="panel-collapse collapse collapseSlide show" data-parent="#datosFisicos"> 

                                           <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                   <div class="card">
                                                      <div class="card-header bg-primary">
                                                        <label class="card-title h3">Totales de Mejoras</label>
                                                      </div>
                                                      <div class="card-body">
                                                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                   <div class="card-header bg-primary">
                                                      <label class="card-title h3">Gestionado de Mejoras</label>
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="chart">
                                                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                      </div>
                                                    </div>
                                                </div>                                                                                                       
                                           </div>
                                 
                                    </div>

                                </div>

                            </div>

                        </li>    

                    
                      
                        
                </ul>
            </div>
            <div class="tab-pane fade" id="origenDestino" role="tabpanel" aria-labelledby="origenDestino-tab">
               
            </div>
            <div class="tab-pane fade" id="dominio" role="tabpanel" aria-labelledby="dominio-tab">
                
            </div>
            <div class="tab-pane fade" id="regimenes" role="tabpanel" aria-labelledby="regimenes-tab">
                
            </div>
        </div>
                
        </div>
    </div>
</div>

   @push('scripts')
   <script src="{{asset('/js/librerias/Chart.min.js')}}"></script>

   <script>
 
  


         //ALTA Y MODIFICACION PARCELARIO
      var areaChartCanvas = $('#areaParcelario').get(0).getContext('2d')

        data_alta = [0,0,0,0,0,0,0,0,0,0,0,0];
        data_modif = [0,0,0,0,0,0,0,0,0,0,0,0];

        $.ajax({
            type: "GET",
            url: "{{url('gestionadoParcelas')}}",
            data: "",
            dataType: "json",
            async: false,
            success: function (response) {

                for(i=0; i < response.altas.length; i++){
                    data_alta[response.altas[i].mes - 1] = response.altas[i].cantidad;
                }  
                
                for(i=0; i < response.modificaciones.length; i++){
                    data_modif[response.modificaciones[i].mes - 1] = response.modificaciones[i].cantidad;
                }   

            },error: function (response) {
    
            }
        });
        
        var areaChartData = {
            labels  : ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'],
            datasets: [
                {
                    label               : 'Altas de parcelas',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                :  data_alta
                },
                {
                    label               : 'Modificaciones de parcelas',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                :  data_modif
                },
            ]
        }

        var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            labels:{ defaultFontSize:30},
            display: true
        },
        scales: {
        xAxes: [{
            gridLines : {
                display : false,
            }
        }],
        yAxes: [{
            gridLines : {
                display : false,
            }
        }]
        }
        }

        var areaChart       = new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
        })


        //DONA DE PARCELARIO TIPOS NOMENCLATURAS
    var donutChartCanvas = $('#donutParcelarioTiposNomencla').get(0).getContext('2d');
        
        labels = [];
        data = [];
        backgroundColor = [];

        $.ajax({
            type: "GET",
            url: "{{url('nomenclasParcelas')}}",
            data: "",
            dataType: "json",
            async: false,
            success: function (response) {
    

                for(i=0; i < response.cabeceras.length; i++){
                    labels[i] = response.cabeceras[i].tipo_nomenclatura_descrip;
                    backgroundColor[i] = getRandomColor();
                }

                for(i=0; i < response.cantidades.length; i++){
                    data[i] = response.cantidades[i].cantidad;
                }

            },error: function (params) {
    
            }
        });

        donutData = {
            labels: labels,
            datasets: [
                {
                    data: data,
                    backgroundColor : backgroundColor
                }
            ]
        }
        var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
            cutoutPercentage:0,
            legend: {
                labels:{ defaultFontSize:30},
                display: true
            }
        }

        var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

      //DONA DE PERSONAS
    var barChartCanvas = $('#barChartPersonas').get(0).getContext('2d')
    
    data = [];

    $.ajax({
        type: "GET",
        url: "{{url('estadosPersonas')}}",
        data: "",
        dataType: "json",
        async: false,
        success: function (response) {
            
            data= [response.cantidades[0].sin_doc, response.cantidades[0].sin_cuit, response.cantidades[0].sin_genero, response.cantidades[0].sin_email, response.cantidades[0].sin_fecha, response.cantidades[0].sin_tel]   
            
        },error: function (response){

        }
    });

    areaChartData = {
        labels: [
            'SIN DOC.',
            'SIN CUIL',
            'SIN GENERO',
            'SIN EMAIL',
            'SIN FECHA NAC.',
            'SIN TEL.',
         ],
            datasets: [
                {
                    label               : 'Estado de los datos',
                    backgroundColor     : ['rgba(227,54,88,0.9)','rgba(236,146,32,0.9)','rgba(80,140,245,0.9)','rgba(172,93,231,0.9)','rgba(102,37,93,0.9)','rgba(0,0,0,0.9)'],
                    borderColor         : 'rgba(0,0,0,0.8)',
                    pointRadius          : false,
                    pointColor          : '#23536F',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : data
                }
            ]
    }


    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%> font-size: 20px;"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}% style="font-size:20px"></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false

      var barChart = new Chart(barChartCanvas, {
         type: 'bar',
         data: areaChartData,
         options: barChartOptions
      })


      //ALTA Y MODIFICACION PERSONAS
        data_alta = [0,0,0,0,0,0,0,0,0,0,0,0];
        data_modif = [0,0,0,0,0,0,0,0,0,0,0,0];

      var areaChartCanvas = $('#areaChartPersona').get(0).getContext('2d')

      $.ajax({
          type: "GET",
          url: "{{url('gestionadoPersonas')}}",
          data: "",
          dataType: "json",
          async: false,
          success: function (response) {

            for(i=0; i < response.altas.length; i++){
                data_alta[response.altas[i].mes - 1] = response.altas[i].cantidad;
            }  
                
            for(i=0; i < response.modificaciones.length; i++){
                data_modif[response.modificaciones[i].mes - 1] = response.modificaciones[i].cantidad;
            }   

          }
      });

      var areaChartData = {
        labels  : ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'],
         datasets: [
         {
            label               : 'Alta de Personas',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : data_alta
         },
         {
            label               : 'Modificaciones de Personas',
            backgroundColor     : 'rgba(210, 214, 222, 1)',
            borderColor         : 'rgba(210, 214, 222, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : data_modif
         },
         ]
      }

      var areaChartOptions = {
         maintainAspectRatio : false,
         responsive : true,
         legend: {
            labels:{ defaultFontSize:30},
         display: true
         },
         scales: {
         xAxes: [{
            gridLines : {
               display : false,
            }
         }],
         yAxes: [{
            gridLines : {
               display : false,
            }
         }]
         }
      }

      var areaChart       = new Chart(areaChartCanvas, {
         type: 'line',
         data: areaChartData,
         options: areaChartOptions
      })



      //TOTALES DE TIPOS DE MEJORAS

      var pieChartCanvas = $('#pieChart').get(0).getContext('2d');

      labels = [];
      backgroundColor = [];
      data = [];
     
      $.ajax({
          type: "GET",
          url: "{{url('get_tipos_mejoras')}}",
          data: "",
          dataType: "json",
          async: false,
          success: function (response) {

            for(i=0; i < response.cabeceras.length; i++){
                labels[i] = response.cabeceras[i].tipo_mejora_descrip;
                backgroundColor[i] = getRandomColor();
            }

            for(i=0; i < response.cantidades.length; i++){
                data[i] = response.cantidades[i].cantidad;
            }

        },error: function (response) {
            console.log(response.responseText);
        }
    });
    
    var donutData = {
            labels: labels,
            datasets: [
                {
                    data: data,
                    backgroundColor : backgroundColor,
                }
            ]
        }
    var pieData        = donutData;
      var pieOptions     = {
         maintainAspectRatio : false,
         responsive : true,
      }

      var pieChart = new Chart(pieChartCanvas, {
         type: 'pie',
         data: pieData,
         options: pieOptions
      })


      //GESTIONADO DE MEJORAS

        data_alta = [0,0,0,0,0,0,0,0,0,0,0,0];
        data_modif = [0,0,0,0,0,0,0,0,0,0,0,0];

        $.ajax({
            type: "GET",
            url: "{{url('gestionadoMejoras')}}",
            data: "",
            dataType: "json",
            async: false,
            success: function (response) {

                for(i=0; i < response.altas.length; i++){
                    data_alta[response.altas[i].mes - 1] = response.altas[i].cantidad;
                }  
                
                for(i=0; i < response.modificaciones.length; i++){
                    data_modif[response.modificaciones[i].mes - 1] = response.modificaciones[i].cantidad;
                }   

            },error: function (response) {
                console.log(response.responseText);
            }
        });

        areaChartData = {
            labels  : ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'],
            datasets: [
            {
                label               : 'Alta Mejoras',
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : data_alta
            },
            {
                label               : 'Modificaciones Mejoras',
                backgroundColor     : 'rgba(210, 214, 222, 1)',
                borderColor         : 'rgba(210, 214, 222, 1)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : data_modif
            },
            ]
        }

        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
        var lineChartOptions = $.extend(true, {}, areaChartOptions)
        var lineChartData = $.extend(true, {}, areaChartData)
        lineChartData.datasets[0].fill = false;
        lineChartData.datasets[1].fill = false;
        lineChartOptions.datasetFill = false

        var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
        })



    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 14)];
        }
        return color;
    }


   </script>
   @endpush

   @push('css')
   <link rel="stylesheet" href="{{asset('/css/librerias/adminlte.min.css')}}">
   <link rel="stylesheet" href="{{asset('/css/librerias/select2.css')}}">
   <link rel="stylesheet" href="{{asset('/css/librerias/select2-bootstrap4.css')}}">
   @endpush

@endsection
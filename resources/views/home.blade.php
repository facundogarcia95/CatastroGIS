@php
     setlocale(LC_TIME, "spanish");
@endphp
@extends('principal')
@section('contenido')
<main class="main">
    @include('breadcrumb.bread')
            <div class="container-fluid">   
                <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <!-- small box -->
                                <div class="card text-white bg-success">
                                    <div class="card-body pb-0">
                                        <button class="btn btn-transparent p-0 float-right" type="button">
                                        <i class="fa fa-shopping-cart fa-4x"></i>
                                        </button>
                                        <div class="text-value h4"><strong>$ {{$totales[0]->totalcompra}} </strong>(<label class="text-uppercase">@php
                                            echo strftime("%B");   
                                        @endphp </label>)</div>
                                        <div class="h2">Compras</div>
                                    </div>
                                    <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                                        <a href="{{url('compra')}}" class="small-box-footer h4">Compras <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-xs-12">
                                <!-- small box -->
                                <div class="card text-white bg-primary">
                                    <div class="card-body pb-0">
                                        <button class="btn btn-transparent p-0 float-right" type="button">
                                        <i class="fa fa-suitcase fa-4x"></i>
                                        </button>
                                        <div class="text-value h4"><strong>$ {{$totales[0]->totalventa}} </strong>(<label class="text-uppercase">@php
                                            echo strftime("%B");
                                        @endphp </label>)</div>
                                        <div class="h2">Ventas</div>
                                    </div>
                                    <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                                        <a href="{{url('venta')}}" class="small-box-footer h4">Ventas <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                    
                                </div>
                            </div>
                            

                        </div>


                        <!-- Estadísticas gráficos -->
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <!-- compras - meses -->

                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Compras </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="compras">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                            </div>

                            </div><!--col-md-4-->
                        
                            <div class="col-md-6 col-xs-12">
                            
                                <!-- ventas - meses -->
                                
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Ventas </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="ventas">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                                </div>
                            

                            </div><!-- col-md-4 -->
                        
                        </div>

                    <div class="row">

                        <div class="col-lg-6 col-xs-12">
                            <!-- small box -->
                            <div class="card text-white" style="background-color: rgba(248,108,67, 1)">
                                <div class="card-body pb-0">
                                    <button class="btn btn-transparent p-0 float-right" type="button">
                                    <i class="fa fa-product-hunt fa-4x"></i>
                                    </button>
                                    <div class="text-value h4"><strong>$-{{round($totales[0]->ajustes,2)}} </strong>(<label class="text-uppercase">@php
                                        echo strftime("%B");
                                    @endphp </label>)</div>
                                    <div class="h2">Faltantes de Inventario</div>
                                </div>
                                <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                                    <a href="{{url('faltante')}}" class="small-box-footer h4">Ajustes <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <!-- Pérdidas por venta -->
                            <div class="card text-white" style="background-color: rgba(248,108,67, 1)">
                                <div class="card-body pb-0">
                                    <button class="btn btn-transparent p-0 float-right" type="button">
                                    <i class="fa fa-product-hunt fa-4x"></i>
                                    </button>
                                    <div class="text-value h4"><strong>$-{{round($totales[0]->totalventaAnulada,2)}} </strong>(<label class="text-uppercase">@php
                                        echo strftime("%B");
                                    @endphp </label>)</div>
                                    <div class="h2">Pérdidas Por Ventas Anuladas</div>
                                </div>
                                <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                                    <a href="{{url('venta')}}" class="small-box-footer h4">Ventas <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                
                            </div>
                        </div>

                    </div>

        <div class="row">
                            <div class="col-md-6 col-xs-12">
                            
                                <!-- faltantes - meses -->
                                
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Faltantes </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="faltantes">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                                </div>
                            

                            </div><!-- col-md-4 -->


                            <div class="col-md-6 col-xs-12">
                            
                                <!-- Pérdidas por venta - meses -->
                                
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Pérdidas </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="perdidasPorVentasAnuladas">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                                </div>
                            

                            </div><!-- col-md-4 -->

                            <div class="col-md-6 col-xs-12">
                            
                                <!-- Mas vendidos - meses -->
                                
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Mas Vendidos -  
                                            <label class="text-uppercase">@php echo strftime("%B");@endphp </label>
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="productosMasVendidos">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                                </div>
                            

                            </div><!-- col-md-4 -->

                            <div class="col-md-6 col-xs-12">
                            
                                <!-- Menos vendidos - meses -->
                                
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Menos Vendidos - 
                                            <label class="text-uppercase">@php echo strftime("%B");@endphp </label>
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="productosMenosVendidos">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                                </div>
                            

                            </div><!-- col-md-4 -->                  

                            <div class="col-md-6 col-xs-12">
                            
                                <!-- Compras precio por producto -->
                                
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Precio de compra por Producto - 
                                            <label class="text-uppercase">@php echo strftime("%G");@endphp </label>
                                        </h4>
                                        <div class="form-group row">
                                            <label class="form-control-label" for="nombre">Producto </label>

                                            <select class="form-control selectpicker" name="idproducto" id="idproducto" data-live-search="true" onchange="precioCompraProducto()">
                                                            
                                                    <option value="" selected>Seleccione</option>
                                                    
                                                
                                                    @foreach($productos as $prod)
                                                    
                                                            <option  value="{{$prod->id}}">{{$prod->nombre}}</option>
        
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="precioCompraPorProducto">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                                </div>
                            

                            </div><!-- col-md-4 -->

                            <div class="col-md-6 col-xs-12">
                            
                                <!-- Compras precio por producto -->
                                
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Ventas por vendedor - 
                                            <label class="text-uppercase">@php echo strftime("%G");@endphp </label>
                                        </h4>
                                        <div class="form-group row">
                                            <label class="form-control-label" for="">Vendedor:</label>

                                            <select class="form-control selectpicker" name="idvendedor" id="idvendedor" data-live-search="true" onchange="ventasPorVendedor()">
                                                            
                                                    <option value="" selected>Seleccione</option>
                                                    
                                                
                                                    @foreach($vendedores as $vendedor)
                                                    
                                                            <option  value="{{$vendedor->id}}">{{$vendedor->nombre}}</option>
        
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="ventasporvendedor">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                                </div>
                            

                            </div><!-- col-md-4 -->

                            <div class="col-md-6 col-xs-12">
                            
                                <!-- Compras precio por producto -->
                                
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Ventas por producto - 
                                            <label class="text-uppercase">@php echo strftime("%G");@endphp </label>
                                        </h4>
                                        <div class="form-group row">
                                            <label class="form-control-label" for="">Producto:</label>

                                            <select class="form-control selectpicker" name="productoVenta" id="productoVenta" data-live-search="true" onchange="ventasPorProducto()">
                                                            
                                                    <option value="" selected>Seleccione</option>
                                                    
                                                
                                                    @foreach($productosVentas as $producto)
                                                    
                                                            <option  value="{{$producto->id}}">{{$producto->nombre}}</option>
        
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="ventasporproducto">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                                </div>
                            

                            </div><!-- col-md-4 -->

                            <div class="col-md-6 col-xs-12">
                            
                                <!-- Compras por Proveedor - meses -->
                                
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h4 class="text-center">Compras a Proveedores - 
                                            <label class="text-uppercase">@php echo strftime("%G");@endphp </label>
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="ct-chart">
                                            <canvas id="comprasPorProveedor">                                                
                                            </canvas>
                                        </div>
                                    </div>
                                                
                                </div>
                            

                            </div><!-- col-md-4 -->

                        </div><!--row-->

                        
                      

                @push ('scripts')
                <script src="{{asset('js/Chart.min.js')}}"></script>

                    <script>
                    $(function () {
                        /* ChartJS
                        * -------
                        * Here we will create a few charts using ChartJS
                        */

                        //--------------
                        //- AREA CHART -
                        //--------------

                        /**inicio de compras mes */
                        
                        var varCompra=document.getElementById('compras').getContext('2d');

                            var charCompra = new Chart(varCompra, {
                                type: 'bar',
                                data: {
                                    labels: [<?php foreach ($comprasmes as $reg)
                                        { 
                                    
                                    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                                    //$mes_traducido=strftime('%B',strtotime($reg->mes));

                                    echo '"'. $reg->mes.'",';} ?>],
                                    datasets: [{
                                        label: 'Compras',
                                        data: [<?php foreach ($comprasmes as $reg)
                                            {echo ''. $reg->totalmes.',';} ?>],
                                        
                                        backgroundColor: 'rgba(77,189,116, 1)',
                                        borderColor: 'rgba(60, 160, 110, 1)',
                                        borderWidth:3
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero:true
                                            }
                                        }]
                                    }
                                }
                            });

                            /*fin compras mes* */


                        /**inicio de ventas mes */
                        var varVenta=document.getElementById('ventas').getContext('2d');

                            var charVenta = new Chart(varVenta, {
                                type: 'bar',
                                data: {
                                    labels: [<?php foreach ($ventasmes as $reg)
                                {
                                    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                                    //$mes_traducido=strftime('%B',strtotime($reg->mes));
                                    
                                    echo '"'. $reg->mes.'",';} ?>],
                                    datasets: [{
                                        label: 'Ventas',
                                        data: [<?php foreach ($ventasmes as $reg)
                                        {echo ''. $reg->totalmes.',';} ?>],
                                        backgroundColor: 'rgba(32, 168, 216, 1)',
                                        borderColor: 'rgba(20, 140, 150, 0.5)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero:true
                                            }
                                        }]
                                    }
                                }
                            });
                             /*fin ventas mes* */

                              /**inicio de FALTANTES mes */
                        var varFaltantes=document.getElementById('faltantes').getContext('2d');
                        var charFaltantes = new Chart(varFaltantes, {
                            type: 'bar',
                            data: {
                                labels: [<?php foreach ($faltantesmes as $reg)
                            {
                                setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                                //$mes_traducido=strftime('%B',strtotime($reg->mes));
                                
                                echo '"'. $reg->mes.'",';} ?>],
                                datasets: [{
                                    label: 'Faltantes',
                                    data: [<?php foreach ($faltantesmes as $reg)
                                    {echo ''. $reg->totalmes.',';} ?>],
                                    backgroundColor: 'rgba(248,108,67, 1)',
                                    borderColor: 'rgba(54, 162, 235, 0.2)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true
                                        }
                                    }]
                                }
                            }
                        });

                        /*fin FALTANTES mes* */

                        
                              /**inicio de PERDIDAS POR VENTAS ANULADAS por mes */
                            var varPerdidasVentas =document.getElementById('perdidasPorVentasAnuladas').getContext('2d');
                            var charPerdidasVentas = new Chart(varPerdidasVentas, {
                            type: 'bar',
                            data: {
                                labels: [<?php foreach ($perdidaVentaMes as $reg)
                            {
                                setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                                //$mes_traducido=strftime('%B',strtotime($reg->mes));
                                
                                echo '"'. $reg->mes.'",';} ?>],
                                datasets: [{
                                    label: 'Pérdidas Por Ventas Anuladas',
                                    data: [<?php foreach ($perdidaVentaMes as $reg)
                                    {echo ''. $reg->totalmes.',';} ?>],
                                    backgroundColor: 'rgba(248,108,67, 1)',
                                    borderColor: 'rgba(54, 162, 235, 0.2)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true
                                        }
                                    }]
                                }
                            }
                        });

                        /*fin PERDIDAS POR VENTAS ANULADAS mes* */

                          /**inicio de Productos mas vendidos mes */
                          var varProductosMasVendidos=document.getElementById('productosMasVendidos').getContext('2d');
                        var charMasVendidos= new Chart(varProductosMasVendidos, {
                            type: 'doughnut',
                            data: {
                                labels: [<?php foreach ($productosvendidos as $reg)
                            {
                                                    
                                echo '"'.intval($reg->cantidad).' '.$reg->producto.'",';} ?>],

                                datasets: [{
                                    label: 'Mas Vendidos',
                                    data: [<?php 
                                    foreach ($productosvendidos as $reg)
                                        echo ''.$reg->cantidad.',';   
                                        echo '],';
                                    ?>
                                    
                                    backgroundColor: [ 'red',
                                                       'orange',
                                                        'yellow',
                                                        'green',
                                                        'blue',
                                                        'black',
                                                        'purple',
                                                        'aqua'],
                                    hoverBackgroundColor: 'rgba(77,113,189, 1)',
                                    hoverBorderColor: 'rgba(0, 0, 0, 1)',
                                    hoverBorderWidth: 2
                                    }]
                            },
                            options: {
                               
                            }
                        });

                        /*fin Mas vendidos mes* */

                        /**inicio de Productos mas vendidos mes */
                        var varProductosMenosVendidos=document.getElementById('productosMenosVendidos').getContext('2d');
                        var charMenosVendidos= new Chart(varProductosMenosVendidos, {
                            type: 'doughnut',
                            data: {
                                labels: [<?php foreach ($productosmenosvendidos as $reg)
                            {
                                                    
                                echo '"'.intval($reg->cantidad).' '.$reg->producto.'",';} ?>],

                                datasets: [{
                                    label: 'Menos Vendidos',
                                    data: [<?php 
                                    foreach ($productosvendidos as $reg)
                                        echo $reg->cantidad.',';   
                                        echo '],';
                                    ?>
                                    backgroundColor: ['red', 'orange', 'yellow', 'green', 'blue','black', 'purple', 'aqua'],
                                    hoverBackgroundColor: 'rgba(77,113,189, 1)',
                                    hoverBorderColor: 'rgba(0, 0, 0, 1)',
                                    hoverBorderWidth: 2
                                    }]
                            },
                            options: {
                               
                            }
                        });

                        /* MENOS VENDIDOS MES*/

                        /**inicio de COMPRAS POR PROVEEDOR */
                    
                        var varComprasPorProveedor=document.getElementById('comprasPorProveedor').getContext('2d');
                        var charComprasPorProveedor= new Chart(varComprasPorProveedor, {
                            type: 'bar',
                            data: {
                                labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                        
                                datasets: [
                                    <?php 
                                    $colores = ['light','red','orange','yellow', 'green','blue','black','purple','aqua','grey','pink','cian','brown'];
                                    $meses = array(1,2,3,4,5,6,7,8,9,10,11,12);
                                    $color = 1;
                                    foreach($comprasporproveedor as $key => $prop){
                                                echo '{ 
                                                label: "'.$key.'",';
                                                echo 'backgroundColor: window.chartColors.'.$colores[$color].',';
                                                echo 'data: [';
                                            for($i=0; $i<count($meses); $i++){
                                                $valor = 0;
                                                foreach($prop as $dato){
                                                    if($meses[$i] == $dato["mes"]){
                                                        $valor = $dato["total"];
                                                        break;
                                                    }
                                                }
                                                echo $valor.',';
                                            }   
                                            
                                            echo ']
                                        },';
                                            
                                    $color++; } ?> ]
                            },
                            options: {
                                
                                    
                            }
                        });
       
                        /* COMPRAS POR PROVEEDOR*/

                      
                           
            /**inicio de Precio compra por producto mes */
                var datos = [];
                 var varPrecioCompra=document.getElementById('precioCompraPorProducto').getContext('2d');
                 window.charPrecioCompra = new Chart(varPrecioCompra, {
                           type: 'line',
                           data: {
                               datasets: [{
                                   label: 'Precio de compra: ',
                                   data: datos,
                                   backgroundColor: window.chartColors.red,
                                   borderColor: window.chartColors.black,
                                   pointRadius: 10,
                                   fill: true,
                                   lineTension: 0,
                                   borderWidth: 2
                               }]
                           },
                           options: {
                             animation: {
                                 duration: 0
                             },
                             scales: {
                                 xAxes: [{
                                    type: 'time',
                                    time: {
                                        displayFormats: {
                                        'millisecond': 'MMM DD',
                                        'second': 'MMM DD',
                                        'minute': 'MMM DD',
                                        'hour': 'MMM DD',
                                        'day': 'MMM DD',
                                        'week': 'MMM DD',
                                        'month': 'MMM DD',
                                        'quarter': 'MMM DD',
                                        'year': 'MMM DD',
                                        }
                                    }
                                 }],
                                 yAxes: [{
                                     gridLines: {
                                         drawBorder: false
                                     },
                                     scaleLabel: {
                                         display: true,
                                         labelString: 'Precio Compra ($)'
                                     }
                                 }]
                             },
                             tooltips: {
                                 intersect: false,
                                 mode: 'index',
                                 callbacks: {
                                     label: function(tooltipItem, myData) {
                                         console.log(tooltipItem);
                                         console.log(myData);

                                         var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                                         if (label) {
                                             label += ': ';
                                         }
                                         label += parseFloat(tooltipItem.yLabel).toFixed(2);
                                         return label;
                                     }
                                 }
                             }     
                         
                           }
                       });

                              /*fin precio compra por producto */

                    /**inicio de Precio compra por producto mes */
                    var ventas = [];
                    var varVentasPorVendedor = document.getElementById('ventasporvendedor').getContext('2d');
                    window.charVentasPorVendedor = new Chart(varVentasPorVendedor, {
                           type: 'line',
                           data: {
                               datasets: [{
                                   label: 'Ventas: ',
                                   data: ventas,
                                   backgroundColor: window.chartColors.red,
                                   borderColor: window.chartColors.black,
                                   pointRadius: 10,
                                   fill: true,
                                   lineTension: 0,
                                   borderWidth: 2
                               }]
                           },
                           options: {
                             animation: {
                                 duration: 0
                             },
                             scales: {
                                 xAxes: [{
                                    type: 'time',
                                    time: {
                                        displayFormats: {
                                        'millisecond': 'MMM DD',
                                        'second': 'MMM DD',
                                        'minute': 'MMM DD',
                                        'hour': 'MMM DD',
                                        'day': 'MMM DD',
                                        'week': 'MMM DD',
                                        'month': 'MMM DD',
                                        'quarter': 'MMM DD',
                                        'year': 'MMM DD',
                                        }
                                    }
                                 }],
                                 yAxes: [{
                                     gridLines: {
                                         drawBorder: false
                                     },
                                     scaleLabel: {
                                         display: true,
                                         labelString: 'Total Vendido ($)'
                                     }
                                 }]
                             },
                             tooltips: {
                                 intersect: false,
                                 mode: 'index',
                                 callbacks: {
                                     label: function(tooltipItem, myData) {
                                         console.log(tooltipItem);
                                         console.log(myData);

                                         var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                                         if (label) {
                                             label += ': ';
                                         }
                                         label += parseFloat(tooltipItem.yLabel).toFixed(2);
                                         return label;
                                     }
                                 }
                             }     
                         
                           }
                       });

                              /*fin Total ventas por vendedor */ 
                              
                              
                         /**inicio ventas por producto  */
                    var ventasProducto = [];
                    var varVentasPorProducto = document.getElementById('ventasporproducto').getContext('2d');
                    window.charVentasPorProducto = new Chart(varVentasPorProducto, {
                           type: 'line',
                           data: {
                               datasets: [{
                                   label: 'Ventas: ',
                                   data: ventasProducto,
                                   backgroundColor: window.chartColors.red,
                                   borderColor: window.chartColors.black,
                                   pointRadius: 10,
                                   fill: true,
                                   lineTension: 0,
                                   borderWidth: 2
                               }]
                           },
                           options: {
                             animation: {
                                 duration: 0
                             },
                             scales: {
                                 xAxes: [{
                                    type: 'time',
                                    time: {
                                        displayFormats: {
                                        'millisecond': 'MMM DD',
                                        'second': 'MMM DD',
                                        'minute': 'MMM DD',
                                        'hour': 'MMM DD',
                                        'day': 'MMM DD',
                                        'week': 'MMM DD',
                                        'month': 'MMM DD',
                                        'quarter': 'MMM DD',
                                        'year': 'MMM DD',
                                        }
                                    }
                                 }],
                                 yAxes: [{
                                     gridLines: {
                                         drawBorder: false
                                     },
                                     scaleLabel: {
                                         display: true,
                                         labelString: 'Total Vendido ($)'
                                     }
                                 }]
                             },
                             tooltips: {
                                 intersect: false,
                                 mode: 'index',
                                 callbacks: {
                                     label: function(tooltipItem, myData) {
                                         console.log(tooltipItem);
                                         console.log(myData);

                                         var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                                         if (label) {
                                             label += ': ';
                                         }
                                         label += parseFloat(tooltipItem.yLabel).toFixed(2);
                                         return label;
                                     }
                                 }
                             }     
                         
                           }
                       });

                              /*fin Total ventas por producto */      

                    });
                    </script>
                @endpush

            </div>
           
                
        </main>

@endsection
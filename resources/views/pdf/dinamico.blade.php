<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Dinámico</title>   
    
    <style>
    .datagrid table { 
        border-collapse: collapse; 
        text-align: left; 
        width: 100%; 
    } 
    .datagrid {
        font: normal 12px/150% Verdana, Arial, Helvetica, sans-serif; 
        background: #fff; 
        overflow: hidden; 
        border: 1px solid #000000; 
        -webkit-border-radius: 10px; 
        -moz-border-radius: 10px; 
        border-radius: 10px; 
    }
    .datagrid table td, .datagrid table th { 
        padding: 3px 10px; 
    }
    .datagrid table thead th {
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #FFFFFF), color-stop(1, #FFFFFF) );
        background:-moz-linear-gradient( center top, #FFFFFF 5%, #FFFFFF 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#FFFFFF');
        background-color:#FFFFFF; 
        color:#000000; 
        font-size: 15px; 
        font-weight: bold; 
        border-left: 1px solid #000000; 
    } 
    .datagrid table thead th { 
        border: 1px solid #000000; 
    }
    .datagrid table tbody td { 
        color: #000000; 
        border-left: 1px solid #E1EEF4;
        font-size: 11px;
        font-weight: normal; 
    }
    .datagrid table tbody td { 
        border: 1px solid #000000;
    }
    .datagrid table tbody tr:last-child td th{ 
        border-bottom: 1px solid #000000;
    }
    .datagrid table tfoot td div { 
        border-top: 1px solid #000000;        
        background: #E1EEF4;
    } 
    .datagrid table tfoot td { 
        padding: 0; 
        font-size: 10px 
    } 
    .datagrid table tfoot td div{ 
        padding: 0px;
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    </style>
   <body class="container">
      <table style="width:100%;">
         <tr style="text-align:left">
             <td width="180px">
             <font size="3">
                 Emision: {{$emision}}<br>
                 Usuario: {{$usuario}}
             </font>
             </td>                
             <td  style="text-align:center">
                 <img src="{{asset('img')."/".env('ICONO_LOGO')}}" width="100">
             </td>
         </tr>
         <tr style="vertical-align: middle;">
            <td colspan="2">
               <h1 style="text-align: center; vertical-align: middle; padding-top: 50px;">REPORTE DÍNAMICO</h1>
            </td>
         </tr>
     </table>
     <br>

         <div class="datagrid">
                  <table>
                   
                     <tbody style="border-bottom: 3px; color: black;">
                        <tr style="background-color: black; color: white; border: 2px; padding:10px;">
                           <th>Padrón</th>
                           <th>Nomenclatura</th>
                           <th>RUD</th>
                           <th>Titulares</th>
                           <th>Superficies</th>
                           <th>Avalúo</th>
                           <th>Mejoras</th>
                           <th>Estado</th>
                           <th>Clasificación</th>
                        </tr>
                        @foreach ($resultado as $item)
                        <tr>
                           <td><a class=" rounded text-primary" href="{{url('gestion/padron',$item->parcela_id)}}">{{$item->parcela_padron}}</a></td>
                           <td><label class="rounded">{{$item->parcela_nomenclatura}}</label></td>
                           <td><label class=" rounded">{{$item->direccion_nomencla_rud_real}}</label></td>
                           <td>
                              @if (count($item->personas($item->parcela_id))>0)
                                 @foreach ($item->personas($item->parcela_id) as $titular)
                                 <a href="{{url('gestion/personas?persona_id='.$titular->persona_id)}}" class="form-control text-primary rounded">
                                       {{$titular->persona_denominacion}} 
                                 </a>
                                 
                                 @endforeach                                       
                              @else
                                    <p class="text-catastro text-uppercase text-center"> - </p>
                              @endif
                           </td>
                           <td>
                           
                                 <div class="input-group mt-2">
                                    <div class="input-group-addon">
                                       <u>Sup. Mensura:</u>
                                    </div>
                                    <label class="form-control rounded">{{$item->parcela_super_mensura??0}}</label>
                                 </div>

                                 <div class="input-group mt-2">
                                    <div class="input-group-addon">
                                       <u>Sup. Título:</u>
                                    </div>
                                    <label class="form-control rounded">{{$item->parcela_super_titulo??0}}</label>
                                 </div>


                           </td>
                           <td><label class=" rounded">{{$item->parcela_avaluo??0}}</label></td>
                           <td>
                              @if (count($item->mejoras($item->parcela_id)) > 0)
                                 <div class="datagrid">
                                    <table>
                                       <thead>
                                          <tr>
                                             <th >Exp:</th>
                                             <th>Tipo:</th>
                                             <th>Sup:</th>
                                             <th>Estado:</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @foreach ($item->mejoras($item->parcela_id) as $mejora)
                                             <tr>
                                                <td>{{$mejora->mejora_nro_exp}}</td>
                                                <td>{{$mejora->tipo_mejora_descrip}}</td>
                                                <td>{{$mejora->mejora_sup_cub}}</td>
                                                <td>{{$mejora->tipo_mejora_estado_descrip}}</td>
                                             </tr>
                                          @endforeach
                                       </tbody>
                                    </table>
                                 </div>
                              @else
                                 <p class="text-catastro text-uppercase text-center"> - </p>
                              @endif
                           </td>
                           <td><label class=" rounded">{{$item->tipo_estado_codigo." - ".$item->tipo_estado_parcela}}</label></td>
                           <td><label class=" rounded">{{$item->tipo_ryb}}</label></td>
                        </tr> 
                        @endforeach
                        
                     </tbody>
                  </table>
      </table>
   </body>
</html>
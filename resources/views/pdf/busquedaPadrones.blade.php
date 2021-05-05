@inject('controlador', 'App\Http\Controllers\ParcelaController')
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Padrones</title>   
    
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
               <h1 style="text-align: center; vertical-align: middle; padding-top: 50px;">LISTADO DE PADRONES SEGÚN CONSULTA</h1>
            </td>
         </tr>
     </table>
     <br>

         <div class="datagrid">
                  <table>
                   
                     <tbody style="border-bottom: 3px; color: black;">
                        <tr style="background-color: black; color: white; border: 2px; padding:10px;">
                           <th>Padrón</th>
                           <th>Padrón Origen</th>
                           <th>Nomenclatura</th>
                           <th>Titulares</th>
                           <th>Avalúo</th>
                           <th>Fracción</th>
                           <th>Estado</th>
                        </tr>
                        @if ($parcelas->count() > 0)
                           @foreach ($parcelas as $parcela)
                                   
                              <tr>
                                 <td>@isset($parcela->parcela_id)<a href="{{url('gestion/padron',$parcela->parcela_id)}}">@endisset<b>{{$parcela->parcela_padron}}</b></a></td>
                                 <td>  
                                    @isset($parcela->parcela_id)
                                       @php
                                          $parcelas_origen = $controlador->parcelas_origen($parcela->parcela_id);
                                       @endphp
                                       @if (count($parcelas_origen) >0)
                                                @foreach ($parcelas_origen as $item)
                                                   @isset($item->parcela_id)
                                                      @if ($item->parcela_id != 0 && $item->parcela_id != null)
                                                         <a href="{{url('gestion/padron',$item->parcela_origen->parcela_id)}}">
                                                            
                                                               {{$item->parcela_origen->parcela_padron}}
                                                         
                                                         </a> <br/> 
                                                      @else
                                                            <p class="text-catastro text-uppercase">Sin Origen</p>
                                                      @endif
                                                   @endisset
                                                @endforeach
                                    
                                       @else
                                          <p class="text-catastro text-uppercase">Sin Origen</p>
                                       @endif
                                    @endisset
                                 </td>
                                 <td>
                                    {{$parcela->parcela_nomenclatura}}
                                 </td>
                                 <td>  
                                       @php
                                             $titulares = $controlador->titulares($parcela->parcela_id);
                                       @endphp
                                       @if (count($titulares) >1)
                                             <div class="collapse" id="collapsePersonas{{$parcela->parcela_id}}">
                                                @foreach ($titulares as $item)
                                                      <a href="{{url('gestion/personas?persona_id='.$item->persona_id)}}">
                                                         {{$item->persona_denominacion}} 
                                                      </a> <br/>
                                                @endforeach
                                          </div>
                                       @elseif(count($titulares) == 1)
                                          @foreach ($titulares as $item)
                                             <a href="{{url('gestion/personas?persona_id='.$item->persona_id)}}" >
                                                   {{$item->persona_denominacion}}
                                                </a> <br/>
                                          @endforeach
                                       @else
                                          <p class="text-catastro text-uppercase text-center"> - </p>
                                       @endif
                                 
                                 </td>
                                 <td>
                                    @if (isset($parcela->parcela_avaluo) &&  $parcela->parcela_avaluo != "")
                                          {{$parcela->parcela_avaluo}}
                                    @else
                                    <p class="text-catastro text-uppercase text-center"> - </p>
                                    @endif
                                 
                                 </td>
                                 <td>
                                    @if (isset($parcela->parcela_fraccion_ori) &&  $parcela->parcela_fraccion_ori != "")
                                       {{$parcela->parcela_fraccion_ori}}
                                    @else
                                    <p class="text-catastro text-uppercase text-center"> - </p>
                                    @endif
                                 </td>
                                 <td>
                                    {{$parcela->tipo_estado_codigo}} - {{$parcela->tipo_estado_parcela}}
                                 </td>
                              </tr>
                           @endforeach
                        @else
                        <tr>
                           <td colspan="9"><b class="text-catastro">No se encontraron registros</b></a></td>
                        </tr>
                        @endif
                        
                     </tbody>
                  </table>
      </table>
   </body>
</html>
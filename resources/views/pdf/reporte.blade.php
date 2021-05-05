<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte General</title>   
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
    #watermark {
        position: relative;
        overflow: hidden;
    }
    #watermark p {
        position: absolute;
        top: 450;
        left: 40;
        color: rgba(133, 133, 133, 0.316);
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 72px;
        pointer-events: none;
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
    }
    </style>
    <body>
        <div id="watermark">
            <p>CATASTRO LAS HERAS</p>
            <main>
                <table style="width:100%" border="0">
                    <tr style="text-align:left">
                        <td width="43%">
                            <font size="2">
                                Emision: {{$emision}}<br>
                                Usuario: {{$usuario}}
                            </font>
                        </td>                
                        <td  style="text-align:left">
                            <img src="{{asset('img')."/".env('ICONO_LOGO')}}" width="140px">
                        </td>
                    <tr>
                </table>
                <br>
                <table style="width:100%">
                    <tr>
                        <td style="width:30%">
                            <div class="datagrid">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>PADRON</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td style="text-align:center"><font size="3"><b>{{$parcela->parcela_padron}}</b></font></td>
                                        </tr>      
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td style="width:100%">
                            <div class="datagrid">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>NOMENCLATURA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align:center"><font size="3"><b>{{$parcela->parcela_nomenclatura}}</b></font></td>
                                        </tr>      
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <table style="width:100%">
                    <tr>
                        <td>
                        <div class="datagrid">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Fraccion</th>
                                            <th>Padrón Rentas</th>
                                            <th>Fecha de Alta</th>
                                            <th>Fecha de Modificación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$parcela->parcela_fraccion_ori}}</td>
                                            <td>{{$parcela->parcela_padron_terr}}</td>
                                            <td>{{$parcela_f_alta}}</td>
                                            <td>{{$parcela_f_proceso}}</td>
                                        </tr>      
                                    </tbody>         
                                    
                                    <thead>
                                        <tr>
                                            <th>Sup Mensura</th>
                                            <th>Sup Titulo</th>
                                            <th>Sup Cultivada</th>
                                            <th>Sup Libre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                                    
                                            <td height="18px">{{$parcela->parcela_super_mensura}}</td>
                                            <td>{{$parcela->parcela_super_titulo}}</td>
                                            <td>{{$parcela->parcela_super_cultivada}}</td>
                                            <td>{{$parcela->parcela_super_libre}}</td>
                                        </tr>      
                                    </tbody>                       
                                    
                                    <thead>
                                        <tr>
                                            <th colspan='2'>Sup % Común</th>
                                            <th colspan='2'>Padrón Pasaje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan='2' height="18px">{{$parcela->parcela_porc_comun}}</td>
                                            <td colspan='2'>{{$parcela->parcela_padron_pasaje}}</td>
                                        </tr>      
                                    </tbody> 

                                    <thead>
                                        <tr>
                                            <th colspan='2'>Plano N°</th>
                                            <th>Plano Fecha</th>
                                            <th>Cant. Frentes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan='2' height="18px">{{$parcela->parcela_plano_nro}}</td>
                                            <td>{{$parcela_plano_fecha}}</td>
                                            <td>{{$parcela->parcela_cant_frentes}}</td>
                                        </tr>      
                                    </tbody> 

                                    <thead>
                                        <tr>
                                            <th>Med Lateral N°</th>
                                            <th>Med Lateral S°</th>
                                            <th>Med Lateral E°</th>
                                            <th>Med Lateral O°</th>
                                        </tr>
                                    </thead>
                                            
                                    <tbody>
                                        <tr>
                                            <td height="18px">{{$parcela->parcela_lateral_norte}}</td>
                                            <td>{{$parcela->parcela_lateral_sur}}</td>
                                            <td>{{$parcela->parcela_lateral_este}}</td>
                                            <td>{{$parcela->parcela_lateral_oeste}}</td>
                                        </tr>      
                                    </tbody>   

                                    <thead>
                                        <tr>
                                            <th colspan='2'>Ochava</th>
                                            <th colspan='2'>Punto Cardinal Frente</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan='2' height="18px">{{$parcela->parcela_ochava}}</td>
                                            <td colspan='2'>{{$parcela->parcela_lado_frente}}</td>
                                        </tr>
                                    </tbody>

                                    <thead>
                                        <tr>
                                            <th>Es Esquina</th>
                                            <th>Es Baldio</th>
                                            <th>Es Cochera</th>
                                            <th>Es PH</th>
                                        </tr>
                                                                                          
                                    </thead>
                                    
                                    <tbody>
                                        <tr>
                                            <td height="18px">{{ ($parcela->es_esquina == 1)?'SI':'NO'}}</td>
                                            <td height="18px">{{ ($parcela->es_baldio == 1)?'SI':'NO'}}</td>
                                            <td height="18px">{{ ($parcela->es_cochera == 1)?'SI':'NO'}}</td>
                                            <td height="18px">{{ ($parcela->es_ph == 1)?'SI':'NO'}}</td>
                                        </tr>
                                    </tbody>

                                    <thead>
                                        <tr>
                                            <th colspan='2'>Destino</th>
                                            <th colspan='2'>Zona</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan='2' height="18px">{{$parcela->tipo_parcela_destino_abrev}} - {{$parcela->tipo_parcela_destino_descrip}}</td>
                                            <td colspan='2' height="18px">{{$parcela->tipo_parcela_zona_cod}} - {{$parcela->tipo_parcela_zona_descrip}}</td>
                                        </tr>
                                    </tbody>

                                    <thead>
                                        <tr>
                                            <th colspan='4'>Estado de la Parcela</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan='4' style="18px">{{$parcela->tipo_parcela_estado_codigo}} - {{$parcela->tipo_parcela_estado_descrip}}</td>
                                        </tr>
                                    </tbody>     

                                    <thead>
                                        <tr>
                                            <th colspan='4'>SERVICIOS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan='4' style="18px">{{$listado_servicios}}</td>
                                        </tr>
                                    </tbody>                            

                                </table>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="datagrid">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan='7' style="text-align:center">DIRECCION REAL</th>
                                        </tr>
                                    </thead>
                                    @if(empty($direccion_real))
                                        <tr>
                                            <td colspan="7" style="text-align:center">NO TIENE DIRECCION REAL REGISTRADA</td>
                                        </tr>
                                    @else
                                        <thead>
                                            <tr>
                                                <th colspan='4'>Calle</th>
                                                <th>Puerta</th>
                                                <th>Piso</th>
                                                <th>Depto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan='4'>{{$direccion_real->direccion_calle}}</td>
                                                <td>{{$direccion_real->direccion_numeracion}}</td>
                                                <td>{{$direccion_real->direccion_piso}}</td>
                                                <td>{{$direccion_real->direccion_depto}}</td>
                                            </tr>      
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th colspan='4'>Barrio</th>
                                                <th>Mzana</th>
                                                <th>Casa</th>
                                                <th>Lote</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan='4'>{{$direccion_real->barrio_nombre}}</td>
                                                <td>{{$direccion_real->direccion_manzana}}</td>
                                                <td>{{$direccion_real->direccion_casa}}</td>
                                                <td>{{$direccion_real->direccion_lote}}</td>
                                            </tr>      
                                        </tbody>            

                                        <thead>
                                            <tr>
                                                <th>Torre</th>
                                                <th>Local</th>
                                                <th>Area</th>
                                                <th>Codigo Postal</th>
                                                <th colspan='4'>Distrito - Localidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$direccion_real->direccion_torre}}</td>
                                                <td>{{$direccion_real->direccion_local}}</td>
                                                <td>{{$direccion_real->direccion_area}}</td>
                                                <td>{{$direccion_real->direccion_cp}}</td>
                                                <td colspan='4'>{{$direccion_real->distrito_nombre}}</td>
                                            </tr>      
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </td>
                    </tr>
<!--
                    <tr>
                        <td>
                            <div class="datagrid">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan='7' style="text-align:center">DIRECCION POSTAL</th>
                                        </tr>
                                    </thead>
                                    @if(empty($direccion_postal))
                                        <tr>
                                            <td colspan="7" style="text-align:center">NO TIENE DIRECCION POSTAL REGISTRADA</td>
                                        </tr>
                                    @else
                                        <thead>
                                            <tr>
                                                <th colspan='4'>Calle</th>
                                                <th>Puerta</th>
                                                <th>Piso</th>
                                                <th>Depto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan='4'>{{$direccion_postal->direccion_calle}}</td>
                                                <td>{{$direccion_postal->direccion_numeracion}}</td>
                                                <td>{{$direccion_postal->direccion_piso}}</td>
                                                <td>{{$direccion_postal->direccion_depto}}</td>
                                            </tr>      
                                        </tbody>   
                        
                                        <thead>
                                            <tr>
                                                <th colspan='4'>Barrio</th>
                                                <th>Mzana</th>
                                                <th>Casa</th>
                                                <th>Lote</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan='4'>{{$direccion_postal->barrio_nombre}}</td>
                                                <td>{{$direccion_postal->direccion_manzana}}</td>
                                                <td>{{$direccion_postal->direccion_casa}}</td>
                                                <td>{{$direccion_postal->direccion_lote}}</td>
                                            </tr>      
                                        </tbody>            
                                        <thead>
                                            <tr>
                                                <th>Torre</th>
                                                <th>Local</th>
                                                <th>Area</th>
                                                <th>Codigo Postal</th>
                                                <th colspan='4'>Distrito - Localidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$direccion_postal->direccion_torre}}</td>
                                                <td>{{$direccion_postal->direccion_local}}</td>
                                                <td>{{$direccion_postal->direccion_area}}</td>
                                                <td>{{$direccion_postal->direccion_cp}}</td>
                                                <td colspan='4'>{{$direccion_postal->distrito_nombre}}</td>
                                            </tr>      
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th colspan='8'>Provincia</th>
                                            </tr>
                                        </thead>                                
                                        <tbody>
                                            <tr>
                                                <td colspan='8'>{{$direccion_postal->provincia_nombre}}</td>
                                            </tr>      
                                        </tbody>                                
                                    @endif
                                </table>
                            </div>
                        </td>
                    </tr>
                -->
                    <tr>
                        <td>
                            <div class="datagrid">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan='7' style="text-align:center">MEJORAS</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th>Expediente</th>
                                            <th>Fecha</th>
                                            <th>Uso</th>
                                            <th>Tipo</th>
                                            <th>Destino</th>
                                            <th>Categoria</th>
                                            <th>Superficie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(empty($mejoras->all()))
                                            <tr>
                                                <td colspan="7" style="text-align:center">NO TIENE MEJORAS REGISTRADAS</td>
                                            </tr>
                                        @else
                                            @foreach($mejoras as $mejora)
                                            <tr>
                                                <td>{{$mejora->mejora_nro_exp}}-{{$mejora->mejora_letra_exp}}-{{\Carbon\Carbon::parse($mejora->mejora_fecha_exp)->format('Y')}}</td>
                                                <td>{{\Carbon\Carbon::parse($mejora->mejora_fecha_exp)->format('d/m/Y')}}</td>
                                                <td>{{$mejora->tipo_mejora_uso_descrip}}</td>
                                                <td>{{$mejora->tipo_mejora_estado_descrip}}</td>
                                                <td>{{$mejora->tipo_mejora_destino_descrip}}</td>
                                                <td>{{$mejora->tipo_mejora_categoria_descrip}}</td>
                                                <td>{{$mejora->mejora_sup_cub}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>            
                                </table>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="datagrid">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan='6' style="text-align:center">TITULARES</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th>Figura</th>
                                            <th>Tipo</th>
                                            <th>Denominación</th>
                                            <th>Documento</th>
                                            <th>CUIT/CUIL</th>
                                            <th>Principal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(empty($titulares->all()))
                                            <tr>
                                                <td colspan="7" style="text-align:center">NO TIENE TITULARES REGISTRADOS</td>
                                            </tr>
                                        @else
                                            @foreach($titulares as $titular)
                                            <tr>
                                                <td>{{$titular->tipo_persona_parcela_descrip}}</td>
                                                <td>{{$titular->tipo_persona_descrip}}</td>
                                                <td>{{$titular->persona_denominacion}}</td>
                                                <td>{{$titular->persona_nro_doc}}</td>
                                                <td>{{$titular->persona_cuit}}</td>
                                                <td style="text-align:center">
                                                    @if($titular->persona_parcela_ppal == 1)
                                                        SI
                                                    @else
                                                        NO
                                                    @endif                                            
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>            
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                @if(!empty($urlImg))
                <div style="page-break-after:always;"></div>
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="text-align:center">
                            <img src='{{$urlImg}}'/>
                        </td>
                    </tr>
                </table>
                @endif
            </main>
        </div>
    </body>
</html>
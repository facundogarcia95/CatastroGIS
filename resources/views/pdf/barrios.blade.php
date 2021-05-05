<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LISTADO DE BARRIOS</title>   
    
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
               <h1 style="text-align: center; vertical-align: middle; padding-top: 50px;">REPORTE DE BARRIOS</h1>
            </td>
         </tr>
     </table>
     <br>

         <div class="datagrid">
                  <table>
                   
                     <tbody style="border-bottom: 3px; color: black;">
                        <tr style="background-color: black; color: white; border: 2px; padding:10px;">
                           <th>NOMBRE</th>
                           <th>NOMBRE ALT.</th>
                           <th>DISTRITO</th>
                           <th>ESTADO</th>
                           <th>DOMINIO</th>
                           <th>FUENTE</th>
                           <th>NRO PLANO</th>
                           <th>EXPEDIENTE</th>
                           <th>OBSERVACION</th>
                        </tr>
                        @foreach ($resultado as $item)
                        <tr>
                           <td><label class="rounded">{{$item->barrio_nombre}}</label></td>
                           <td><label class="rounded">{{$item->nombre_alternativo}}</label></td>
                           <td><label class="rounded">{{$item->distrito}}</label></td>
                           <td><label class="rounded">{{$item->estado_barrio}}</label></td>
                           <td><label class="rounded">{{$item->dominio_barrio}}</label></td>
                           <td><label class="rounded">{{$item->fuente_barrio}}</label></td>
                           <td><label class=" rounded">{{$item->nro_plano_barrio?:0}}</label></td>
                           <td><label class=" rounded">{{$item->expediente_barrio}}</label></td>
                           <td><label class=" rounded">{{$item->observacion}}</label></td>
                        </tr> 
                        @endforeach
                        
                     </tbody>
                  </table>
      </table>
   </body>
</html>
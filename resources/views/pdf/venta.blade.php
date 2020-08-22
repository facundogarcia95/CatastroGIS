<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de venta</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
 
 
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }
 
        #encabezado{
        text-align: center;
        margin-left: 15%;
        margin-right: 15%;
        font-size: 15px;
        }
 
        #fact{
        /*position: relative;*/
        float: right;
        font-size: 20px;
        background:#D2691E;
        border-radius: 10px;  
        }
 
        section{
        clear: left;
        }
 
        #cliente{
        text-align: left;
        }
 
        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }
 
        #facliente thead{
        padding: 20px;
        background:#D2691E;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facvendedor thead{
        padding: 20px;
        background: #D2691E;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facproducto{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facproducto thead{
        padding: 20px;
        background: #D2691E;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
      
        }
 
       
    </style>
    <body>
        @foreach ($venta as $v)
        <header>
            <!--<div id="logo">
                <img src="img/logo.png" alt="" id="imagen">
            </div>-->

            <div>
                
                <table id="datos">
                    <thead>                        
                        <tr>
                            <th id="">DATOS DEL CLIENTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p >Nombre: {{$v->nombre}}<br>
                            Tipo: {{$v->tipo_identificacion}}<br/>
                            N° Comprobante: {{$v->num_venta}}<br>
                            Dirección: {{$v->direccion}}<br>
                            Teléfono: {{$v->telefono}}<br>
                            Email: {{$v->email}}</</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div id="fact">
                <p>&nbsp;{{$v->tipo_identificacion}} &nbsp;<br>
                    &nbsp;N°: {{$v->num_venta}}&nbsp;</p>
            </div>
        </header>
        <br>
       
        @endforeach
        <br>
       
        <section>
            <div>
                <table id="facproducto">
                    <thead>
                        <tr id="fa">
                            <th>CANTIDAD</th>
                            <th>PRODUCTO</th>
                            <th>PRECIO VENTA ($)</th>
                            <th>DESCUENTO (%)</th>
                            <th>SUBTOTAL ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $det)
                        <tr>
                            <td>{{$det->cantidad}}</td>
                            <td>{{$det->producto}}</td>
                            <td>${{$det->precio}}</td>
                            <td>{{$det->descuento}}</td>
                            <td>${{number_format($det->cantidad*$det->precio - $det->cantidad*$det->precio*$det->descuento/100,2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @foreach ($venta as $v)
                        <tr>
                           <th colspan="4"><p align="right">TOTAL:</p></th>
                           <td><p align="right">${{number_format($v->total,2)}}</p></td>
                        </tr>
                        
                        @if($v->impuesto > 0)
                            <tr>
                                <th colspan="4"><p align="right">TOTAL IMPUESTO ({{$v->impuesto}}%):</p></th>
                                <td><p align="right">${{number_format($v->total*($v->impuesto)/100,2)}}</p></td>
                            </tr>
                        @endif

                        <tr>
                            <th  colspan="4"><p align="right">TOTAL PAGAR:</p></th>            
                            @if($v->impuesto > 0)
                                <td><p align="right">${{number_format($v->total+($v->total*($v->impuesto)/100),2)}}</p></td>
                            @else
                                <td><p align="right">$ {{number_format($v->total,2)}}</p></td>
                            @endif
                        </tr>

                        @endforeach
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <!--puedes poner un mensaje aqui-->
            <div id="datos">
                <p id="encabezado">
                    @foreach ($negocio as $neg => $val)
                        
                       @if($val != null && $neg != "id" && $neg != "impuesto" && $neg != "logo" && $neg != "created_at" && $neg != "updated_at")
                        
                       @if($neg == "Nombre")
                            <b>{{$val}}</b><br>
                        @else
                            {{$neg}}: {{$val}}<br>
                        @endif

                       @endif

                    @endforeach
                   
                </p>
            </div>
        </footer>
    </body>
</html>
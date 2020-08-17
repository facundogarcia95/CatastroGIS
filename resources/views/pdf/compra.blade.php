<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de compra</title>
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
        margin-left: 35%;
        margin-right: 35%;
        font-size: 15px;
        }
 
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        background:#33AFFF;
        border-radius: 10px;  
        }
 
        section{
        clear: left;
        }
 
        #cliente{
        text-align: left;
        }
 
        #faproveedor{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }
 
        #faproveedor thead{
        padding: 20px;
        background:#33AFFF;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #faccomprador{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #faccomprador thead{
        padding: 20px;
        background: #33AFFF;
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
        background: #33AFFF;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
    
    </style>
    <body>
        @foreach ($compra as $v)
        <header>
            <!--<div id="logo">
                <img src="img/logo.png" alt="" id="imagen">
            </div>-->
         
             <div>
                
                <table id="datos">
                    <thead>                        
                        <tr>
                            <th id="">DATOS DEL PROVEEDOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="proveedor">Nombre: {{$v->nombre}}<br>
                            {{$v->tipo_identificacion}}: {{$v->num_compra}}<br>
                            Dirección: {{$v->direccion}}<br>
                            Teléfono: {{$v->telefono}}<br>
                            Email: {{$v->email}}</</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div id="fact">
                <p>&nbsp;{{$v->tipo_identificacion}} COMPRA &nbsp;<br/>
                    &nbsp;N° Compra: {{$v->num_compra}}&nbsp;</p>
            </div>
        </header>
        <br>
        
        @endforeach
        <br>
        <section>
            <div>
                <table id="faccomprador">
                    <thead>
                        <tr id="fv">
                            <th>COMPRADOR</th>
                            <th>FECHA COMPRA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$v->usuario}}</td>
                            <td>{{$v->created_at}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facproducto">
                    <thead>
                        <tr id="fa">
                            <th>CANTIDAD</th>
                            <th>PRODUCTO</th>
                            <th>PRECIO COMPRA ($)</th>
                            <!--<th>CANTIDAD*PRECIO</th>-->
                            <th>SUBTOTAL ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $det)
                        <tr>
                            <td>{{$det->cantidad}}</td>
                            <td>{{$det->producto}}</td>
                            <td>${{$det->precio}}</td>
                            <!--<td>${{$det->cantidad*$det->precio}}</td>-->
                            <td>${{number_format($det->cantidad*$det->precio,2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @foreach ($compra as $c)
                        <tr>
                           <th colspan="3"><p align="right">TOTAL:</p></th>
                            <td><p align="right">${{number_format($c->total)}}<p></td>
                        </tr>

                        @if($c->impuesto > 0)
                        <tr>
                            <th colspan="3"><p align="right">TOTAL IMPUESTO ({{$c->impuesto}}%):</p></th>
                            <td><p align="right">$ {{number_format($c->total*$c->impuesto/100,2)}}</p></td>
                        </tr>
                        @endif

                        <tr>
                            <th  colspan="3"><p align="right">TOTAL PAGAR:</p></th>
                            @if($c->impuesto > 0)
                                <td><p align="right">$ {{number_format($c->total+($c->total*$c->impuesto/100),2)}}</p></td>
                            @else
                            <td><p align="right">$ {{number_format($c->total,2)}}</p></td>
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
                        
                       @if($val != null && $neg != "id" && $neg != "impuesto" && $neg != "logo")
                        
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
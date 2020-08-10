

function precioCompraProducto(){

    id_producto= $("#idproducto").val();
    token =  $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: "POST",
        url: "ajax-consultas",
        data: {_token: token, funcion: 'precio_compra_por_producto',idproducto: id_producto},
        dataType: "json",
        success: function (response) {
        
            if(response.length>0){

                datos = [];

                for(i=0; i<response.length; i++){

                    dato = {t:response[i].t, y: response[i].y}
                    datos.push(dato);
                }    

                var dataset = charPrecioCompra.config.data.datasets[0];
                dataset.data = datos;	
                charPrecioCompra.update();
           }else{

            datos = [];
            var dataset = charPrecioCompra.config.data.datasets[0];
            dataset.data = datos;	
            charPrecioCompra.update();

            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'El producto seleccionado no tiene compras registradas',
              
                })
       }

        },error: function (response) {
            console.log(response);
        }
    });
}

function ventasPorVendedor(){

    idvendedor= $("#idvendedor").val();
    token =  $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: "POST",
        url: "ajax-consultas",
        data: {_token: token, funcion: 'ventas_por_vendedor',idvendedor: idvendedor},
        dataType: "json",
        success: function (response) {
        
            if(response.length>0){

                ventas = [];

                for(i=0; i<response.length; i++){

                    dato = {t:response[i].t, y: response[i].y}
                    ventas.push(dato);
                }    

                var dataset = charVentasPorVendedor.config.data.datasets[0];
                dataset.data = ventas;	
                charVentasPorVendedor.update();
           
            }else{
                ventas = [];
                var dataset = charVentasPorVendedor.config.data.datasets[0];
                dataset.data = ventas;	
                charVentasPorVendedor.update();

                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'El vendedor seleccionado no tiene ventas registradas',
                  
                    })
           }

        },error: function (response) {
            console.log(response);
        }
    });

}



function ventasPorProducto(){

    idproducto= $("#productoVenta").val();
    token =  $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: "POST",
        url: "ajax-consultas",
        data: {_token: token, funcion: 'ventas_por_producto',idproducto: idproducto},
        dataType: "json",
        success: function (response) {
        
            if(response.length>0){

                ventasProducto = [];

                for(i=0; i<response.length; i++){

                    dato = {t:response[i].t, y: response[i].y}
                    ventasProducto.push(dato);
                }    

                var dataset = charVentasPorProducto.config.data.datasets[0];
                dataset.data = ventasProducto;	
                charVentasPorProducto.update();
           
            }else{
                ventasProducto = [];
                var dataset = charVentasPorProducto.config.data.datasets[0];
                dataset.data = ventasProducto;	
                charVentasPorProducto.update();

                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'El vendedor seleccionado no tiene ventas registradas',
                  
                    })
           }

        },error: function (response) {
            console.log(response);
        }
    });

}
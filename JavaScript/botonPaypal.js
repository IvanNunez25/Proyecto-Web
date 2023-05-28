paypal.Button.render({
    env: 'sandbox', // sandbox | production
    style: {
        label: 'checkout', // checkout | credit | pay | buynow | generic
        size: 'large', // small | medium | large | responsive
        shape: 'rect', // pill | rect
        color: 'blue' // gold | blue | silver | black
    },

    // PayPal Client IDs - replace with your own
    // Create a PayPal app: https://developer.paypal.com/developer/applications/create

    client: {
        sandbox: 'AcFC6Kxd73VrJLtqOJZnUSatcGMZcUbRyzBnFB2Km2gIqlmJVg2FhRhPV1sp4YznvIgMEfycWzMayQ2w',
        production: '<insert production client id>'
    },

    // Wait for the PayPal button to be clicked

    payment: async function(data, actions) {

        const respuesta = await fetch('PHP/MostrarCarrito.php');
        const datos = await respuesta.json();
        let totalPrecio = 20;
        totalPrecio = calcularTotalPrecio(datos);

        return actions.payment.create({
            payment: {
                transactions: [{
                    amount: {
                        total: totalPrecio,
                        currency: 'MXN'
                    },
                    // description:"",
                    // custom:"Codigo"
                }]
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(async function() {
            let numProductos = 0;
            let subtotal = 0;
            let total = 0;

            await fetch('PHP/InsertarVenta.php', {
                method: 'POST'
            });

            const respuesta2 = await fetch('PHP/ObtenerIDVenta.php');
            const id_venta = await respuesta2.json();
            let ID = 0;

            id_venta.forEach(id => {
                ID = id.vta_id;
                console.log(ID);
            });

            const respuesta = await fetch('PHP/MostrarCarrito.php');
            const datos = await respuesta.json();

            console.log(datos);

            const promesasDetalle = datos.map(registro => {
                if (parseInt(registro.dis_existencia) > parseInt(registro.cardis_cantidad)) {
                    return ejecutarProcedimiento(registro.dis_id, registro.cardis_cantidad)
                        .then(() => {
                            numProductos += 1;
                            console.log('Cuenta: ' + numProductos);

                            subtotal = (registro.cardis_cantidad * registro.dis_precioUnitario);
                            total += subtotal;

                            console.log('Cantidad: ' + registro.cardis_cantidad);
                            console.log('Precio: ' + registro.dis_precioUnitario);
                            console.log('SubTotal: ' + subtotal);
                            console.log('ID Disco: ' + registro.dis_id);
                            console.log('ID Venta: ' + ID);

                            const formDataDetalles = new FormData();
                            formDataDetalles.append('parametroCantidad', registro.cardis_cantidad);
                            formDataDetalles.append('parametroPrecio', registro.dis_precioUnitario);
                            formDataDetalles.append('parametroSubTotal', subtotal);
                            formDataDetalles.append('parametroIDDisco', registro.dis_id);
                            formDataDetalles.append('parametroIDVenta', ID);

                            return fetch('PHP/InsertarDetalle.php', {
                                method: 'POST',
                                body: formDataDetalles
                            });
                        });
                } else {
                    return Promise.resolve(); // Promesa vacía si no se cumple la condición
                }
            });

            await Promise.all(promesasDetalle);

            console.log('Total: $' + total);
            console.log('Productos: ' + numProductos);
            console.log('ID: ' + ID);

            const formDataVenta = new FormData();
            formDataVenta.append('parametroTotal', total);
            formDataVenta.append('parametroNumProductos', numProductos);
            formDataVenta.append('parametroID', ID);

            await fetch('PHP/ActualizarVenta.php', {
                method: 'POST',
                body: formDataVenta
            });

            const respuesta3 = await fetch('PHP/MostrarCarrito.php');
            const datos3 = await respuesta3.json();

            const promesasDetalle2 = datos3.map(registro => {
                if (parseInt(registro.dis_existencia) > parseInt(registro.cardis_cantidad)) {
                    return eliminarDelCarrito(registro.cardis_id);
                } else {
                    return Promise.resolve(); // Promesa vacía si no se cumple la condición
                }
            });

            await Promise.all(promesasDetalle2);

            window.alert('¡Pago realizado!');
            window.location = "perfil.php";
        });
    }



}, '#paypal-button-container');

async function ejecutarProcedimiento(parametro1, parametro2) {

    const formData = new FormData();
    formData.append('parametro1', parametro1);
    formData.append('parametro2', parametro2);

    await fetch('PHP/ActualizarStock.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error(error);
        });
}

function eliminarDelCarrito(id_pedido) {

    const formDataEliminacion = new FormData();
    formDataEliminacion.append('parametroPedidoID', id_pedido);
    fetch('PHP/EliminarDelCarrito.php', {
        method: 'POST',
        body: formDataEliminacion
    });
}

function calcularTotalPrecio(datos) {
    let totalPrecio = 0;

    for (let registro of datos) {

        if (parseInt(registro.dis_existencia) >= parseInt(registro.cardis_cantidad)) {
            totalPrecio += (registro.cardis_cantidad * registro.dis_precioUnitario);
        }
    }

    return totalPrecio;
}
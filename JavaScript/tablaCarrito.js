
let dataTable;
let dataTableInicializada = false;

const dataTableOpciones = {
    columnDefs: [
        { className: "centrado", targets: [3, 4, 5, 6, 7] },
        { orderable: false, targets: [6, 7] }
    ],
    pageLength: 10,
    destroy: true,
    language: {
        lengthMenu: "Mostrar _MENU_ resgistros por página",
        zeroRecords: "Ningún registro encontrado",
        info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
        infoEmpty: "Ningun registro encontrado",
        infoFiltered: "(filtrados desde _MAX_ registros totales)",
        search: "Buscar:",
        loadingRecords: "Cargando ...",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
        }
    }
}

const iniciarDataTable = async () => {
    if (dataTableInicializada) {
        dataTable.destroy();
    }

    await listarUsuarios();

    dataTable = $("#datatable_usuarios").DataTable(dataTableOpciones);

    dataTableInicializada = true;
}

const listarUsuarios = async () => {
    try {
        const response = await fetch('./PHP/MostrarCarrito.php');
        const usuarios = await response.json();

        let content = ``;
        usuarios.forEach((usuario, index) => {
            content += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${usuario.art_nombre}</td>
                    <td>${usuario.dis_nombre}</td>
                    <td>${usuario.cardis_cantidad}</td>
                    <td>${usuario.dis_precioUnitario}</td>
                    <td>${usuario.cardis_cantidad * usuario.dis_precioUnitario}</td>
                    <td>${parseInt(usuario.cardis_cantidad) <= parseInt(usuario.dis_existencia) ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-xmark"></i>'}</td>
                    <td><button class="btn btn-sm btn-danger" onclick='eliminarProducto(${usuario.cardis_id})'><i class="fa-solid fa-trash"></i></button></td>
                </tr>`;
        });

        // ID del cuerpo de la tabla
        tableBody_usuarios.innerHTML = content;
    } catch (error) {
        console.log(error);
    }
}

function eliminarProducto(ID_producto) {
    Swal.fire({
        title: 'Eliminar Producto',
        text: '¿Deseas eliminar el producto seleccionado?',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `PHP/EliminarDelCarrito2.php?id=${ID_producto}`;
        }
    })
}

window.addEventListener('load', async () => {
    await iniciarDataTable();
});
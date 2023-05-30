// Importar la biblioteca jsPDF
import jsPDF from 'jspdf';

// Crear una instancia de jsPDF
const doc = new jsPDF();
// Establecer el tamaño de página
doc.setPageSize('a4'); 
// Cargar la imagen
const imgData = '.\Imagenes\shopping-bag.png'; 
// Agregar la imagen al PDF
doc.addImage(imgData, 'JPEG', doc.internal.pageSize.getWidth() - 80, 15, 60, 40);
// Agregar el encabezado
doc.setFontSize(20);
doc.text('Comprobante de compra', 10, 10);

// Crear una instancia del objeto Date
const today = new Date();
// Obtener los componentes de la fecha
const year = today.getFullYear();
const month = today.getMonth() + 1; // Los meses comienzan desde 0, por lo que se suma 1
const day = today.getDate();
// Formatear la fecha
const formattedDate = `${day}/${month}/${year}`;
//Consulta producto
let nombreDisco;
fetch('./PHP/MostrarCarrito.php')  
  .then(response => response.json())
  .then(data => {
    const nombre = data.dis_nombre;
    console.log(nombre);
  })
  .catch(error => {
    console.error('Error:', error);
  });
//Consulta precio
let precioDisco;
fetch('./PHP/MostrarCarrito.php')  
  .then(response => response.json())
  .then(data => {
    const precio = data.dis_precioUnitario;
    console.log(precio);
  })
  .catch(error => {
    console.error('Error:', error);
  });
//Consulta precio
let cantDisco;
fetch('./PHP/MostrarCarrito.php')  
  .then(response => response.json())
  .then(data => {
    const cant = data.cardis_cantidad;
    console.log(cant);
  })
  .catch(error => {
    console.error('Error:', error);
  });

// Agregar los detalles de la compra
const compra = {
  fecha: formattedDate,
  producto: nombreDisco,
  precio: precioDisco,
  cantidad: cantDisco,
  total: precioDisco*cantDisco,
};

doc.setFontSize(12);
doc.text(`Fecha: ${compra.fecha}`, 10, 30);
doc.text(`Producto: ${compra.producto}`, 10, 40);
doc.text(`Precio: ${compra.precio}`, 10, 50);
doc.text(`Cantidad: ${compra.cantidad}`, 10, 60);
doc.text(`Total: ${compra.total}`, 10, 70);

// Agregar una línea horizontal
doc.setLineWidth(0.5);
doc.line(15, 80, 195, 80);

// Agregar el pie de página
doc.setFontSize(10);
doc.text('Gracias por su compra', 15, 90);

// Guardar el PDF
doc.save('comprobante.pdf');

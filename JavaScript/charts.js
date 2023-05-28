const ctx = document.getElementById('myChart');

const myCharts = new Chart(ctx, {
  type: 'bar',
  data: {
    datasets: [{
      label: 'Número de albumes',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

fetch('PHP/ChartConsulta1.php')
  .then(response => response.json())
  .then(datos => { 
    console.log(datos);
    mostrar(datos);
  })
  .catch(error => console.log(error))

const mostrar = (articulos) => {
  articulos.forEach(element => {
    console.log(element);
    myCharts.data['labels'].push(element.art_nombre);
    myCharts.data['datasets'][0].data.push(parseInt(element.cantidadTotal));
  });

  myCharts.update();
}

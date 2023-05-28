const ctx2 = document.getElementById('myChart2');

const myCharts2 = new Chart(ctx2, {
  type: 'doughnut',
  data: {
    datasets: [{
        data: [],
        backgroundColor: []
      }],
      labels: []
  },
  options: {
    responsive: true
  }
});

fetch('PHP/ChartConsulta2.php')
  .then(response => response.json())
  .then(datos => { 
    console.log(datos);
    mostrar2(datos);
  })
  .catch(error => console.log(error))

const mostrar2 = (articulos) => {
  articulos.forEach(element => {
    console.log(element);
    myCharts2.data['labels'].push(element.dis_nombre);
    myCharts2.data['datasets'][0].data.push(parseInt(element.cantidad));
    myCharts2.data.datasets[0].backgroundColor.push(getRandomColor());
  });

  myCharts2.update();
}

const getRandomColor = () => {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  };

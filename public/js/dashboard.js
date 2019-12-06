$(function () {
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  var meses = new Array(
    'Janeiro',
    'Fevereiro',
    'Março',
    'Abril',
    'Maio',
    'Junho',
    'Julho',
    'Agosto',
    'Setembro',
    'Outubro',
    'Novembro',
    'Dezembro'
  );

  //-------------
  //- BAR CHART -
  //-------------
  
  var data1 = new Array();
  var mes_label = new Array();
  reservas_mensal.forEach(element => {
    data1[element.mes-1] = element.count;
  });

  var data2 = new Array();
  reservas_canceladas.forEach(element => {
    data2[element.mes-1] = element.count;
  });

  console.log(reservas_canceladas);

  var barChartData = {
    labels  : meses,
    datasets: [
      {
        label: 'Reservas Efetuadas',
        backgroundColor: '#32CD32',
				borderColor: '#32CD32',
        // data: [65, 59, 80, 81, 56, 55, 40]
        data: data1
      },
      {
        label: 'Reservas Canceladas',
        backgroundColor: '#f56954',
				borderColor: '#f56954',
        // data: [28, 48, 40, 19, 86, 27, 90]
        data: data2
      }
    ]
  }
  
  window.onload = function() {
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    window.myBar = new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: {
        responsive: true,
        legend: {
          position: 'top',
        },
      }
    });
    
    //-------------
    //- PIE CHART -
    //-------------
    var config = {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            Math.round(Math.random() * 100),
            Math.round(Math.random() * 100),
            Math.round(Math.random() * 100),
            Math.round(Math.random() * 100),
            Math.round(Math.random() * 100),
            Math.round(Math.random() * 100),
          ],
          backgroundColor: [
            '#d2d6de',
            '#C71585',
            '#00c0ef',
            '#f39c12',
            '#f56954',
            '#00a65a',
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Gray',
          'Violet',
          'Litgh Blue',
          'Orange',
          'Red',
          'Green'
        ]
      },
      options: {
        responsive: true
      }
    };

    var pieChart = $('#pieChart').get(0).getContext('2d')
    window.myPie = new Chart(pieChart, config);

  };

})
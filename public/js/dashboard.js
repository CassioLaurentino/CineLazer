$(function () {
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  // //--------------
  // //- AREA CHART -
  // //--------------

  // // Get context with jQuery - using jQuery's .get() method.
  // var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
  // // This will get the first returned node in the jQuery collection.
  // var areaChart       = new Chart(areaChartCanvas)

  var areaChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Electronics',
        backgroundColor: '#c1c7d1',
				borderColor: '#c1c7d1',
        data: [65, 59, 80, 81, 56, 55, 40]
      },
      {
        label: 'Digital Goods',
        backgroundColor: '#3b8bba',
				borderColor: '#3b8bba',
        data: [28, 48, 40, 19, 86, 27, 90]
      }
    ]
  }

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
          '#3c8dbc',
          '#00c0ef',
          '#f39c12',
          '#f56954',
          '#00a65a',
        ],
        label: 'Dataset 1'
      }],
      labels: [
        'Red',
        'Orange',
        'Yellow',
        'Green',
        'Blue',
        'piroca'
      ]
    },
    options: {
      responsive: true
    }
  };

  //-------------
  //- BAR CHART -
  //-------------
  var barChartData = areaChartData
  
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
    
    var pieChart = $('#pieChart').get(0).getContext('2d')
    window.myPie = new Chart(pieChart, config);

  };

})
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

  };

})
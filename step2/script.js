
function drawChart(id,obj){

  var ctx = document.getElementById(id).getContext('2d');
  var chart = new Chart(ctx, obj);
}

function getCharts(){

  $.ajax({

    url: "getCharts.php",
    method:"GET",
    success: function(data){

      var charts = JSON.parse(data);
      console.log(charts);

      drawChart("salesChart",charts[0]);
      drawChart("salesChartByAgent",charts[1]);
    },
    error: function(){

      console.log("Error in recovering sales data");
    }
  })
}

function init(){

  getCharts();
}

$(document).ready(init);

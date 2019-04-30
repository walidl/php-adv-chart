
function drawChart(id,obj){

  var newCanvas = $("<canvas id='" + id + "'> </canvas>");
  $(".graphs .container").append(newCanvas);
  var ctx = document.getElementById(id).getContext('2d');
  var chart = new Chart(ctx, obj);
}

function getCharts(){

  var urlParams = new URLSearchParams(window.location.search);
  var level = urlParams.get('level');

  $.ajax({

    url: "getCharts.php",
    method:"GET",
    data: {level: level},
    success: function(data){

      var charts = JSON.parse(data);
      console.log(charts);

      for (var i = 0; i < charts.length; i++) {

        drawChart(charts[i]["id"],charts[i]["oggetto"]);

      }
      
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

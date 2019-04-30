
function drawChart(valori){

  var ctx = document.getElementById('salesChart').getContext('2d');
  var chart = new Chart(ctx, {

    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],
        datasets: [{
            label: 'Vendite',
            backgroundColor: 'rgba(232, 242, 255,0.5)',
            borderColor: 'rgba(0, 0, 0,0.7)',
            data: valori,
            tension: 0.5,
        },
      ],
    },

    // Configuration options go here
    options: {}
  });
}

function getSales(){

  $.ajax({

    url: "fullDB.php",
    method:"GET",
    success: function(data){

      var sales = JSON.parse(data);
      console.log(sales);

      drawChart(sales);
    },
    error: function(){

      console.log("Error in recovering sales data");
    }
  })
}

function init(){

  getSales();
}

$(document).ready(init);

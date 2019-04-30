<?php

  include "database.php";

  function firstGraph($fatt){

    // var_dump($fatt); die();

    $obj = [

      "type" => $fatt["type"],
      "data" => [
        "labels" => ["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],
        "datasets" =>[[

          "label"=> "Vendite",
          "backgroundColor" => "rgba(232, 242, 255,0.5)",
          "borderColor" => "rgba(0, 0, 0,0.7)",
          "data" => $fatt["data"],
          "tension"=> 0.5,

        ]],
      ],
    ];

    // var_dump($obj); die();

    return $obj;
  }

  function secondGraph($fatt){

    // var_dump($fatt); die();
    $data = $fatt["data"];

    $labels = array_keys($data);
    $values = array_values($data);

    // var_dump($values); die();

    $obj = [

      "type" => $fatt["type"],
      "data" => [
        "labels" => $labels,
        "datasets" =>[[

          "label"=> "Income",
          "backgroundColor" => ["#FFCD56", "#ff1e1e","#0F9D58","#5624c1" ],
          "borderColor" => "rgba(255, 255, 255,0.5)",
          "data" => $values,
          "tension"=> 0.2,

        ]],
      ],

      "options" => [

        "elements" =>[

          "arc"=>[

          "borderWidth" => 0,
          ],
        ],
      ],
    ];

    // var_dump($obj); die();

    return $obj;
  }


  $grafici[] = firstGraph($graphs["fatturato"]);
  $grafici[] = secondGraph($graphs["fatturato_by_agent"]);

  echo json_encode($grafici);
 ?>

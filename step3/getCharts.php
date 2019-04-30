<?php
  function graficoFatturato($id,$dati){

    $obj = [

      "type" => $dati["type"],
      "data" => [
        "labels" => ["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],
        "datasets" =>[[

          "label"=> "Vendite",
          "backgroundColor" => "rgba(232, 242, 255,0.5)",
          "borderColor" => "rgba(0, 0, 0,0.7)",
          "data" => $dati["data"],
          "tension"=> 0.5,

        ]],
      ],
    ];
    return [

      "id" => $id,
      "oggetto" => $obj,
    ];
  }

  function graficoFatturatoByAgent($id,$dati){

    // var_dump($fatt); die();
    $data = $dati["data"];

    $labels = array_keys($data);
    $values = array_values($data);

    // var_dump($values); die();

    $obj = [

      "type" => $dati["type"],
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

    return [

      "id" => $id,
      "oggetto" => $obj,
    ];
  }

  function graficoTeamEfficiency($id,$dati){

    // var_dump($fatt); die();

    // var_dump($values); die();

    $obj = [

      "type" => $dati["type"],
      "data" => [
        "labels" => ["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],
        "datasets" =>[],
      ],

    ];

    $data = $dati["data"];
    // var_dump($data); die();

    foreach ($data as $key => $value) {

      $obj["data"]["datasets"][] = [

        "label"=> $key,
        "backgroundColor" => "rgba(0,0,0,0)",
        "borderColor" => "rgba(" . rand(0,255) . ",". rand(0,255) .",". rand(0,255) .",0.5)",
        "data" => $value,
        "tension"=> 0.5,

      ];
    }

  // echo json_encode($obj); die();

    return [

      "id" => $id,
      "oggetto" => $obj,
    ];
  }

  function chartsData($charts){

    $return = [];

    foreach ($charts as $key => $value) {
      switch ($key) {

        case 'fatturato':
          $return[] = graficoFatturato($key,$value);
          break;
        case 'fatturato_by_agent':
          $return[] = graficoFatturatoByAgent($key,$value);
          break;
        case 'team_efficiency':
          $return[] = graficoTeamEfficiency($key,$value);
          break;
        default:
          // code...
          break;
      }
    }

    echo json_encode($return);die();
  }
  function init(){

    include "database.php";

    $level = $_GET["level"];
    // echo "$level";

    $permessi= [

      "clevel"=> ["clevel","employee","guest"],
      "employee" => ["employee","guest"],
      "guest" => ["guest"],

    ];

    if( $permessi[$level] != null ){

      foreach ($graphs as $key => $value) {

        if(in_array($value["access"],$permessi[$level])){
          $autorized[$key] = $value;
        }
      }
      chartsData($autorized);
      // var_dump($autorized); die();
    }

    else{


    }

  }

  init();

 ?>

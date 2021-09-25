<?php
  
  /**
   * Get V1 of the API
   * 
   **/
  require_once('../../app.php');

  /**
   * Decode any incoming JSON Post
   * 
   **/ 
  $_POST = json_decode(file_get_contents("php://input"), true);
  
  /**
   * Should we do something with it?
   * Is it even set? If not, provide message 
   * 
   **/
  if(!empty($_POST) && isset($_POST)) {
    updateViperOverlay($_POST);
  } else {
    echo "<pre>// I N V A L I D - D A T A</pre>";
  }


  function updateViperOverlay($data) {

    $sub_count = intval($_POST['subCount']);
    $goal_text = str_replace(" ","&nbsp;&nbsp;&nbsp;", $_POST['goal']);
    $goal_num = 0;

    for($i=0;$i<count(VIPER_SUB_GOALS);$i++){
      if(VIPER_SUB_GOALS[$i] >= $sub_count) {
        $goal_num = VIPER_SUB_GOALS[$i];
        break;
      }
    }


    $data = Array (
      "follower" => $_POST['follower'],
      "subscriber" => $_POST['subscriber'],
      "sub_count" => $sub_count,
      "goal_num" => $goal_num,
      "goal" => $goal_text
    );

    // encode array to json
    $json = json_encode($data);
    file_put_contents("../data.json", $json);


  }
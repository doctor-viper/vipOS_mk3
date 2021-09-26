<?php

  /**
   * Get V1 of the API
   * 
   **/
  require_once('../../../app.php');

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
    update_viper_recents($_POST['follower'],$_POST['subscriber'],VIPER_LAMETRIC_INFO);
  } else {
    echo "<pre>// I N V A L I D - D A T A</pre>";
  }  


  /**
   * update_viper_recents
   * 
   * Constructs an object to send to the local Lametric app that
   * reflects the most recent follower and subscriber
   * 
   * Using curl to bypass SSL check
   * 
   * $follower    string    latest follower
   * $subscriber  string    latest subscriber
   * $config      object    URL and Headers for cURL POST
   * 
   **/
  function update_viper_recents($follower, $subscriber, $config) {

    // set up follower info
    $followerObj = new stdClass();
    $followerObj->text = "latest follower: " . $follower['name'];
    $followerObj->icon = 4788;

    // set up most recent sub info
    $subscriberObj = new stdClass();
    $subscriberObj->text = "latest subscriber: " . $subscriber['name'];
    $subscriberObj->icon = 653;

    // set frames
    $framesArray = array(
      $followerObj,
      $subscriberObj
    );

    // payload obj
    $payloadObj = new stdClass();
    $payloadObj->frames = $framesArray;

    // json encode
    $payload = json_encode($payloadObj);

    // curl
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $config['URL']);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    // set headers
    $headers = $config['HEADERS'];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    // $output contains the output string
    $response = curl_exec($ch);

    if ($response === false) 
        $response = curl_error($ch);

    curl_close($ch);   

  }

?>
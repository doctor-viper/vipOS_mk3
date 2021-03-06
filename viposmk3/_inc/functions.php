<?php

  
  /**
   * 
   * update_viper_overlay_data
   * 
   * $data   object       Data object with recent follower, 
   *                      subscriber, sub count, and sub goal
   * 
   * Converts data object to JSON to be used by the Viper
   * Overlay, will figure out next goal level based on how many subscribers
   * there are dynamically. 
   * 
   * See CONST // VIPER_SUB_GOALS
   * 
   **/
  function update_viper_overlay_data($data) {

    $sub_count = intval($data['sub_count']);
    $goal_text = str_replace(" ","&nbsp;&nbsp;&nbsp;", $data['goal']);
    $goal_num = get_sub_goal($sub_count);

    $data = Array (
      "follower" => $data['follower'],
      "subscriber" => $data['subscriber'],
      "sub_count" => $sub_count,
      "goal_num" => $goal_num,
      "goal" => $goal_text,
      "bits_leader" => $data['bits_leader'],
      "bits_amt" => $data['bits_amt']
    );

    // encode array to json
    $json = json_encode($data);
    file_put_contents("C:\\xampp\\viper\\viposmk3\\_data\data.json", $json);

  }



  /**
   * 
   * update_viper_overlay_data
   * 
   * $data   object       Data object with recent follower, 
   *                      subscriber, sub count, and sub goal
   * 
   * Converts data object to JSON to be used by the Viper
   * Overlay, will figure out next goal level based on how many subscribers
   * there are dynamically. 
   * 
   * See CONST // VIPER_SUB_GOALS
   * 
   **/
  function turn_predator_vision_on_off($value = false) {

    $data = Array (
      "play" => $value
    );

    // encode array to json
    $json = json_encode($data);
    file_put_contents("C:\\xampp\\viper\\viposmk3\\_data\predator.json", $json);

  }



  /**
   * update_viper_overlay
   * 
   * Grabs the most recent follower, subscriber, top cheerer ( + score ) from DecAPI / Twitch APIs
   * and the sub goal from the config file. Returns all info in a object to be used in overlays
   * 
   * RETURN
   * $data   object       Data object with recent follower, 
   *                      subscriber, sub count, sub goal
   *                      and cheer leader + score
   * 
   **/ 
  function update_viper_overlay() {

    // create curl resource
    $ch = curl_init();

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // set url - followers
    curl_setopt($ch, CURLOPT_URL, "https://decapi.me/twitch/followers/dr_viper");

    // $output contains the output string
    $follower = curl_exec($ch);

    // set url - subscibers ( requires OAuth token )
    curl_setopt($ch, CURLOPT_URL, "https://decapi.me/twitch/latest_sub/dr_viper?token=".VIPER_SUB_TOKEN);

    // $output contains the output string
    $subscriber = curl_exec($ch);

    // set url - subsciber count
    curl_setopt($ch, CURLOPT_URL, "https://decapi.me/twitch/subcount/dr_viper");

    // $output contains the output string
    $sub_count = curl_exec($ch);

    // Construct data object to pass to update_viper_overlay_data()
    $data["follower"] = $follower;
    $data["goal"] = str_replace(" ","&nbsp;&nbsp;&nbsp;", VIPER_GOAL_DESC);
    $data["sub_count"] = $sub_count;
    $data["subscriber"] = $subscriber;

    // Get the bits leader information and add that to the data obj
    try {
      $bits_info = get_viper_bits_leader();
    } catch (Throwable $e) {
      refresh_twitch_oath();
      sleep(1);
      $bits_info = get_viper_bits_leader();
    }

    // We don't need everything, so only grab what we want
    $data["bits_leader"] = $bits_info["user_name"];
    $data["bits_amt"] = $bits_info["score"];

    // Update the data source we'll be polling later
    update_viper_overlay_data($data);

    // Update the Lametric Overlay
    update_viper_lametric_app($follower,$subscriber);

    // Get the goal num ( goal limits array in config file )
    // This number isn't required for data, so we add it after the write call
    $goal_num = get_sub_goal(intval($sub_count));
    $data["goal_num"] = $goal_num;

    curl_close($ch);

    return $data;    

  }



  function update_viper_lametric_app($follower,$subscriber) {

    $ch = curl_init( 'http://localhost/viposmk3/lametric/follow_subs_app/update/' );
    
    # Setup request to send json via POST.
    $payload = json_encode( array( "follower" => array( "name" => $follower ), "subscriber" => array( "name" => $subscriber ) ) );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    
    # Return response instead of printing.
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    
    # Send request.
    $result = curl_exec($ch);
    curl_close($ch);


  }



  /**
   * get_viper_latest_sub
   * 
   * Gets the latest subscriber
   * 
   **/
  function get_viper_latest_sub() {
    
    // create curl resource
    // $ch = curl_init();

    // //return the transfer as a string
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // // Set headers
    // curl_setopt($ch, CURLOPT_HTTPHEADER, VIPER_TWITCH_API_HEADERS);
    
    // // set url
    // curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/bits/leaderboard?count=1&period=month&started_at=".urlencode($start_date));

    // // $output contains the output string
    // $bits_info = curl_exec($ch);

    // $data = json_decode($bits_info);

    // // echo "<pre>";
    // // var_dump($data);
    // // echo "</pre>";

    // curl_close($ch);

    // $return_obj["user_name"] = $data->data[0]->user_name;
    // $return_obj["score"] = $data->data[0]->score;

    // return $return_obj;

  }



  /**
   * get_viper_bits_leader
   * 
   * Gets the bits ( cheerer ) leader for the past month
   * 
   **/
  function get_viper_bits_leader() {
    
    global $viper_twitch_api_headers;

    // create curl resource
    $ch = curl_init();

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Set headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, $viper_twitch_api_headers);
    
    // Set start date for today in RFC 3339 Format
    $start_date = date("Y-m-d\TH:i:sP");

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/bits/leaderboard?count=1&period=month&started_at=".urlencode($start_date));

    // $output contains the output string
    $bits_info = curl_exec($ch);

    $data = json_decode($bits_info);

    curl_close($ch);

    if(property_exists($data, "error")) {
      throw new Exception();
    }

    $return_obj["user_name"] = "COULD BE";
    $return_obj["score"] = "YOU!";

    if(count($data->data) > 0) {
      $return_obj["user_name"] = $data->data[0]->user_name;
      $return_obj["score"] = $data->data[0]->score;
    }

    return $return_obj;

  }



  /**
   *
   * get_sub_goal
   * 
   * Takes in a sub count and determines what the
   * next sub goal should be based on the goal array
   * 
   * $sub_count   int       numner of current subscribers
   * 
   **/
  function get_sub_goal($sub_count) {
    $goal_num = 0;
    for($i=0;$i<count(VIPER_SUB_GOALS);$i++){
      if(VIPER_SUB_GOALS[$i] > $sub_count) {
        $goal_num = VIPER_SUB_GOALS[$i];
        break;
      }
    }
    return $goal_num;
  }



  /**
   * 
   *
   **/
  function refresh_twitch_oath() {
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, "https://id.twitch.tv/oauth2/token?grant_type=refresh_token&refresh_token=".VIPER_REFRESH_TOKEN."&client_id=".VIPER_CLIENT_ID."&client_secret=".VIPER_CLIENT_SECRET);
        
    $response = json_decode(curl_exec($ch));
    
    file_put_contents('C:\\xampp\\viper\\viposmk3\\_inc\\twitch\\access_token.txt', $response->access_token);

    global $viper_twitch_api_headers;

    $viper_twitch_api_headers = [
      'Authorization: Bearer ' . $response->access_token,
      'Client-Id: ' . VIPER_CLIENT_ID
    ];

    curl_close($ch);

  }


?>
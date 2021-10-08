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
    $bits_info = get_viper_bits_leader();
    // We don't need everything, so only grab what we want
    $data["bits_leader"] = $bits_info["user_name"];
    $data["bits_amt"] = $bits_info["score"];

    // Update the data source we'll be polling later
    update_viper_overlay_data($data);

    // Get the goal num ( goal limits array in config file )
    // This number isn't required for data, so we add it after the write call
    $goal_num = get_sub_goal(intval($sub_count));
    $data["goal_num"] = $goal_num;

    curl_close($ch);

    return $data;    

  }



  /**
   * get_viper_bits_leader
   * 
   * Gets the bits ( cheerer ) leader for the past month
   * 
   **/
  function get_viper_bits_leader() {
    
    // create curl resource
    $ch = curl_init();

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Set headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, VIPER_TWITCH_BITS_HEADERS);
    
    // Set start date for today in RFC 3339 Format
    $start_date = date("Y-m-d\TH:i:sP");

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/bits/leaderboard?count=1&period=month&started_at=".urlencode($start_date));

    // $output contains the output string
    $bits_info = curl_exec($ch);

    $data = json_decode($bits_info);

    // echo "<pre>";
    // var_dump($data);
    // echo "</pre>";

    curl_close($ch);

    $return_obj["user_name"] = $data->data[0]->user_name;
    $return_obj["score"] = $data->data[0]->score;

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


?>
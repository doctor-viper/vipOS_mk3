<?php

  
  /**
   * 
   * update_viper_overlay
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
  function update_viper_overlay($data) {

    $sub_count = intval($data['subCount']);
    $goal_text = str_replace(" ","&nbsp;&nbsp;&nbsp;", $data['goal']);
    $goal_num = get_sub_goal($sub_count);

    $data = Array (
      "follower" => $data['follower'],
      "subscriber" => $data['subscriber'],
      "sub_count" => $sub_count,
      "goal_num" => $goal_num,
      "goal" => $goal_text
    );

    // encode array to json
    $json = json_encode($data);
    file_put_contents("../data.json", $json);

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
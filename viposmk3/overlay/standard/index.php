<?php

  /**
   * Get V1 of the API 
   * and the header
   * 
   **/
  require_once('../../app.php');
  require_once("../../../templates/header.php");

  // create curl resource
  $ch = curl_init();

  //return the transfer as a string
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  // set url
  curl_setopt($ch, CURLOPT_URL, "https://decapi.me/twitch/followers/dr_viper");

  // $output contains the output string
  $follower = curl_exec($ch);

  // set url
  curl_setopt($ch, CURLOPT_URL, "https://decapi.me/twitch/latest_sub/dr_viper");

  // $output contains the output string
  $subscriber = curl_exec($ch);

  // set url
  curl_setopt($ch, CURLOPT_URL, "https://decapi.me/twitch/subcount/dr_viper");

  // $output contains the output string
  $sub_count = curl_exec($ch);

  // Construct data object to pass to update_viper_overlay()
  $data["follower"] = $follower;
  $data["goal"] = VIPER_GOAL_DESC;
  $data["subCount"] = $sub_count;
  $data["subscriber"] = $subscriber;

  // Update the data source we'll be polling later
  update_viper_overlay($data);

  $goal_num = get_sub_goal(intval($sub_count));

?>

<div class='all-in-one'>

  <div class='carousel'>

    <div class='carousel-container'>  
      <h1 class='black follower-text'><?=$follower?></h1>
      <h1 class='pink follower-text'><?=$follower?></h1>
      <h1 class='follower-text'><?=$follower?></h1>
      <h2 class='sub-color'>- Latest Follower -</h2>
      <h2>- Latest Follower -</h2>      
    </div>

    <div class='carousel-container'>
      <h1 class='black subscriber-text'><?=$subscriber?></h1>
      <h1 class='pink subscriber-text'><?=$subscriber?></h1>
      <h1 class='subscriber-text'><?=$subscriber?></h1>
      <h2 class='sub-color'>- Latest Subscriber -</h2>
      <h2>- Latest Subscriber -</h2>
    </div>

    <div class='carousel-container'>
      <h1 class='black goal-text'>Purple&nbsp;&nbsp;Wig</h1>
      <h1 class='pink goal-text'>Purple&nbsp;&nbsp;Wig</h1>
      <h1 class='goal-text'>Purple&nbsp;&nbsp;Wig</h1>
      <h2 class='sub-color'>- Next Sub Goal -</h2>
      <h2>- Next Sub Goal -</h2>
    </div>

  </div>

  <div class='subscriber-goal'>
    <h1 class='black'>Subscriptions Goal<span class='goalnums'><span class='sub-count-text'><?=$sub_count?></span> / <span class='sub-count-goal-text'><?=$goal_num?></span></span></h1>
    <h1 class='pink'>Subscriptions Goal<span class='goalnums'><span class='sub-count-text'><?=$sub_count?></span> / <span class='sub-count-goal-text'><?=$goal_num?></span></span></h1>
    <h1>Subscriptions Goal<span class='goalnums'><span class='sub-count-text'><?=$sub_count?></span> / <span class='sub-count-goal-text'><?=$goal_num?></span></span></h1>
  </div>

</div>

<?php
  // close curl resource to free up system resources
  curl_close($ch);
  // Footer
  require_once("../../../templates/footer.php"); 
?>
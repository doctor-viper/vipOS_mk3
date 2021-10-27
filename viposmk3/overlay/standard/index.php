<?php

  /**
   * Get V1 of the API 
   * and the header
   * 
   **/
  require_once('../../app.php');
  require_once("../../../templates/header.php");

  // On initial load, grab most recent values and write to data.json file
  $viper_info = update_viper_overlay();

?>

<div class='carousel-parent'>

  <div class='carousel'>

    <div class='carousel-container'>  
      <h1 class='black follower-text'><?=$viper_info["follower"]?></h1>
      <h1 class='pink follower-text'><?=$viper_info["follower"]?></h1>
      <h1 class='follower-text'><?=$viper_info["follower"]?></h1>
      <h2 class='sub-color'>- Latest Follower -</h2>
      <h2>- Latest Follower -</h2>      
    </div>

    <div class='carousel-container'>
      <h1 class='black subscriber-text'><?=$viper_info["subscriber"]?></h1>
      <h1 class='pink subscriber-text'><?=$viper_info["subscriber"]?></h1>
      <h1 class='subscriber-text'><?=$viper_info["subscriber"]?></h1>
      <h2 class='sub-color'>- Latest Subscriber -</h2>
      <h2>- Latest Subscriber -</h2>
    </div>

    <div class='carousel-container'>
      <h1 class='black bits-leader-text'><?=$viper_info["bits_leader"]?></h1>
      <h1 class='pink bits-leader-text'><?=$viper_info["bits_leader"]?></h1>
      <h1 class='bits-leader-text'><?=$viper_info["bits_leader"]?></h1>
      <h2 class='sub-color'>- Top Cheerer @ <span class="bits-amt"><?=$viper_info["bits_amt"]?></span> -</h2>
      <h2>- Top Cheerer @ <span class="bits-amt"><?=$viper_info["bits_amt"]?></span> -</h2>
    </div>

    <div class='carousel-container'>
      <h1 class='black goal-text'><?=$viper_info["goal"];?></h1>
      <h1 class='pink goal-text'><?=$viper_info["goal"];?></h1>
      <h1 class='goal-text'><?=$viper_info["goal"];?></h1>
      <h2 class='sub-color'>- Next Sub Goal -</h2>
      <h2>- Next Sub Goal -</h2>
    </div>

  </div>

  <!-- <div class='subscriber-goal'>
    <h1 class='black'>Subscriptions Goal<span class='goalnums'><span class='sub-count-text'><?=$viper_info["sub_count"]?></span> / <span class='sub-count-goal-text'><?=$viper_info["goal_num"]?></span></span></h1>
    <h1 class='pink'>Subscriptions Goal<span class='goalnums'><span class='sub-count-text'><?=$viper_info["sub_count"]?></span> / <span class='sub-count-goal-text'><?=$viper_info["goal_num"]?></span></span></h1>
    <h1>Subscriptions Goal<span class='goalnums'><span class='sub-count-text'><?=$viper_info["sub_count"]?></span> / <span class='sub-count-goal-text'><?=$viper_info["goal_num"]?></span></span></h1>
  </div> -->

</div>

<?php
  // Footer
  require_once("../../../templates/footer.php"); 
?>
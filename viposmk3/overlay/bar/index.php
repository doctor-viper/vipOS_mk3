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

<div class="overlay-bar">

  <div class="main-bar">
    
    <div class="main-item commands">
      <h1 class="black">CMDS:</h1>
      <h1 class="grey">CMDS:</h1>
      <h1>CMDS:</h1>       
    </div>

    <div class="main-item discord">
      <h1 class="black">!discord</h1>
      <h1 class="grey">!discord</h1>
      <h1>!discord</h1>  
    </div>

    <div class="main-item socials">
      <h1 class="black">!socials</h1>
      <h1 class="grey">!socials</h1>
      <h1>!socials</h1>      
    </div>

    <div class="main-item lurk">
      <h1 class="black">!lurk</h1>
      <h1 class="grey">!lurk</h1>
      <h1>!lurk</h1>      
    </div>

    <div class="main-item sfx">
      <h1 class="black">!sfx</h1>
      <h1 class="grey">!sfx</h1>
      <h1>!sfx</h1>      
    </div>

    <div class="main-item follow">
      <h1 class="black">Latest Follow:</h1>
      <h1 class="grey">Latest Follow:</h1>
      <h1>Latest Follow:</h1>
      <h2 class="black follower-text"><?=$viper_info["follower"]?></h2>
      <h2 class="pink follower-text"><?=$viper_info["follower"]?></h2>
      <h2 class="follower-text"><?=$viper_info["follower"]?></h2>   
    </div>

    <div class="main-item sub">
      <h1 class="black">Latest Sub:</h1>
      <h1 class="grey">Latest Sub:</h1>
      <h1>Latest Sub:</h1>
      <h2 class="black subscriber-text"><?=$viper_info["subscriber"]?></h2>
      <h2 class="pink subscriber-text"><?=$viper_info["subscriber"]?></h2>
      <h2 class="subscriber-text"><?=$viper_info["subscriber"]?></h2>   
    </div>

    <div class="main-item cheer">
      <h1 class="black">Top Cheer:</h1>
      <h1 class="grey">Top Cheer:</h1>
      <h1>Top Cheer:</h1>
      <h2 class="black bits-leader-text"><?=$viper_info["bits_leader"]?>&nbsp;&nbsp;@&nbsp;&nbsp;<?=$viper_info["bits_amt"]?></h2>
      <h2 class="pink bits-leader-text"><?=$viper_info["bits_leader"]?>&nbsp;&nbsp;@&nbsp;&nbsp;<?=$viper_info["bits_amt"]?></h2>
      <h2 class="bits-leader-text"><?=$viper_info["bits_leader"]?>&nbsp;&nbsp;@&nbsp;&nbsp;<?=$viper_info["bits_amt"]?></h2>   
    </div>
    
  </div>

  <div class='subscriber-goal'>
    <h1 class='black'>Subscriptions Goal<span class='goalnums'><span class='sub-count-text'><?=$viper_info["sub_count"]?></span> / <span class='sub-count-goal-text'><?=$viper_info["goal_num"]?></span></span></h1>
    <h1 class='pink'>Subscriptions Goal<span class='goalnums'><span class='sub-count-text'><?=$viper_info["sub_count"]?></span> / <span class='sub-count-goal-text'><?=$viper_info["goal_num"]?></span></span></h1>
    <h1>Subscriptions Goal<span class='goalnums'><span class='sub-count-text'><?=$viper_info["sub_count"]?></span> / <span class='sub-count-goal-text'><?=$viper_info["goal_num"]?></span></span></h1>
  </div>

</div>

<?php
  // Footer
  require_once("../../../templates/footer.php"); 
?>
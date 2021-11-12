<?php

  /**
   * Get V1 of the API 
   * and the header
   * 
   **/
  require_once('../../app.php');
  require_once("../../../templates/header.php");

?>

<div id="video-container">
  <video id="predator" width="1920" height="1080" muted autoplay loop>
    <source src="/assets/video/predator_vision.mp4" type="video/mp4">
  </video>
</div>

<?php
  // Footer
  require_once("../../../templates/footer.php"); 
?>
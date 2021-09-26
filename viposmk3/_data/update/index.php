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
    update_viper_overlay($_POST);
  } else {
    echo "<pre>// I N V A L I D - D A T A</pre>";
  }
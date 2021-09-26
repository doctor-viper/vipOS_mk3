<?php
  
  /**
   * Lametric Info for pushing to local app
   * 
   **/
  CONST VIPER_LAMETRIC_INFO = [
    "URL" => "<URL>",
    "HEADERS" => [
      'X-Access-Token: <TOKEN>',
      'Accept: application/json',
      'Cache-Control: no-cache'
    ]
  ];


  /**
   * All the sub goal limits up to 300.
   * 
   **/
  CONST VIPER_SUB_GOALS = array(50,100,150,200,250,300);
  CONST VIPER_GOAL_DESC = "<YOUR GOAL>";


  /**
   * Webhook URLs for the Discord Server
   *
   **/
  CONST VIPER_DISCORD_WEBHOOKS = Array (
    "GENERAL"     => "https://discord.com/api/webhooks/<CHANNEL_INFO>",
    "FLIGHTDECK"  => "https://discord.com/api/webhooks/<CHANNEL_INFO>"
  );


?>
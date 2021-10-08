<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head>

  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Important stuff for SEO, don't neglect. (And don't dupicate values across your site!) -->
  <title>D O C T O R - V I P E R</title>
  <meta name="author" content="Dr. Viper" />
  <meta name="description" content="Here to bust some punks." />

  <!-- Who owns the content of this site? -->
  <meta name="Copyright" content="" />

  <!--  Mobile Viewport
  http://j.mp/mobileviewport & http://davidbcalhoun.com/2010/viewport-metatag
  device-width : Occupy full width of the screen in its current orientation
  initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
  maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width (wrong for most sites)
  -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Use Iconifyer to generate all the favicons and touch icons you need: http://iconifier.net -->
  <link rel="shortcut icon" href="/favicon.ico" />

  <!-- concatenate and minify for production -->
  <link rel="stylesheet" href="/assets/css/style.css?bust=<?=time();?>" />


  <!-- This is a minimized, base version of Modernizr. (http://modernizr.com)
      You will need to create new builds to get the detects you need. -->
  <script src="/assets/js/libs/modernizr-3.2.0.base.js"></script>

  <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>window.jQuery || document.write("<script src='assets/js/libs/jquery-1.11.3.min.js'>\x3C/script>")</script>

  <!-- this is where we put our custom functions -->
  <!-- don't forget to concatenate and minify for production -->
  <script src="/assets/js/functions.js?bust=<?=time();?>"></script>
  <script>$(document).ready(initPage);</script>

  <!-- Twitter: see https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/summary for details -->
  <meta name="twitter:card" content="">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:url" content="">
  <!-- Facebook (and some others) use the Open Graph protocol: see http://ogp.me/ for details -->
  <meta property="og:title" content="" />
  <meta property="og:description" content="" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="" />

</head>

<body<?php if($_SERVER['REQUEST_URI'] == '/'){ ?> class="home-page"<?php } ?>>
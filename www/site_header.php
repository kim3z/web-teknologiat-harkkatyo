<?php 
/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

date_default_timezone_set('Europe/Helsinki');
setlocale(LC_TIME, "fi_FI");

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>JULK - Ilmainen julkaisujärjestelmä</title>

  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="webteknologiat.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Margarine" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
  <link rel="stylesheet" href="assets/summernote/summernote-bs4.css">
  <style>
  /* Hero image css from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_hero_image */
  
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="http://new-lipas.uwasa.fi/~y104696/" style="font-family: 'Margarine', cursive;">JULK</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="http://new-lipas.uwasa.fi/~y104696/">Etusivu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://new-lipas.uwasa.fi/~y104696/docs/documentation-about-this-app-for-my-teacher/">Dokumentointi</a>
          </li>
          <?php
            if (isset($_SESSION['user'])) {
              echo '
              <li class="nav-item">
                <a class="nav-link" href="page_create_post.php">Uusi postaus</a>
              </li>';
            }
          ?>
          <?php if (!isset($_SESSION['user'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="page_register.php">Rekisteröidy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-primary text-white" href="page_login.php">Kirjaudu sisään</a>
          </li>
          <?php } ?>
          <?php
            if (isset($_SESSION['user'])) {
              echo '
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Kirjaudu ulos</a>
              </li>';
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
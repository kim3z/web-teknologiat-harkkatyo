<?php 
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
  <link href="assets/webteknologiat.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Margarine" rel="stylesheet">

  <style>
  /* Hero image css from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_hero_image */
  body, html {
    height: 100%;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }
  .hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/img/adventure.jpg');
  height: 80%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

.hero-text button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 10px 25px;
  color: black;
  background-color: #ddd;
  text-align: center;
  cursor: pointer;
}

.hero-text button:hover {
  background-color: #555;
  color: white;
}
/*./hero-image css*/

.card-img-top {
  width: 100%;
    height: 15vw;
    object-fit: cover;
}
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="/">JULK</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#documentation">Dokumentointi</a>
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
        </ul>
      </div>
    </div>
  </nav>
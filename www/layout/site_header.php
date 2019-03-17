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

  <title>MySite</title>

  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/webteknologiat.css" rel="stylesheet">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="/">Web-teknologiat</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="page_register.php">Rekisteröidy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="page_login.php">Kirjaudu sisään</a>
          </li>
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
        </ul>
      </div>
    </div>
  </nav>
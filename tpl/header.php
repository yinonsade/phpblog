<?php

$gooday = '';
$hour = date('H') + 2;
if ($hour > 5 && $hour < 12) {
    $gooday = 'Good morning!  ';
} elseif ($hour > 11 && $hour < 18) {
    $gooday = 'Good afternon!  ';
} elseif ($hour > 17 && $hour < 22) {
    $gooday = 'Good evning!  ';
} else {
    $gooday = 'Good night!  ';
}

?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/fx.scss">


  <title>
    <?=$title?>
  </title>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light navBGcss sticky-top">
      <a class="navbar-brand text-white" href="./"><span><img src="images/logo.png" alt=""></span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="blog.php">Blog</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <?php if (!isset($_SESSION['user_id'])): ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="signin.php">Sign in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="signup.php">Sing up</a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">
              <?=$gooday . '-' . htmlspecialchars($_SESSION['user_name']);?> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="logout.php">logout</a>
          </li>

          <?php endif;?>
        </ul>
      </div>
    </nav>
  </header>


  <?php if (isset($_GET['sm'])): ?>
  <div id="sm-box" class="container fixed-top mt-3">
    <div class="col-8 m-auto">
      <div class="alert alert-success text-center" role="alert">
        <?=$_GET['sm'];?>
      </div>
    </div>
  </div>
  <?php endif?>
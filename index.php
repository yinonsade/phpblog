<?php
require_once 'app/helpers.php';
start_session('mblogsession');
$title = 'Home Page'
?>
<?php include 'tpl/header.php';
?>

<main class="index-main">
  <div class="container text-center mt-5 mb-5">
    <div class="row">
      <div class="col-12 typewriter">
        <h1 class="main-title">Let evreyone know what is your BEST song!</h1>

      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mt-5 mb-5">


      </div>

      <div class="col-md-3 mt-5 mb-5 ">
        <a href="blog.php">
          <p class="bgPICcss">
            <span class="title">That</span>
            <span class="title">music</span>
            <span class="title">Blog!</span>
          </p>
        </a>
      </div>
      <div class="col-md-4 mt-5 mb-5">
      </div>
    </div>


</main>
<?php include 'tpl/footer.php';?>
<?php

require_once 'app/helpers.php';
start_session('mblogsession');

if (!verify_user()) {

    header('location: blog.php');
    exit;

}

$title = 'Add Post Page';
$error = '';

if (isset($_POST['submit'])) {

    db_connect();
    $user_title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $user_title = mysqli_real_escape_string($mysql_link, $user_title);
    $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $article = mysqli_real_escape_string($mysql_link, $article);
    $youtube = trim(filter_input(INPUT_POST, 'youtube', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $youtube = mysqli_real_escape_string($mysql_link, $youtube);
    $youtube = trim($youtube);

    if (!$user_title || mb_strlen($user_title) < 3) {
        $error = '* Title is required, at least 3 chars';
    } else if (!$article || mb_strlen($article) < 3) {
        $error = '* Article is required, at least 3 chars';
    } else if (!youtuber($youtube)) {
        $error = '* Please insert a valid youtube link!';
    } else {

        $uid = $_SESSION['user_id'];
        $sql = "INSERT INTO posts VALUES(null, $uid, '$user_title', '$article', NOW(), '$youtube')";
        $result = db_insert($sql);

        if ($result) {

            header('location: blog.php?sm=Post saved');
            exit;

        } else {

            $error = '* Error saving your new digg';

        }

    }

}

?>

<?php include 'tpl/header.php'?>
<main>
  <div class="container">
    <div class="row">
      <div class="col-12 pt-3">
        <h1 class="display-2 text-center">So...what is your SONG?</h1>
      </div>
    </div>
    <div class="row addpost">
      <div class="col-md-8 d-block m-auto">
        <p>Let us know!</p>
        <form action="" method="POST" novalidate="novalidate" autocomplete="off">
          <div class="form-group">
            <label for="title"><span class="text-danger">*</span> Your Song: </label>
            <input class="form-control" type="text" name="title" id="title" value="<?=old('title');?>">
          </div>
          <div class="form-group">
            <label for="article"><span class="text-danger">*</span> Why is it the best?: </label>
            <textarea rows="10" class="form-control" name="article" id="article"><?=old('article');?></textarea>
          </div>
          <div class="form-group">
            <label for="title"><span class="text-danger"></span> Youtube Link: </label>
            <input class="form-control" type="text" name="youtube" id="youtube" value="<?=old('youtube');?>">
          </div>

          <input name="submit" class="btn btn-primary btn-block mb-5" type="submit" value="Save">
          <?php if ($error): ?>
          <div class="alert alert-danger mt-3 mb-5" role="alert">
            <?=$error;?>
          </div>

          <?php endif;?>
        </form>
      </div>
    </div>
  </div>
</main>
<?php include 'tpl/footer.php'?>
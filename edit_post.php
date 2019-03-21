<?php

require_once 'app/helpers.php';
start_session('mblogsession');

if (!verify_user()) {

    header('location: blog.php');
    exit;

}

$uid = $_SESSION['user_id'];

if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {

    db_connect();
    $pid = mysqli_real_escape_string($mysql_link, $_GET['pid']);
    $sql = "SELECT * FROM posts WHERE id = $pid AND user_id = $uid";
    $post = db_query_row($sql);

    if (!$post) {
        header('location: blog.php');
    }

}

$title = 'Edit Post Page';
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

        $sql = "UPDATE posts SET title = '$user_title', article = '$article', youtube = '$youtube' WHERE id = $pid AND user_id = $uid";
        db_update($sql);
        header('location: blog.php?sm=Post updated');
        exit;

    }

}
?>

<?php include 'tpl/header.php'?>
<main>
  <div class="container addpost">
    <div class="row">
      <div class="col-12 pt-3">
        <h1 class="display-2">Edit Your Post Here</h1>
        <a href="blog.php"><i class="fas fa-chevron-circle-left fa-2x my-3"></i></a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 text-center d-block m-auto">
        <form action="" method="POST" novalidate="novalidate" autocomplete="off">
          <div class="form-group">
            <label for="title"><span class="text-danger">*</span> Title: </label>
            <input class="form-control" type="text" name="title" id="title" value="<?=$post['title'];?>">
          </div>
          <div class="form-group">
            <label for="article"><span class="text-danger">*</span> Article: </label>
            <textarea rows="10" class="form-control" name="article" id="article"><?=$post['article'];?></textarea>
          </div>
          <div class="form-group">
            <label for="title"><span class="text-danger"></span> Youtube Link: </label>
            <input class="form-control" type="text" name="youtube" id="youtube" value="<?=$post['youtube'];?>">
          </div>

          <input name="submit" class="btn btn-primary btn-block" type="submit" value="Update">
          <?php if ($error): ?>
          <div class="alert alert-danger mt-3" role="alert">
            <?=$error;?>
          </div>
          <?php endif;?>
        </form>
      </div>
    </div>
  </div>
</main>
<?php include 'tpl/footer.php'?>
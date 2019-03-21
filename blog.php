<?php
require_once 'app/helpers.php';
start_session('mblogsession');
$title = 'Blog page';
$sql = "SELECT u.name, p.id, p.user_id, p.title, p.article, p.youtube, up.avatar, DATE_FORMAT(p.date, '%d/%m/%Y %H:%i:%s')
        pdate FROM posts p
        JOIN users u ON u.id = p.user_id
        JOIN users_profile up ON u.id = up.user_id
        ORDER BY pdate desc";

$posts = db_query_all($sql);
$uid = $_SESSION['user_id'] ?? false;
?>

<?php include 'tpl/header.php';?>
<main class="mb-5">
  <div class="container">
    <div class="row">
      <div class="col-12 pt-3 m-auto">
        <h3 class="float-right glow">Share your ideas for <br> songs and music that you like!</h3>
        <?php if (verify_user()): ?>
        <p><a class="btn btn-primary" href="add_post.php"><i class="fas fa-plus"></i>Add your post...</a></p>
        <?php else: ?>
        <p><a class="btn btn-primary" href="signup.php">signup for posting...</a></p>
        <?php endif;?>
      </div>
    </div>
    <div class="row">
      <?php foreach ($posts as $post): ?>


      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header">
            <span>
              <img class="img-thumbnail sizing" width="60" src="images/<?=$post['avatar']?>">
              <?=$post['name'];?></span>
            <span class="float-right">
              <?=$post['pdate'];?></span>
          </div>
          <div class="card-body">
            <h4>
              <?='<span class="h6">' . $post['name'] . "'s " . 'Best song is:  ' . '</span>' . display_output($post['title']);?>
            </h4>
            <p>
              <?=display_output($post['article']);?>
            </p>



            <a target="_blank" href="<?=display_output($post['youtube']);?>"><button type="button" class="btn btn-danger"
                data-toggle="modal" data-target="#exampleModal">
                click to hear the song <i class="fab fa-youtube"></i>
              </button></a>






            <?php if ($uid == $post['user_id']): ?>
            <p>
              <div class="btn-group float-right">
                <a class="btn-editor btn btn-secondary btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="edit_post.php?pid=<?=$post['id'];?>"><i class="fas fa-pen"></i>Edit</a>
                  <a class="dropdown-item confirm-ms-link" href="delete_post.php?pid=<?=$post['id'];?>"><i class="fas fa-trash-alt"></i>
                    Delete</a>
                </div>
              </div>
            </p>
            <?php endif;?>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</main>
<div class=text-center>
  <button type="button" class="btn btn-info scroll" onclick="topFunction()"><i class="fas fa-arrow-up"></i></button>
</div>

<br><br><br><br>
<?php include 'tpl/footer.php';?>
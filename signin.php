<?php

require_once 'app/helpers.php';
start_session('mblogsession');

if (isset($_SESSION['user_id'])) {
    header('location: blog.php');
    exit;
}

$title = 'Sign in page';
$error = '';

if (isset($_POST['submit'])) {

    if (isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

        db_connect();
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        $email = mysqli_real_escape_string($mysql_link, $email);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $password = mysqli_real_escape_string($mysql_link, $password);

        if (!$email) {
            $error = ' * A valid email is required';
        } elseif (!$password) {
            $error = ' * Password is required';
        } else {

            $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
            $user = db_query_row($sql);

            if ($user) {

                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    header('location: blog.php?sm=Welcome, ' . $user['name']);
                    exit;
                } else {
                    $error = ' * Wrong email / password';
                }

            } else {

                $error = ' * Wrong email / password';

            }

        }

    }

    $token = csrf_token();

} else {

    $token = csrf_token();

}

?>

<?php include 'tpl/header.php'?>
<main>
  <div class="container">
    <div class="row">
      <div class="col-12 pt-3">
        <h1 class="display-2">Sing in and Start Posting!</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mt-5">
        <div class="card">
          <div class="card-header">
            <span class="h5">Sign in with your account</span>
          </div>
          <div class="card-body">
            <form action="" method="POST" novalidate="novalidate" autocomplete="off">
              <input type="hidden" name="token" value="<?=$token;?>">
              <div class="form-group">
                <label for="email"><span class="text-danger">*</span> Email:</label>
                <input value="<?=old('email');?>" class="form-control" type="email" name="email" id="email">
              </div>
              <div class="form-group">
                <label for="password"><span class="text-danger">*</span> Password:</label>
                <input class="form-control" type="password" name="password" id="password">
              </div>
              <input class="btn btn-primary" name="submit" type="submit" value="Sign in">
              <?php if ($error): ?>
              <span class="text-danger">
                <?=$error;?>
              </span>
              <?php endif;?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include 'tpl/footer.php'?>
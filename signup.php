<?php

require_once 'app/helpers.php';
start_session('mblogsession');

if (isset($_SESSION['user_id'])) {
    header('location: blog.php');
    exit;
}

$title = 'Sign up page';
$error = ['name' => '', 'email' => '', 'password' => ''];

if (isset($_POST['submit'])) {

    if (isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

        db_connect();
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $name = mysqli_real_escape_string($mysql_link, $name);
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        $email = mysqli_real_escape_string($mysql_link, $email);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $password = mysqli_real_escape_string($mysql_link, $password);
        $form_valid = true;
        $query_email = "SELECT email FROM users WHERE email = '$email'";

        if (!$name || mb_strlen($name) < 2) {
            $error['name'] = '* Name is required at least 2 chars.';
            $form_valid = false;
        }

        if (!$email) {
            $error['email'] = '* A valid email is required.';
            $form_valid = false;
        } elseif (db_query_row($query_email)) {
            $error['email'] = '* Email is taken.';
            $form_valid = false;
        }

        if (!$password || mb_strlen($password) < 6 || mb_strlen($password) > 20) {
            $error['password'] = '* Password is required between 6 - 20 chars';
            $form_valid = false;
        }

        if ($form_valid) {

            $image_name = 'default.jpg';
            $max_size = 1024 * 1024 * 5;
            $ex = ['png', 'jpg', 'jpeg', 'gif', 'bmp'];

            if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {

                if (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

                    if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= $max_size) {

                        $file_info = pathinfo($_FILES['image']['name']);

                        if (in_array(strtolower($file_info['extension']), $ex)) {

                            $image_name = date('Y.m.d.H.i.s') . '-' . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image_name);

                        }

                    }

                }

            }

            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users VALUES(null, '$name', '$email', '$password', NOW())";
            $uid = db_insert($sql, true);
            db_insert("INSERT INTO users_profile VALUES(null, $uid, '$image_name')");
            $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['user_id'] = $uid;
            $_SESSION['user_name'] = $name;
            header('location: blog.php?sm=You sign up successfully, welcome ' . $name);
            exit;

        }

    }

    $token = csrf_token();

} else {

    $token = csrf_token();

}

?>

<?php include 'tpl/header.php'?>
<main>
  <div class="container mb-5">
    <div class="row">
      <div class="col-12 pt-3">
        <h1 class="display-2">Sing up to "THAT MUSIC BLOG"!</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 my-5">
        <div class="card">
          <div class="card-header">
            <span class="h5">Sign up for new account</span>
          </div>
          <div class="card-body">
            <form action="" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data">
              <input type="hidden" name="token" value="<?=$token;?>">
              <div class="form-group">
                <label for="name"><span class="text-danger">*</span> Name:</label>
                <input value="<?=old('name');?>" class="form-control" type="text" name="name" id="name">
                <span class="text-danger mt-1">
                  <?=$error['name'];?>
                </span>
              </div>
              <div class="form-group">
                <label for="email"><span class="text-danger">*</span> Email:</label>
                <input value="<?=old('email');?>" class="form-control" type="email" name="email" id="email">
                <span class="text-danger mt-1">
                  <?=$error['email'];?>
                </span>
              </div>
              <div class="form-group">
                <label for="password"><span class="text-danger">*</span> Password:</label>
                <input class="form-control" type="password" name="password" id="password">
                <span class="text-danger mt-1">
                  <?=$error['password'];?>
                </span>
              </div>
              <div class="form-group">
                <label for="image">Profile Image:</label>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                  <input name="image" type="file" class="custom-file-input" id="image">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
              </div>
              <input class="btn btn-primary my-3" name="submit" type="submit" value="Sign up">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include 'tpl/footer.php'?>
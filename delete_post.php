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
    $sql = "DELETE FROM posts WHERE id = $pid AND user_id = $uid";
    $sm = db_delete($sql) ? '?sm=Post deleted' : '';
    header('location: blog.php' . $sm);

}
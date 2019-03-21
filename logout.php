<?php

require_once 'app/helpers.php';
start_session('mblogsession');
session_destroy();
header('location: signin.php');
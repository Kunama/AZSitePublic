<?php
include('backbones/includes/global.php');
session_start();
session_destroy();
session_unset();
unset($_SESSION["Role"]);
$_SESSION = array();
redirect('login.php');
?>

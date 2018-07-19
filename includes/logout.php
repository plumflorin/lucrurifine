<?php session_start(); ?>

<?php

$_SESSION['username'] = null;

unset($_SESSION);

session_destroy();

header("Location: ../index.php");

 ?>

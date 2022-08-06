<?php
session_start();
$test = "test";
unset( $_SESSION['id']);
unset( $_SESSION['login']);
unset( $_SESSION['adminstatus']);
header("location:index.php");

<?php 
  session_start(); 

  if (!isset($_SESSION['user_email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: index.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['user_email']);
  	header("location: index.php");
  }
  $user = $_SESSION['user_email'];
?>
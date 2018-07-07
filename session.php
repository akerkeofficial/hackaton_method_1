<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect('localhost', 'root', '','method_hackaton_1');
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['user_email'];
// SQL Query To Fetch Complete Information Of User
$user_check_query = "SELECT  user_email,user_id from users where user_email='$user_check'";
$result = mysqli_query($connection, $user_check_query);

$row = mysqli_fetch_assoc($result);
$login_session =$row['user_email'];
if(!isset($login_session)){
mysqli_close($connection); // Closing Connection
}
?>
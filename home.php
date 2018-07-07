<?php 
   include("session.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['user_email'])) : ?>
    	<p>Welcome <strong><?php 
    	$user = $_SESSION['user_email'];
    	echo  $user; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		

		<?php
		$text = "";
		$user = $_SESSION['user_email'];
		echo $user;
$connection = mysqli_connect('localhost', 'root', '','method_hackaton_1');

// $sql2 = mysqli_query($connection,"SELECT money FROM users WHERE user_email = '$login_session'");
// $row2 = mysqli_fetch_array($sql2);
// $nombre = $row2['money'];
// echo $nombre;

if(isset($_POST['money_save']))
{
	  $text = mysqli_real_escape_string($connection, $_POST['input_text']);

     //$asd = "UPDATE users set money=$text where user_email='user_email'";
	  $asd = "UPDATE users set money = '$text' where user_email='$user'";
     mysqli_query($connection,$asd);
     header('location: plan.php');
}
?>


<form  method="POST">
    <h2>Input your budget</h2>
    <p><textarea rows="10" cols="45" name="input_text"></textarea></p>
    <p><input type="submit" value="Отправить" name="money_save"></p>
</form>
</body>
</html>


<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b> 
</div>




<?php
$connection = mysqli_connect('localhost', 'root', '','method_hackaton_1');
  $text = mysqli_real_escape_string($connection, $_POST['input_text']);

// $sql2 = mysqli_query($connection,"SELECT money FROM users WHERE user_email = '$login_session'");
// $row2 = mysqli_fetch_array($sql2);
// $nombre = $row2['money'];
// echo $nombre;

if(isset($_POST['money_save']))
{
     $asd = "UPDATE users set money=$text where user_email='$login_session'";
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

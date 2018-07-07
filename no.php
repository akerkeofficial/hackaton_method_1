<!DOCTYPE html>
<html>
<style type="text/css"></style>
<body>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "method_hackaton_1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT rest_id,name,address FROM rest where type='hotel' OR type='hostel'";
$result = $conn->query($sql);

?>
<?php

$img = "img/accom/ajour.jpg";
$img1 = "img/accom/terra.jpg";
$img2 = "img/accom/dimalhostel.jpg";
$img3 = "img/accom/hostel64.jpg";
$img4 = "img/accom/kazakh.jpg";
$img5 = "img/accom/kazhostel.jpeg";
$img6 = "img/accom/nicehostel.jpg";
$img7 = "img/accom/roza.jpg";
$img8 = "img/accom/skyhostel.jpg";
$img9 = "img/accom/turkestan.jpg";


$collection = array( $img, $img1, $img2,$img3,$img4,$img5,$img6,$img7,$img8,$img9);


    // output data of each row

    while($row = $result->fetch_assoc()) {
        foreach ( $collection as $item ) {

		echo "<img style='max-width: 100px;' src='./".$item."'/>";
		echo "<br> id: ". $row["rest_id"]. " - Name: ". $row["name"]. " " . $row["address"] . "<br>";

}
    }

$conn->close();

?> 



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>

</body>
</html>
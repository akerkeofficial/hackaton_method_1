<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Bootstrap 3 rows with PHP loop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
  <?php
    $cars = array("Volvo", "BMW", "Fiat", "Ford", "Audi", "Kia", "Renault", "Opel");
    echo '<div class="row">';
    foreach($cars as $item => $car) {  
  ?>
    <div class="col-md-4">
    <h4><?php echo $car ;?></h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fringilla maximus urna, consectetur faucibus mauris porta.</p>
    </div>
    <?php
    $count = 4;
       if($count == 3){
         echo "</div><div class='row'>";
       }
     ?>
    <?php $count++; 
      }
    ?>
  </div>
</body>

</html>
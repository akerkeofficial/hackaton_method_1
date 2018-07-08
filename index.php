<?php
// registration


$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'method_hackaton_1');
// REGISTER USER
if (isset($_POST['register_btn'])) {
  // receive all input values from the form
  session_start();
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if ($password != $password1) {
  array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE user_name='$username' OR user_email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['user_name'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['user_email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password);//encrypt the password before saving in the database

    $query = "INSERT INTO users (user_name, user_email, password) 
          VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['user_email'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: question.php');
  }
}



// LOGIN USER
if (isset($_POST['log_in_btn'])) {
  $email_in = mysqli_real_escape_string($db, $_POST['email_in']);
  $password_in = mysqli_real_escape_string($db, $_POST['password_in']);

  if (empty($email_in)) {
    array_push($errors, "email_in is required");
  }
  if (empty($password_in)) {
    array_push($errors, "password_in is required");
  }

  if (count($errors) == 0) {
    $password_in = md5($password_in);
    $query = "SELECT * FROM users WHERE user_email='$email_in' AND password='$password_in'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['user_email'] = $email_in;
      $_SESSION['success'] = "You are now logged in";
      header('location: home.php');
    }else {
      array_push($errors, "Wrong email_in/password_in combination");
    }
  }
}

?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AlmatyGo</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Priezjie.com</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Алматы</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#portfolio">Климат</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">Достопримечательности</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#team">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger button special" href="#contact">Войти</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">Welcome To Our Almaty!</div>
          <div class="intro-heading text-uppercase">It's Nice To Meet You</div>
          <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
        </div>
      </div>
    </header>

    <!-- Services -->
    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Алматы</h2>
            <h3 class="section-subheading text-muted">Город вашей мечты</h3>

            <!-- About -->

  <div class="about">
    <div class="container">
      <div class="row">
        <div class="col">
          
        </div>
      </div>
      <div class="row about_row">
        <div class="col-lg-6 about_col order-lg-1 order-2">
          <div class="about_content">
            <p>Город Алматы расположен в центре евразийского континента, на юго-востоке Республики Казахстан. Географические координаты: 77 градусов восточной долготы и 43 градуса северной широты. Алматы находится на одной параллели с такими известными городами как Гагры и Владивосток.<br>Алматы живописно раскинулся в предгорьях Заилийского Алатау – самого северного горного хребта Тянь-Шаня. Так что, Алматы такой же горный город как Душанбе или Ереван. Общая площадь города - более чем 170 квадратных километров.</p>
          </div>
        </div>
        <div class="col-lg-6 about_col order-lg-2 order-1">
          <div class="about_image">
            <img src="img/almaty-2022-vue-nocturne.jpg" alt="https://unsplash.com/@sanfrancisco">
          </div>
        </div>
      </div>
    </div>
  </div>
          </div>
        </div>
        
      </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="bg-light" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading2 text-uppercase">Климат</h2>
            <h3 class="section-subheading text-muted">Климат нашего города</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
              <img class="img-fluid" src="img/14073f5ecaa4b09d21010dd1fb76c2a2.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Осень</h4>
              <p class="text-muted"></p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal6">
              <img class="img-fluid" src="img/06-thumbnaill.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Летняя красота</h4>
              <p class="text-muted"></p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal3">
              <img class="img-fluid" src="img/y3-11.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Весна</h4>
              <p class="text-muted"></p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal4">
              <img class="img-fluid" src="img/badb23d67fd20f7718abb0aa80e6713b_crop_l_2_t_0_w_764_h_429_resize_w_525_h_1.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Лето</h4>
              <p class="text-muted"></p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal5">
              <img class="img-fluid" src="img/05-thumbnail1.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Дождливые дни</h4>
              <p class="text-muted"></p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
              <img class="img-fluid" src="img/350_197_fixedwidth1.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Зима</h4>
              <p class="text-muted"></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About -->
    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Достопримечательности</h2>
            <h3 class="section-subheading text-muted">В этом разделе вы можете познакомиться с очень духовно-культурными местами</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul class="timeline">
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/11.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                   
                    <h4 class="subheading">Горы</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Горы Алматы, они же Заилийский Алатау (хребет Северного Тянь-Шаня) — сравнительно молодые и, как Великие Гималаи, все еще продолжают расти. Высота горных вершин колеблется в районе 4000 м, высшая точка — пик Талгар. Места здесь красивые, чистые.</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/22.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    
                    <h4 class="subheading">Отели и гостиницы</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Отель «Казахстан» - уникальный исторический памятник мегаполиса Алматы, достояние Республики Казахстан. Образец монументальной, надежной советской архитектуры. Отель «Казахстан» один из немногих отелей в мире, ставший неотъемлемой частью города.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/33.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                 
                    <h4 class="subheading">Центральный Государственный музей</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Центральный Государственный музей Республики Казахстан является одним из самых больших  музеев Центральной Азии. Три этажа музея включают в себя,как выставочные галереи, так и 4 экспозиционных зала. Каждый посетитель обязательно сможет найти зал или памятник по душе.</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/44.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                 
                    <h4 class="subheading">Иссыкский золотой человек</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Сокровища кургана Иссык, в том числе точная копия экспонировались в Казахском музее археологии, находящемся в Алма-Ате, а теперь в Государственном музее золота и драгоценных металлов Республики Казахстан в Астане. «Золотой человек» на крылатом барсе стал одним из национальных символов Казахстана.</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <h4>Be Part
                    <br>Of Our
                    <br>Story!</h4>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Team -->
    <section class="bg-light" id="team">
      <div class="container">
           <div class="row about_row">
        <div class="col-lg-6 about_col order-lg-1 order-2">
            <h2 class="section-heading text-uppercase">About us</h2>
            <h3 class="section-subheading text-muted">Цель нашей команды</h3>
          <div class="about_content">
            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
           
          </div>
        </div>
        <div class="col-lg-6 about_col order-lg-2 order-1">
          <div class="about_image">
            <img src="img/almaty-2022-vue-nocturne.jpg" alt="https://unsplash.com/@sanfrancisco">
          </div>
        </div>
      </div>
        </div>
      </div>
    </section>

    
    <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
                <div class="col-md-5">
                <form method="POST" action="index.php">
                  <div class="col-lg-6 text-center">
                     <h2 class="section-heading text-uppercase">Войти</h2>
                  </div>
                  <div class="form-group">
                    <input class="form-control"  type="email" placeholder="Your Email..." required="required" data-validation-required-message="Please enter your email address" name="email_in">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="password" placeholder="Your Password..." required="required" data-validation-required-message="Please enter your password" name="password_in">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="col-lg-12 text-left">
                  <div id="success"></div>
                  <button type="submit" name="log_in_btn">Войти</button>
                </div>
                </form>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-5">
                <form method="POST" action="index.php">
                  <div class="col-lg-6 text-center">
                     <h2 class="section-heading text-uppercase">Регистрация</h2>
                  </div>
                            

                  <div class="form-group">
                    <input class="form-control" id="username" type="text" placeholder="Your Name..." required="required" data-validation-required-message="Please enter your name" name="username">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email..." required="required" data-validation-required-message="Please enter your email address" name="email">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="password" type="password" placeholder="Your Password..." required="required" data-validation-required-message="Please enter your password" name="password">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="password1" type="password" placeholder="Please confirm your password" required="required" data-validation-required-message="Please confirm your password" name="password1">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="col-lg-12 text-left">
                  <div id="success"></div>
                  <button type="submit" name="register_btn">Регистрация</button>
                </div>
                </form>
            </div>
            </div>
            </div>
            </section>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>

  </body>

</html>

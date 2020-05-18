<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/templates/style.css">
    <title> POSTER </title>
</head>
    <body class="grey lighten-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../index.php">POSTERS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="../index.php">Home</a>
      <a class="nav-item nav-link" href="../register.php"> Sing UP!</a>  
      </div>
  </div>
      <?php 
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
        if (isset($_SESSION['id'])) {   
            //  echo 'welcome id :' . $_SESSION['id'];
            include 'config/db_connect.php';
            include 'class.post.php';
              $id = $_SESSION['id'];
            $sql1 = " select last_name, first_name from user where id = $id";
            $result1 = mysqli_query($connect, $sql1);
            $name = mysqli_fetch_assoc($result1);
         ?><div class="pull-right">
                <ul class="nav pull-right">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <?php echo  $name['last_name'] . '  ' . $name['first_name']  ?> </a>
                        <ul class="dropdown-menu">
                            <li><a href="../postByUser.php"><i class="icon-envelope"></i> Post By Use</a></li>
                            <li><a href="/log_out.php">  </i>  Logout</a></li>
                        </ul>
                    </li>
                </ul>
              </div>
      <?php } else { ?>
             <div class="pull-right">
                <a class="nav-item nav-link" href="../login.php">Sign in</a>
              </div>
              <?php } ?>
      
    </div>
  </div>
</nav>

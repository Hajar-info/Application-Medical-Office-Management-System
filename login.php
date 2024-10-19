<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(isset($_SESSION["username"])){
    header("Location: home.php");
    exit();
  }

// Vérifiez si l'utilisateur a choisie leur type
  if (!isset($_GET["role"])) {
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css_au/style.css" />
</head>
<body>
<?php
require('config1.php');

if (isset($_POST['username'])){
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn,$username);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn,$password);
  $query = "SELECT * FROM `users` WHERE username LIKE '%$username%' and password='".hash('sha256', $password)."'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $rows = mysqli_num_rows($result);
  if($rows==1){
      $_SESSION['username'] = $username;
      header("Location: home.php");
  }else {
        header("Location: login.php?role=".$_SESSION['role']."&msg=error");
  }
}
?>

<DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>|Gestion d'un cabinet médical👨🏻‍⚕️| </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- dakchi dyl page lokhra -->

        <link rel="stylesheet" type="text/css" href="css_au/style.css">

  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap"  rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body class="login">
 <body>


  <div class="container">
    <div class="img">
  
     <img src="img/MD.svg"> 
    </div>

    <div class="login-content">
      <form action="login.php" method="post" name="login">
        
        <?php
        if ( isset($_GET['role']) ) {
          if ( $_GET['role'] == "admin" ) {
            $_SESSION['role'] = "admin";
            echo ' <img src="img/man.png">';
          } else if ( $_GET['role'] == "medecin" ) {
            $_SESSION['role'] = "medecin";
            echo ' <img src="img/DOCTORR.png"> ';
          } else if ( $_GET['role'] == "secretaire" ) {
            $_SESSION['role'] = "secretaire";
            echo ' <img src="img/SEC.png"> ';
          }
        }
        ?>

        <h2 style="font-size: 30px" class="title">BIENVENUE <?php echo strtoupper($_GET['role']);?></h2>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-user"></i>
                 </div>

                 <div class="div">
                    <h5>Username</h5>
                    <input type="text" name="username"class="input" required>
                 </div>
              </div>
              <div class="input-div pass">
                 <div class="i">
                    <i class="fas fa-lock"></i>
                 </div>

                 <div class="div">
                    <h5>Password</h5>
                    <input type="password" name="password" class="input" required>
                 </div>
              </div>
              <a style="color: #0F4D67" href="forgout.php">Mot de passe oublié?</a>
              <input type="submit" name="submit" class="btn" value="Login">

             <!---------------- register ----------------------->

           <p class="box-register">Vous êtes nouveau ici?
            <a  style="color: #0F4D67"; href="register1.php">S'inscrire</a></p>
                  <?php if ( isset($_GET['msg'] ) ) {
                      if ($_GET['msg'] == "error") {
                      $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                   ?>
           <p class="errorMessage"><?php echo $message; ?></p>
                 <?php } } ?>

            <!-------------------------------------------------->

            </form>
        </div>
    </div>
    <script type="text/javascript" src="js_au/main.js"></script>
</body>
</html>

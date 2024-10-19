<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if( isset( $_SESSION["username"] ) ) {
    header("Location: home.php");
    exit();
  }

// Vérifiez si l'utilisateur a choisie leur type
  if (!isset($_SESSION["role"])) {
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
require_once('config1.php');

if ( isset( $_POST['email']) ) {
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn, $email);
 
  $query = "SELECT * FROM users WHERE email ='$email'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $rows = mysqli_num_rows($result);
  if( $rows == 1 ) {
    // code here
    $message = "<p style='color:green;'>Succes Email !</p>";
      
  } else {
    $message = "Ereur : Email non trouvable !";
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
      <form action="forgout.php" method="post" name="login">
        
        <?php
        if ( isset($_SESSION['role']) ) {
          if ( $_SESSION['role'] == "admin" ) {
            echo ' <img src="img/man.png"> ';
          } else if ( $_SESSION['role'] == "medecin" ) {
            echo ' <img src="img/DOCTORR.png"> ';
          } else if ( $_SESSION['role'] == "secretaire" ) {
            echo ' <img src="img/SEC.png"> ';
          }
        }
        ?>

        <h2 style="font-size: 30px" class="title">BIENVENU <?php echo strtoupper($_SESSION['role']);?></h2>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-user"></i>
                 </div>

                 <div class="div">
                    <h5>Email</h5>
                    <input type="text" name="email"class="input" >
                 </div>
              </div>
              <input type="submit" name="submit" class="btn" value="Reset your password">
           <p class="errorMessage"><?php echo $message; ?></p>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js_au/main.js"></script>
</body>
</html>

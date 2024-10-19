<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(isset($_SESSION["username"])){
    header("Location:home.php");
    exit();
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription</title>
  <link rel="stylesheet" href="css_au/style.css" />
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
</head>
<body>
<?php
require('config1.php');

if ( isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'], $_REQUEST['role']) ) {

  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username); 

  // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn, $email);

  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);

  // récupérer le type et supprimer les antislashes
  if (!empty($_POST['role']) ) {
    $role = stripslashes($_POST['role']);
  } else { header("Location: register1.php");}
  

  //requéte SQL + mot de passe crypté
  $query = "INSERT INTO `users` (username, email, password, role)
    VALUES ('$username', '$email', '".hash('sha256', $password)."', '$role')";
  // Exécuter la requête sur la base de données
  $res = mysqli_query($conn, $query);
  if( $res ) {
    echo '
      <div class="container">
        <div class="img">
          <img src="img/MD.svg">
        </div>
        <div class="login-content">
             <div class="sucess">
               <h3>
                Vous êtes inscrit avec succès.
               </h3>
               <p>
               Cliquez ici pour vous 
               <strong><a href="login.php"> connecter</a></strong>
               </p>
             </div>
        </div>
      </div>
    ';
  }
} else {
?>

<div class="container">
  <div class="img">
    <img src="img/MD.svg">
  </div>
  <div class="login-content">
    <form class="box" action="register1.php" method="post">
     

      <img src="img/man.png">

      <h2 style="font-size: 30px" class="title">
        S'inscrire
      </h2>

      <!-- Input Username -->
      <div class="input-div one">
       <div class="i">
          <i class="fas fa-user"></i>
       </div>

       <div class="div">
          <h5>Username</h5>
          <input type="text" name="username" class="input" required />
       </div>
      </div>

      <!-- Input Email -->
      <div class="input-div one">
       <div class="i">
          <i class="fas fa-user"></i>
       </div>

       <div class="div">
          <h5>Email</h5>
          <input type="text" name="email" class="input" required />
       </div>
      </div>

      <!-- Input Password -->
      <div class="input-div pass">
        <div class="i">
          <i class="fas fa-lock"></i>
        </div>

        <div class="div">
          <h5>Password</h5>
          <input type="password" name="password" class="input" required />
        </div>
      </div>

      <!-- Input Role -->
      <input type="radio" name="role" value="admin" id="admin">
      <label for="admin">Admin</label>

      <input type="radio" name="role" value="medecin" id="med" checked="true">
      <label for="med">Medecin</label>

      <input type="radio" name="role" value="secretaire" id="sec">
      <label for="sec">Secretaire</label>

      <!-- Button Submit -->
      <input type="submit" name="submit" value="S'inscrire" class="btn" />

      <p class="box-register">Déjà inscrit? <a style="color: #0F4D67"; href="login.php">Connectez-vous ici</a></p>
    </form>
  </div>
</div>

<script type="text/javascript" src="js_au/main.js"></script>

<?php
  }
?>

</body>
</html>

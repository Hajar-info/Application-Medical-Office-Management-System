<?php
// Informations d'identification
define('servername','localhost');
define('username','root');
define('password','');
define('dbname','dbgcm');
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect(servername,username,password,dbname);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>
<?php

// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["username"])){
  header("Location:../../login.php");
  exit(); 
}



// Etablir la connexion avec Mysql
$servername="localhost";
$user="root";
$password="";
$connexion=mysqli_connect($servername,$user,$password);
mysqli_select_db($connexion,"dbgcm");
// charger la liste des medecin
$Sql22="select * from medecin";
$listeMed=mysqli_query($connexion,$Sql22);
//charger la liste des types d'analyse
$req1="select * from typeanalyse";
$listetype=mysqli_query($connexion,$req1);
// charger la liste des patients
$Sql222="select * from patient";
$listePat=mysqli_query($connexion,$Sql222);
//charger la liste des techniciens
$Sql2223="select * from technicien";
$listeTech=mysqli_query($connexion,$Sql2223);
// charger la liste des analysemedicale
$Sql2="select * from analysemedicale,medecin,patient,technicien,typeanalyse
WHERE analysemedicale.NumDossierPat=patient.NumDossierPat and analysemedicale.NumIdMedecin=medecin.NumIdMedecin and analysemedicale.MatricTechnicien=technicien.MatricTechnicien and analysemedicale.IdTypeAnalyse=typeanalyse.IdTypeAnalyse;";
$reponse=mysqli_query($connexion,$Sql2);
// Ajouter  analyse
extract($_POST);
if(isset($_POST['ajouter'])){
   $requet="INSERT INTO analysemedicale(IdTypeAnalyse,DateAnalyseMed,DescriptionAnalyse,NumDossierPat,NumIdMedecin,MatricTechnicien,EtatAnalyse)
   VALUES('$TypeAnalyse','$DateAnalyseMed','$DescriptionAnalyse','$NumDossierPat','$NumIdMedecin','$MatricTechnicien','$EtatAnalyse');";
   mysqli_query($connexion,$requet);
   header("location:GestionAnalyse.php");
}
//Supression
if(isset($_GET['Sup'])){
   $id=$_GET['code'];
   $sql2="DELETE FROM analysemedicale WHERE CodeAnalyseMed='$id'";
   $rep=mysqli_query($connexion,$sql2);
   header("location:GestionAnalyse.php");
}
//Visualiser
if(isset($_GET['Vue'])){
   $id=$_GET['code'];
   $sqll="SELECT * FROM analysemedicale,medecin,patient,technicien
   WHERE analysemedicale.NumDossierPat=patient.NumDossierPat and analysemedicale.NumIdMedecin=medecin.NumIdMedecin and analysemedicale.MatricTechnicien=technicien.MatricTechnicien and CodeAnalyseMed='$id'";
   $reponse2=mysqli_query($connexion,$sqll);
   $rows2=mysqli_fetch_array($reponse2);
}
// Mise à Jour
if(isset($_POST['modifier'])){
   extract($_POST);
   $requet="UPDATE analysemedicale SET DateAnalyseMed='$DateAnalyseMed',DescriptionAnalyse='$DescriptionAnalyse',NumDossierPat='$NumDossierPat',NumIdMedecin='$NumIdMedecin',MatricTechnicien='$MatricTechnicien' WHERE CodeAnalyseMed='$CodeAnalyseMed' ;";
   $resultat=mysqli_query($connexion,$requet);
   header("location:GestionAnalyse.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>PGC | Listes Des Analyses médicaux</title>

 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
 <!-- DataTables -->
 <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
 <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

 <!-- Theme style -->
 <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
    
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="../../logout1.php" >Déconnexion</a>
</li>
     <!-- Navbar Search -->
     <li class="nav-item">
       <a class="nav-link" data-widget="navbar-search" href="#" role="button">
         <i class="fas fa-search"></i>
       </a>
       <div class="navbar-search-block">
         <form class="form-inline">
           <div class="input-group input-group-sm">
             <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
             <div class="input-group-append">
               <button class="btn btn-navbar" type="submit">
                 <i class="fas fa-search"></i>
               </button>
               <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                 <i class="fas fa-times"></i>
               </button>
             </div>
           </div>
         </form>
       </div>
     </li>

     <!-- Messages Dropdown Menu -->
     <li class="nav-item dropdown">
       <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="far fa-comments"></i>
         <span class="badge badge-danger navbar-badge">3</span>
       </a>
       <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         <a href="#" class="dropdown-item">
           <!-- Message Start -->
           <div class="media">
             <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
             <div class="media-body">
               <h3 class="dropdown-item-title">
                 Brad Diesel
                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
               </h3>
               <p class="text-sm">Call me whenever you can...</p>
               <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
             </div>
           </div>
           <!-- Message End -->
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
           <!-- Message Start -->
           <div class="media">
             <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
             <div class="media-body">
               <h3 class="dropdown-item-title">
                 John Pierce
                 <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
               </h3>
               <p class="text-sm">I got your message bro</p>
               <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
             </div>
           </div>
           <!-- Message End -->
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
           <!-- Message Start -->
           <div class="media">
             <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
             <div class="media-body">
               <h3 class="dropdown-item-title">
                 Nora Silvester
                 <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
               </h3>
               <p class="text-sm">The subject goes here</p>
               <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
             </div>
           </div>
           <!-- Message End -->
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
       </div>
     </li>
     <!-- Notifications Dropdown Menu -->
     <li class="nav-item dropdown">
       <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="far fa-bell"></i>
         <span class="badge badge-warning navbar-badge">15</span>
       </a>
       <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         <span class="dropdown-item dropdown-header">15 Notifications</span>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
           <i class="fas fa-envelope mr-2"></i> 4 new messages
           <span class="float-right text-muted text-sm">3 mins</span>
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
           <i class="fas fa-users mr-2"></i> 8 friend requests
           <span class="float-right text-muted text-sm">12 hours</span>
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
           <i class="fas fa-file mr-2"></i> 3 new reports
           <span class="float-right text-muted text-sm">2 days</span>
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
       </div>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-widget="fullscreen" href="#" role="button">
         <i class="fas fa-expand-arrows-alt"></i>
       </a>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
         <i class="fas fa-th-large"></i>
       </a>
     </li>
   </ul>
 </nav>
 <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <?php require_once("../inc/menu.php"); ?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1>Gestion des Analyses Médicaux</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             
            
           </ol>
         </div>
       </div>
     </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">

     <!-- CARTE LISTE CLIENT -->
     <div class="card card-info">
       <div class="card-header">
         <h3 class="card-title">Liste des analyses</h3>

         <div class="card-tools">
           <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
             <i class="fas fa-minus"></i>
           </button>
           <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
             <i class="fas fa-times"></i>
           </button>
         </div>
       </div>
       <div class="card-body">
         <table id="example1" class="table table-bordered table-striped">
           <thead>
           <tr>
             <th>Code-Analyse</th>
             <th>Date</th>
             <th>Description</th>
             <th>Patient</th>
             <th>Médecin</th>
             <th>Technicien</th>
             <th>Action</th>
           </tr>
           </thead>
           <tbody>
             <?php
               while($row=mysqli_fetch_array($reponse))
               {
                   echo"
               <tr>
                   <td> ".$row['CodeAnalyseMed']." </td>
                   <td>".$row['DateAnalyseMed']."</td>
                   <td>".$row['DescriptionAnalyse']."</td>
                   <td>".$row['NomPatient']."</td>
                   <td>".$row['NomMedecin']."</td>
                   <td>".$row['NomTechnicien']."</td>
                   <td>
                   <a onClick=\"javascript: return confirm('Veuillez confirmer la suppression');\" href=GestionAnalyse.php?code=".$row['CodeAnalyseMed']."&Sup=ok><i class='fas fa-trash'></i></a>
                   <a href=GestionAnalyse.php?code=".$row['CodeAnalyseMed']."&Vue=ok><i class='fas fa-eye'></i></a>
                   <a href=GestionAnalyse.php?code=".$row['CodeAnalyseMed']."&Vue=ok><i class='fas fa-pen'></i></a>
                   </td>
               </tr>" ;
               }
               ?>
           </tbody>
           <tfoot>
           <tr>
           <th>Code-Analyse</th>
             <th>Date</th>
             <th>Description</th>
             <th>Patient</th>
             <th>Médecin</th>
             <th>Technicien</th>
             <th>Action</th>
           </tr>
           </tfoot>
         </table>
       </div>
       <!-- /.card-body -->
       
       <!-- /.card-footer-->
     </div>
     <!-- CARTE FORMULAIRE CLIENT -->
     <div class="card card-primary">

       <div class="card-header">
         <h3 class="card-title">Formulaire-Analyse</h3>

         <div class="card-tools">
           <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
             <i class="fas fa-minus"></i>
           </button>
           <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
             <i class="fas fa-times"></i>
           </button>
         </div>
       </div>
       <form method="POST" action="GestionAnalyse.php">

       <div class="card-body">
       <div class="form-group">
                   <label for="exampleInputEmail1">Code d'analyse :</label>
                   <input type="text" name="CodeAnalyseMed" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['CodeAnalyseMed'];}?>" placeholder="Code Analyse" readonly="true"/>
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Type analyse:</label>
                   <select  name="TypeAnalyse" class="form-control" id="exampleInputEmail1" placeholder="Entrer type">
                   <?php
                               if (!empty($rows2)) {
                                 echo"<option value=".$rows2['TypeAnalyse']."
                                 selected=selected>".$rows2['TypeAnalyse']."</option>" ;
                               }

                               while($row33=mysqli_fetch_array($listetype))
                               {
                                   echo"<option value=".$row33['IdTypeAnalyse'].">".$row33['LibelleAnalyse']."</option>" ;
                               }?>
                     
                   </select>
       </div>
      
       <div class="form-group">
                 <label for="exampleInputEmail1">Date :</label>
                   
                   <input type="Date" class="form-control" data-inputmask-alias="datetime" name="DateAnalyseMed" data-inputmask-inputformat="dd/mm/yyyy" value="<?php if (!empty($rows2)) {echo $rows2['DateAnalyseMed'];}?>" data-mask>
                 </div>
        <div class="form-group">
                
       <div class="form-group">
                   <label for="exampleInputEmail1">Description :</label>
                   <input type="text" name="DescriptionAnalyse" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['DescriptionAnalyse'];}?>" placeholder="Entrer la description">
       </div>
          <div class="form-group">
                   <label for="exampleInputEmail1">Patient :</label>
                   <select name="NumDossierPat" class="form-control select2" style="width: 100%;">
                                  <?php
                               if (!empty($rows2)) {
                                 echo"<option value=".$rows2['NumDossierPat']."
                                 selected=selected>".$rows2['NomPatient']."</option>" ;
                               }
                               while($row=mysqli_fetch_array($listePat))
                               {
                                   echo"<option value=".$row['NumDossierPat'].">".$row['NomPatient']."</option>" ;
                               }
                                  ?>
                 </select>
                 </div>
          <div class="form-group">
                   <label for="exampleInputEmail1">Médecin :</label>
                   <select name="NumIdMedecin" class="form-control select2" style="width: 100%;">
                                  <?php
                               if (!empty($rows2)) {
                                 echo"<option value=".$rows2['NumIdMedecin']."
                                 selected=selected>".$rows2['NomMedecin']."</option>" ;
                               }
                               while($row=mysqli_fetch_array($listeMed))
                               {
                                echo"<option value=".$row['NumIdMedecin'].">".$row['NomMedecin']."(Spécialité : ".$row['NomSpecialite'].")</option>" ;                               }
                                  ?>
                 </select>
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Technicien :</label>
                   <select name="MatricTechnicien" class="form-control select2" style="width: 100%;">
                                  <?php
                               if (!empty($rows2)) {
                                 echo"<option value=".$rows2['MatricTechnicien']."
                                 selected=selected>".$rows2['NomTechnicien']."</option>" ;
                               }
                               while($row=mysqli_fetch_array($listeTech))
                               {
                                   echo"<option value=".$row['MatricTechnicien'].">".$row['NomTechnicien']."</option>" ;
                               }
                                  ?>
                 </select>
                 </div>
                  <div class="form-group">
                   <label for="exampleInputEmail1">Etat payment:</label>
                   <input type="text" name="EtatAnalyse" class="form-control" id="exampleInputEmail1" value="non paye" readonly="true">
       </div>

       </div>
       <!-- /.card-body -->
       <div class="card-footer">
       <button type="submit" name="ajouter" class="btn btn-primary">Nouveau</button>
       <button type="submit" name="modifier" class="btn btn-info">Mise à Jour</button>
       
       
       </div>
       <!-- /.card-footer-->
      </form>
     </div>
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <footer class="main-footer">
   <div class="float-right d-none d-sm-block">
     <b>Version</b> 3.2.0
   </div>
   <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
 </footer>

 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
   <!-- Control sidebar content goes here -->
 </aside>
 <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
 $(function () {
   $("#example1").DataTable({
     "responsive": true, "lengthChange": false, "autoWidth": false,
     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
   $('#example2').DataTable({
     "paging": true,
     "lengthChange": false,
     "searching": false,
     "ordering": true,
     "info": true,
     "autoWidth": false,
     "responsive": true,
   });
 });
</script>
</body>
</html>

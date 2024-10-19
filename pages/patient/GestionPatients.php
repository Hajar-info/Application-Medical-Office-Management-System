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
// charger la liste des patients
$Sql2="select * from patient";
$reponse=mysqli_query($connexion,$Sql2);
// Ajouter un patient
if(isset($_POST['ajouter'])){
 extract($_POST);
   $requet="INSERT INTO patient(NumDossierPat,NomPatient,PrenomPatient,DateNaissPat,SexePatient,StatutMatriPat,ProfessPatient,PoidsPatient,TensionPatient,TemperPatient,Teleph1Patient,Teleph2Patient)
   VALUES(NULL,'$NomPatient','$PrenomPatient','$DateNaissPat','$SexePatient','$StatutMatriPat','$ProfessPatient','$PoidsPatient','$TensionPatient','$TemperPatient','$Teleph1Patient','$Teleph2Patient');";
   mysqli_query($connexion,$requet);
   header("location:GestionPatients.php");
 }
//Supression
if(isset($_GET['Sup'])){
   $id=$_GET['code'];
   $sql2="DELETE FROM patient WHERE NumDossierPat ='$id'";
   $rep=mysqli_query($connexion,$sql2);
   header("location:GestionPatients.php");
}
//Visualiser
if(isset($_GET['Vue'])){
   $id=$_GET['code'];
   $sql2="SELECT * FROM patient WHERE NumDossierPat='$id'";
   $reponse2=mysqli_query($connexion,$sql2);
   $rows2=mysqli_fetch_array($reponse2);
}
// Mise à Jour
if(isset($_POST['modifier'])){
   extract($_POST);
   $requet="UPDATE patient SET
   NomPatient='$NomPatient',
   PrenomPatient='$PrenomPatient',
   DateNaissPat='$DateNaissPat',
   SexePatient='$SexePatient',
   StatutMatriPat='$StatutMatriPat',
   ProfessPatient='$ProfessPatient',
   PoidsPatient='$PoidsPatient',
   TensionPatient='$TensionPatient',
   TemperPatient='$TemperPatient',
   Teleph1Patient='$Teleph1Patient',
   Teleph2Patient='$Teleph2Patient'
   WHERE 	NumDossierPat ='$NumDossierPat';";
   $resultat=mysqli_query($connexion,$requet);
   header("location:GestionPatients.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>PGC | Listes Des Patients</title>
  <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
 <!-- daterange picker -->
 <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
 <!-- iCheck for checkboxes and radio inputs -->
 <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
 <!-- Bootstrap Color Picker -->
 <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
 <!-- Tempusdominus Bootstrap 4 -->
 <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
 <!-- Select2 -->
 <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
 <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
 <!-- Bootstrap4 Duallistbox -->
 <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
 <!-- BS Stepper -->
 <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
 <!-- dropzonejs -->
 <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
 <!-- Theme style -->
 <link rel="stylesheet" href="../../dist/css/adminlte.min.css">


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
<?php  require_once("../inc/menu.php");   ?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1>Gestion Patients</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Accueil</a></li>
             <li class="breadcrumb-item active">Gestion-Patients</li>
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
         <h3 class="card-title">Liste des Patients</h3>

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
             <th>N°Dossier</th>
             <th>Nom</th>
             <th>Prénom</th>
             <th>Date-naiss</th>
              <th>Profession</th>
             <th>Poids</th>
             <th>Tension</th>
             <th>Temperature</th>
             <th>Telephone1</th>
             <th>Action</th>
           </tr>
           </thead>
           <tbody>
             <?php
               while($row=mysqli_fetch_array($reponse))
               {
                   echo"
               <tr>
                   <td> ".$row['NumDossierPat']." </td>
                   <td>".$row['NomPatient']."</td>
                   <td>".$row['PrenomPatient']."</td>
                   <td>".$row['DateNaissPat']."</td>
                   
                   <td>".$row['ProfessPatient']."</td>
                   <td>".$row['PoidsPatient']."</td>
                   <td>".$row['TensionPatient']."</td>
                   <td>".$row['TemperPatient']."</td>
                   <td>".$row['Teleph1Patient']."</td>
                   <td>
                   <a onClick=\"javascript: return confirm('Voulez-vous vraiment supprimer cette ligne ?');\" href=GestionPatients.php?code=".$row['NumDossierPat']."&Sup=ok><i class='fas fa-trash'></i></a>
                   <a href=GestionPatients.php?code=".$row['NumDossierPat']."&Vue=ok><i class='fas fa-eye'></i></a>
                   <a href=GestionPatients.php?code=".$row['NumDossierPat']."&Vue=ok><i class='fas fa-pen'></i></a>
                   </td>
               </tr>" ;
               }
               ?>
           </tbody>
           <tfoot>
           <tr>
             <th>Id</th>
             <th>Nom</th>
             <th>Prénom</th>
             <th>Date-naissance</th>
             
             <th>Profession</th>
             <th>Poids</th>
             <th>Tension</th>
             <th>Temperature</th>
             <th>Telephone1</th>
             <th>Action</th>
           </tr>
           </tfoot>
         </table>
       </div>
       <!-- /.card-body -->
      
       <!-- /.card-footer-->
     </div>
     <!-- CARTE FORMULAIRE Patient -->
     <div class="card card-primary">

       <div class="card-header">
         <h3 class="card-title">Formulaire-Patient</h3>

         <div class="card-tools">
           <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
             <i class="fas fa-minus"></i>
           </button>
           <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
             <i class="fas fa-times"></i>
           </button>
         </div>
       </div>
       <form method="POST" action="GestionPatients.php">
       <div class="card-body">

       <div class="form-group">
                   <label for="exampleInputEmail1">N° Dossier Patient :</label>
                   <input type="text" name="NumDossierPat" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['NumDossierPat'];}?>" placeholder="N° Dossier Patient" readonly="true"/>
       </div>
       <div class="form-group">
                   <label for="exampleInputEmail1">Nom :</label>
                   <input type="text" name="NomPatient" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['NomPatient'];}?>" placeholder="Entrer Nom">
       </div>
       <div class="form-group">
                   <label for="exampleInputEmail1">Prénom :</label>
                   <input type="text" name="PrenomPatient" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['PrenomPatient'];}?>" placeholder="Entrer Prénom">
       </div>
       <div class="form-group">
                 <label for="exampleInputEmail1">Date naissance:</label>
                   
                   <input type="Date" class="form-control" name="DateNaissPat" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" value="<?php if (!empty($rows2)) {echo $rows2['DateNaissPat'];}?>" data-mask>
                 </div>
                 <!-- /.input group -->
              
       <div class="form-group">
         <label for="exampleInputEmail1">Adresse :</label>
           <input type="text" name="StatutMatriPat" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['StatutMatriPat'];}?>" placeholder="Entrer Adresse">
       </div>
       <div class="form-group">
         <label for="exampleInputEmail1">Profession :</label>
           <input type="text" name="ProfessPatient" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['ProfessPatient'];}?>" placeholder="Entrer Profession">
       </div>
       <div class="form-group">
                   <label for="exampleInputEmail1">Poid :</label>
                   <input type="text" name="PoidsPatient" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['PoidsPatient'];}?>" placeholder="Entrer Poid">
       </div>
       <div class="form-group">
                   <label for="exampleInputEmail1">Tension :</label>
                   <input type="text" name="TensionPatient" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['TensionPatient'];}?>" placeholder="Entrer Tension">
       </div>
        <div class="form-group">
                   <label for="exampleInputEmail1">Temperature :</label>
                   <input type="text" name="TemperPatient" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['TemperPatient'];}?>" placeholder="Entrer Tempeture">
        </div>
         <div class="form-group">
                   <label for="exampleInputEmail1">Telephone1 :</label>
                   <input type="text" name="Teleph1Patient" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['Teleph1Patient'];}?>" placeholder="Entrer Téléphone1">
        </div>
         <div class="form-group">
                   <label for="exampleInputEmail1">Telephone2 :</label>
                   <input type="text" name="Teleph2Patient" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['Teleph2Patient'];}?>" placeholder="Entrer Téléphone2">
        </div>
       
       </div>
       <!-- /.card-body -->
       <div class="card-footer">
       <button type="submit" name="ajouter" class="btn btn-primary">Nouveau</button>
       <button type="submit" name="modifier" class="btn btn-info">Modifier</button>
       
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



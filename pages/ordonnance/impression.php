<?php
// Initialiser la session
session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if ( !isset($_SESSION["username"]) ) {
  header("Location: ../../login.php");
  exit(); 
}

// Etablir la connexion avec Mysql
require_once('../../config1.php');

$CodeOrdonnance = $_GET['code'];

/// medicament
$sql33 = "SELECT * FROM contenir,ordonnance,medicament WHERE contenir.CodeOrdonnance = ordonnance.CodeOrdonnance AND contenir.IdMedicament = medicament.IdMedicament AND contenir.CodeOrdonnance ='$CodeOrdonnance' ";
$reponse33 = mysqli_query($conn, $sql33);

/// Info ordann

$sql3 = "SELECT * FROM ordonnance,medecin,specialite,patient,consultation,typeconsultation WHERE 
ordonnance.NumDossierPat=patient.NumDossierPat AND
 ordonnance.NumIdMedecin=medecin.NumIdMedecin AND
  ordonnance.NumConsultation=consultation.NumConsultation AND 
  consultation.IdTypeConsultation=typeconsultation.IdTypeConsultation AND 
  medecin.IdSpecialite =specialite.IdSpecialite  AND 
  CodeOrdonnance ='$CodeOrdonnance' ";
$reponse3 = mysqli_query($conn, $sql3);
$rows2 = mysqli_fetch_array($reponse3);

$sql4 = "SELECT * FROM ordonnance WHERE CodeOrdonnance ='$CodeOrdonnance' ";
$reponse4 = mysqli_query($conn, $sql4);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Imprimer ordonnance</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
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
            <h1>Imprimer Ordonnance</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Imprimer Ordonnance</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Cabenit Médicale Mimoza
                    
                  </h4><br><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Médecin :
                  <address>
                    <strong><?php   if (!empty($rows2)) { echo $rows2['NomMedecin']."  ".$rows2['PrenomMedecin'];} ?></strong><br>
                                                                                
                    <?php   if (!empty($rows2)) { echo $rows2['NomSpecialite'];} ?><br>
                    Télephone: <?php   if (!empty($rows2)) { echo $rows2['telephoneMedecin'];} ?><br>
                    Email: <?php   if (!empty($rows2)) { echo $rows2['email_medecin'];} ?> 
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Patient :
                 
                  <address>
                    <strong> <?php   if (!empty($rows2)) { echo $rows2['NomPatient']."  ".$rows2['PrenomPatient'];} ?> </strong><br>
                    Phone :           <?php   if (!empty($rows2)) { echo $rows2['Teleph1Patient'];} ?><br>
                    Date-Naissance : <?php   if (!empty($rows2)) { echo $rows2['DateNaissPat'];} ?><br>
                    Adresse :         <?php   if (!empty($rows2)) { echo $rows2['StatutMatriPat'];} ?> <br>
                    
                   
                  </address>
              
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>N° Consultation :  <?php   if (!empty($rows2)) { echo $rows2['NumConsultation'];} ?></b><br>
                  <br>
                  <b>Type Consultation:</b> <?php   if (!empty($rows2)) { echo $rows2['LibelleConsultation'];} ?><br>
                  <b>Date Consultation:</b> <?php   if (!empty($rows2)) { echo $rows2['Date_Consultation'];} ?><br>
                  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Médicament</th>
                      <th>Détail Ordonnance :</th>
                     
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                while($row=mysqli_fetch_array($reponse4))
                {
                    echo 
                  "<tr>
                    <td>".$row['medicaments']."</td>
                    <td>".$row['DetailOrdonnance']."</td>
                    
                  </tr>" ;
                }
                ?>

                   
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6"><br><br><br><br><br><br><br><br>
                 
                  

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  Un Cabinet Médical  est un établissement de soins où un personnel soignant peut prendre en charge des personnes malades pour le diagnostic et / ou la thérapie. 

                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                 

                  <div class="table-responsive"><br><br><br>
                    <table class="table">
                      <tr>
                        <th style="width:50%">E-mail :</th>
                        <td>cabinetmedicale@gmail.com</td>
                      </tr>
                      <tr>
                        <th>Adresse</th>
                        <td>Rue Med V Imm 56 App 67 Kenitra</td>
                      </tr>
                      <tr>
                        <th>Téléphone :</th>
                        <td>05 37 36 78 90</td>
                      </tr>
                      <tr>
                        <th>Site Web</th>
                        <td>www.cabinetmedicale.com</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="impression.php?code=<?php echo $CodeOrdonnance;?>" rel="noopener" class="btn btn-success"><i class="fas fa-print"></i> Imprimer</a>
                  
                  <button type="button" action="" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Format PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
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
<script src="../../dist/js/demo.js"></script>
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>

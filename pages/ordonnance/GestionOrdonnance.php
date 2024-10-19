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

// charger la liste DES TYPES CONSULTATION
$Sql212 = "SELECT * from consultation 
where NumConsultation=(SELECT max(NumConsultation) FROM consultation)";
$listeCons = mysqli_query($conn, $Sql212);

// charger la liste des medecins
$Sql22 = "select * from medecin,specialite where medecin.IdSpecialite = specialite.IdSpecialite";
$listeMed = mysqli_query($conn, $Sql22);

// charger la liste des patients
$Sql222 = "select * from patient";
$listePat = mysqli_query($conn, $Sql222);

// charger la liste des medicament
$Sqlll = "select * from medicament";
$listeMedi = mysqli_query($conn, $Sqlll);

// charger la liste des consultations
$Sql2 = "select * from ordonnance,medecin,patient,consultation where 
  ordonnance.NumDossierPat = patient.NumDossierPat and 
  ordonnance.NumIdMedecin = medecin.NumIdMedecin and 
  ordonnance.NumConsultation=consultation.NumConsultation ";
$reponse = mysqli_query($conn, $Sql2);


// Ajouter un produit
extract($_POST);
if ( isset($_POST['ajouter']) ) {
  // récupérer detail de l'ordonance et supprimer les antislashes ajoutés par le formulaire
  $DetailOrdonnance = stripslashes($_POST['DetailOrdonnance']);

  // replaces single quote with \'
  $DetailOrdonnance = str_replace("'", "\'", $DetailOrdonnance);
  
  $medicaments = implode(', ',$medicaments);
  $requet = "INSERT INTO ordonnance(DateOrdonnance,DetailOrdonnance,NumDossierPat,NumIdMedecin,NumConsultation,medicaments,posologie,nbrUnite)
  VALUES('$DateOrdonnance','$DetailOrdonnance','$NumDossierPat','$NumIdMedecin','$IdTypeConsultation','$medicaments','$posologie','$nbrUnite');";
  mysqli_query($conn, $requet);
  header("Location: GestionOrdonnance.php");
}

//Supression
if ( isset($_GET['Sup']) ) {
  $CodeOrdonnance = $_GET['code'];
  $sql2 = "DELETE FROM ordonnance WHERE CodeOrdonnance = '$CodeOrdonnance'";
  $rep = mysqli_query($conn, $sql2);
  header("Location: GestionOrdonnance.php");
}

//Visualiser
if ( isset($_GET['Vue']) ) {

    $CodeOrdonnance = $_GET['code'];
    $sql3 = "SELECT * FROM ordonnance,medecin,patient,typeconsultation,medicament WHERE 
    ordonnance.NumDossierPat = patient.NumDossierPat and 
    ordonnance.NumIdMedecin = medecin.NumIdMedecin and 
    ordonnance.NumConsultation = consultation.NumConsultation and 
    CodeOrdonnance = '$CodeOrdonnance' ";

    $reponse3 = mysqli_query($conn,  $sql3);
    $rows3 = mysqli_fetch_array($reponse3);
  
  if ( !empty($rows3) ) {

?>
  <style>
  .wrapper {
    display: none;
  }

  .print {
    padding: 50px;
    display: grid;
    justify-content: center;
    align-items: center;
    height: 1200px;
  }

  .print img {
    margin-left: 50%;
  }

  .btnPrint {
    display: flex;
    justify-content: center;
    margin-top: 15px;
  }

  #fa-print {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 30px;
    color: #007bff;
    cursor: pointer;
  }

  .closePrint {
    display: flex;
    justify-content: center;
    align-items: center;
    color: red;
  }

  .line {
    background-color: #a0a5ab;
    margin: 10px 0;
    border: 1px #a0a5ab solid;
    width: 800px;
  }
  
  .ordo {
    height: 800px;
  }
  </style>

  <style type="text/css" media="print">
    .wrapper,.closePrint,.fa-print {visibility:hidden;}
    .print,.line {visibility:visible;}
  </style>

<div class="print" id="print">
  <?php
  $nommed = $rows3['NomMedecin'];
  $queryMed = "SELECT * FROM medecin WHERE NomMedecin = '$nommed'";
  $repMed = mysqli_query($conn,  $queryMed);
  $rowsMed = mysqli_fetch_array($repMed);

  $idspecialiste = $rows3['IdSpecialite'];
  $querySp = "SELECT * FROM specialite WHERE IdSpecialite = '$idspecialiste'";
  $repSp = mysqli_query($conn,  $querySp);
  $rowsSp = mysqli_fetch_array($repSp);

  echo 'Dr. '.$rows3['NomMedecin']. ' '.$rowsMed['PrenomMedecin'].'<br>'.$rowsSp['NomSpecialite'].'<br><img src="../../dist/img/ordo.png" style="width: 50px;"><br><br>';
  ?>
  <div class="line"></div>
  <?php
  echo 'Patient : '.$rows3['NomPatient']; 
  echo '<br>Consultation : '.$rows3['LibelleConsultation'];
  ?>
  <div class="line"></div>
  <?php
  echo '
  <br><div class="ordo"><h1>Ordonnance</h1>';
  echo '<br>Date d\'ordonnance: '.$rows3['DateOrdonnance'];
  echo '<br>
  Détail d\'ordonnance : '.$rows3['DetailOrdonnance'];
  echo '<br>Médicaments : '.$rows3['medicaments'].'</div>';
  ?>
  <div class="line"></div>
  <?php
  echo '<center>Telephone : '.$rowsMed['telephoneMedecin'].'<br>Email : '.$rowsMed['email_medecin'].'<br>Address : '.$rowsMed['adresseMedecin'].'</center>';
  ?>
</div>
<div class="btnPrint">
  <!-- Button Print -->
  <i onClick='go_print()' class='fas fa-print' id='fa-print'></i>
  <!-- Button Close -->
  <a class="closePrint" onClick="close_print()" id="closePrint" href="#">X Close</a>
</div>

<script>
  function go_print() {
    window.print();
    return false;
  }
  function close_print() {
    document.getElementById('print').style.display = "none";
    document.getElementById('wrapper').style.display = "block";
    document.getElementById('closePrint').style.display = "none";
    document.getElementById('fa-print').style.display = "none";
  }
</script>

<?php
}
}

if ( isset($_GET['update']) ) {

    $CodeOrdonnance = $_GET['code'];
    $sql2 = "SELECT * FROM ordonnance,medecin,patient,typeconsultation,medicament WHERE ordonnance.NumDossierPat=patient.NumDossierPat and ordonnance.NumIdMedecin=medecin.NumIdMedecin and ordonnance.IdTypeConsultation=typeconsultation.IdTypeConsultation and ordonnance.medicam=medicament.IdMedicament and CodeOrdonnance ='$CodeOrdonnance' ";

    $reponse2 = mysqli_query($conn,  $sql2);
    $rows2 = mysqli_fetch_array($reponse2);
}

// Mise à Jour
if ( isset($_POST['modifier']) ) {
    extract($_POST);
    $requet = "UPDATE ordonnance  SET 
   DateOrdonnance='$DateOrdonnance',
    DetailOrdonnance='$DetailOrdonnance',
    NumDossierPat='$NumDossierPat',
    NumIdMedecin='$NumIdMedecin',
   IdTypeConsultation='$IdTypeConsultation', IdMedicament='$IdMedicament' WHERE CodeOrdonnance='$CodeOrdonnance' ;";
    $resultat = mysqli_query($conn, $requet);
    header("Location: GestionOrdonnance.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Listes Des Ordonnances</title>

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
  <style>
    #btnToggle {
      cursor: pointer;
      padding: 10px;
      color: grey;
      background-color: #ced4da;
      border-radius: 5px;
      text-align: center;
    }
    #btnToggle:hover {
      color: #21252f;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper" id="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Accueil</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
    <li class="nav-item"  >
      <a class="nav-link" href="../../logout1.php" > Déconnexion </a> 
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
            <h1>Gestion Odrdonnances</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Gestion-Ordonnances</li>
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
          <h3 class="card-title">Liste des Ordonnances</h3>

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
              <th>N° d'Ordonnance</th>
              <th>Date </th>
              <th>Patient</th>
              <th>Médecin</th>
              <th>Consultation</th>
              <th>Médicaments</th>
              <th> Detail </th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php
                while ( $row = mysqli_fetch_array($reponse) ) {
                    echo"
                <tr>
                    <td> ".$row['CodeOrdonnance']." </td>
                    <td>".$row['DateOrdonnance']."</td>
                    <td>".$row['NomPatient']."</td>
                    <td>".$row['NomMedecin']."</td>
                    <td>".$row['NumConsultation']." Le :".$row['Date_Consultation']."</td>
                    
                    <td>".$row['medicaments']."</td>
                     <td>".$row['DetailOrdonnance']."</td>
                    <td>
                    <a onClick=\"javascript: return confirm('Veuillez confirmer la suppression');\" href=GestionOrdonnance.php?code=".$row['CodeOrdonnance']."&Sup=ok><i class='fas fa-trash'></i></a>
                    <a href=GestionOrdonnance.php?code=".$row['CodeOrdonnance']."&Vue=ok><i class='fas fa-eye'></i></a>
                     <a href='impression.php?code=".$row['CodeOrdonnance']."'><i class='fas fa-print'></i></a>

                    </td>
                </tr>" ;
                }
                ?>
                
            </tbody>
            <tfoot>
            <tr>
              <th>N° d'Ordonnance</th>
              <th>Date </th>
              <th>Patient</th>
              <th>Médecin</th>
              <th>Type Consultation</th>
              <th>Médicaments </th>
              <th> Detail </th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- CARTE FORMULAIRE CLIENT -->
      <div class="card card-primary">

        <div class="card-header">
          <h3 class="card-title">Formulaire-Ordonnances</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
<form method="POST" action="GestionOrdonnance.php">

<div class="card-body">
<div class="form-group">
  <label for="exampleInputEmail1">N° Ordonnance :</label>
  <input type="text" name="CodeOrdonnance" class="form-control" id="exampleInputEmail1" value="<?php if (!empty($rows2)) {echo $rows2['CodeOrdonnance'];}?>" placeholder="N° Ordonnance" readonly="true"/>
</div>

<div class="form-group">
  <label for="exampleInputEmail1">Date Ordonnance:</label>
    
    <input type="Date" name="DateOrdonnance" class="form-control" data-inputmask-alias="datetime" name="DateOrdonnance" data-inputmask-inputformat="dd/mm/yyyy" value="<?php if (!empty($rows2)) {echo $rows2['DateOrdonnance'];}?>" data-mask>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Patient :</label>
<select name="NumDossierPat" class="form-control select2" style="width: 100%;">
 <?php
  if ( !empty($rows2) ) {
    echo"<option value=".$rows2['NumDossierPat']."
    selected=selected>".$rows2['NomPatient']."</option>" ;
  }
  while ( $row = mysqli_fetch_array($listePat) ) {
      echo"<option value=".$row['NumDossierPat'].">".$row['NomPatient']."</option>" ;
  }
?>
</select>
</div>

<div class="form-group">
  <label for="exampleInputEmail1">
    Médecin :
  </label>
  <select name="NumIdMedecin" class="form-control select2" style="width: 100%;">
     <?php
  if ( !empty($rows2) ) {
    echo"<option value=".$rows2['NumIdMedecin']."
    selected=selected>".$rows2['NomMedecin']."</option>" ;
  }
  while ( $row = mysqli_fetch_array($listeMed) ) {
      echo"<option value=".$row['NumIdMedecin'].">".$row['NomMedecin']." (Spécialité : ".$row['NomSpecialite'].")</option>";
  }
     ?>
  </select>
</div>

<div class="form-group">
  <label for="exampleInputEmail1">Consultation :</label>
  <select name="IdTypeConsultation" class="form-control select2" style="width: 100%;">
  <?php
  if ( !empty($rows2) ) {
    echo"<option value=".$rows2['NumConsultation']."
    selected=selected>".$rows2['Date_Consultation']."</option>" ;
  }
  while ( $row = mysqli_fetch_array($listeCons) ) {
      echo"<option value=".$row['NumConsultation'].">N° : ".$row['NumConsultation']." Le :".$row['Date_Consultation']."</option>" ;
  }
 ?>
</select>
</div>

 <div class="form-group">
  <label for="exampleInputEmail1">Médicaments :</label><br>
  <div id="btnToggle">Clicker ici pour Afficher/Masquer medicaments</div>
  <div id="show_hide">
<?php
  while ( $row = mysqli_fetch_array($listeMedi) ) {?>
      <input type="checkbox" name="medicaments[]" value="<?php echo $row['NomMedicament'];?>">
      <?php echo $row['NomMedicament'];
    }
 ?>
 </div>
</div>

 <div class="form-group">
  <label for="exampleInputEmail1">Posologie :</label>
  <input type="text" name="posologie" class="form-control" id="exampleInputEmail1" placeholder="">
</div>

 <div class="form-group">
  <label for="exampleInputEmail1">Nombre d'unité :</label>
  <input type="text" name="nbrUnite" class="form-control" id="exampleInputEmail1" placeholder="Nombre d'unité">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">
    Detail Ordonnance :
  </label>
  <input type="text" name="DetailOrdonnance" class="form-control" id="exampleInputEmail1"  value="<?php if (!empty($rows2)) {echo $rows2['DetailOrdonnance'];}?>" placeholder="Entrer la Detail">
</div>
        
</div>
<!-- /.card-body -->
<div class="card-footer">
  <button type="submit" name="ajouter" class="btn btn-primary">Nouveau</button>
  <button type="submit" name="modifier" class="btn btn-info">Mise à Jour</button>
  <button type="reset" class="btn btn-danger">Effacer</button>
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
<script src="../../dist/js/demo.js"></script>
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

<script>
$(document).ready(function(){
  $("#btnToggle").click(function(){
    $("#show_hide").toggle(500);
  });
});
</script>

</body>
</html>

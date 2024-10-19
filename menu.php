<?php
echo "
<aside class='main-sidebar sidebar-dark-primary elevation-4'>
    <!-- Brand Logo -->
    <a href='index.php' class='brand-link'>
      <img src='dist/img/iconcabinet.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .7'>
      <span class='brand-text font-weight-light'> <strong style='font-size:25PX'>Gestion-Cabinet</strong></span>
    </a>

    <!-- Sidebar -->
    <div class='sidebar'>
      <!-- Sidebar user (optional) -->
      <div class='user-panel mt-3 pb-3 mb-3 d-flex'>
        <div class='image'>
          <img style='height:44px; width:44px '  src='dist/img/DO.png' class='img-circle elevation-2' alt='User Image'>
        </div>
        <div class='info'>
          <a href='#' class='d-block'>";
            echo $_SESSION['username'];
          echo "</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class='form-inline'>
        <div class='input-group' data-widget='sidebar-search'>
          <input class='form-control form-control-sidebar' type='search' placeholder='Search' aria-label='Search'>
          <div class='input-group-append'>
            <button class='btn btn-sidebar'>
              <i class='fas fa-search fa-fw'></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class='mt-2'>
        <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class='nav-item'>
            <a href='#' class='nav-link'>
            
              <img style='height:25px; width:25px '  src='dist/img/homee.png' ></img>
              <p>
                Accueil
                <i class='right fas fa-angle-left'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='home.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Accueil</p>
                </a>
              </li>
            </ul>
          </li> 




          <li class='nav-item'>
            <a href='#' class='nav-link'>
                <img style='height:25px; width:25px '  src='dist/img/patient.png' ></img>
              <p>
                Patient
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/patient/GestionPatients.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Patients</p>
                </a>
              </li>
            </ul>
          </li>   ";




        if ( $_SESSION['role'] == "admin" || $_SESSION['role'] == "medecin" ) {
          echo "

          <li class='nav-item'>
            <a href='#' class='nav-link'>
                <img style='height:25px; width:25px '  src='dist/img/docto.png' ></img>
              <p>
                Médecin
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>

            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/medecin/GestionMedecin.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Médecin</p>
                </a>
              </li>
            </ul>

            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/specialite/GestionSpecialites.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Speécialité</p>
                </a>
              </li>
            </ul>
          </li>

          <li class='nav-item'>
            <a href='#' class='nav-link'>
                <img style='height:25px; width:25px '  src='dist/img/consultation.png' ></img>
              <p>
                Consultation   <i class='fas fa-angle-left right'></i>
              </p>
            </a>

            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/consultation/GestionConsultation.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Consultation</p>
                </a>
              </li>
            </ul>

            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/TypeConsultation/GestionTypeConsultation.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>G-Type Consultation</p>
                </a>
              </li>
            </ul>

            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/salle/GestionSalle.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Salle</p>
                </a>
              </li>
            </ul>
          </li>


          <li class='nav-item'>
            <a href='#' class='nav-link'>
              <img style='height:25px; width:25px '  src='dist/img/microscope.png' ></img>
              <p>
                Analyse Médicale
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>

            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/Analyse/GestionAnalyse.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Analyse</p>
                </a>
              </li>
            </ul>

            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/ResultatAnalyse/GestionResultatAnalyse.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>G-Résultat Analyse</p>
                </a>
              </li>
            </ul>

            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/TypeAnalyse/GestionTypeAnalyse.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>G-Type Analyse</p>
                </a>
              </li>
            </ul>
             </li>


             <li class='nav-item'>
            <a href='#' class='nav-link'>
              <img style='height:25px; width:25px '  src='dist/img/ordo.png' ></img>
              <p>
                Ordonnance
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/ordonnance/GestionOrdonnance.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Ordonnance</p>
                </a>
              </li>
            </ul>

            
          

            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/Medicament/GestionMedicament.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Médicament</p>
                </a>
              </li>
            </ul>
          </li>


            ";
        }

        if ( $_SESSION['role'] == "admin" ) {
        echo "

          <li class='nav-item'>
            <a href='#' class='nav-link'>
              <img style='height:25px; width:25px '  src='dist/img/scret.png' ></img>
              <p>
                Secretaire
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/Secretaire/GestionSecretaire.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Secretaire</p>
                </a>
              </li>
            </ul>
          </li>

          <li class='nav-item'>
            <a href='#' class='nav-link'>
              <img style='height:25px; width:25px '  src='dist/img/TEC.png' ></img>
              <p>
                Technicien
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='pages/technicien/GestionTechnicien.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Gestion Technicien</p>
                </a>
              </li>
            </ul>
          </li> ";}

        if ( $_SESSION['role'] == "admin" || $_SESSION['role'] == "secretaire" ) {
            echo "
          <li class='nav-item'>
            <a href='#' class='nav-link'>
              <img style='height:25px; width:25px '  src='dist/img/sal.png' ></img>
              <p>
                Paiements
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
            <li class='nav-item'>
              <a href='pages/payment/GestionPayment.php' class='nav-link'>
                <i class='far fa-circle nav-icon'></i>
                <p>Payment-consultation</p>
              </a>
            </li>
          


            
            <li class='nav-item'>
              <a href='pages/payment/PaymentAnalyse.php' class='nav-link'>
                <i class='far fa-circle nav-icon'></i>
                <p>Payment-Analyse</p>
              </a>
            </li>
            <li class='nav-item'>
              <a href='pages/payment/FacturationAnalyse.php' class='nav-link'>
                <i class='far fa-circle nav-icon'></i>
                <p>Facturation</p>
              </a>
            </li>

            ";
          }
          echo "
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  ";
?>

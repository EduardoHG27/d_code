<style>
  body {
    font-family: "Lato", sans-serif;
  }

  .sidebar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }

  .sidebar a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
  }

  .sidebar a:hover {
    color: #f1f1f1;
  }

  .sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }

  .openbtn {
    font-size: 20px;
    cursor: pointer;
    background-color: #4747d1;
    color: white;
    padding: 10px 15px;
    border: none;
  }

  .openbtn:hover {
    background-color: #66b3ff;
  }

  #main {
    transition: margin-left .5s;
    padding: 16px;
  }

  /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
  @media screen and (max-height: 450px) {
    .sidebar {
      padding-top: 15px;
    }

    .sidebar a {
      font-size: 18px;
    }

    span.float-right.summary_icon {
      font-size: 3rem;
      position: absolute;
      right: 1rem;
      color: #ffffff96;
    }

    .imgs {
      margin: .5em;
      max-width: calc(100%);
      max-height: calc(100%);
    }

    .imgs img {
      max-width: calc(100%);
      max-height: calc(100%);
      cursor: pointer;
    }

    #imagesCarousel,
    #imagesCarousel .carousel-inner,
    #imagesCarousel .carousel-item {
      height: 60vh !important;
      background: black;
    }

    #imagesCarousel .carousel-item.active {
      display: flex !important;
    }

    #imagesCarousel .carousel-item-next {
      display: flex !important;
    }

    #imagesCarousel .carousel-item img {
      margin: auto;
    }

    #imagesCarousel img {
      width: auto !important;
      height: auto !important;
      max-height: calc(100%) !important;
      max-width: calc(100%) !important;
    }
  }
</style>



<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/font-awesome/css/all.min.css">



<!-- Vendor CSS Files

<link href="<?php echo base_url(); ?>/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/vendor/venobox/venobox.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>/assets/css/jquery.datetimepicker.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/fullcalendar/main.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/css/select2.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/bootstrapValidator/bootstrap.min.css" rel="stylesheet">







<link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery-te-1.4.0.css">

<script src="<?php echo base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
 
-->

<!--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<!-- Latest compiled and minified JavaScript -->

<!--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="<?php echo base_url(); ?>/assets/bootstrapValidator/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/bootstrapValidator/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>/assets/bootstrapValidator/dataTables.bootstrap.min.js"></script>

 -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<link href="<?php echo base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/select/css/select2.min.css">

<script src="https://kit.fontawesome.com/e131073142.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="<?php echo base_url(); ?>/css/bootstrap/estilos.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/css/bootstrap/estilos_tablas.css" rel="stylesheet">
<link id="pagestyle" href="<?php echo base_url(); ?>/assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>


<link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
<!-- 
datatable anterior
<script src="<?php echo base_url(); ?>/assets/data/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
datatable anterior




https://code.jquery.com/jquery-3.5.1.js
https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js
https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js
<script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/venobox/venobox.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/counterup/counterup.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/bootstrapValidator/bootstrapValidator.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/data/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/font-awesome/js/all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/fullcalendar/main.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-te-1.4.0.min.js" charset="utf-8"></script>

-->



<br>
<br>
<br>
<?php $session = session(); ?>
<div>


  <nav id="main" class="navbar navbar-light fixed-top bg-primary" style="padding:0;min-height: 3.5rem">
    <div class="container-fluid mt-2 mb-2">
      <div class="col-lg-12">
        <div class="col-md-1 float-left" style="display: flex;">
          <button class="openbtn" onclick="openNav()">☰</button>
        </div>
        <div class="col-md-4 float-left text-white">
          <large><b>Gym Management System</b></large>
        </div>
        <div class="float-right">
          <div class=" dropdown mr-4">
            <a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $session->get('usuario'); ?> </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
              <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
              <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="<?php echo base_url(); ?>/principal/inicio">Inicio</a>
    <a href="<?php echo base_url(); ?>/principal/data">Datos</a>
    <a href="<?php echo base_url(); ?>/principal/student">Miembros</a>
    <a href="<?php echo base_url(); ?>/principal/plans">Planes</a>
    <a href="<?php echo base_url(); ?>/principal/staff">Staff</a>
    <a href="<?php echo base_url(); ?>/principal/staff">DASHBOARD</a>
    <a href="<?php echo base_url(); ?>/principal/boot">Boot</a>
    <a href="<?php echo base_url(); ?>/principal/session_out">Salir</a>
  </div>
  <div id="sidevar" class="containe-fluid">


    <div class="modal fade" id="uni_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id='submit' onclick="">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="confirm_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
          </div>
          <div class="modal-body">
            <div id="delete_content"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>

          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="generic_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="viewer_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
          <img src="" alt="">
        </div>
      </div>
    </div>
    <script>
      function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.getElementById("sidevar").style.marginLeft = "250px";

      }

      function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("sidevar").style.marginLeft = "0px";
      }
    </script>

    <style>
     
    </style>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Seguimiento - Referencia</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
  <link href="assets/css/demo.css" rel="stylesheet"/>
  <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/<?php echo (isset($_GET['view']))? $_GET['view'] : 'home' ?>-style.css">
  <script src="assets/js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
  <?php if(!isset($_GET['view']) || $_GET['view'] != 'login' ){ ?>
  <div class="wrapper">
    <div class="sidebar" data-color="blue">
      <div class="logo">
        <a href="./" class="simple-text">
          MENU
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="">
            <a href="./">
              <i class="fa fa-home"></i>
              <p>Inicio</p>
            </a>
          </li>
          <li>
            <a href="./?view=consulta">
              <i class="fa fa-search"></i>
                <p>Consulta</p>
            </a>
          </li>
          <?php if(isset($_SESSION['user_id']) && Core::$user->rol == 1){ ?>          
          <li>
            <a href="./?view=coleccion">
              <i class="fa fa-sitemap"></i>
              <p>Colecciones</p>
            </a>    
          </li>
          <li>
              <a href="./?view=referencias">
                  <i class="fa fa-tag"></i>
                  <p>Referencias</p>
              </a>
          </li>
          <li>
            <a href="./?view=categoria">
              <i class="fa fa-cubes"></i>
              <p>Familias</p>
            </a>
          </li>
          <li>
            <a href="./?view=areas">
              <i class="fa fa-map-marker"></i>
              <p>Áreas</p>
            </a>
          </li>
          <li>
            <a href="./?view=estadoMuestra">
              <i class="fa fa fa-braille"></i>
              <p>Estado Muestra</p>
            </a>
          </li>
          <li>
            <a href="./?view=plantas">
              <i class="fa fa-building"></i>
              <p>Plantas</p>
            </a>
          </li>
          <li>
            <a href="./?view=users">
              <i class="fa fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <?php if(isset($_GET['alert'])){ 
          $alert = $_GET['alert'];
        ?>
        <div class="alert alert-layout alert-success" id="alert">
          <strong><?php echo $alert ?>.</strong>
        </div>
      <?php  } ?> 
      <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container-fluid">
          <!-- <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div> -->
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <?php if(isset(Core::$user) && Core::$user != ''){?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i>
                  &nbsp;<?php  echo Core::$user->nombre ?>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="./?view=configuration"><i class="fa fa-cogs"></i> Configuracion</a></li>
                  <li class="divider"></li>
                  <li><a href="logout.php"><i class="fa fa-sign-out"></i> Salir</a></li>
                </ul>
              </li>
              <?php }else{ ?>
                <a href="./index.php?view=login" class="btn btn-info"> INICIAR SESION</a>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="container-fluid">
        <?php 
          // puedo cargar otras funciones iniciales
          // dentro de la funcion donde cargo la vista actual
          // como por ejemplo cargar el corte actual
          View::load("home");
        ?>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="pull-left">
            <ul>
              <li>
                <a href="#" target="_blank">
                  Crystal
                </a>
              </li>
            </ul>
          </nav>
          <p class="copyright pull-right">
            <a href="#" target="_blank">Crystal</a> &copy; 2018 
          </p>
        </div>
      </footer>
    </div>
  </div>
  <?php }else{ View::load("login"); } ?>
</body>

  <!--   Core JS Files   -->
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/material.min.js" type="text/javascript"></script>

  <!--  Notifications Plugin    -->
  <script src="assets/js/bootstrap-notify.js"></script>

  <!-- Material Dashboard javascript methods -->
  <script src="assets/js/material-dashboard.js"></script>

  <script type="text/javascript" src="assets/js/script.js"></script>
  <script>
      $("#alert").delay(2000).slideUp(500, function() {
        $(this).alert('close');
      });
  </script>
</html>

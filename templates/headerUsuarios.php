<?php
    session_start();
    $url_base = "http://localhost/appEmpleadosPuestos/";

    if(!isset($_SESSION['nombreusuario'])){
        header("Location:".  $url_base . "login.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
  <title>Sistema Empleados</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

  <header>
    <!-- place navbar here -->
  </header>

    <!-- <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav d-flex flex-row justify-content-between">
            <div class="d-flex flex-row ">
                <li class="nav-item">
                    <a class="nav-link active" href="#" aria-current="page">Inicio <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>usuarios/empleados/">Estados de Cuenta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>usuarios/empleados/">Gestion de tarjetas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>usuarios/empleados/">Soporte</a>
                </li>           
            </div>

            <div class="d-flex float-rigth">
                <li class="nav-item">
                    <a class="nav-link" href="#"> <?php echo $_SESSION['nombreusuario']; ?></a>
                </li>    
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>cerrar.php">Cerrar Sesión</a>
                </li>    
            </div>
        </ul>
    </nav> -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Parte izquierda del menú -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white bg-secondary" href="<?php echo $url_base; ?>usuarios/Principal/" aria-current="page">Inicio <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-light" href="<?php echo $url_base; ?>usuarios/empleados/">Estados de Cuenta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>usuarios/GestionTarjetas/">Gestión de tarjetas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>usuarios/BloquearTarjetas/">Bloquear Tarjeta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>usuarios/soporte/">Soporte</a>
                </li>
            </ul>

            <!-- Parte derecha del menú -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="#"><?php echo $_SESSION['nombreusuario']; ?></a>
                </li>    
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>cerrar.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container my-4">

    <!-- Mensaja de succes o completado con SweetAlert2 -->
    <?php if(isset($_GET['mensaje'])) { ?>
        <script>
            Swal.fire({icon: "success", title:" <?php echo $_GET['mensaje']; ?> "});
        </script>
    <?php }?>
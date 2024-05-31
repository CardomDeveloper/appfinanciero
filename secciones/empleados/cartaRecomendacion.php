<?php
include("../../bd.php");


if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    //Recuperando informacion de la base de datos
    $sentencia = $conexion->prepare(" SELECT * FROM tbl_puestos WHERE  id=:id ");
    $sentencia->bindParam(":id", $txtID);

    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY); // FETCH_LAZY solo carga un registro, recupera informacion
    $NombreUsuario = $registro['NombreUsuario'];
    $Fecha = $registro['Fecha'];
    $Descripcion = $registro['Descripcion'];
    $Monto = $registro['Monto'];
    $NombreEmpresa = $registro['NombreEmpresa'];

    //print_r($registro);

    // $nombreCompleto = $Fecha . " " . $Descripcion . " " . $Monto. " " . $NombreEmpresa;

    // $foto = $registro['foto'];
    // $cv = $registro['cv'];

    // $idPuesto = $registro['idpuesto'];
    // $puesto = $registro['puesto'];

    // $puestoDesempenado = $idPuesto;

    $fechaIngreso = $registro['fechaingreso'];

    $fechaInicio = new DateTime($fechaIngreso);
    $fechaFin = new DateTime(date('Y-m-d'));
    $diferencia = date_diff($fechaInicio, $fechaFin);


}

ob_start();
?>

<!doctype html>
<html lang="en">

<head>
  <title>Estado de Cuenta</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


</head>
<body>

    <div class="mt-5">

        <h1 class="mb-5 px-2 text-center">Estado de cuenta: <?php echo $NombreUsuario; ?></h1>
    
        <p class="mx-2">Guatemala, Guatemala a <strong> <?php echo date('d-M-Y'); ?></strong></p>
    
        <p class="mx-2" style="text-align: justify;">Tu estado de cuenta es <strong> <?php echo $NombreUsuario; ?></strong>,         
        </p>
    
        <p class="mx-2" style="text-align: justify;"><strong> <?php echo $Fecha; ?> <?php echo $Descripcion; ?> <?php echo $Monto; ?> <?php echo $NombreEmpresa; ?></strong>

        </p>   

    </div>



      <!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
  integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>

</body>
</html>


<!-- DomPdf -->
<?php

$HTML = ob_get_clean();

require_once("../../libs/autoload.inc.php");

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));

$dompdf->setOptions($opciones);

$dompdf->loadHTML($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array( "Attachment"=>false ));

?>
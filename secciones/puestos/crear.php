<?php
include("../../bd.php");

if($_POST){
    print_r($_POST);

    // Recolectamos los datos del metodo POST
    $NombreUsuario = (isset($_POST["NombreUsuario"]) ? $_POST["NombreUsuario"] : "");
    $Fecha = (isset($_POST["Fecha"]) ? $_POST["Fecha"] : "");
    $Descripcion = (isset($_POST["Descripcion"]) ? $_POST["Descripcion"] : "");
    $Monto = (isset($_POST["Monto"]) ? $_POST["Monto"] : "");
    $NombreEmpresa = (isset($_POST["NombreEmpresa"]) ? $_POST["NombreEmpresa"] : "");

    //Preparar insercción de los datos
    $sentencia = $conexion->prepare(" INSERT INTO tbl_puestos(id,NombreUsuario,Fecha,Descripcion,Monto,NombreEmpresa) VALUES(null,:NombreUsuario,:Fecha,:Descripcion,:Monto,:NombreEmpresa) ");
    //Asignando los valores que vienen del metodo POST (Los que vienen del formulario)
    $sentencia->bindParam(":NombreUsuario", $NombreUsuario);
    $sentencia->bindParam(":Fecha", $Fecha);
    $sentencia->bindParam(":Descripcion", $Descripcion);
    $sentencia->bindParam(":Monto", $Monto);
    $sentencia->bindParam(":NombreEmpresa", $NombreEmpresa);
    $sentencia->execute();

    $mensaje = "Registro Agregado";

    header("Location: index.php?mensaje=". $mensaje); //mensaje en la URL esta en el Script SweetAlert2
}

?>
<?php  include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        Consumos
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="NombreUsuario" id="nombrePuesto" aria-describedby="helpId" placeholder="Nombre">
            </div>

            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="Fecha" id="nombrePuesto" aria-describedby="helpId" placeholder="Fecha">
            </div>

            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="Descripcion" id="nombrePuesto" aria-describedby="helpId" placeholder="Descripcion">
            </div>

            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">Monto</label>
                <input type="text" class="form-control" name="Monto" id="nombrePuesto" aria-describedby="helpId" placeholder="Monto">
            </div>

            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">Nombre Empresa</label>
                <input type="text" class="form-control" name="NombreEmpresa" id="nombrePuesto" aria-describedby="helpId" placeholder="Nombre Empresa">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>

<?php  include("../../templates/footer.php"); ?>
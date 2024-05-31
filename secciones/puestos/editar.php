<?php
include("../../bd.php");

//Editar Datos de Puestos
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    //Recuperando informacion de la base de datos
    $sentencia = $conexion->prepare(" SELECT * FROM tbl_puestos WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY); // FETCH_LAZY solo carga un registro
    $NombreUsuario = $registro['NombreUsuario'];
    $Fecha = $registro['Fecha'];
    $Descripcion = $registro['Descripcion'];
    $Monto = $registro['Monto'];
    $NombreEmpresa = $registro['NombreEmpresa'];

}

//Aceptar cambios al editar Puesto
if($_POST){

    // Recolectamos los datos del metodo POST
    $txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
    $NombreUsuario = (isset($_POST["NombreUsuario"]) ? $_POST["NombreUsuario"] : "");
    $Fecha = (isset($_POST["Fecha"]) ? $_POST["Fecha"] : "");
    $Descripcion = (isset($_POST["Descripcion"]) ? $_POST["Descripcion"] : "");
    $Monto = (isset($_POST["Monto"]) ? $_POST["Monto"] : "");
    $NombreEmpresa = (isset($_POST["NombreEmpresa"]) ? $_POST["NombreEmpresa"] : "");

    //Preparar insercción de los datos
    $sentencia = $conexion->prepare(" UPDATE tbl_puestos SET NombreUsuario=:NombreUsuario, Fecha=:Fecha, Descripcion=:Descripcion, Monto=:Monto, NombreEmpresa=:NombreEmpresa WHERE id=:id");

    //Asignando los valores que vienen del metodo POST (Los que vienen del formulario)
    $sentencia->bindParam(":NombreUsuario", $NombreUsuario);
    $sentencia->bindParam(":Fecha", $Fecha);
    $sentencia->bindParam(":Descripcion", $Descripcion);
    $sentencia->bindParam(":Monto", $Monto);
    $sentencia->bindParam(":NombreEmpresa", $NombreEmpresa);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $mensaje = "Registro Actualizado";

    header("Location: index.php?mensaje=". $mensaje); //mensaje en la URL esta en el Script SweetAlert2
  
}

?>
<?php  include("../../templates/header.php"); ?>


<div class="card">
    <div class="card-header">
        Actualizar Consumos
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">           
            </div>

            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">Nombre:</label>
                <input type="text" value="<?php echo $NombreUsuario; ?>" class="form-control" name="NombreUsuario" id="nombrePuesto" aria-describedby="helpId" placeholder="Nombre">
            </div>

            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">Fecha:</label>
                <input type="date" value="<?php echo $Fecha; ?>" class="form-control" name="Fecha" id="nombrePuesto" aria-describedby="helpId" placeholder="Fecha">
            </div>

            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">Descripcion:</label>
                <input type="text" value="<?php echo $Descripcion; ?>" class="form-control" name="Descripcion" id="nombrePuesto" aria-describedby="helpId" placeholder="Descripcion">
            </div>

            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">Monto:</label>
                <input type="text" value="<?php echo $Monto; ?>" class="form-control" name="Monto" id="nombrePuesto" aria-describedby="helpId" placeholder="Monto">
            </div>

            <div class="mb-3">
                <label for="nombrePuesto" class="form-label">NombreEmpresa:</label>
                <input type="text" value="<?php echo $NombreEmpresa; ?>" class="form-control" name="NombreEmpresa" id="nombrePuesto" aria-describedby="helpId" placeholder="NombreEmpresa">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>

<?php  include("../../templates/footer.php"); ?>
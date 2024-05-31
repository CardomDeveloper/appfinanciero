<?php
include("../../bd.php");

//Editar Datos de Usuario
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID'])? $_GET['txtID'] : "");
    $sentencia = $conexion->prepare(" SELECT * FROM tbl_usuarios WHERE id=:id"); 
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    $registros = $sentencia->fetch(PDO::FETCH_LAZY); // FETCH_LAZY solo carga un registro

    $usuario = $registros['nombreusuario'];
    $password = $registros['password'];
    $correo = $registros['correo'];
}

//Aceptar cambios al editar Usuario
if($_POST){

    // Recolectamos los datos del metodo POST
    $txtID = (isset($_POST['txtID'])? $_POST['txtID'] : "");
    $usuario = (isset($_POST['usuario'])? $_POST['usuario'] : "");
    $password = (isset($_POST['password'])? $_POST['password'] : "");
    $correo = (isset($_POST['correo'])? $_POST['correo'] : "");

    //Preparar insercción de los datos
    $sentencia = $conexion->prepare(" UPDATE tbl_usuarios SET nombreusuario=:nombreusuario, password=:password, correo=:correo WHERE id=:id  ");
    $sentencia->bindParam(":nombreusuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $mensaje = "Registro Actualizado";

    header("Location: index.php?mensaje=". $mensaje); //mensaje en la URL esta en el Script SweetAlert2


}

?>

<?php  include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        Usuarios
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="txtID" class="form-label">ID</label>
              <input type="text" value="<?php echo $txtID; ?>" readonly class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del Usuario:</label>
                <input type="text" value="<?php echo $usuario; ?>" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del Usuario">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password" value="<?php echo $password; ?>" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba Contraseña">
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label">Correo:</label>
              <input type="email" value="<?php echo $correo; ?>" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su Correo">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>

<?php  include("../../templates/footer.php"); ?>
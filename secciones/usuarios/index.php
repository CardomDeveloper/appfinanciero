<?php
include("../../bd.php");

//Eliminar Datos de Usuarios
if(isset($_GET['txtID'])){

    print_r($_GET);

    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    $sentencia = $conexion->prepare(" DELETE FROM tbl_usuarios WHERE id=:id ");

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $mensaje = "Registro Eliminado";

    header("Location: index.php?mensaje=". $mensaje); //mensaje en la URL esta en el Script SweetAlert2
}

//Listar Datos de Usuarios
$sentencia = $conexion->prepare(" SELECT * FROM tbl_usuarios ");
$sentencia->execute();
$lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php  include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header d-flex">
        <h2 class="fs-3">Usuarios</h2>
        <a name="" id="" class="btn btn-success mx-3" href="crear.php" role="button">Agregar Usuario</a>
    </div>

    <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del Usuario</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($lista_tbl_usuarios as $registros){ ?>
                    
                    <tr class="">
                        <td scope="row"><?php echo $registros['id']; ?></td>
                        <td><?php echo $registros['nombreusuario']; ?></td>
                        <td><?php echo $registros['password']; ?></td>
                        <td><?php echo $registros['correo']; ?></td>
                        <td>
                            <a name="" id="" class="btn btn-warning" href="editar.php?txtID=<?php echo $registros['id'] ?>" role="button">Editar</a>
                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $registros['id']; ?>);" role="button">Eliminar</a>
                        </td>
                    </tr>

                <?php } ?>



                </tbody>
            </table>
        </div>

    </div>
</div>


<?php  include("../../templates/footer.php"); ?>
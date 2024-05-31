<?php
include("../../bd.php");

//Eliminar Datos de Puestos
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    $sentencia = $conexion->prepare(" DELETE FROM tbl_puestos WHERE id=:id ");

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $mensaje = "Registro Eliminado";

    header("Location: index.php?mensaje=". $mensaje); //mensaje en la URL esta en el Script SweetAlert2
}

//Listar Datos de Puestos
$sentencia = $conexion->prepare(" SELECT * FROM tbl_puestos ");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php  include("../../templates/header.php"); ?>

<div class="card">


    <div class="card-header d-flex">        
        <h2 class="fs-3">Estado de Cuenta</h2>
        
    </div>

    <div class="card-body">     
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre Usuario</th>    
                        <th scope="col">Fecha</th>         
                        <th scope="col">Descripcion Consumo</th>                
                        <th scope="col">Monto</th>
                        <th scope="col">NombreEmpresa</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($lista_tbl_puestos as $registro){ ?>
                    
                    <tr class="">
                        <td scope="row"><?php  echo $registro['id']; ?></td>
                        <td><?php  echo $registro['NombreUsuario']; ?></td>
                        <td><?php  echo $registro['Fecha']; ?></td>
                        <td><?php  echo $registro['Descripcion']; ?></td>
                        <td><?php  echo $registro['Monto']; ?></td>
                        <td><?php  echo $registro['NombreEmpresa']; ?></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="generar_pdf.php?txtID=<?php echo $registro['id']; ?>" role="button">Descargar</a>

                        

                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>

                        </td>
                    </tr>

                <?php } ?>


                </tbody>
            </table>
        </div>

    </div>
</div>


<?php  include("../../templates/footer.php"); ?>
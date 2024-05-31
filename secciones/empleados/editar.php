<?php
include("../../bd.php");

//Editar Datos de Empleados
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    //Recuperando informacion de la base de datos
    $sentencia = $conexion->prepare(" SELECT * FROM tbl_empleados WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY); // FETCH_LAZY solo carga un registro, recupera informacion

    $primerNombre = $registro['primernombre'];
    $segundoNombre = $registro['segundonombre'];
    $primerApellido = $registro['primerapellido'];
    $segundoApellido = $registro['segundoapellido'];

    $foto = $registro['foto'];
    $cv = $registro['cv'];

    $idPuesto = $registro['idpuesto'];
    $fechaIngreso = $registro['fechaingreso'];

    //Listar Datos de Puestos
    $sentencia = $conexion->prepare(" SELECT * FROM tbl_puestos ");
    $sentencia->execute();
    $lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

}

//Aceptar cambios al editar empleados
if($_POST){
    // print_r($_POST);
    // print_r($_FILES);

    $txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");

    $primerNombre = (isset($_POST['primerNombre']) ? $_POST['primerNombre']  : "");
    $segundoNombre = (isset($_POST['segundoNombre']) ? $_POST['segundoNombre']  : "");
    $primerApellido = (isset($_POST['primerApellido']) ? $_POST['primerApellido']  : "");
    $segundoApellido = (isset($_POST['segundoApellido']) ? $_POST['segundoApellido']  : "");
    $idPuesto = (isset($_POST['idPuesto']) ? $_POST['idPuesto']  : "");
    $fechaIngreso = (isset($_POST['fechaIngreso']) ? $_POST['fechaIngreso']  : "");

    $sentencia = $conexion->prepare(" UPDATE tbl_empleados SET 
        primernombre=:primerNombre,
        segundonombre=:segundoNombre,
        primerapellido=:primerApellido,
        segundoapellido=:segundoApellido,
        idpuesto=:idPuesto,
        fechaingreso=:fechaIngreso

        WHERE id=:id
    ");

    $sentencia->bindParam(":primerNombre",$primerNombre);
    $sentencia->bindParam(":segundoNombre",$segundoNombre);
    $sentencia->bindParam(":primerApellido",$primerApellido);
    $sentencia->bindParam(":segundoApellido",$segundoApellido);
    $sentencia->bindParam(":idPuesto",$idPuesto);
    $sentencia->bindParam(":fechaIngreso",$fechaIngreso);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();

    /* -------------------  En imagenes(fotos) ------------------- */ 
    $foto = (isset($_FILES['foto']['name']) ? $_FILES['foto']['name']  : "");

    $fecha = new DateTime();

    $nombreArchivoFoto = ($foto != '') ? $fecha->getTimestamp(). "_" . $_FILES['foto']['name'] : "";
    $tmp_foto = $_FILES['foto']['tmp_name'];

    if($tmp_foto != ''){
        move_uploaded_file($tmp_foto, "./".$nombreArchivoFoto);  //(Mover Archivo temporal a un nuevo destino)

        //Buscar la foto relacionado con el empleado
        $sentencia = $conexion->prepare(" SELECT foto FROM tbl_empleados WHERE id=:id ");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registroRecuperado = $sentencia->fetch(PDO::FETCH_LAZY); // carga un registro y recupera informacion
   
        // borrado Fotos
        if(isset($registroRecuperado['foto']) && $registroRecuperado['foto'] != "" ){
            if(file_exists("./" . $registroRecuperado['foto'])){
                unlink("./" . $registroRecuperado['foto']);
            }
        }

        /* Una vez borrada se actualiza*/
        $sentencia = $conexion->prepare(" UPDATE tbl_empleados SET foto=:foto WHERE id=:id"); 
        $sentencia->bindParam(":foto",$nombreArchivoFoto);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
    }


    /* -------------------  En Archivos PDF ------------------- */ 

    $cv = (isset($_FILES['cv']['name']) ? $_FILES['cv']['name']  : "");

    $nombreArchivoCv = ($cv != '') ? $fecha->getTimestamp(). "_" . $_FILES['cv']['name'] : "";
    $tmp_cv = $_FILES['cv']['tmp_name'];

    if($tmp_cv != ''){
        move_uploaded_file($tmp_cv, "./".$nombreArchivoCv);  //(Mover Archivo temporal a un nuevo destino)

        //Buscar el archivo relacionado con el empleado
        $sentencia = $conexion->prepare(" SELECT cv FROM tbl_empleados WHERE id=:id ");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registroRecuperado = $sentencia->fetch(PDO::FETCH_LAZY); // carga un registro y recupera informacion        

        // borrado Fotos
        if(isset($registroRecuperado['cv']) && $registroRecuperado['cv'] != "" ){
            if(file_exists("./" . $registroRecuperado['cv'])){
                unlink("./" . $registroRecuperado['cv']);
            }
        }

        /* Una vez borrado se actualiza*/
        $sentencia = $conexion->prepare(" UPDATE tbl_empleados SET cv=:cv WHERE id=:id ");
        $sentencia->bindParam(":cv",$nombreArchivoCv);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();

    }


    $mensaje = "Registro Actualizado";

    header("Location: index.php?mensaje=". $mensaje); //mensaje en la URL esta en el Script SweetAlert2
}

?>

<?php  include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        Datos del Empleado
    </div>

    <div class="card-body">
    
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">           
            </div>
            
            <div class="mb-3">
                <label for="primerNombre" class="form-label">Primer Nombre</label>
                <input type="text" value="<?php echo $primerNombre; ?>" class="form-control" name="primerNombre" id="primerNombre" aria-describedby="helpId" placeholder="Primer Nombre">
            </div>

            <div class="mb-3">
                <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                <input type="text" value="<?php echo $segundoNombre; ?>" class="form-control" name="segundoNombre" id="segundoNombre" aria-describedby="helpId" placeholder="Segundo Nombre">
            </div>

            <div class="mb-3">
                <label for="primerApellido" class="form-label">Primer Apellido</label>
                <input type="text" value="<?php echo $primerApellido; ?>" class="form-control" name="primerApellido" id="primerApellido" aria-describedby="helpId" placeholder="Primer Apellido">
            </div>

            <div class="mb-3">
                <label for="segundoApellido" class="form-label">Segundo Apellido</label>
                <input type="text" value="<?php echo $segundoApellido; ?>" class="form-control" name="segundoApellido" id="segundoApellido" aria-describedby="helpId" placeholder="Segundo Apellido">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Fotografía</label>               
                <img width="70" src="<?php echo $foto; ?>" class="img-fluid rounded" alt="" >
                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Fotografía">
            </div>

            <div class="mb-3">
                <label for="cv" class="form-label">CV(PDF)</label>
                
                <a href="<?php echo $cv; ?>"> <?php echo $cv; ?> </a>
                <input type="file" class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
            </div>

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto:</label>
                <!--  echo $idPuesto; -->

                <select class="form-select form-select-sm" name="idPuesto" id="idPuesto">
                   
                    <?php foreach($lista_tbl_puestos as $registro){ ?>
                         
                        <option <?php echo ($idPuesto == $registro['id']) ? "selected" : ""?> value="<?php echo $registro['id']?>"> 
                            <?php echo $registro['nombrepuesto'] ?> 
                        </option>

                    <?php } ?> 
                </select>

            </div>

            <div class="mb-3">
                <label for="fechaIngreso" class="form-label">Fecha de Ingreso:</label>
                <input type="date" value="<?php echo $fechaIngreso; ?>" class="form-control" name="fechaIngreso" id="fechaIngreso" aria-describedby="emailHelpId" placeholder="Fecha de Ingreso">
            </div>

            <button type="submit" class="btn btn-success">Actualizar Registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
</div>

<?php  include("../../templates/footer.php"); ?>
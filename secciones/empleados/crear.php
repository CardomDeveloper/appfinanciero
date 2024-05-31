<?php
include("../../bd.php");

if($_POST){
    print_r($_POST);
    print_r($_FILES);

    $primerNombre = (isset($_POST['primerNombre']) ? $_POST['primerNombre']  : "");
    $segundoNombre = (isset($_POST['segundoNombre']) ? $_POST['segundoNombre']  : "");
    $primerApellido = (isset($_POST['primerApellido']) ? $_POST['primerApellido']  : "");
    $segundoApellido = (isset($_POST['segundoApellido']) ? $_POST['segundoApellido']  : "");

    $foto = (isset($_FILES['foto']['name']) ? $_FILES['foto']['name']  : "");
    $cv = (isset($_FILES['cv']['name']) ? $_FILES['cv']['name']  : "");

    $idPuesto = (isset($_POST['idPuesto']) ? $_POST['idPuesto']  : "");
    $fechaIngreso = (isset($_POST['fechaIngreso']) ? $_POST['fechaIngreso']  : "");

    $sentencia = $conexion->prepare(" INSERT INTO 
        tbl_empleados (id, primernombre, segundonombre, primerapellido, segundoapellido, foto, cv, idpuesto, fechaingreso) 
        VALUES (NULL, :primerNombre , :segundoNombre, :primerApellido, :segundoApellido, :foto, :cv, :idPuesto, :fechaIngreso) 
    ");

    $sentencia->bindParam(":primerNombre",$primerNombre);
    $sentencia->bindParam(":segundoNombre",$segundoNombre);
    $sentencia->bindParam(":primerApellido",$primerApellido);
    $sentencia->bindParam(":segundoApellido",$segundoApellido);


    $fecha = new DateTime();

    $nombreArchivoFoto = ($foto != '') ? $fecha->getTimestamp(). "_" . $_FILES['foto']['name'] : "";
    $tmp_foto = $_FILES['foto']['tmp_name'];

    if($tmp_foto != ''){
        move_uploaded_file($tmp_foto, "./".$nombreArchivoFoto);  //(Mover Archivo temporal a un nuevo destino)
    }

    $sentencia->bindParam(":foto",$nombreArchivoFoto);


    $nombreArchivoCv = ($cv != '') ? $fecha->getTimestamp(). "_" . $_FILES['cv']['name'] : "";
    $tmp_cv = $_FILES['cv']['tmp_name'];

    if($tmp_cv != ''){
        move_uploaded_file($tmp_cv, "./".$nombreArchivoCv);  //(Mover Archivo temporal a un nuevo destino)
    }

    $sentencia->bindParam(":cv",$nombreArchivoCv);

    $sentencia->bindParam(":idPuesto",$idPuesto);
    $sentencia->bindParam(":fechaIngreso",$fechaIngreso);

    $sentencia->execute();

    $mensaje = "Registro Agregado";

    header("Location: index.php?mensaje=". $mensaje); //mensaje en la URL esta en el Script SweetAlert2
}

//Listar Datos de Puestos
$sentencia = $conexion->prepare(" SELECT * FROM tbl_puestos ");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

<?php  include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        Datos del Empleado
    </div>

    <div class="card-body">
    
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="primerNombre" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" name="primerNombre" id="primerNombre" aria-describedby="helpId" placeholder="Primer Nombre">
            </div>

            <div class="mb-3">
                <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" name="segundoNombre" id="segundoNombre" aria-describedby="helpId" placeholder="Segundo Nombre">
            </div>

            <div class="mb-3">
                <label for="primerApellido" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="primerApellido" id="primerApellido" aria-describedby="helpId" placeholder="Primer Apellido">
            </div>

            <div class="mb-3">
                <label for="segundoApellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="segundoApellido" id="segundoApellido" aria-describedby="helpId" placeholder="Segundo Apellido">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Fotografía</label>
                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Fotografía">
            </div>

            <div class="mb-3">
                <label for="cv" class="form-label">CV(PDF)</label>
                <input type="file" class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
            </div>

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-sm" name="idPuesto" id="idPuesto">
                   
                    <?php foreach($lista_tbl_puestos as $registro){ ?>
                         <!-- echo $registro['id'] va dentro de value -->
                         <option value="<?php echo $registro['id']  ?>"> <?php echo $registro['nombrepuesto'] ?> </option>

                    <?php } ?> 
                </select>


            </div>

            <div class="mb-3">
                <label for="fechaIngreso" class="form-label">Fecha de Ingreso:</label>
                <input type="date" class="form-control" name="fechaIngreso" id="fechaIngreso" aria-describedby="emailHelpId" placeholder="Fecha de Ingreso">
            </div>

            <button type="submit" class="btn btn-success">Agregar Registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
</div>

<?php  include("../../templates/footer.php"); ?>




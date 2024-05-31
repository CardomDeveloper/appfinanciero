<?php

include("../../bd.php");

//Editar Datos de Puestos

    //Recuperando informacion de la base de datos
    $sentencia = $conexion->prepare("SELECT 
    s.id,
    s.limitecredito,
    s.limitecredito - SUM(p.Monto) as saldodisponible,
    s.extrafinanciamiento,
    s.fecha,
    s.fechapago,
    s.puntosdisponibles,
    s.puntosdisponibles / 8 as puntoscompras,
    p.NombreUsuario,
    p.Descripcion,
    p.Fecha,
    SUM(p.Monto) as monto,
    p.NombreEmpresa
FROM 
    tbl_saldos s
INNER JOIN 
    tbl_puestos p ON s.cui = p.cui");

$sentencia->execute();

// Almacenar los resultados en variables PHP
$datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);





// Ejecutar la consulta
// $sentencia->execute();

// Obtener el registro (FETCH_LAZY solo carga un registro)
// $registro = $sentencia->fetch(PDO::FETCH_LAZY);

// Obtener los valores del registro
// $id = $registro['id'];
// $limitecredito = $registro['limitecredito'];
// $monto_id = $registro['monto_id'];
// $saldodisponible = $registro['saldodisponible'];
// $extrafinanciamiento = $registro['extrafinanciamiento'];
// $fecha = $registro['fecha'];
// $fechapago = $registro['fechapago'];
// $puntosdisponibles = $registro['puntosdisponibles'];
// $puntoscompras = $registro['puntoscompras'];
// $NombreUsuario = $registro['NombreUsuario'];
// $Descripcion = $registro['Descripcion'];
// $Fecha = $registro['Fecha'];
// $Monto = $registro['Monto'];
// $NombreEmpresa = $registro['NombreEmpresa'];

    // $sentencia->bindParam(":id", $txtID);
    // $sentencia->execute();

    // $registro = $sentencia->fetch(PDO::FETCH_LAZY); // FETCH_LAZY solo carga un registro
    // $NombreUsuario = $registro['NombreUsuario'];
    // $Fecha = $registro['Fecha'];
    // $Descripcion = $registro['Descripcion'];
    // $Monto = $registro['Monto'];
    // $NombreEmpresa = $registro['NombreEmpresa'];

// }




?>


<?php  include("../../templates/headerUsuarios.php"); ?>


<div class="card">
    <div class="card-header d-flex bg-info">        
        <h2 class="fs-3">Detalle Cuentas</h2>
    </div>
    <div>
        <div class="card-body">
            <!-- Imagen de tarjeta de crédito ficticia -->
            <div class="text-center">
                <img src="https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExd3JhOXpuNHN5M2RobDNnbmRreDRvMTgyMXFiMzM5NWZtcGtzZjV1aiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/XwyCWeFAwwdFOXQHHK/giphy.webp">
            </div>

            <div><h3>Movimientos durante 6 meses</h3></div>
            <div class="table-responsive-sm">
                <table class="table" id="tabla_id">
                    <tr>
                        <th>ID</th>
                        <th>Límite de Crédito</th>
                        <th>Saldo Disponible</th>
                        <th>Extra Financiamiento</th>
                        <th>Fecha De Corte</th>
                        <th>Fecha de Pago</th>
                    </tr>
                    <?php foreach ($datos as $fila): ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['limitecredito']; ?></td>
                        <td><?php echo htmlspecialchars($fila['saldodisponible']); ?></td>
                        <td><?php echo htmlspecialchars($fila['extrafinanciamiento']); ?></td>
                        <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($fila['fechapago']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>    
            <div>                
        </div>


        <div class="card-body">
            <div><h3>Tus puntos</h3></div>
            <!-- Imagen de tarjeta de crédito ficticia -->
            <div class="table-responsive-sm">
                <table class="table" id="tabla_id">
                    <tr>
                        <th>ID</th>
                        <th>Puntos Disponibles</th>
                        <th>Puntos Compras</th>
                    </tr>
                    <?php foreach ($datos as $fila): ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo htmlspecialchars($fila['puntosdisponibles']); ?></td>
                        <td>Q<?php echo htmlspecialchars($fila['puntoscompras']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>    
            <div>            
        </div>
    </div>
</div>

<?php  include("../../templates/footer.php"); ?>
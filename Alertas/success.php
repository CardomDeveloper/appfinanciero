<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solicitud Enviada</title>
    <!-- Incluye SweetAlert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        // Muestra la alerta de SweetAlert 2
        Swal.fire({
            title: 'Solicitud enviada',
            text: 'Tu solicitud ha sido enviada exitosamente.',
            icon: 'success'
        }).then(function() {
            // Redirecciona a la página principal después de cerrar la alerta
            window.location.href = 'http://localhost/appEmpleadosPuestos/usuarios/GestionTarjetas/';
        });
    </script>
</body>
</html>
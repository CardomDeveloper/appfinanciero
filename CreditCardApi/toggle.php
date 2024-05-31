<?php
    require 'config.php';

    // Cambia el estado
    $newStatus = toggleStatus();

    // Redirige a index.php con un mensaje de éxito
    header("Location: index.php?status=success");
    exit;
?>
<?php
    // config.php

    // Archivo para almacenar el estado de la tarjeta
    define('STATUS_FILE', 'status.txt');

    // Función para obtener el estado actual
    function getCurrentStatus() {
        if (!file_exists(STATUS_FILE)) {
            file_put_contents(STATUS_FILE, 'desbloqueada');
        }
        return trim(file_get_contents(STATUS_FILE));
    }

    // Función para cambiar el estado
    function toggleStatus() {
        $currentStatus = getCurrentStatus();
        $newStatus = ($currentStatus === 'desbloqueada') ? 'bloqueada' : 'desbloqueada';
        file_put_contents(STATUS_FILE, $newStatus);
        return $newStatus;
    }
?>
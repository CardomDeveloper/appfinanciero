<?php

require('../../templates/fpdf/fpdf/fpdf.php');

// Aquí debes incluir la conexión a la base de datos
include("../../bd.php");

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(33, 150, 243); // Azul
        $this->Cell(0, 10, 'Estado de Cuenta', 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    // Tabla coloreada
    function FancyTable($header, $data)
    {
        $this->SetFillColor(33, 150, 243); // Azul
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        
        // Cabecera
        $w = array(20, 40, 40, 60, 30, 60);
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();
        
        // Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        
        // Datos
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['id'], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row['NombreUsuario'], 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, $row['Fecha'], 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, $row['Descripcion'], 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, $row['Monto'], 'LR', 0, 'C', $fill);
            $this->Cell($w[5], 6, $row['NombreEmpresa'], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

if (isset($_GET['txtID'])) {
    $id = $_GET['txtID'];

    // Obtener datos del registro con el ID proporcionado
    $query = $conexion->prepare("SELECT * FROM tbl_puestos WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $registro = $query->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        $pdf = new PDF('L', 'mm', 'A4'); // Orientación horizontal
        $pdf->AddPage();
        $header = array('ID', 'Nombre Usuario', 'Fecha', 'Descripcion Consumo', 'Monto', 'Nombre Empresa');
        $data = array($registro);
        $pdf->FancyTable($header, $data);
        $pdf->Output('D', 'EstadoDeCuenta.pdf');
    } else {
        echo "No se encontró el registro.";
    }
}

?>

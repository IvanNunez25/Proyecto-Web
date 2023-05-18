
<?php
//Factura comprobante
require('fpdf.php');
$pdf = new PDF_Code128('P','mm','Letter');
$pdf->SetMargins(17,17,17);
$pdf->AddPage();
class PDF extends FPDF
{
// Encabezado
function Header()
{
    $this->Image('./Imagenes/shopping-bag.png',165,12,35,35,'PNG');
    $this->SetFont('sans-serif','B',15);
	$this->setFontColor(0,0,0);
    $this->Cell(150,10,utf8_decode(strtoupper("Kpop Store")),0,0,'L');
	$this->Ln(9);
	$this->SetFont('sans-serif','',10);
	$this->SetTextColor(39,39,51);
	$this->Cell(150,9,utf8_decode("Torreón Coahuila"),0,0,'L');
	$this->Ln(5);
	$this->Cell(150,9,utf8_decode("Teléfono: 00000000"),0,0,'L');
	$this->Ln(5);
	$this->Cell(150,9,utf8_decode("Email: correo@ejemplo.com"),0,0,'L');
	$this->Ln(10);
	$this->SetFont('sans-serif','',10);
	$this->Cell(30,7,utf8_decode("Fecha de emisión:"),0,0);
	$this->SetTextColor(97,97,97);
	$this->Cell(116,7,utf8_decode(date("d/m/Y", strtotime("13-09-2022"))." ".date("h:s A")),0,0,'L');
	$this->SetFont('sans-serif','B',10);
	$this->SetTextColor(39,39,51);
	$this->Cell(35,7,utf8_decode(strtoupper("Factura Nro.")),0,0,'C');
	$this->Ln(7);
	$this->SetFont('sans-serif','',10);
	$this->SetTextColor(39,39,51);
	$this->Cell(13,7,utf8_decode("Cliente:"),0,0);
	$this->SetTextColor(97,97,97);
	$this->Cell(60,7,utf8_decode("Carlos Alfaro"),0,0,'L');
	$this->SetTextColor(97,97,97);
	$this->Cell(60,7,utf8_decode("DNI: 00000000"),0,0,'L');
	$this->SetTextColor(39,39,51);
	$this->Cell(7,7,utf8_decode("Tel:"),0,0,'L');
	$this->SetTextColor(97,97,97);
	$this->Cell(35,7,utf8_decode("00000000"),0,0);
	$this->SetTextColor(39,39,51);
	$this->Ln(7);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('sans.serif','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//Conexiones 
require('PHP/Conexion.php');
require('parametrosventa.php');
//Consulta Nombre del disco
$consultaNom = "SELECT dis_nombre FROM discos WHERE (dis_id = ".$disco_id.");";
$ejecucionNom = mysqli_query($conexion, $consultaNom);
//Consulta Artista
$consultaArt = "SELECT art_nombre FROM artistas WHERE (art_id = (SELECT art_id FROM discos WHERE (dis_id = ".$disco_id.")));";
$ejecucionArt = mysqli_query($conexion, $consultaArt);
//Consulta precio
$consultaPrecio = "SELECT dis_precioUnitario FROM discos WHERE (dis_id = ".$disco_id.");";
$ejecucionPrecio = mysqli_query($conexion, $consultaPrecio);


// Tabla de productos 
$pdf->SetFont('sans-serif','',8);
$pdf->SetFillColor(150, 107, 157);
$pdf->SetDrawColor(150, 107, 157);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(90,8,utf8_decode("Descripción"),1,0,'C',true);
$pdf->Cell(15,8,utf8_decode("Cant."),1,0,'C',true);
$pdf->Cell(20,8,utf8_decode("Artista."),1,0,'C',true);
$pdf->Cell(25,8,utf8_decode("Precio"),1,0,'C',true);
$pdf->Cell(32,8,utf8_decode("Subtotal"),1,0,'C',true);

$pdf->Ln(8);


$pdf->SetTextColor(39,39,51);

/*----------  Detalles de la tabla  ----------*/
//Columna de nombre del disco
while($row=$ejecucionNom->fetch_assoc())
{
	$pdf->Cell(90,7,$row['dis_nombre'],'L',1,'C');
}

//Columna de cantidad
while($row=$ejecucionNom->fetch_assoc())
{
	$pdf->Cell(15,7,utf8_decode(echo $cantidad),'L',1,'C');
}
//Columna de nombre de artista
while($row=$ejecucionArt->fetch_assoc())
{
	$pdf->Cell(20,7,$row['art_nombre'],'L',1,'C');
}
//Columna de precio unitario
while($row=$ejecucionPrecio->fetch_assoc())
{
	$pdf->Cell(25,7,$row['dis_precioUnitario'],'L',1,'C');
}
while($row=$ejecucionNom->fetch_assoc())
{
	$pdf->Cell(32,7,utf8_decode($total),'LR',1,'C');
}


$pdf->Ln(7);


$pdf->Output();
?>
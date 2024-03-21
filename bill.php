<?php
require_once("./controllers/BillController.php");
require_once './vendor/autoload.php';
use setasign\Fpdi\Fpdi;
// use Fpdf\Fpdf;

$companie = $companies->fetch(PDO::FETCH_ASSOC);
$accounting = $accountings->fetch(PDO::FETCH_ASSOC);

$carts = $cartProduct->getAll($accounting['cart_id']);

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(219, 221, 224);

$pdf->Image('assets/images/Epharmacy_logo/Epharmacy_logo.png', 10, 10, 30);

// Customer information
$pdf->Cell(0, 10, $accounting['firstname']." ".$accounting['lastname'], 0, 1, 'R');
$pdf->Cell(0, 10, $accounting['adress'].", ".$accounting['city'], 0, 1, 'R');
$pdf->Cell(0, 10, $accounting['province'].", ".$accounting['country'], 0, 1, 'R');
$pdf->Cell(0, 10, $accounting['postal_code'], 0, 1, 'R');
$pdf->Ln(5); // Line break

$pdf->Cell(0, 10, 'Date: ' . $accounting['date_created'], 0, 1, 'C');
$pdf->Ln();

$pdf->Cell(0, 10, 'Bill: #' . $accounting['id'], 0, 1, 'F');
$pdf->Ln(5); // Line break

// Table header
$pdf->Cell(130, 8, 'Product', 1, 0, 'L', true);
$pdf->Cell(30, 8, 'Quantity', 1, 0, 'L', true);
$pdf->Cell(30, 8, 'Price', 1, 0, 'R', true);
$pdf->Ln();

// Sample data (replace with your actual data)
$products = [
    ['Product 1', '1', '$8'],
    ['Product 2', '3', '$20'],
    ['Product 3', '2', '$30'],
];

// Table rows
while ($product = $carts->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(130, 8, $product['name'], 1);
    $pdf->Cell(30, 8, $product['quantity'], 1);
    $pdf->Cell(30, 8, $product['total'] . " $", 1);
    $pdf->Ln();
}

$pdf->Ln(10); // Line break

// // Total
// $total = array_reduce($products, function ($acc, $product) {
//     return $acc + (int)str_replace('$', '', $product[1]);
// }, 0);
$pdf->Cell(160, 10, 'Total:', 0, 0, 'R');
$pdf->Cell(30, 10, number_format($accounting['total_amount'], 2) . " " . '$', 0, 1);

$pdf->Ln(15);

// Company information
$pdf->Cell(0, 10, $companie['name'].", ".$companie['adress'].", ".$companie['city'].", ".$companie['province'].", ".$companie['country'].", ".$companie['postal_code'], 0, 1, 'C');

// Output PDF to browser or file
$pdf->Output('bill.pdf', 'D');

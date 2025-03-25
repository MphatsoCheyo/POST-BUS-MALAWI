<?php
session_start();
require_once('../vendor/autoload.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

// Get the JSON data from the request
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

// If JSON decoding fails, return an error
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid JSON data']);
    exit;
}

// Extract ticket information from the data
$booking_code = $data['booking_code'] ?? 'Unknown';
$selected_seats = $data['selected_seats'] ?? 'None';
$route = $data['route'] ?? 'Unknown';
$travel_date = $data['travel_date'] ?? 'Unknown';
$departure_time = $data['departure_time'] ?? 'Unknown';
$passenger_name = $data['passenger_name'] ?? 'Unknown';
$passenger_id = $data['passenger_id'] ?? 'Unknown';
$passenger_phone = $data['passenger_phone'] ?? 'Unknown';
$amount_paid = $data['amount_paid'] ?? 'Unknown';

// Use TCPDF library to generate the PDF
use TCPDF as TCPDF;
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Post Bus Malawi');
$pdf->SetAuthor('Post Bus Malawi');
$pdf->SetTitle('Bus Ticket - ' . $booking_code);
$pdf->SetSubject('Bus Ticket');
$pdf->SetKeywords('Bus, Ticket, Post Bus Malawi, ' . $booking_code);

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set default monospaced font
$pdf->SetDefaultMonospacedFont('courier');

// Set margins
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(true, 15);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', 'B', 16);

// Logo
$logo_path = '../images/m.webp';
if (file_exists($logo_path)) {
    $pdf->Image($logo_path, 15, 10, 30, 0, 'WEBP', '', 'T', false, 300, '', false, false, 0, false, false, false);
}

// Document title
$pdf->Cell(0, 20, 'POST BUS MALAWI', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'E-TICKET', 0, 1, 'C');

// Line break
$pdf->Ln(10);

// Set font for content
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'TICKET DETAILS', 0, 1, 'L');
$pdf->SetFont('helvetica', '', 10);

// Table header
$pdf->SetFillColor(220, 220, 220);
$pdf->Cell(60, 7, 'Booking Reference', 1, 0, 'L', true);
$pdf->Cell(0, 7, $booking_code, 1, 1, 'L');

$pdf->Cell(60, 7, 'Route', 1, 0, 'L', true);
$pdf->Cell(0, 7, $route, 1, 1, 'L');

$pdf->Cell(60, 7, 'Travel Date', 1, 0, 'L', true);
$pdf->Cell(0, 7, $travel_date, 1, 1, 'L');

$pdf->Cell(60, 7, 'Departure Time', 1, 0, 'L', true);
$pdf->Cell(0, 7, $departure_time, 1, 1, 'L');

$pdf->Cell(60, 7, 'Seat(s)', 1, 0, 'L', true);
$pdf->Cell(0, 7, $selected_seats, 1, 1, 'L');

$pdf->Cell(60, 7, 'Amount Paid', 1, 0, 'L', true);
$pdf->Cell(0, 7, $amount_paid, 1, 1, 'L');

// Line break
$pdf->Ln(10);

// Passenger details
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'PASSENGER DETAILS', 0, 1, 'L');
$pdf->SetFont('helvetica', '', 10);

$pdf->Cell(60, 7, 'Name', 1, 0, 'L', true);
$pdf->Cell(0, 7, $passenger_name, 1, 1, 'L');

$pdf->Cell(60, 7, 'ID Number', 1, 0, 'L', true);
$pdf->Cell(0, 7, $passenger_id, 1, 1, 'L');

$pdf->Cell(60, 7, 'Phone', 1, 0, 'L', true);
$pdf->Cell(0, 7, $passenger_phone, 1, 1, 'L');

// Line break
$pdf->Ln(10);

// QR Code (if TCPDF support it)
if (method_exists($pdf, 'write2DBarcode')) {
    // Create a JSON object for the QR code
    $qr_data = json_encode([
        'ticketId' => $booking_code,
        'route' => $route,
        'date' => $travel_date,
        'departureTime' => $departure_time,
        'passengerName' => $passenger_name,
        'seats' => $selected_seats
    ]);
    
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'BOARDING PASS', 0, 1, 'L');
    $pdf->Cell(0, 7, 'Scan this QR code at the bus terminal for boarding', 0, 1, 'L');
    
    // Generate QR code
    $pdf->write2DBarcode($qr_data, 'QRCODE,L', 70, 160, 60, 60, ['border' => true, 'padding' => 2], 'N');
    
    $pdf->SetY(225);
    $pdf->SetFont('helvetica', 'I', 10);
    $pdf->Cell(0, 7, 'Ticket ID: ' . $booking_code, 0, 1, 'C');
}

// Important notes
$pdf->SetY(-40);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->MultiCell(0, 5, 'IMPORTANT NOTES:
1. Please arrive at least 30 minutes before departure time.
2. Present this ticket and valid ID at the terminal.
3. Luggage allowance: 20kg per passenger.
4. For any inquiries, please call +265 1 234 5678.
5. Terms and conditions apply.', 0, 'L');

// Set content type and send the PDF to the browser
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="PostBusMalawi_Ticket_' . $booking_code . '.pdf"');

// Close and output PDF document
$pdf->Output('PostBusMalawi_Ticket_' . $booking_code . '.pdf', 'I');
exit;
?>

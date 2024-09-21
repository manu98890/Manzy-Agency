<?php
include '../session_check.php'; 
include '../conn.php';
require '../vendor/autoload.php'; // Include Composer autoloader

use Fpdf\Fpdf; // Use the FPDF namespace

// Retrieve payment and transaction details from the URL parameters
if (isset($_GET['transaction_id']) && isset($_GET['payment_amount']) && isset($_GET['hotel_id'])) {
    $transactionId = $_GET['transaction_id'];
    $paymentAmount = $_GET['payment_amount'];
    $hotelId = $_GET['hotel_id'];
    $paymentStatus = $_GET['payment_status'];
    $room_size = mysqli_real_escape_string($conn, $_GET['room_size']);
    $days = mysqli_real_escape_string($conn, $_GET['days']);
    $user_id = $_SESSION['user_id'];

    // Query the hotel details from the database
    $query = "SELECT name, description, price FROM Hotels WHERE id = $hotelId";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    $hotel = mysqli_fetch_assoc($result);
    if (!$hotel) {
        die('No hotel found with this ID.');
    }

    $hotelName = $hotel['name'];
    $hotelPrice = $hotel['price'];

    $insertQuery = "INSERT INTO roomsbooking (hotel_id, rooms, roomSize, userid, price, days) 
            VALUES ($hotelId, 1, '$room_size', $user_id, $paymentAmount, '$days')";

    if ($conn->query($insertQuery) === TRUE) {
        // Generate PDF receipt if payment is successful
        if ($paymentStatus === 'completed') {
            generateReceipt($transactionId, $hotelName, $room_size, $days, $paymentAmount, $user_id);

            // Success message and auto-redirect after 4 seconds
            echo '
            <div class="alert alert-success" role="alert">
                Payment successful! Redirecting you to the success page...
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "payment_success.php"; 
                }, 4000); // Redirect after 4 seconds
            </script>';
        } else {
            echo '
            <div class="alert alert-danger" role="alert">
                Payment failed! Please try again later.
            </div>';
        }
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
} else {
    die('Error: Missing payment or transaction details.');
}

function generateReceipt($transactionId, $hotelName, $room_size, $days, $paymentAmount, $user_id) {
    // Create a new PDF instance
    $pdf = new Fpdf();
    $pdf->AddPage();

    // Set the font for the document
    $pdf->SetFont('Arial', 'B', 16);

    // Title
    $pdf->Cell(0, 10, 'Payment Receipt', 0, 1, 'C');

    // Line break
    $pdf->Ln(10);

    // Transaction Details
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Transaction ID: ' . $transactionId, 0, 1);
    $pdf->Cell(0, 10, 'Hotel Name: ' . $hotelName, 0, 1);
    $pdf->Cell(0, 10, 'Room Size: ' . $room_size, 0, 1);
    $pdf->Cell(0, 10, 'Number of Days: ' . $days, 0, 1);
    $pdf->Cell(0, 10, 'Payment Amount: $' . $paymentAmount, 0, 1);
    $pdf->Cell(0, 10, 'User ID: ' . $user_id, 0, 1);

    // Save the PDF to a file on the server
    $fileName = 'receipt_' . $transactionId . '.pdf';
    $filePath = '../receipts/' . $fileName;
    $pdf->Output('F', $filePath);

    // Force the browser to download the file
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    readfile($filePath);
    exit;
}
?>

<?php
include '../session_check.php';
include '../conn.php';

$userId = $_SESSION['user_id']; // Get user ID from session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form data exists
    if (isset($_POST['activate']) && is_array($_POST['activate']) &&
        isset($_POST['date']) && is_array($_POST['date'])) {
        
        foreach ($_POST['activate'] as $bookingId => $status) {
            // Sanitize inputs
            $bookingId = intval($bookingId);
            $status = in_array($status, ['activate', 'deactivate']) ? $status : 'deactivate';
            $date = isset($_POST['date'][$bookingId]) ? $_POST['date'][$bookingId] : null;
            
            // Validate date format (YYYY-MM-DD)
            $date = preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) ? $date : null;
            
            // Update the booking record
            $sql = "
                UPDATE Booking b
                JOIN payments p ON b.payment_id = p.id
                SET b.activate = ?, b.date = COALESCE(?, b.date)
                WHERE b.id = ? AND p.user_id = ?
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssii', $status, $date, $bookingId, $userId);
            $stmt->execute();
            
            if ($stmt->affected_rows === 0) {
                echo "Error updating booking ID: $bookingId or no access to update.<br>";
            }
            $stmt->close();
        }
    }
    
    header('Location: index.php');
}

$conn->close();
?>

<?php
include 'db.php';

// Function to fetch pending registrations
function fetchRegistrations($conn) {
    $sql = "SELECT * FROM students WHERE status = 'pending'";
    $result = $conn->query($sql);
    return $result;
}

// Function to update registration status
function updateRegistrationStatus($conn, $id, $status) {
    $sql = "UPDATE students SET status = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('si', $status, $id);
    if ($stmt->execute() === false) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $status = $_POST['action'] == 'enrolled' ? 'enrolled' : 'declined';
        updateRegistrationStatus($conn, $user_id, $status);
    }
}

// Fetch pending registrations
$registrations = fetchRegistrations($conn);
?>

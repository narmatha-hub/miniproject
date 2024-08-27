<?php
// Database connection
$conn = new mysqli('localhost:4306', 'root', '', 'database');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch notifications
$sql = "SELECT id, text, link FROM notifications ORDER BY id  DESC";
$result = $conn->query($sql);

$notifications = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

// Return notifications as JSON
echo json_encode($notifications);

$conn->close();
?>

<?php
// Assuming you have a database connection already set up
$conn = new mysqli('localhost:4306', 'root', '', 'database');

// Handle adding/updating notifications
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $text = $_POST['text'];
    $link = $_POST['link'];

    if ($id) {
        // Update existing notification
        $stmt = $conn->prepare("UPDATE notifications SET text = ?, link = ? WHERE id = ?");
        $stmt->bind_param('ssi', $text, $link, $id);
    } else {
        // Add new notification
        $stmt = $conn->prepare("INSERT INTO notifications (text, link) VALUES (?, ?)");
        $stmt->bind_param('ss', $text, $link);
    }
    $stmt->execute();
    $stmt->close();
}

// Handle deleting notifications
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM notifications WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to the admin page after performing the action
header('Location: admin.php');
?>

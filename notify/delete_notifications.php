<?php
// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'database_name');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the index of the notification to delete
$index = isset($_POST['index']) ? intval($_POST['index']) : -1;

if ($index >= 0) {
    // Fetch all notifications
    $sql = "SELECT id FROM notifications ORDER BY id ASC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Find the ID of the notification to delete based on the index
        $ids = [];
        while($row = $result->fetch_assoc()) {
            $ids[] = $row['id'];
        }
        
        if (isset($ids[$index])) {
            $notification_id = $ids[$index];
            
            // Prepare the delete statement
            $sql = "DELETE FROM notifications WHERE id = ?";
            $stmt = $conn->prepare($sql);
            
            if ($stmt) {
                $stmt->bind_param("i", $notification_id);
                $stmt->execute();
                
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'No rows affected or notification not found']);
                }

                $stmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL statement']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid notification index']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No notifications found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid notification index']);
}

$conn->close();
?>

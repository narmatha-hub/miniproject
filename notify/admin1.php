<?php
// Database connection
$conn = new mysqli('localhost:4306', 'root', '', 'database');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to add a notification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_notification'])) {
    $text = $_POST['text'];
    $link = $_POST['link'];

    $stmt = $conn->prepare("INSERT INTO notifications (text, link) VALUES (?, ?)");
    $stmt->bind_param("ss", $text, $link);
    $stmt->execute();
    $stmt->close();
}

// Fetch notifications for display
$sql = "SELECT id, text, link FROM notifications ORDER BY id DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #004080;
            padding: 10px;
            color: white;
            text-align: center;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .notification-list {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .notification-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .notification-item:last-child {
            border-bottom: none;
        }
        .notification-item a {
            color: blue;
            text-decoration: none;
        }
        .notification-item button {
            background-color: #ff4c4c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .add-notification {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .add-notification input, .add-notification button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>Admin - Manage Notifications</h1>
    </div>

    <div class="container">
        <div class="add-notification">
            <h2>Add Notification</h2>
            <form method="POST" action="">
                <input type="text" name="text" placeholder="Notification text" required>
                <input type="url" name="link" placeholder="Optional link (https://example.com)">
                <button type="submit" name="add_notification">Add Notification</button>
            </form>
        </div>

        <div class="notification-list">
            <h2>Notifications</h2>
            <ul id="admin-notifications" style="list-style: none; padding: 0;">
                <?php while($row = $result->fetch_assoc()): ?>
                <li class="notification-item">
                    <?= htmlspecialchars($row['text']) ?>
                    <?php if($row['link']): ?>
                    <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank">[Link]</a>
                    <?php endif; ?>
                    <button data-id="<?= $row['id'] ?>">Delete</button>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>

    <script>
        document.querySelectorAll('.notification-item button').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                fetch('delete_notification.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + id
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        this.parentElement.remove();
                    } else {
                        alert('Failed to delete notification.');
                    }
                });
            });
        });
    </script>

</body>
</html>

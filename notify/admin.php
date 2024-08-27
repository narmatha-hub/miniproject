<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarSphere - Home</title>
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
        .delete-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>Welcome to ScholarSphere</h1>
    </div>

    <div class="container">
        <div class="notification-list">
            <h2>Notifications</h2>
            <ul id="notifications" style="list-style: none; padding: 0;">
                <?php
                   $conn=mysqli_connect("localhost:4306","root","","database");
                    // Handle form submission to add a notification
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_notification'])) {
                        $text = $_POST['text'];
                        $link = $_POST['link'];

                        // Prepare and bind parameters
                        $stmt = $conn->prepare("INSERT INTO notifications (text, link) VALUES (?, ?)");
                        $stmt->bind_param("ss", $text, $link);

                        // Execute the query
                        if ($stmt->execute()) {
                            echo "Notification added successfully!";
                        } else {
                            echo "Error: " . $stmt->error;
                        }

                        // Close the statement
                        $stmt->close();
                    }

                    // Fetch notifications for display
                    $sql = "SELECT id, text, link FROM notifications ORDER BY id DESC";
                    $result = $conn->query($sql);

                    // Check if any notifications were fetched
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<li class='notification-item'>";
                            echo "<span>" . htmlspecialchars($row["text"]) . " " . ($row["link"] ? "<a href='" . htmlspecialchars($row["link"]) . "' target='_blank'>[Link]</a>" : "") . "</span>";
                            echo "<button class='delete-btn' data-id='" . $row["id"] . "'>Delete</button>";
                            echo "</li>";
                        }
                    } else {
                        echo "<li>No notifications available.</li>";
                    }

                    // Close the connection
                    $conn->close();
                ?>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach delete button event listener
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    deleteNotification(id);
                });
            });
        });

        function deleteNotification(id) {
            fetch('delete_notifications.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Remove the notification from the list
                    document.querySelector(`.delete-btn[data-id="${id}"]`).closest('.notification-item').remove();
                } else {
                    console.error('Delete failed:', data.message);
                    alert('Failed to delete notification: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while trying to delete the notification.');
            });
        }
    </script>

</body>
</html>

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
        }
        .notification-item:last-child {
            border-bottom: none;
        }
        .notification-item a {
            color: blue;
            text-decoration: none;
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
                <!-- Notifications will be loaded here -->
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('fetch_notifications.php')
                .then(response => response.json())
                .then(data => {
                    const notificationUl = document.getElementById('notifications');
                    notificationUl.innerHTML = '';
                    data.forEach(notification => {
                        const li = document.createElement('li');
                        li.className = 'notification-item';
                        li.innerHTML = `
                            ${notification.text}
                            ${notification.link ? `<a href="${notification.link}" target="_blank">[Link]</a>` : ''}
                        `;
                        notificationUl.appendChild(li);
                    });
                });
        });
    </script>

</body>
</html>

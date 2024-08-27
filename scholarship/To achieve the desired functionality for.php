To achieve the desired functionality for your MR scholarship form, you'll need to implement a few key features:

Auto-generate Application Number: Generate a unique application number when the form is submitted.
Display Application Number: Show the generated application number to the user.
Handle Multiple Scholarships: Ensure the same application ID is used if the user is eligible for multiple scholarships.
Implementation Steps
Modify the Form Submission Handling (Backend):

Update add_student.php to handle generating and displaying the application number.
Ensure that the application number is consistent if the user is eligible for multiple scholarships.
Front-End Handling:

Use JavaScript to manage form steps and display the application number after successful submission.
Backend Implementation (PHP)
Here's an example of how you might modify add_student.php to handle the generation and display of the application number:

php
Copy code
<?php
// add_student.php

// Database connection (replace with your own connection details)
$conn = new mysqli("localhost", "username", "password", "database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
// (Get other form fields similarly)

// Check if the student is eligible for MR Scholarship
// (Add your eligibility check logic here)

// Generate unique application number
$phone_number = $_POST['mobilenumber'];
$serial_number = rand(1000, 9999); // Generate a random serial number (ensure it's unique)
$application_number = "sp" . $phone_number . $serial_number;

// Insert application into the database
$sql = "INSERT INTO applications (firstname, lastname, phone_number, application_number, ...) 
        VALUES ('$firstname', '$lastname', '$phone_number', '$application_number', ...)";
if ($conn->query($sql) === TRUE) {
    echo "Application successful. Your application number is: " . $application_number;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
Front-End Implementation (JavaScript)
To display the application number on the same page, you can use JavaScript. For simplicity, you might display the result directly on the page or redirect the user to a confirmation page.

Update apply_js.js:
javascript
Copy code
// apply_js.js

function nextPrev(n) {
    // Your existing code for navigating between steps
    // ...
}

// Add code to handle form submission and display application number
document.getElementById("regForm").onsubmit = function(event) {
    event.preventDefault(); // Prevent default form submission

    var formData = new FormData(this);
    
    fetch('add_student.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Display the response from the server
        document.getElementById("applicationNumber").innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
};
Update HTML to Include a Display for Application Number:
Add a placeholder in your HTML where the application number will be shown:

html
Copy code
<div id="applicationNumber"></div>
Summary
Backend (add_student.php): Handle form submission, generate the application number, and store it in the database. Ensure the application number is unique and consistent for multiple scholarships.
Frontend (apply_js.js): Manage form submission via AJAX to avoid page reload and display the application number on the same page.
By implementing these steps, you ensure a smooth user experien
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $community = $_POST['community'];
    $gender = $_POST['gender'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $income = $_POST['income'];
    $aadhar = $_POST['aadhar'];
    $mobilenumber = $_POST['mobilenumber'];
    $dayscholar = $_POST['dayscholar'];
    $govtSchool = $_POST['govtSchool'];
    $college_name = $_POST['college_name'];
    $degree = $_POST['degree'];
    $college_code = $_POST['college_code'];
    $regno = $_POST['regno'];
    $bank_name = $_POST['bank_name'];
    $accno = $_POST['accno'];
    $ifsc_code = $_POST['ifsc_code'];

    // Generate unique application number
    $serial_number = uniqid(); // Generate a unique serial number
    $application_number = 'sp' . substr($mobilenumber, -4) . $serial_number;

    // Database connection
    $conn = new mysqli('localhost', 'username', 'password', 'apply');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO stud (firstname, lastname, email, dob, community, gender, fathername, mothername, income, aadhar, mobilenumber, dayscholar, govtSchool, college_name, degree, college_code, regno, bank_name, accno, ifsc_code, application_number)
            VALUES ('$firstname', '$lastname', '$email', '$dob', '$community', '$gender', '$fathername', '$mothername', '$income', '$aadhar', '$mobilenumber', '$dayscholar', '$govtSchool', '$college_name', '$degree', '$college_code', '$regno', '$bank_name', '$accno', '$ifsc_code', '$application_number')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Application Submitted Successfully! Your Application Number is: $application_number'); window.location.href = 'index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

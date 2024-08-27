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

    // Validate income and community
    if ($community == "BC" && $income > 200000) {
        echo "<script>alert('You are not eligible for the BC Scholarship due to income criteria.'); window.location.href='index.php';</script>";
        exit();
    }
    elseif ($community == "MBC" && $income > 200000) {
        echo "<script>alert('You are not eligible for the MBC Scholarship due to income criteria.'); window.location.href='index.php';</script>";
        exit();
    }
    elseif ($community == "BCM" && $income > 300000){
        echo "<script>alert('You are not eligible for the BCM Scholarship due to income criteria.'); window.location.href='index.php';</script>";
        exit();
    }
    else {
        echo "<script>alert('You are not eligible for this Scholarship due to income criteria.'); window.location.href='index.php';</script>";
        exit();
    }

    // Database connection
    $conn = new mysqli("localhost:4306", "root", "", "apply");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Generate application number
    $firstTwoLetters = substr($firstname, 0, 2); // Get first two letters of first name
    $result = $conn->query("SELECT COUNT(*) as total FROM stud");
    $row = $result->fetch_assoc();
    $serialNumber = $row['total'] + 1; // Increment serial number by the total number of entries

    $applicationNumber = "sp" . $firstTwoLetters . $serialNumber; // Generate the application number

    // Insert data into the database
    $sql = "INSERT INTO stud (application_number, firstname, lastname, email, dob, community, gender, fathername, mothername, income, aadhar, mobilenumber, dayscholar, govtSchool, college_name, degree, college_code, regno, bank_name, accno, ifsc_code) 
            VALUES ('$applicationNumber', '$firstname', '$lastname', '$email', '$dob', '$community', '$gender', '$fathername', '$mothername', '$income', '$aadhar', '$mobilenumber', '$dayscholar', '$govtSchool', '$college_name', '$degree', '$college_code', '$regno', '$bank_name', '$accno', '$ifsc_code')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Application submitted successfully! Your Application Number is: $applicationNumber'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.location.href='index.php';</script>";
    }

    $conn->close();
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    if ($govtSchool != "yes") {
        echo "<script>alert('You are not eligible for this scholarship.'); window.location.href='mr.html';</script>";
        exit();
    }

    $conn = new mysqli("localhost:4306", "root", "", "apply");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO stud(firstname, lastname, email, dob, community, gender, fathername, mothername, income, aadhar, mobilenumber, dayscholar, govtSchool, college_name, degree, college_code, regno, bank_name, accno, ifsc_code) 
            VALUES ('$firstname', '$lastname', '$email', '$dob', '$community', '$gender', '$fathername', '$mothername', '$income', '$aadhar', '$mobilenumber', '$dayscholar', '$govtSchool', '$college_name', '$degree', '$college_code', '$regno', '$bank_name', '$accno', '$ifsc_code')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record added successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.location.href='index.php';</script>";
    }

    $conn->close();
}
?>


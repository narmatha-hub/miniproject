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

    
    $conn = new mysqli('localhost:4306', 'root', '', 'apply');


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $sql_check = "SELECT application_number FROM stud WHERE mobilenumber='$mobilenumber'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
      
        $row = $result->fetch_assoc();
        $application_number = $row['application_number'];
    } else {
        
        $serial_number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); 
        $application_number = 'sp' . $serial_number;
    }

    
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

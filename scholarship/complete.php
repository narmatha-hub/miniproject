<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Scholarship Application</title>
    <link rel="stylesheet" href="apply_cs.css">
</head>
<body>
    <fieldset>
        <div class="container">
            <form id="regForm" method="post" action="">
                <h1>Community Scholarship Application</h1>

                <!-- Personal Information -->
                <div class="tab">
                    <h2>Personal Information:</h2>
                    <label for="firstname">Firstname:</label>
                    <input type="text" name="firstname" required>
                    <label for="lastname">Lastname:</label>
                    <input type="text" name="lastname" required>
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" required>
                    <label for="community">Community/Category:</label>
                    <select id="community" name="community" required>
                        <option value="">Select Community</option>
                        <option value="BC">BC</option>
                        <option value="MBC">MBC</option>
                        <option value="SC">SC</option>
                        <option value="ST">ST</option>
                        <option value="BCM">BCM</option>
                    </select><br>
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="">Choose your option</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select><br>
                    <label for="fatherName">Father Name:</label>
                    <input type="text" id="fatherName" name="fathername" required><br>
                    <label for="motherName">Mother Name:</label>
                    <input type="text" id="motherName" name="mothername" required><br>
                    <label for="income">Annual Family Income:</label>
                    <input type="text" id="income" name="income" required><br>
                    <label for="aadharNumber">Aadhar Number:</label>
                    <input type="text" id="aadharNumber" name="aadhar" required><br>
                    <label for="mobileNumber">Mobile Number:</label>
                    <input type="text" id="mobileNumber" name="mobilenumber" required><br>
                    <label for="dayScholar">Day Scholar/Hosteler:</label>
                    <input type="text" id="dayScholar" name="dayscholar" required><br>
                    <label for="govtSchool">Studied in Govt School (6-12):</label>
                    <select id="govtSchool" name="govtSchool" required>
                        <option value="">Choose your option</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select><br>
                </div>

                <!-- Institute Information -->
                <div class="tab">
                    <h2>Institute Information:</h2>
                    <p><input type="text" name="college_name" placeholder="College Name" required></p><br><br>
                    <p><input type="text" name="degree" placeholder="Degree" required></p><br><br>
                    <p><input type="text" name="college_code" placeholder="College Code" required></p><br><br>
                    <p><input type="text" name="regno" placeholder="Register Number" required></p><br><br>
                    <p><input type="file" name="bonafide" placeholder="Upload your certificate" required></p><br><br>
                </div>

                <!-- Bank Details -->
                <div class="tab">
                    <h2>Bank Details:</h2>
                    <p><input type="text" name="bank_name" placeholder="Bank Name" required></p>
                    <p><input type="text" name="accno" placeholder="Account Number" required></p>
                    <p><input type="text" name="ifsc_code" placeholder="IFSC Code" required></p>
                </div>

                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        <button type="submit">Submit</button>
                    </div>
                </div>

                <!-- Circles which indicate the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
            </form>
        </div>
    </fieldset>

    <!-- JavaScript to handle multi-step form -->
    <script src="apply_js.js"></script>
</body>
</html>

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
    else{
        echo "<script>alert('You are not eligible for the this Scholarship due to income criteria.'); window.location.href='index.php';</script>";
        exit();
    }

    // Database connection
    $conn = new mysqli("localhost:4306", "root", "", "apply");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO stud (firstname, lastname, email, dob, community, gender, fathername, mothername, income, aadhar, mobilenumber, dayscholar, govtSchool, college_name, degree, college_code, regno, bank_name, accno, ifsc_code) 
            VALUES ('$firstname', '$lastname', '$email', '$dob', '$community', '$gender', '$fathername', '$mothername', '$income', '$aadhar', '$mobilenumber', '$dayscholar', '$govtSchool', '$college_name', '$degree', '$college_code', '$regno', '$bank_name', '$accno', '$ifsc_code')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Application submitted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.location.href='index.php';</script>";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Scholarship Application</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    width: 50%;
    margin: auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    text-align: center;
    color: #333;
}

label {
    display: block;
    margin: 10px 0 5px;
    color: #333;
}

input[type="text"], input[type="email"], input[type="date"], select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

.tab {
    display: none;
}

.step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #ccc;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
}

.step.active {
    opacity: 1;
}

.step.finish {
    background-color: #4CAF50;
}

    </style>
</head>
<body>
    <fieldset>
        <div class="container">
            <form id="regForm" method="post" action="apply_cs.php">
                <h1>Community Scholarship Application</h1>

                
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

               
                <div class="tab">
                    <h2>Institute Information:</h2>
                    <p><input type="text" name="college_name" placeholder="College Name" required></p><br><br>
                    <p><input type="text" name="degree" placeholder="Degree" required></p><br><br>
                    <p><input type="text" name="college_code" placeholder="College Code" required></p><br><br>
                    <p><input type="text" name="regno" placeholder="Register Number" required></p><br><br>
                    <p><input type="file" name="bonafide" placeholder="Upload your certificate" required></p><br><br>
                </div>

                
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

              
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
            </form>
        </div>
    </fieldset>

   
    <script >
        var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
        document.querySelector("button[type='submit']").style.display = "inline";
    } else {
        document.getElementById("nextBtn").style.display = "inline";
        document.querySelector("button[type='submit']").style.display = "none";
    }
    //... and run a function that displays the correct step indicator:
    fixStepIndicator(n);
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function fixStepIndicator(n) {
   
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    
    x[n].className += " active";
}
function validateEligibility() {
            
            var community = document.getElementById('community').value;
            var income = parseFloat(document.getElementById('income').value.replace(/,/g, ''));

          
            if (['SC', 'ST'].includes(community) && income <= 200000) {
                return true;
            }
            return false;
        }


    </script>
</body>
</html>

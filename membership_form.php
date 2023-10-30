<?php
require_once("Database/connection.php");
$e_id=$_REQUEST["e_id"];
$staffq="SELECT `type`,`gender` FROM `enquiry_master` WHERE `e_id`='$e_id'";
$resulte=mysqli_query($connection,$staffq);
if($resulte && $rowe=mysqli_fetch_assoc($resulte))
{
  if($rowe["type"] == 'Staff')
  header("Location: show.php");
  else
{
  $gender = $rowe["gender"];
  echo "<script>var gender = '$gender';</script>";
}
}

$querym="SELECT * FROM `membership_form` WHERE `e_id`='$e_id'";
$resultm=mysqli_query($connection,$querym);

$dob="";
$anniversary_date="";
$is_married='unmarried';
$rem="";

$currentDate = date('Y-m-d');
$start_date=$currentDate;
$expiry_date=$currentDate;
echo "<script>var rem= 0; var datadays=0;</script>";
if($resultm && $rowm=mysqli_fetch_assoc($resultm))
{
  if($currentDate <= $rowm['expiry_date'])
    header("Location: membership_update.php?e_id=$e_id");
  else if ($currentDate > $rowm['expiry_date'])
  {
    $dob=$rowm["dob"];
    $anniversary_date=$rowm["anniversary_date"];
    $is_married=$rowm["is_married"];
    $expiry_date=$rowm['expiry_date'];
    $exp_date=date(('Y-m-d'), strtotime($start_date . ' -7 day'));
    if ($exp_date<$expiry_date)
    {  
      $start_date=$rowm['expiry_date'];
      $start_date=date(('Y-m-d'), strtotime($start_date . ' +1 day'));
    }

    
    $rem=$rowm['amount_payable'];
    echo "<script>rem= $rem;
    </script>";
  }
}
?>
<script>
  var start = "<?php echo $start_date; ?>";
  const year = start.getFullYear();
  const month = start.getMonth() + 1; // JavaScript months are zero-indexed, so we need to add 1 to get the actual month number.
  const day = start.getDate();
  const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
  start = `${day}-${month}-${year}`;
</script>
<!DOCTYPE html>
<html>

<title>membership</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="CSS/w3.css">
<link rel="stylesheet" href="CSS/w3schools.com_w3css_4_w3.css">
<link rel="stylesheet" href="CSS/FONT/font-awesome.min.css">
<link rel="stylesheet" href="CSS/FONT/font-awesome.css">
<style>
    /* Additional custom styling */
    form{
        border-radius: 0.35rem;
    }
    body{
      font-family: Arial, Helvetica, sans-serif;
      background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.2)), url("bg.jpg");
      background-size:cover;
      background-attachment: fixed;
    }

    .center-form {
        display: flex;
        justify-content: right;
        align-items: center;
        /* height: 93.3vh; Adjust the height as needed */
        padding: 35px;
    }
    .hi{
        width: 19px;
        height: 19px;
        align-items: center;
    }
    h1{
      text-align: center;
      font-family: Arial, Helvetica, sans-serif;
      color: black;
      font-weight: 600;
    }
    .w4-padding{
      padding: 30px;
    }
    .container {
      display: flex;
      flex-direction: row;
    }
    .container1 {
      display: flex;
      flex-direction: row;
    }
    .left {
      flex: 1;
      margin-right: 10px;
    }

    .right {
      flex: 1;
    }
    .w3-center{
      font-weight: 600;
    }
    @media (max-width: 500px) {
      .container {
        flex-direction: column;
      }
      .container1 {
        flex-direction: column;
      }
      .left,
      .right {
        flex: 1;
        margin-right: 0px;
      }
      .left1{
        margin-bottom: 10px;
      }
      .right1{
        width: 100%
      }
      .container label{
      margin-bottom: -20px;
      }
      .container1 label{
      margin-bottom: 0px;
      }
      .center-form {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 35px;
      }
      .w3-center {
      font-size: 28px;
      font-weight: 600;
      }
    }
    </style>
<body>
  <?php include 'nav.php';?>
<div class="img">
<div class="w3-container mainc center-form">
<form action="" class="w3-card-4 w3-light-grey w3-text-black w3-margin w4-padding" style="width:500px;font-family: Arial, Helvetica, sans-serif; padding-top: 4px; padding-bottom: 0;" method="post">
<h1 class="w3-center">Membership Form</h1>
<div id="alertBox" class="w3-panel w3-pale-red w3-border" style="display: none;"><p><?php echo $message;?></p></div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><label for="dob"><i class="w3-xxlarge fa fa-calendar" style="position: relative; right: 25px; left: -6px; bottom: 1px; top: 16px;color: #00FF00;"></i></label></div>
  <div class="w3-rest">
    <label>Birth Date</label><br>
    <input class="w3-input w3-border design" name="dob" id="dob" value="<?php echo $dob?>" type="date">
      <span id="dob-error" class="error-message"></span>
  </div>
</div>

<div class="w3-row w3-section">
<div class="w3-col" style="width:50px"><i class="w3-xxxlarge fa fa-user" style="position: relative; right: 25px; left: -6px; bottom: 1px; top: 0px;color: #00FF00;"></i></div>
    <div class="w3-rest">
      <div class="container">
      <div class="left1" style="width: 100%">
      <label>Marital Status </label><br>
      <div class="container1">
      <label><input class="w3-radio hi" type="radio" name="is_married" value="married"  id="marriedRadio" <?php if($is_married=='married') echo 'checked';?> onchange="handleMaritalStatusChange()">
      Married &nbsp;</label>
      <label><input class="w3-radio hi" type="radio" name="is_married" value="unmarried"  id="unmarriedRadio" <?php if($is_married=='unmarried') echo 'checked'?> onchange="handleMaritalStatusChange()">
      Unmarried</label>
      </div>
      </div>
      <div class="right1" style="width: 100%">  
        <label>Anniversary Date</label><br>
        <input class="w3-input w3-border" name="anniversary_date" type="date" id="anniversaryDate" onblur = "return anndate()" value="<?php echo $anniversary_date?>" <?php if($is_married=='unmarried') echo 'readonly';?> onchange="anniversarydate()">
        <span id="anniversary-error" class="error-message"></span>
      </div>
        </div>
    </div>
  </div>

<div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-users" style="position: relative; right: 25px; left: -9px; bottom: 1px; top: 7px; color: #00FF00;"></i></div>
    <div class="w3-rest">
        <label>Membership Type</label><br>
        <div class="container">
        <?php
    // Assuming you have established the database connection
          $query = "SELECT membership_type, fees, days FROM m_days";
          $result = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_assoc($result)) {
            echo '<label>';
            echo '<input type="radio" class="w3-radio hi" onclick="handleMembershipTypeChange()" name="membership_type" value="' . $row['membership_type'] . '" data-fees="' . $row['fees'] . '" data-days="' . $row['days'] . '">';
            ?>&nbsp;<?php
            echo $row['membership_type'];
            echo '</label>';?>&nbsp;&nbsp;&nbsp;<?php
          }
        ?>
      </div>
    </div>
  </div>
  <!-- Display the calculated expiry date, fee from the table, and remaining amount -->

  <div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-calendar" style="position: relative; right: 25px; left: -6px; bottom: 1px; top: 14px; color: #00FF00;"></i></div>
    <div class="w3-rest">
      <div class="container">
      <div class="left">
        <label>Start Date</label><br>
        <input class="w3-input w3-border" name="start_date" type="date" value="<?php echo $start_date;?>" id="startDate" readonly>
      </div>
      <div class="right">  
        <label>Expiry Date</label><br>
        <input class="w3-input w3-border" name="expiry_date" type="date" id="expiryDate" readonly>
      </div>
        </div>
    </div>
  </div>

  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-rupee" style="position: relative; right: 25px; left: -6px; bottom: 1px; top: 16px;color: #00FF00;"></i></div>
    <div class="w3-rest">
      <div class="container">
        <div class="left">
        <label>Total Fees</label><br>
          <input class="w3-input w3-border design" name="tableFee" id="tableFee"  type="number" readonly>
        </div>
        <div class="left">
          <label>Paid Amount</label>
          <input class="w3-input w3-border design" name="userPaidAmount" id="userPaidAmount" onkeypress="return amtvalid(event)" onkeyup="amountpaid()" type="number"  readonly required>
        </div>
        <div class="right">
          <label>Balance</label>
          <input class="w3-input w3-border" name="amount_payable" type="number" value="<?php echo $rem?>" id="remainingAmount"  readonly>
          <span id="" class="error-message"></span>
        </div>
      </div>
    </div>




<div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-money" style="position: relative; right: 25px; left: -11px; bottom: 1px; top: 6px;color: #00FF00;"></i></div>
    <div class="w3-rest">
      <label>Payment Mode?</label><br>
      <div class="container1">
    <label><input class="w3-radio hi" type="radio" name="mode" value="UPI">
      UPI &nbsp;</label>
    <label><input class="w3-radio hi" type="radio" name="mode" value="CASH">
      CASH &nbsp;</label>
    <label><input class="w3-radio hi" type="radio" name="mode" value="CARD">
      CARD &nbsp;</label>
    <label><input class="w3-radio hi" type="radio" name="mode" value="CHEQUE">
      CHEQUE</label>
  </div>
  </div>
  

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-file-text-o " style="position: relative; right: 20px; left: -5px; bottom: 1px; top: 20px;color: #00FF00;"></i></div>
    <div class="w3-rest">
    <label>Description</label><br>
      <input class="w3-input w3-border w3" name="des" type="text" required>
    </div>
  </div>    
<div class="button">
  <button type="submit" onclick="validateForm()" class="w3-button w3-block w3-section btn w3-black w3-ripple w3-padding" name="btnSubmit">Submit</button>
  </div>
</div>
</form>

<script>
  function showAlert(message) {
    alertBox.innerHTML = message;
    alertBox.style.display = "block";
  }

  function hideAlert() {
    alertBox.innerHTML = "";
    alertBox.style.display = "none";
  }
  //anniversary date if married otherwise unmarried through function
  function anndate() {
    var isMarriedRadio = document.getElementById("marriedRadio");
    var anniversaryDate = document.getElementById("anniversaryDate");

    if (isMarriedRadio.checked && !anniversaryDate.value) {
        // If married and anniversary date is empty, switch to Unmarried
        document.getElementById("unmarriedRadio").checked = true;
        anniversaryDate.readOnly = true;
    }
}
function validateForm() {
  var dobInput = document.getElementById("dob");
  var dobValue = dobInput.value;

  // Check if a date is selected
  if (!dobValue) {
    showAlert("Please select a date of birth");
  } else {
    
  }
}
function amtvalid(event) {
  var ikey = (event.which) ? event.which : event.keyCode;

  // Check if the key code corresponds to a digit (0-9)
  if (ikey >= 48 && ikey <= 57) {
    return true;
  }

  return false;
}
    document.addEventListener('DOMContentLoaded', function() {
  const radioButtons = document.querySelectorAll('input[name="membership_type"]');
  const startDateInput = document.getElementById('startDate');
  const expiryDateInput = document.getElementById('expiryDate');
  const tableFeeSpan = document.getElementById('tableFee');
  const tableFees = document.getElementById('tableFees');
  const userPaidAmountInput = document.getElementById('userPaidAmount');
  const remainingAmountInput = document.getElementById('remainingAmount');
    
  radioButtons.forEach(radioButton => {
    radioButton.addEventListener('change', function() {
      const selectedRadioButton = this;
      const selectedFees = parseFloat(selectedRadioButton.getAttribute('data-fees'));
      const selectedDays = parseInt(selectedRadioButton.getAttribute('data-days'));
      datadays = parseInt(selectedRadioButton.getAttribute('data-days'));
      userPaidAmountInput.removeAttribute("readonly");
      startDateInput.removeAttribute("readonly");
      if (!isNaN(selectedFees) && !isNaN(selectedDays)) {
        const today = startDateInput.value;
        const expiryDate = new Date(today);
        expiryDate.setDate(expiryDate.getDate() + selectedDays);
        expiryDateInput.value = formatDate(expiryDate);

        tableFeeSpan.textContent = selectedFees.toFixed(2);
        tableFee.value = selectedFees.toFixed(2);
        updateRemainingAmount(selectedFees+rem);
      }
    });
  });

  
  userPaidAmountInput.addEventListener('input', function() {
    const userPaidAmount = parseFloat(userPaidAmountInput.value);
    const tableFee = parseFloat(tableFeeSpan.textContent);

    updateRemainingAmount(tableFee, userPaidAmount);
  });
   
//  validation for amount --------------------------------------------------------------
userPaidAmountInput.addEventListener('input', amountpaid);

function amountpaid() {
    const userPaidAmountInput = document.getElementById("userPaidAmount");
    const tableFeeSpan = document.getElementById("tableFee");
    const remainingAmountInput = document.getElementById('remainingAmount');
    const userPaidAmount = parseFloat(userPaidAmountInput.value); // Get the value

    const tableFee = parseFloat(tableFeeSpan.value); // Get the value

    if (userPaidAmount > (tableFee+rem) || userPaidAmount < 0) {
      showAlert("You cannot Pay more than Fees!!!");
        userPaidAmountInput.value = tableFee+rem; // Clear the input
        remainingAmountInput.value = 0;

    }else
    {
    hideAlert();
        }
}


  function updateRemainingAmount(tableFee, userPaidAmount) {
   
      const remainingAmount = tableFee + rem - userPaidAmount;
      remainingAmountInput.value = remainingAmount.toFixed(2);

  }

  function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  }
});
function handleMembershipTypeChange() {
    const radioButtons = document.querySelectorAll('input[name="membership_type"]');
    const userPaidAmountInput = document.getElementById("userPaidAmount").value=null;

    radioButtons.forEach(radioButton => {
        radioButton.addEventListener('change', function() {
            const selectedRadioButton = document.querySelector('input[name="membership_type"]:checked');
            if (selectedRadioButton) {
                userPaidAmountInput.removeAttribute("readonly");
            } else {
                userPaidAmountInput.setAttribute("readonly", true);
                userPaidAmountInput.value = ""; // Clear the input
            }
        });
    });
}
  </script>

<!-- javascript start from here  -->

<script>
        function validateDOB(dobValue) {
            // Implement your DOB validation logic here
            // Return true if DOB is valid, otherwise return false
            // For example, you can use regular expressions or other validation methods
            return true; // Placeholder, replace with actual validation logic
        }

        function showErrorMessage(message) {
            // Implement your error message display logic here
            // For example, you can show the error message in a designated element
            const errorMessageElement = document.getElementById("error-message");
            errorMessageElement.textContent = message;
        }

        function handleMaritalStatusChange() {
    const marriedRadio = document.getElementById("marriedRadio");
    const unmarriedRadio = document.getElementById("unmarriedRadio");
    
    const dob = document.getElementById("dob");
    const anniversaryDateInput = document.getElementById("anniversaryDate");
    const anniversaryError = document.getElementById("anniversary-error");
    const dobInput = document.getElementById("dob");
    const selectedDate = new Date(anniversaryDateInput.value);
    const currentDate = new Date();
    if (marriedRadio.checked) {
        if (dob.value.trim() === "") {
            showAlert("Please enter your date of birth");
            anniversaryDateInput.setAttribute("readonly", true);
            anniversaryDateInput.value = "";
            marriedRadio.checked = false; // Uncheck the radio button
            marriedRadio.value = "no"; // Set the value to "no"
            unmarriedRadio.checked = true;
        } else {
            if (validateDOB(dob.value)) {
                anniversaryDateInput.removeAttribute("readonly");
                anniversaryDate.focus();
                anniversaryDateInput.value="<?php echo $anniversary_date?>";
                anniversaryError.textContent = ""; // Clear error message
            } else {
                showErrorMessage("Invalid date of birth");
                anniversaryDateInput.setAttribute("readonly", true);
                anniversaryDateInput.value = "";
                marriedRadio.checked = false; // Uncheck the radio button
                marriedRadio.value = "no"; // Set the value to "no"
            }
        }
    } else {
        anniversaryDateInput.setAttribute("readonly", true);
        anniversaryDateInput.value = ""; // Clear input value
        anniversaryError.textContent = "";
    }
}
// function anniversarydate() 
//     {
//         const anniversaryDateInput = document.getElementById("anniversaryDate");
//         const anniversaryError = document.getElementById("anniversary-error");
//         const dobInput = document.getElementById("dob");
//         const selectedDate = new Date(anniversaryDateInput.value);
//         const currentDate = new Date();

//             if(selectedDate > currentDate) {
//                 alert("Anniversary date cannot be in the future");
//                 anniversaryDateInput.value = ""; // Clear the input
//               } 
//            else if(anniversaryDateInput.value < dobInput.value )
//             {
//               alert("Anniversary cant be before date of birth");
//               anniversaryDateInput.value = ""; // Clear the input

//             }
//     }

        
    </script>

  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const startDateInput = document.getElementById('startDate');
    const expiryDateInput = document.getElementById('expiryDate');

    startDateInput.addEventListener('change', function() {
        const startDate = new Date(startDateInput.value);
        var expiryDate = new Date(startDateInput.value);
        const tableFees = document.getElementById('tableFees');
        var currentDate = new Date();
        const minDate = new Date(currentDate.getTime() - 7 * 24 * 60 * 60 * 1000);
        const ys = startDate.getFullYear();
        const ms = startDate.getMonth() + 1; // JavaScript months are zero-indexed, so we need to add 1 to get the actual month number.
        const ds = startDate.getDate();
        var startinputformat = `${ys}-${ms}-${ds}`;      //input formatted y-m-d
        hideAlert();
        // alert(''+starting);
        if (startDate < minDate) {
            showAlert("Start date must be within the past 7 days.");
            startDateInput.value = new Date(minDate);
            startDateInput.value = currentDate.toISOString().split('T')[0];
            // expiryDateInput.value = "";
            const today = startDateInput.value;
          //  alert(today);
           const selectedDays = datadays;
          //  alert(selectedDays);
           expiryDate = new Date(today);
          //  alert(expiryDate);
           expiryDate.setDate(expiryDate.getDate() + selectedDays);

           expiryDateInput.value = formatDate(expiryDate);
            // showAlert(startDateInput);
            startDateInput.value = now.format("DD-MON-YYYY"); // Set the start date to the current date
        } else if (startDate > currentDate) {
            showAlert("Start date should not be greater than "+formatDate(currentDate));
            startDateInput.value = currentDate.toISOString().split('T')[0];
            const today = startDateInput.value;
          //  alert(today);
           const selectedDays = datadays;
          //  alert(selectedDays);
           expiryDate = new Date(today);
          //  alert(expiryDate);
           expiryDate.setDate(expiryDate.getDate() + selectedDays);

           expiryDateInput.value = formatDate(expiryDate);
            startDateInput.value = now.formatDate(new Date(currentDate.getTime() + 24 * 60 * 60 * 1000)); // Set the start date to the expiry date + 1 day
        }
        else {
          hideAlert();
        }
           const today = startDateInput.value;
          //  alert(today);
           const selectedDays = datadays;
          //  alert(selectedDays);
           expiryDate = new Date(today);
          //  alert(expiryDate);
           expiryDate.setDate(expiryDate.getDate() + selectedDays);

           expiryDateInput.value = formatDate(expiryDate);
          //  alert(expiryDateInput);
            // Data is correct, clear the error message
            function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
            }
            
    });
    
    
});
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${day}-${month}-${year}`;
}

  // birth date validation here 111111111111111111111111111111111111111111111111111111111111111111

 
  document.addEventListener("DOMContentLoaded", function() {
      const dobInput = document.getElementById("dob");
      const marriedradio = document.getElementById("marriedRadio");
      const unmarriedRadio = document.getElementById("unmarriedRadio");
      const anniversaryDateInput = document.getElementById("anniversaryDate");
    
      dobInput.addEventListener("change", validateBirthDate);
    
      function validateBirthDate() {
        const selectedDate = new Date(dobInput.value);
        const currentDate = new Date();
        const minDate = new Date(currentDate);
        minDate.setFullYear(currentDate.getFullYear() - 5);
          const maxDate = new Date(currentDate);
    maxDate.setFullYear(currentDate.getFullYear() - 100); 

    const maleRadio = document.getElementById('male');
  const femaleRadio = document.getElementById('female');


        if (selectedDate > currentDate) {
          showAlert("Birth date cannot be in the future");
          dobInput.value = ""; // Clear the input
        } else if (selectedDate > minDate) {
          showAlert("Birth date must be at least 5 years in the past");
          dobInput.value = ""; // Clear the input
        }else if (selectedDate < maxDate) {
      showAlert("Birth date cannot be more than 100 years ago");
      dobInput.value = ""; // Clear the input
    } 
        else {
          
            // Data is correct, clear the error message
            hideAlert();
            // marriedradio.setAttribute("disabled", true);
//             const gender = maleRadio.checked ? "male" : "female";

// // Calculate age based on selected date of birth
var age = calculateAge(selectedDate);
// showAlert(""+age);  
// const age = currentDate.getFullYear() - dobInput.getFullYear();
// age = 15;
// Check age and gender conditions
if (gender === "male" && age < 21) {
  unmarriedRadio.checked = true;
  anniversaryDateInput.value="";
  anniversaryDateInput.setAttribute("readonly", true);
  marriedradio.setAttribute("disabled", true);

} else if (gender === "female" && age < 18) {
  unmarriedRadio.checked = true;
  anniversaryDateInput.value="";
  anniversaryDateInput.setAttribute("readonly", true);
  marriedradio.setAttribute("disabled", true);
} else {

  // Data is correct, clear the error message and make marital status readonly
  hideAlert();
  marriedradio.removeAttribute("disabled");
}
}
        
 }
  function calculateAge(birthDate) {
  const currentDate = new Date();
  const age = currentDate.getFullYear() - birthDate.getFullYear();
  const birthMonth = birthDate.getMonth();
  const currentMonth = currentDate.getMonth();

  if (currentMonth < birthMonth || (currentMonth === birthMonth && currentDate.getDate() < birthDate.getDate())) {
    return age - 1;
  }

  return age;
}
    });
</script>
<script>
                const membershipTypeRadios = document.querySelectorAll('input[name="membershiptype"]');
                const expiryDateField = document.getElementById("expiryDateField");

                membershipTypeRadios.forEach(radio => {
                    radio.addEventListener("change", function() {
                        const selectedDays = radio.value;
                        if (selectedDays) {
                            const expiryDate = calculateExpiryDate(selectedDays);
                            expiryDateField.value = expiryDate;
                        } else {
                            expiryDateField.value = "";
                        }
                    });
                });

                function calculateExpiryDate(days) {
                    const today = new Date();
                    const expiryDate = new Date(today.getTime() + days * 24 * 60 * 60 * 1000);
                    return expiryDate.toISOString().split('T')[0];
                }
            </script>
</body>
</html>



<?php
if (isset($_POST['btnSubmit'])) {
  error_reporting(E_ALL);
ini_set('display_errors', 1);
  $e_id=$_GET["e_id"];
    $dob = $_POST['dob'];
    $is_married = $_POST['is_married'];
    $anniversary_date = $_POST['anniversary_date'];
    if (empty($anniversary_date)) {
      $anniversary_date = "";
  } else {
      if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $anniversary_date)) {
      } else {
        $anniversary_date = "";
      }
  }
    if(isset($_POST['membership_type']))
    $membership_type = $_POST['membership_type']; // Corrected variable name
    $start_date = $_POST['start_date'];
    $expiry_date = $_POST['expiry_date'];
    $reminder_date=date('Y-m-d', strtotime($start_date . ' +7 days'));
    if($_POST['mode'])
    {
    $mode = $_POST['mode'];
    }
    else
    {
      $mode = null;
    }
    $fees = $_POST['tableFee'];
    $amount_paid = $_POST['userPaidAmount'];
    $amount_payable = $_POST['amount_payable'];
    $des = $_POST['des'];


    if (empty($dob)) {
      echo '<script>showAlert("Please enter your date of birth");</script>';
  }
   elseif (empty($is_married)) {
    echo '<script>showAlert("Please select your marital status");</script>';
  } elseif (empty($anniversary_date) && $is_married === 'married') {
    echo '<script>showAlert("Please enter your anniversary date");</script>';
      
  }elseif(empty($anniversary_date)){
    $anniversary_date="";
  }
  elseif (empty($start_date)) {
    echo '<script>showAlert("Start date should not be empty");</script>';
  }  
  elseif (empty($membership_type)) {
    echo '<script>showAlert("Please select your membership type");</script>';
    
  } elseif (empty($amount_paid) || $amount_paid <= 1) {
    echo '<script>showAlert("Please enter the amount you want to pay");</script>';
      
  } elseif (empty($mode)) {
    echo '<script>showAlert("Please select the payment mode");</script>';

  } elseif (empty($des)) {
    echo '<script>showAlert("Please Enter description");</script>';

  } else
   {
    echo '<script> hideAlert();</script>';
    $querymem="SELECT * FROM `membership_form` WHERE `e_id`='$e_id'";
    $resultmem=mysqli_query($connection,$querym);
    if($resultmem && $rowm=mysqli_fetch_assoc($resultmem))
    {
      $runquery = "UPDATE membership_form
        SET `dob` = '$dob', 
        `is_married` = '$is_married', 
        `anniversary_date` = '$anniversary_date', 
        `membership_type` = '$membership_type', 
        `start_date` = '$start_date',
        `expiry_date` = '$expiry_date',
        `reminder_date` = '$reminder_date',
        `amount_paid`='$amount_paid', 
        `fees` = '$fees',
        `amount_payable`='$amount_payable',
        `des` = '$des' 
    WHERE `e_id` = '$e_id'";
        $resultrun = mysqli_query($connection, $runquery); // Corrected variable name
    }  
    else
    {
      
      $runquery = "INSERT INTO membership_form (`e_id`,`dob`, `is_married`, `anniversary_date`, `membership_type`, `start_date`, `expiry_date`, `mode`,`reminder_date`,`fees`,`amount_paid`,`amount_payable`,`des`) VALUES ('$e_id','$dob', '$is_married', '$anniversary_date', '$membership_type', '$start_date', '$expiry_date', '$mode','$reminder_date','$fees','$amount_paid','$amount_payable','$des')";
      $resultrun = mysqli_query($connection, $runquery); // Corrected variable name
      
    }

    if ($resultrun) {
        // echo "<script>alert('Data inserted successfully');</script>";
        $mquery="SELECT m_id from membership_form WHERE e_id='$e_id'";
 
        $res=mysqli_query($connection,$mquery);

        
        if($row=mysqli_fetch_assoc($res))
          $m_id=$row["m_id"];
        $receiptquery = "INSERT INTO `receipt`(`e_id`, `m_id`, `fees`, `amount_paid`, `amount_payable`, `pay_mode`, `description`) VALUES('$e_id','$m_id','$fees','$amount_paid','$amount_payable','$mode','$des')";
        $receiptresult=mysqli_query($connection,$receiptquery);
        if($receiptresult)
        {
          echo "<script>
          alert('Inserted successfully');
          window.location.href='receipt.php?m_id=$m_id';
          </script>";}
    } else {
        echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
    }
}
}
else
?>
<!-- Insertion code End form here -->
<?php

$e_id = $_GET["e_id"]; 
$query = "SELECT gender FROM enquiry_master WHERE e_id = '$e_id'";
$result = mysqli_query($connection, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $gender = $row['gender'];
} else {
    echo "gender is not found";
    $gender = ""; // Set a default value
}
// echo "<script>alert($gender);</script>";
?>

<script>
function anniversarydate() {
    const anniversaryDateInput = document.getElementById("anniversaryDate");
    const anniversaryError = document.getElementById("anniversary-error");
    const dobInput = document.getElementById("dob");
    const selectedDate = new Date(anniversaryDateInput.value);
    const currentDate = new Date();

    // Fetch the gender from the server, you need to replace 'male' and 'female' with the actual values.
    const gender = "<?php echo $gender; ?>"; 

    if (selectedDate > currentDate) {
      showAlert("Anniversary date cannot be in the future");
        anniversaryDateInput.value = ""; // Clear the input
    }
    else if(anniversaryDateInput.value < dobInput.value )
            {
              showAlert("Anniversary cant be before date of birth");
              anniversaryDateInput.value = ""; // Clear the input

            }
 else if (gender === 'male' && selectedDate < getMinimumDate(dobInput.value, 21)) {
  showAlert("For males, anniversary date should be at least 21 years from DOB");
        anniversaryDateInput.value = ""; // Clear the input
    } else if (gender === 'female' && selectedDate < getMinimumDate(dobInput.value, 18)) {
        showAlert("For females, anniversary date should be at least 18 years from DOB");
        anniversaryDateInput.value = ""; // Clear the input
    }
    else {
            // Data is correct, clear the error message
            hideAlert();
        }
}

function getMinimumDate(dob, years) {
    const dobDate = new Date(dob);
    dobDate.setFullYear(dobDate.getFullYear() + years);
    return dobDate;
}

</script>


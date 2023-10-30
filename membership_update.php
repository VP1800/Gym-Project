<?php
require_once("Database/connection.php");
$e_id = $_GET["e_id"];
$query = "SELECT * FROM membership_form WHERE e_id='$e_id'";
$result = mysqli_query($connection,$query);
$rowm = mysqli_fetch_assoc($result);
$currentDate = date('Y-m-d');
$rem=$rowm["amount_payable"];
$paid=$rowm['amount_paid'];
$fees=$rowm["fees"];
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
echo "<script> var paid= $paid;</script>";
if($fees - $paid == $rem)
{
  echo "<script>var rem= 0;</script>";
}
else {
  echo "<script>var rem= $rem;</script>";
}
if($currentDate > $rowm['expiry_date'])
{
  header("Location: membership_form.php?e_id=$e_id");
}
?>
<!DOCTYPE html>
<html>

<title>membership</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="CSS/w3.css">
<link rel="stylesheet" href="CSS/w3schools.com_w3css_4_w3.css">
<link rel="stylesheet" href="CSS/FONT/font-awesome.min.css">
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
<form action="" class="w3-card-4 w3-light-grey w3-text-black w3-margin w4-padding" style="width:500px;font-family: Arial, Helvetica, sans-serif; padding-top: 4px; padding-bottom: 16;" method="post">
<h1 class="w3-center">Membership Update</h1>
<div id="alertBox" class="w3-panel w3-pale-red w3-border" style="display: none;"><p><?php echo $message;?></p></div>
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-calendar" style="position: relative; right: 25px; left: -6px; bottom: 1px; top: 16px;color: #00FF00;"></i></div>
  <div class="w3-rest">
    <label>Birth Date</label><br>
    <input class="w3-input w3-border design" name="dob" id="dob" value="<?php echo $rowm['dob']; ?>" type="date">
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
          <label><input class="w3-radio hi" type="radio" name="is_married" value="married"  id="marriedRadio" <?php if($rowm['is_married']=='married') echo 'checked'?> onchange="handleMaritalStatusChange()" >
          Married &nbsp;</label>
          <label><input class="w3-radio hi" type="radio" name="is_married" value="unmarried"  id="unmarriedRadio" <?php if($rowm['is_married']=='unmarried') echo 'checked'?>  onchange="handleMaritalStatusChange()">
          Unmarried</label>
        </div>
        </div>
        <div class="right1" style="width: 100%">  
          <label>Anniversary Date</label><br>
            <input class="w3-input w3-border" name="anniversary_date" type="date" id="anniversaryDate" onchange="anniversarydate()" value="<?php echo $rowm["anniversary_date"]?>" <?php if($rowm['is_married']=='unmarried'){ echo 'readonly';}else{}?> onchange="anniversarydate()">
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
          while ($rows = mysqli_fetch_assoc($result)) {
            echo '<label>';
            if($rows["membership_type"]== $rowm["membership_type"]){
              echo '<input type="radio" class="w3-radio hi" onclick="handleMembershipTypeChange()" name="membership_type" value="' . $rows['membership_type'] . '" data-fees="' . $rows['fees'] . '" data-days="' . $rows['days'] . '" checked>';
            }else{
            echo '<input type="radio" class="w3-radio hi" onclick="handleMembershipTypeChange()" name="membership_type" value="' . $rows['membership_type'] . '" data-fees="' . $rows['fees'] . '" data-days="' . $rows['days'] . '">';
             } ?>&nbsp;<?php
            echo $rows['membership_type'];
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
        <input class="w3-input w3-border" name="start_date" type="date" placeholder="dd/mm/yyyy" value="<?php echo $rowm['start_date']?>"id="startDate" readonly>
      </div>
      <div class="right">  
        <label>Expiry Date</label><br>
        <input class="w3-input w3-border" name="expiry_date" type="date" value="<?php echo $rowm['expiry_date']?>" id="expiryDate" readonly>
      </div>
        </div>
    </div>
  </div>

  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-rupee" style="position: relative; right: 25px; left: -6px; bottom: 1px; top: 16px;color: #00FF00;"></i></div>
    <div class="w3-rest">
      <div class="container">
        <div class="left">
        <label>Total Fees</label><br>
        <input type="text" class="w3-input w3-border" name="tableFees" value="<?php echo $rowm['fees'];?>" id="tableFee" readonly>
        </div>
        <div class="left">
          <label>Paid Amount</label>
          <input class="w3-input w3-border design" name="userPaidAmount" id="userPaidAmount" value="<?php echo $rowm['amount_paid'];?>" onkeyup="amountpaid()" type="number" readonly>
        </div>
        <div class="right">
          <label>Balance</label>
          <input class="w3-input w3-border" name="amount_payable" type="number" value="<?php echo $rem?>" id="remainingAmount"  readonly>
          <span id="" class="error-message"></span>
        </div>
      </div>
    </div>
  <!------------------------------------------end---------------------------------------------------->

<div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-money" style="position: relative; right: 25px; left: -11px; bottom: 1px; top: 6px;color: #00FF00;"></i></div>
    <div class="w3-rest">
      <label>Payment Mode?</label><br>
      <div class="container1">
    <label><input class="w3-radio hi" type="radio" name="mode" value="UPI" <?php if($rowm['mode']=='UPI') echo 'checked'; else echo 'disabled';?>>
      UPI &nbsp;</label>
    <label><input class="w3-radio hi" type="radio" name="mode" value="CASH" <?php if($rowm['mode']=='CASH') echo 'checked'; else echo 'disabled';?>>
      CASH &nbsp;</label>
    <label><input class="w3-radio hi" type="radio" name="mode" value="CARD" <?php if($rowm['mode']=='CARD') echo 'checked'; else echo 'disabled';?>>
      CARD &nbsp;</label>
    <label><input class="w3-radio hi" type="radio" name="mode" value="CHEQUE" <?php if($rowm['mode']=='CHEQUE') echo 'checked'; else echo 'disabled';?>>
      CHEQUE</label>
      </div>
  </div>
  </div>
  

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-file-text-o " style="position: relative; right: 20px; left: -5px; bottom: 1px; top: 20px;color: #00FF00;"></i></div>
    <div class="w3-rest">
    <label>Description</label><br>
      <input class="w3-input w3-border w3" name="des" type="text" value="<?php echo $rowm["des"]?>">
    </div>
  </div>    
<div class="button">
  <button class="w3-button w3-block w3-section btn w3-black w3-ripple w3-padding" name="btnSubmit">Update</button>
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
    document.addEventListener('DOMContentLoaded', function() {
  const radioButtons = document.querySelectorAll('input[name="membership_type"]');
  const expiryDateInput = document.getElementById('expiryDate');
  const startDateInput = document.getElementById('startDate');
  const tableFeeSpan = document.getElementById('tableFee');
  const tableFees = document.getElementById('tableFees');
  const userPaidAmountInput = document.getElementById('userPaidAmount');
  const remainingAmountInput = document.getElementById('remainingAmount');

  radioButtons.forEach(radioButton => {
    radioButton.addEventListener('change', function() {
      const selectedRadioButton = this;
      const selectedFees = parseFloat(selectedRadioButton.getAttribute('data-fees'));
      const selectedDays = parseInt(selectedRadioButton.getAttribute('data-days'));
      if (!isNaN(selectedFees) && !isNaN(selectedDays)) {
        const today = startDateInput.value;
        const expiryDate = new Date(today);
      expiryDate.setDate(expiryDate.getDate() + selectedDays);

      const currentDate = new Date(); 
        if(expiryDate < currentDate)
        {
          alert('Expiry date cannot be before the current date');
          if (selectedMembershipType !== null) {
          radioButtons.forEach(radio => {
            if (radio.value === selectedMembershipType) {
              radio.checked = true;
            }
          });
        }
        }

        else
        {
          selectedMembershipType = selectedRadioButton.value;
        
        expiryDateInput.value = formatDate(expiryDate);

        tableFeeSpan.textContent = selectedFees.toFixed(2);
        tableFee.value = selectedFees.toFixed(2);
        updateRemainingAmount(selectedFees);
        }
      }
    });
  });

  
  // userPaidAmountInput.addEventListener('input', function() {
  //   const userPaidAmount = parseFloat(userPaidAmountInput.value);
  //   const tableFee = parseFloat(tableFeeSpan.textContent);

  //   updateRemainingAmount(tableFee, userPaidAmount);
  // });
   
//  validation for amount --------------------------------------------------------------
// userPaidAmountInput.addEventListener('input', amountpaid);

// function amountpaid() {
//     const userPaidAmountInput = document.getElementById("userPaidAmount");
//     const tableFeeSpan = document.getElementById("tableFee");
//     const remainingAmountInput = document.getElementById('remainingAmount');
//     const userPaidAmount = parseFloat(userPaidAmountInput.value); // Get the value
//     remainingAmountInput = tableFee - paid - userPaidAmount;
//     const tableFee = parseFloat(tableFeeSpan.value); // Get the value

//     if (userPaidAmount > tableFee-rem || userPaidAmount < 0) {
//         // alert("You cannot Pay more than Fees!!!");
//         userPaidAmountInput.value = 0; // Clear the input
//         remainingAmountInput.value = 0;

//     }
// }


  function updateRemainingAmount(tableFee, userPaidAmount) {
   
      const remainingAmount = tableFee - paid + rem;
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
    const userPaidAmountInput = document.getElementById("userPaidAmount");
    const remainingAmountInput = document.getElementById('remainingAmount');
    radioButtons.forEach(radioButton => {
        radioButton.addEventListener('change', function() {
            const selectedRadioButton = document.querySelector('input[name="membership_type"]:checked');
            if (selectedRadioButton) {
                // userPaidAmountInput.value = (0);
                

            } else {
                userPaidAmountInput.setAttribute("readonly", true);
                userPaidAmountInput.value = userPaidAmountInput.toFixed(2); // Clear the input
                
            }
        });
    });
}
  </script>

<!-- javascript start from here  -->

<script>
        function validateDOB(selectedDate) {
          
            
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
    const dobDate = new Date(dobInput.value);
    const currentDate = new Date();
    if (marriedRadio.checked) {
      anniversaryDateInput.removeAttribute("readonly");
        if (dob.value.trim() === "") {
            showAlert("Please enter your date of birth");
            anniversaryDateInput.setAttribute("readonly", true);
            anniversaryDateInput.value = "";
            marriedRadio.checked = false; // Uncheck the radio button
            marriedRadio.value = "no"; // Set the value to "no"
            unmarriedRadio.checked = true;
        } else {
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
          var age = calculateAge(dobDate);
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
            anniversaryDateInput.removeAttribute("readonly");
            marriedradio.removeAttribute("disabled");
            
            
            }
            return true; // Placeholder, replace with actual validation logic
            
        }
    } else {
        // anniversaryDateInput.setAttribute("readonly", true);
        anniversaryDateInput.value = ""; // Clear input value
        anniversaryError.textContent = "";
        anniversaryDateInput.setAttribute("readonly",true);
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
//                 anniversaryDateInput.value = "<?php //echo $rowm['anniversary_date']?>"; // Clear the input
//               } 
//            else if(anniversaryDateInput.value < dobInput.value )
//             {
//               alert("Anniversary cant be before date of birth");
//               anniversaryDateInput.value = "<?php //echo $rowm['anniversary_date']?>"; // Clear the input

//             }
//     }

 
    </script>

  
  <script>
  
  // birth date validation here 
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
  $currentDate = date('Y-m-d');
  $e_id=$_GET["e_id"];
    $dob = $_POST['dob'];
    $is_married = $_POST['is_married'];
    $anniversary_date = $_POST['anniversary_date'];
    $membership_type = $_POST['membership_type']; // Corrected variable name
    $expiry_date = $_POST['expiry_date'];//
    $fees = $_POST['tableFees'];//
    $amount_paid = $rowm['amount_paid'];
    $amount_payable = $_POST['amount_payable'];//
    $des = $_POST['des'];
    $minus_paid=0;

    if (empty($dob)) {
      echo '<script>showAlert("Please enter your date of birth");</script>';
  }
   elseif (empty($is_married)) {
    echo '<script>showAlert("Please select your marital status");</script>';
  } elseif (empty($anniversary_date) && $is_married === 'married') {
    echo '<script>showAlert("Please enter your anniversary date");</script>';
      
  } elseif (empty($membership_type)) {
    echo '<script>showAlert("Please select your membership type");</script>';
    
  } elseif (empty($amount_paid)) {
    echo '<script>showAlert("Please enter the amount you want to pay");</script>';
      
  } elseif (empty($des)) {
    echo '<script>showAlert("Please Enter description");</script>';

  } else
   {
    echo '<script> hideAlert();</script>';
    if ($amount_payable < 0)
    {  
      $amount_paid=$fees;
      $minus_paid=$amount_payable;
      $amount_payable=0;
    }
    $query = "UPDATE membership_form
    SET `dob` = '$dob', 
        `is_married` = '$is_married', 
        `anniversary_date` = '$anniversary_date', 
        `membership_type` = '$membership_type', 
        `expiry_date` = '$expiry_date',
        `amount_paid`='$amount_paid', 
        `fees` = '$fees',
        `amount_payable`='$amount_payable',
        `des` = '$des' 
    WHERE `e_id` = '$e_id'";
    $result = mysqli_query($connection, $query); // Corrected variable name
    if ($result) {
        
        if($amount_payable ==  0 && $amount_paid == 0 && $fees != $rowm["fees"] && $minus_paid==0)
        {
          $mquery="SELECT m_id from membership_form WHERE e_id='$e_id'";
          $res=mysqli_query($connection,$mquery);
          $row=mysqli_fetch_assoc($res); 
          $m_id=$row["m_id"];
          $rquery = "INSERT INTO `receipt`(`e_id`, `m_id`, `fees`, `amount_paid`, `amount_payable`, `pay_mode`, `description`) VALUES('$e_id','$m_id','$fees','$amount_paid','$amount_payable','$mode','$des')";
          $result=mysqli_query($connection,$rquery);
          echo "<script>alert('Receipt inserted successfully');</script>";
          echo "<script>window.location.href='receipt.php?m_id=$m_id'</script>";    //?m_id='$m_id';
          echo "<script>alert('checkif');</script>";
        }
        else if($minus_paid < 0)
        {
          $mquery="SELECT m_id from membership_form WHERE e_id='$e_id'";
          $res=mysqli_query($connection,$mquery);
          $row=mysqli_fetch_assoc($res); 
          $m_id=$row["m_id"];
          $rquery = "INSERT INTO `receipt`(`e_id`, `m_id`, `fees`, `amount_paid`, `amount_payable`, `pay_mode`, `description`) VALUES('$e_id','$m_id','$fees','$minus_paid','$amount_payable','$mode','$des')";
          $result=mysqli_query($connection,$rquery);
          echo "<script>alert('Receipt inserted successfully');</script>";
          echo "<script>window.location.href='receipt.php?m_id=$m_id'</script>";  //?m_id='$m_id';
          echo "<script>alert('checkelseif');</script>";
        }
        else
        {
          echo "<script>alert('Data updated successfully');</script>";
          echo "<script>window.location.href='showmembers.php';</script>";
        }
        // header("Location: show.php");
    } else {
        echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
    }
}
}
else
?>
<!-- Insertion code End form here -->
<!-- <?php
function validateForm()
{
    $dob = $_POST['dob'];
    $is_married = $_POST['is_married'];
    $anniversary_date = $_POST['anniversary_date'];
    $membership_type = $_POST['membership_type'];
    $userPaidAmount = $_POST['userPaidAmount'];
    $mode = $_POST['mode'];

    if ($dob === "") {
        showErrorMessage("Please enter your name");
        return false;
    }
    if ($is_married === "") {
        showErrorMessage("Please enter your Marital Status");
        return false;
    }
    if ($anniversary_date === "") {
        showErrorMessage("Please enter your anniversary Date");
        return false;
    }
    if ($membership_type === "") {
        showErrorMessage("Please enter your membership type");
        return false;
    }
    if ($userPaidAmount === "") {
        showErrorMessage("Please enter Amount you want to pay");
        return false;
    }
    if ($mode === "") {
        showErrorMessage("Please enter mode of payment");
        return false;
    }
    else
    {

    }
    return true;
}

function showErrorMessage($message)
{
    echo "<script>alert('$message');</script>";
}
?> -->


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


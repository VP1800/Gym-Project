<?php
session_start();
require_once("Database/connection.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>change password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./image">
<link rel="stylesheet" href="CSS/FONT/font-awesome.min.css">
<link rel="stylesheet" href="CSS/FONT/font-awesome.css">
<link rel="stylesheet" href="CSS/w3.css">
<link rel="stylesheet" href="CSS/w3schools.com_w3css_4_w3.css">
<link rel="stylesheet" href="CSS/w31.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.fa{
    color: #00ff00;
  }
body{
background-image: url("image/login_bg.jpg");
background-size: cover;
background-attachment: fixed;
font-family: Arial, Helvetica, sans-serif;
}
button {
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 200px;
  margin-left: 60px;
}
.login {
    padding: 1em;
    color: hsl(0 0 100);
    border: none;
    font-weight: 600;
    margin-top: 15px;
    margin-left: 35%;
    background-color: #1273eb;
    width: 100px;
    display: flex;
  }
  .footer {
      display: flex;
      font-size: 14px;
      color: hsl(0deg 0% 37%);
      gap: 4em;
      margin-left: 35%;
      margin-top: 4%;
      color: #1273eb;
      
    }
    .colwid{
  width:50px;
}
img {
  max-width: 50%;
  height: auto;
  margin-left:33%;
}
.center-form{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  padding: 35px;
}
.err{
  display: none;
  background-color: #f2dede;
  border: 1px solid #ebcd1;
  color: #a94442;
  text-align: center;
  width:380px;
  margin: 0 auto;
  display: none;
  position: fixed;
  top: 10%; /* Adjust the top value to control the distance from the top of the page */
  left: 50%;
  transform: translateX(-50%);

}
.form{
  width:400px ;
  height:auto; 
  padding:35px;
}
.err{
 display: none;
}
.label{
  color: black;
   margin-left: 80px;
}
.showpass{
  margin-left: 50px;
  margin-top: 10px;
}

/* Add media query for screens with a maximum width of 600px */
@media (max-width: 500px) {
  .err {
    width: 80%; /* Adjust the width as needed */
    left: 50%;
    transform: translateX(-50%);
    top: 10%; /* Adjust the top value for spacing */
    font-size: 12px; /* Adjust font size for small screens */
  }
}
@media screen and (max-width: 800px) and (orientation: landscape) {
      .form {
        width:60%;
        /*left: 50%;*/
     /*   transform: translateX(-50%);*/
        top: 70px;
        font-size: 14px; /* Adjust font size for landscape mode */
      }
    }
</style>
</head>

<!-- code to prevent resubmission -->
<script>
  if(window.history.replaceState)
  {
    window.history.replaceState(null,null,window.location.href);
  }

</script>
<body>
<div class="error-box"></div>

<div class="w3-container center-form">
<form action="" method="POST" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin form"onblur="errorhide()" onsubmit="return formSubmission()"> 
<label class="label" for="fname"><b>Change Password</b></label>
<span id="error-container" style="display: none;"></span>

<div class="w3-row w3-section">

      <div class="w3-col colwid"><i class="w3-xxlarge fa fa-key"></i></div>
      <div class="w3-rest">
      <input class="w3-input w3-border" id="oldpassword" name="oldpassword" type="password" placeholder=" Enter current Password"onkeypress="return isString(event)" maxlength="20" onblur="validoldPassword()" onkeydown="checkPasswordLength()">
    </div>
<input class="showpass" type="checkbox" onclick="myFunction1()"> Show Password
</div>

<div class="w3-row w3-section">
    <div class="w3-col colwid"><i class="w3-xxlarge fa fa-key"></i></div>

    <div class="w3-rest">
      <input class="w3-input w3-border" id="newpassword" name="newpassword" type="password" placeholder="Enter new Password" onkeypress="return isString(event)" maxlength="20" onblur="validnewPassword()" onkeydown="checkPasswordLength1()">
    </div>
    <input class="showpass" type="checkbox" onclick="myFunction2()"> Show Password
</div><br>
<button class="w3-button w3-black" type="submit" name="submit">submit</button>
<div class="footer"><a href="dashboard.php">Back To Home</a></div>

  
<!-- </center> -->
</form>
</div>

<script>
  // Selectors for input fields
 // const usernameInput = document.getElementById("username");
  const oldpasswordInput = document.getElementById("oldpassword");
  const newpasswordInput = document.getElementById("newpassword");

  // Selectors for error container
  const errorContainer = document.getElementById("error-container");

  // Event listeners for input fields
 // usernameInput.addEventListener("input", validateUsername);
  oldpasswordInput.addEventListener("input", validoldPassword);
  newpasswordInput.addEventListener("input", validnewPassword);

  // Event listener for show password checkbox
  const showPassCheckbox = document.querySelector(".showpass");
  showPassCheckbox.addEventListener("click", myFunction1);

  function showErrorMessage(message) {
    errorContainer.innerHTML = '<div class="w3-panel w3-pale-red w3-border nomargin"><p>' + message + '</p></div>';
    errorContainer.style.display = "block";
  }

  function hideErrorMessage() {
    errorContainer.style.display = "none";
  }

  function validoldPassword() {
    var oldpassword = oldpasswordInput.value;
    var passwordpattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/;
    if (!passwordpattern.test(oldpassword)) {
      showErrorMessage("Please enter a valid old password of min 8 characters, containing at least one Capital alphabet, a Small alphabet, a Number and a Special symbol (!@#$%^&*)");
    } else {
      hideErrorMessage();
    }
  }
  function checkPasswordLength() {
  var oldpassword = oldpasswordInput.value;
  if (oldpassword.length >= 20) {
    showErrorMessage("Password cannot be more than 20 characters");
  } else {
    hideErrorMessage();
  }
}

  function validnewPassword() {
    var newpassword = newpasswordInput.value;
    var passwordpattern1 = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/;
    if (!passwordpattern1.test(newpassword)) {
      showErrorMessage("Please enter a valid  new password of min 8 characters, containing at least one Capital alphabet, a Small alphabet, a Number and a Special symbol (!@#$%^&*)");
    } else {
      hideErrorMessage();
    }
  }

  function checkPasswordLength1() {
  var newpassword = newpasswordInput.value;
  if (newpassword.length >= 20) {
    showErrorMessage("Password cannot be more than 20 characters");
  } else {
    hideErrorMessage();
  }
}
  function formSubmission() {
    var oldpassword = oldpasswordInput.value;
    var newpassword = newpasswordInput.value;

    
    if (oldpassword === "" && newpassword === "") {
    showErrorMessage("All fields are required");
    return false;
    }

    if (oldpassword === "") {
      showErrorMessage("Enter your current password");
      return false;
    }

    if (newpassword === "") {
      showErrorMessage("Please enter a newpassword");
      return false;
    }

    if (oldpassword == newpassword) {
      showErrorMessage("New password should be different from current");
      return false;
    }

    return true;
  }
</script>

<?php

$errors = [];

if (isset($_POST['submit'])) 
{
  $username = $_SESSION['username'];
  $oldpassword = $_POST['oldpassword'];
  $newpassword = $_POST['newpassword'];

  // validations
  
  if (empty($oldpassword) || !preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/', $oldpassword)) 
  {
      $errors[] = "Enter a valid  Current  password";
  }

  if (empty($newpassword) || !preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/', $newpassword)) 
  {
      $errors[] = "Enter a valid  new password";
  }

  if ($oldpassword == $newpassword) 
  {
      $errors[] = "New password should be different from old";
  }
  
  if (empty($oldpassword) && empty($newpassword))
  {
      echo "<script>alert('Please fill in both the fields');</script>";
  } 
  elseif (!$oldpassword)
  {
    echo "<script>alert('Invalid password format. Password should contain: 
      - A capital alphabet
      - A small alphabet
      - A number
      - A special symbol (!@#$%^&*)');</script>";
    exit; // Stop further execution
  }  
  elseif (!$newpassword)
  {
    echo "<script>alert('Invalid password format. Password should contain: 
      - A capital alphabet
      - A small alphabet
      - A number
      - A special symbol (!@#$%^&*)');</script>";
    exit; // Stop further execution
  }  
  // Check if any errors occurred
  if (count($errors) > 0) 
  {
    foreach ($errors as $error) 
    {
        echo "<script>alert('$error');</script>";
    }
  }
  else 
  {
    // Check if the provided username exists
    $query = "SELECT `username`, `password` FROM login_master WHERE username='$username' AND password='$oldpassword'";

    // -- $query = "SELECT `username`, `password` FROM login_master WHERE username=$username AND password=$oldpassword";
    //$result = mysqli_query($connection, $query);

    $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) == 0) 
        {
            echo "<script>alert('Wrong Current Password!');</script>";
        } 
    else 
    {
        // echo $username;
        $query1 = "UPDATE login_master SET `password`='$newpassword', updated_at=NOW() WHERE username='$username'";

        //-- $query1 = "UPDATE login_master SET `password`=$newpassword,updated_at=NOW() where username=$username";

        $result2 = mysqli_query($connection, $query1);
      if ($result2) 
      {
        echo "<script>alert('Password changed successfully');</script>";
      }
      else
      {
        echo "<script>alert('Password changed failed');</script>";
      } 
      
    }
  }
}

?>



<!----show password1-------->
<script>
function myFunction1() {
  var x = document.getElementById("oldpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<!----show password2-------->
<script>
function myFunction2() {
  var x = document.getElementById("newpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<script>
  function isNumber(evt) {
                     var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if ( iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }   
</script>
<script>
function isString(evt) {
  var allowedCharacters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*?";
  var iKeyCode = evt.which || evt.keyCode;
  var char = String.fromCharCode(iKeyCode);

  // Check if the character is in the list of allowed characters
  if (allowedCharacters.includes(char)) {
    return true;
  }
  
  return false;
}
</script>

<!----cursor blinck in username field------>
<script>
document.addEventListener("DOMContentLoaded", function() {
  var usernameInput = document.getElementById("oldpassword");
  usernameInput.focus();
});
</script>

</body>
</html>
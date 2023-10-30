<?php
include('Database/connection.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>forgot Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="CSS/w3.css">
<link rel="stylesheet" href="image">
<link rel="stylesheet" href="CSS/FONT/font-awesome.min.css">
<link rel="stylesheet" href="CSS/FONT/font-awesome.css">
<link rel="stylesheet" href="css.3 ofline/css/w3.css">
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
    font-size: 12px;
    color: hsl(0deg 0% 37%);
    gap: 4em;
    margin-left: 5%;
    margin-top: 4%;
    color: #1273eb;
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

.form{
  width:400px ;
  height:auto; 
  padding:35px;
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
  top: 20px; /* Adjust the top value to control the distance from the top of the page */
  left: 50%;
  transform: translateX(-50%);
  /* z-index: 999; */
}
.label{
  color: black;
   margin-left: 80px;
}
.colwid{
  width:50px;
}
.showpass{
  margin-left: 1px;
  margin-top: 10px;
}

@media (max-width: 500px) {
  .err {
    width: 80%; /* Adjust the width as needed */
    left: 50%;
    transform: translateX(-50%);
    top: 10%; /* Adjust the top value for spacing */
    font-size: 12px; /* Adjust font size for small screens */
  }
}
@media screen and (max-width: 750px) and (orientation: landscape) {
      .form {
        width: 60%;
        /*left: 50%;*/
     /*   transform: translateX(-50%);*/
        top:20%;
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
    <form method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin form" onblur="errorhide()" onsubmit="return formSubmission()" >
      <label class="label" for="fname"><b>Forgot Password</b></label>
      <span id="error-container" style="display: none;"></span>
      <div class="w3-row w3-section">
          <div class="w3-col colwid"><i class="w3-xxlarge fa fa-user"></i></div>

        <div class="w3-rest">
          <input class="w3-input w3-border" id="username" name="username" type="text" placeholder="Enter your mobile number" onkeypress="return isNumber(event)" maxlength="10" onblur="validateUsername()" onkeydown="checkUsernameLength()">
        </div>
      </div>
      <div class="w3-row w3-section">
          <div class="w3-col colwid"><i class="w3-xxlarge fa fa-key"></i></div>

        <div class="w3-rest">
          <input class="w3-input w3-border" id="Newpassword" name="Newpassword" type="password" placeholder="New Password"  onkeypress="return isString(event)" maxlength="20" onblur="validNewpassword()" onkeydown="checkPasswordLength()">
          <input class="showpass" type="checkbox" onclick ="myFunction1()"> Show Password
        </div>
      </div>
      <div class="w3-row w3-section">
          <div class="w3-col colwid"><i class="w3-xxlarge fa fa-key"></i></div>

        <div class="w3-rest">
          <input class="w3-input w3-border" id="enterpassword" name="enterpassword" type="password" placeholder="Re-enter Password" onkeypress="return isString(event)" maxlength="20" onblur="validenterpassword()" onkeydown="checkPasswordLength1()">
          <input class="showpass" type="checkbox" onclick ="myFunction2()"> Show Password
        </div>
     </div>
    <button class="w3-button w3-black" type="submit" name="submit">Reset Password</button>
    <br><br><a style="margin-left: 120px;"href="login.php">Back to Login</a>
  </form>
  
</div>

<?php
if (isset($_POST["submit"])) 
{
    $username = $_POST['username'];
    $Newpassword = $_POST['Newpassword'];
    $enterpassword = $_POST['enterpassword'];

    $errors = array();

    // Validate username
      // Check if all fields are empty
    if (empty($username) && empty($Newpassword) && empty($enterpassword)) 
    {
        $errors[] = "All fields are required";
    }
    
    

    elseif (empty($username)) 
    {
        $errors[] = "Username is required";
    } 
    elseif (!preg_match('/^[0-9]{10}$/', $username)) 
    {
        $errors[] = "Enter a valid 10-digit username";
        exit;
    }

    // Validate new password
    elseif (empty($Newpassword)) {
        $errors[] = "New Password is required";
    } 
    elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/', $Newpassword)) 
    {
        $errors[] = "Enter a valid New password (8-20 characters)";
        exit;
    }

    elseif (!$Newpassword)
    {
      echo "<script>alert('Invalid password format.New Password should contain: 
        - A capital alphabet
        - A small alphabet
        - A number
        - A special symbol (!@#$%^&*)');</script>";
      exit; // Stop further execution
    }  

    // Validate re-enter password
    elseif (empty($enterpassword)) 
    {
        $errors[] = "Re-enter Password is required";
    } 
    elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/', $enterpassword)) 
    {
        $errors[] = "Enter a valid Re-enter password (8-20 characters)";
        exit;
    }

    elseif (!$enterpassword)
  {
    echo "<script>alert('Invalid password format. Password should contain: 
      - A capital alphabet
      - A small alphabet
      - A number
      - A special symbol (!@#$%^&*)');</script>";
    exit; // Stop further execution
  }  

    // Check if passwords match
    
    elseif ($Newpassword !== $enterpassword) 
    {
        $errors[] = "Passwords do not match";

    }

    // Check if any errors occurred
    elseif (count($errors) > 0) 
    {
        foreach ($errors as $error) 
        {
            echo "<script>alert('$error');</script>";
        }
    } 
    else 
    {
        // Check if the provided username exists
        $query = "SELECT username FROM login_master WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) == 0) 
        {
            echo "<script>alert('Username does not exist');</script>";
        } 
        else 
        {
          $query1 = "UPDATE login_master SET password='$Newpassword', updated_at=NOW() WHERE username='$username'";
          $result1 = mysqli_query($connection, $query1);

            if ($result1) 
            {
                echo "<script>alert('Password changed successfully');</script>";
            } 
            else 
            {
                echo "<script>alert('Password change failed');</script>";
            }
        }
    }
}
?>


<!-----validations------->
<script>
  // Selectors for input fields
  const usernameInput = document.getElementById("username");
  const NewpasswordInput = document.getElementById("Newpassword");
  const enterpasswordInput = document.getElementById("enterpassword");

  // Selectors for error container
  const errorContainer = document.getElementById("error-container");

  // Event listeners for input fields
  usernameInput.addEventListener("input", validateUsername);
  NewpasswordInput.addEventListener("input", validNewpassword);
  enterpasswordInput.addEventListener("input", validenterpassword);

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

  function validateUsername() {
    var username = usernameInput.value;
    var digits = /^\d{10}$/;
    if (!digits.test(username)) {
      showErrorMessage("Please enter a valid 10 digit username");
    } else {
      hideErrorMessage();
    }
  }

  function checkUsernameLength() {
  var username = usernameInput.value;
  if (username.length >= 10) {
    showErrorMessage("Username cannot be more than 10 characters");
  } else {
    hideErrorMessage();
  }
}

  function validNewpassword() {
    var Newpassword = NewpasswordInput.value;
    var passwordpattern =/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/;
    if (!passwordpattern.test(Newpassword)) {
      showErrorMessage("Please enter a valid password of min 8 characters, containing at least one Capital alphabet, a Small alphabet, a Number and a Special symbol (!@#$%^&*)");
    } else {
      hideErrorMessage();
    }
  }

  function checkPasswordLength() {
  var Newpassword = NewpasswordInput.value;
  if (Newpassword.length >= 20) {
    showErrorMessage("Password cannot be more than 20 characters");
  } else {
    hideErrorMessage();
  }
}

  function validenterpassword() {
    var enterpassword = enterpasswordInput.value;
    var passwordpattern1 =/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/;
    if (!passwordpattern1.test(enterpassword)) {
      showErrorMessage("Please enter a valid password of min 8 characters, containing at least one Capital alphabet, a Small alphabet, a Number and a Special symbol (!@#$%^&*)");
    } else {
      hideErrorMessage();
    }
  }

  function checkPasswordLength1() {
  var enterpassword = enterpasswordInput.value;
  if (enterpassword.length >= 20) {
    showErrorMessage("Password cannot be more than 20 characters");
  } else {
    hideErrorMessage();
  }
}

  function formSubmission() {
    var username = usernameInput.value;
    var Newpassword = NewpasswordInput.value;
    var enterpassword = enterpasswordInput.value;

    if (username === "" && Newpassword === "" && enterpassword === "") {
    showErrorMessage("All fields are required");
    return false;
    }

    if (username === "") {
      showErrorMessage("Please enter your username");
      return false;
    } 
    
    if (Newpassword === "") {
      showErrorMessage("Please enter your Newpassword");
      return false;
    }

    if (enterpassword === "") {
      showErrorMessage("Please enter a Re-enter password");
      return false;
    }

   if (Newpassword !== enterpassword) {
      showErrorMessage ("Passwords do not match");
      return false;
    }
   
    return true;
  }
</script>
<!----show password1-------->

<script>
function myFunction1() {
  var x = document.getElementById("Newpassword");
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
  var x = document.getElementById("enterpassword");
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
  var usernameInput = document.getElementById("username");
  usernameInput.focus();
});
</script>

</body>
</html>
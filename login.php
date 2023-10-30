<?php
session_start();
require_once("Database/connection.php");
?>
<!DOCTYPE html>
<html>
<title>login form</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./image">
<link rel="stylesheet" href="CSS/FONT/font-awesome.min.css">
<link rel="stylesheet" href="CSS/FONT/font-awesome.css">
<link rel="stylesheet" href="CSS/w3.css">
<link rel="stylesheet" href="CSS/w3schools.com_w3css_4_w3.css">
<link rel="stylesheet" href="CSS/w31.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<script type="text/javascript">
  function preventBack(){window.history.forward()};
  setTimeout("preventBack()",0)
   window.onunload=function(){null;}
</script>

<style>
  body{
  background-image: url("image/login_bg.jpg");
  background-size: cover;
  background-attachment: fixed;
  font-family: Arial, Helvetica, sans-serif;
  }
  .fa{
    color: #00ff00;
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
      margin-left: 30%;
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

   .error-box {
  background-color: #f2dede;
  border: 1px solid #ebcd1;
  color:#a94442;
  padding: 10px;
  text-align:center;
  width: 300px;
  margin: 0 auto;
  display: none;
  position:fixed;
  top: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
} 

  .form{
  width:380px ;
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
  top: 100px;
  left: 50%;
  transform: translateX(-50%);
}
.colwid{
  width:50px;
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
@media screen and (max-width: 850px) and (orientation: landscape) {
      .form {
        width: 60%;
        /*left: 50%;*/
     /*   transform: translateX(-50%);*/
        top: 20px;
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
<div>
  <div class="w3-container center-form">
<form action="" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin form" onblur="errrhide()" onsubmit="return formSubmission()"> 
<div>
  <img src="./image/login_avatar.png" alt="login avatar" width="120" height="120px">
</div>
 <span id="error-container" style="display: none;"></span>

<div class="w3-row w3-section">
  <div class="w3-col colwid"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="username" name="username" type="text" placeholder="Enter your mobile number" autocomplete="off" onkeypress="return isNumber1(event)" maxlength="10" onblur="validateUsername()" onkeydown="checkUsernameLength()">
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col colwid"><i class="w3-xxlarge fa fa-key"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="password" name="password" type="password" placeholder="Enter Password" autocomplete="off" onkeypress="return isString(event)" maxlength="20" onblur="validPassword()" onkeydown="checkPasswordLength()">
    </div>
     <input class="showpass" type="checkbox" onclick ="myFunction1()">  Show Password
</div>

<button class="w3-button w3-black" type="submit"  name="login">Login</button>
  <div class="footer"><a href="forgotpassword.php">Forgot Password</a></div>
</div>
<!-- </center> -->

</form>
</div>
<script>
  // Selectors for input fields
  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");

  // Selectors for error container
  const errorContainer = document.getElementById("error-container");

  // Event listeners for input fields
  usernameInput.addEventListener("input", validateUsername);
  passwordInput.addEventListener("input", validPassword);

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
  
  // Check if the field is empty, and if it is, skip the validation
  if (username === "") {
    hideErrorMessage();
    return;
  }

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
    showErrorMessage("Username cannot be more than 10 digits");
  } else {
    hideErrorMessage();
  }
}

  function validPassword() {
    var password = passwordInput.value;
    var passwordpattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/;
    if (!passwordpattern.test(password)) {
    showErrorMessage("Please enter a valid password of min 8 characters, containing at least one Capital alphabet, a Small alphabet, a Number and a Special symbol (!@#$%^&*)");
    } else {
      hideErrorMessage();
    }
  }

  function checkPasswordLength() {
  var password = passwordInput.value;
  if (password.length >= 20) {
    showErrorMessage("Password cannot be more than 20 characters");
  } else {
    hideErrorMessage();
  }
}  

  function formSubmission() {

    var username = usernameInput.value;
    var password = passwordInput.value;

    if (username === "" && password === "") {
      showErrorMessage("Please enter both Username and Password");
      return false;
    } 
    
    if (username === "") {
      showErrorMessage("Please enter your username");
      return false;
    } 
    
    if (password === "") {
      showErrorMessage("Please enter a password");
      return false; 
    } 

    
      return true;
    
  }
</script>
<script>
function myFunction1() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
  function isNumber1(evt) {
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

<?php
if(isset($_POST["login"]))
{
  $username = mysqli_real_escape_string($connection, $_POST["username"]);
  $password = mysqli_real_escape_string($connection, $_POST["password"]);
  $name = mysqli_real_escape_string($connection, $_POST["name"]);

    // Validate username and password format
    $validusername = preg_match('/^\d{10}$/', $username);
    $validpassword = preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,20}$/', $password);

  if (!$username && !$password) 
  {
    echo "<script>alert('Both fields are required');</script>";
    exit; 
  }

  elseif (!$username)
  {
    echo "<script>alert('Username is required!');</script>";
    exit; // Stop further execution
  }

  elseif (!$password) 
  {
    echo "<script>alert('Password is required!');</script>";
    exit; // Stop further execution
  }

  elseif (!$validusername && !$validpassword) 
  {
    echo "<script>alert('Both fields are invalid');</script>";
    exit; // Stop further execution
  }

  elseif (!$validusername)
  {
    echo "<script>alert('Invalid username format');</script>";
    echo "<script>showErrorMessage('Maximum Limit reached');</script>"; // Display error message using JavaScript
    exit; // Stop further execution
  }

  elseif (!$validpassword)
  {
    echo "<script>alert('Invalid password format. Password should contain: 
      - A capital alphabet
      - A small alphabet
      - A number
      - A special symbol (!@#$%^&*)');</script>";
    exit; // Stop further execution
  }  

else{

    // 2. retrive matching data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve matching data
    $query = "SELECT username, name, password,user_type FROM login_master WHERE username='".$username."' AND password='".$password."'";

    // 3. authentication
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);
    $response = array();
    if($row["user_type"]=="admin")
    {
        // 4. set session
        $_SESSION['name'] = $row["name"];
        $_SESSION['username'] = $row["username"];
        $_SESSION['gymname1'] = "Muscle";
        $_SESSION['gymname2'] = "Maxx";
        $_SESSION['address'] = "Vijay colony, Sangli.";

        // $SEpincode= ""
        // se mobile="+91 "


        //header('Location:dashboard.php');
        echo '<script>window.location="dashboard.php";</script>';
    }
    else
    {
      echo "<script>alert('Invalid credentials');</script>";
      session_destroy();
    }
}
}
?>


<!----cursor blinck in username field------>
<script>
document.addEventListener("DOMContentLoaded", function() {
  var usernameInput = document.getElementById("username");
  usernameInput.focus();
});
</script>

</body>
</html>
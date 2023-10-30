<?php
require_once("Database/connection.php");
    $id = $_REQUEST["e_id"]; 
    $query = "SELECT * FROM enquiry_master WHERE e_id = '".$id."'";
    $queryfire = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($queryfire);
    ?>

<!DOCTYPE html>
<html>
<head>
<title>Enquiry Update</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php include 'nav.php'; ?>
<style>
    b{
    color:red;
    position: relative;
    margin:none;
    right:1.5%;
    top:0;
    float:right ;
  }
  .design {
    width: 95%;
  }
  
  .img {
    background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.3)), url("image/enquiry.jpg");
    background-size: cover;
    display: flex;
    justify-content: right;
    align-items: center;
    height: 91.8vh;
    
    /* height: 200pt; */

  }
  /* .fa, .w3-col{
    color:#00ff00;
  } */
/* ------------------media queary start----------------------------- */

@media only screen and (min-width: 300px) and (max-width: 600px) 
{
.desing
 {
   margin-bottom:4%;
 }
.mainc 
{  
   
   height: 130vh;
}
}

@media only screen and (min-width: 650px) and (max-width: 700px) 
{
 .mainc 
{
   height: 190vh;
   padding-bottom:280px;
   padding-top:300px;

}
} 
@media only screen and (max-width: 300px)
{
.mainc
{
  padding-top:50px;
  font-size:9px;
  height: 110vh;
}
.w3-xxlarge {
    font-size: 30px!important;
}
h2{
  font-size:15px;

}

}


/* @media screen and (max-width: 653px) and (orientation: landscape)
{
    .m4
    {
      margin-top:300px !important;
    }
} */
@media screen and (max-width: 1000px) and (orientation: landscape)

{
  .mainc
  {
    padding-top:150px;
    height: 170vh;
   
    
  }
}
  .nomargin{
    margin: 0px;
  }

  /* ----------------tryyyy------------------ */
</style>

</head>
<body>
  <div ></div>

  <div class="w3-container con img " >
    <form class="m4 center-form w3-container w3-card-4 w3-light-grey w4-padding w3-text-black w3-margin" method="post" onblur="errorhide()" onsubmit="return formSubmission()">
      <h2 class="w3-center">Enquiry Update</h2>
      <span id="error-container" style="display: none;"></span>

      <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><label for="name"><i class="w3-xxlarge fa fa-user"></i></label></div>
        <div class="w3-rest"><b style="position: relative; right:4%;" >*</b>
            <div class="">
              <input class="w3-input w3-border design" type="text" placeholder="Enter Your Name...." name="name" id="name" onblur="return validateName()" onkeypress="return onlyAlphabets(event)" value="<?php echo htmlspecialchars($row['name']); ?>" >
            </div>
        </div>
      </div>

      <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><label for="gender"><i class="w3-xxlarge fa fa-venus-mars"></i></label></div>
        <div class="w3-rest">
          <input class="w3-radio" type="radio" name="gender" value="male"<?php if($row['gender'] =='male') echo 'checked'; ?> id="gender" required>
          <label>Male</label>

          <input class="w3-radio" type="radio" name="gender" value="female"<?php if($row['gender'] =='female') echo 'checked'; ?> id="gender" required>
          <label>Female</label>
        </div>
      </div>

      
        <div class="w3-row w3-section">
          <div class="w3-col" style="width:50px"><label for="contact"><i class="w3-xxlarge fa fa-phone"></i></label></div>
          <div class="w3-rest">
            <div class="w3-third"><b>*</b>
            <input class="w3-input w3-border design" type="tel" pattern="[6789][0-9]{9}" inputmode="numeric" placeholder="Contact" name="contact1" id="contact" onblur="return validContact()" onkeypress="return isNumber1(event)" maxlength="10" value="<?php echo htmlspecialchars($row['contact']); ?>" required> </div>
            <div class="w3-third">
            <input class="w3-input w3-border design" type="tel" pattern="[6789][0-9]{9}" inputmode="numeric" placeholder="Work (optional)" name="contact2" id="contact1" onblur="return validContact1()" onkeypress="return isNumber1(event)" maxlength="10" value="<?php if($row['telephone']==0){echo null;}else{echo htmlspecialchars($row['work']); }?>">
         </div>
            <div class="w3-third">
              
            <input class="w3-input w3-border design" type="tel" pattern="[0-9]{11}" inputmode="numeric" placeholder="Telephone (optional)" name="contact3" id="contact2" onblur="return validContact2()" onkeypress="return isNumber1(event)" maxlength="11" value="<?php if($row['telephone']==0){echo null;}else{echo htmlspecialchars($row['telephone']);} ?>" ></div>
            <!-- pattern="[0-9]{4}-[0-9]{4}-[0-9]{3}" -->
          </div>

        </div>

        
          <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><label for="email"><i class="w3-xxlarge fa fa-envelope-o"></i></label></div>
            <div class="w3-rest">
              <div class="w3-third"><b>*</b>
                <input class="w3-input w3-border design" name="email1" type="text" placeholder="Email" id="email" onblur="return validEmail()" value="<?php echo htmlspecialchars($row['email']); ?>" required>
              </div>&nbsp
              <div class="w3-third">
                <input class="w3-input w3-border design" name="email2" type="text" placeholder="Email (Optional)"
                  id="email1" value="<?php echo htmlspecialchars($row['alternate_email']); ?>" onblur="return validEmail1()">
              </div>
            </div>

            
              <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><label for="refno1"><i class="w3-xxlarge fa fa-pencil"></i></label></div>
                <div class="w3-rest">
                  <div class="w3-third"><b>*</b>
                    <input class="w3-input w3-border design" type="text" placeholder="Reference no." name="refno1"
                      id="refno1" value="<?php echo htmlspecialchars($row['refno1']); ?>" onblur="return validRefno1()">
                  </div>
                  <div class="w3-third">
                    <input class="w3-input w3-border design" type="text" placeholder="Reference no.(Optional)"
                      name="refno2" value="<?php echo htmlspecialchars($row['refno2']); ?>" id="refno2">
                  </div>
                </div>

                <div class="w3-row w3-section">
                  <div class="w3-col" style="width:50px"><label for="Enquiry"></label><i class="w3-xxlarge fa fa-user"></i></div>
                  <div class="w3-rest">
                  <input class="w3-radio" type="radio" name="type" value="Enquiry" id="enquiryRadio" required <?php if ($row['type'] == 'Enquiry') echo 'checked'; else echo 'disabled'?>>
                  <label>Enquiry</label>

                  <input class="w3-radio" type="radio" name="type" value="Staff" id="staffRadio" required <?php if ($row['type'] == 'Staff') echo 'checked'; ?>>
                  <label>Staff</label>
                  </div>
                </div>

                <input type="submit" value="Update" name="update" class="w3-button w3-block w3-section w3-black w3-ripple w3-padding">
                <!-- <button type="submit" name="btn" 
                  class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">Send
                </button> -->
    </form>



<script src="js/enquiry_update.js">

</script>


</body>

</html>
<?php

  if (isset($_POST["update"])) {
    $name = mysqli_real_escape_string($connection, $_POST["name"]);
    $gender = mysqli_real_escape_string($connection, $_POST["gender"]);
    $contact1 = mysqli_real_escape_string($connection, $_POST["contact1"]);
    $contact2 = mysqli_real_escape_string($connection, $_POST["contact2"]);
    if($contact2 === 0 || $contact2 === null || $contact2 === ""){$contact2=0;}    
    $contact3 = mysqli_real_escape_string($connection, $_POST["contact3"]);
    $email1 = mysqli_real_escape_string($connection, $_POST["email1"]);
    if($contact3 === 0 || $contact3 === null || $contact3 === ""){$contact3=0;}
    $email2 = mysqli_real_escape_string($connection, $_POST["email2"]);
    $refno1 = mysqli_real_escape_string($connection, $_POST["refno1"]);    
    $refno2 = mysqli_real_escape_string($connection, $_POST["refno2"]);
    $type = mysqli_real_escape_string($connection, $_POST["type"]);

    // // Server-side validation
    // if (empty($name)) {
    //   echo "<script>showErrorMessage('php Please enter your name')</script>";
    // }
    // else if(!preg_match('/^[A-Za-z\s]*$/ ', $name))
    // {
    //   echo "<script>showErrorMessage('php Please enter a valid name')</script>";
    // }
  
    // else if (empty($contact1)) 
    // {
    //   echo "<script>showErrorMessage('php Please enter atleast first contact numbers')</script>";
    // }
  
    // else if(!preg_match('/^\d{10}$/', $contact1))
    // {
    //   echo "<script>showErrorMessage('php Please enter a valid 10-digit contact number')</script>";
    // }
  
    // else if (!preg_match('/^\d{10}$/', $contact2)) {
    //   echo "<script>showErrorMessage('php Please enter valid second contact numbers')</script>";
    // }
    
  
  
    // else if (!preg_match('/^\d{10}$/', $contact3)) {
    //   echo "<script>showErrorMessage('php Please enter a valid third contact number')</script>";
    // }
  
    // else if (empty($email1)) 
    // {
    //   echo "<script>showErrorMessage('php Please enter atleast 1 email address')</script>";
    // }
  
    // else if(!filter_var($email1, FILTER_VALIDATE_EMAIL))
    // {
    //   echo "<script>showErrorMessage('php Please enter a valid email address')</script>";
    // }
  
    // else if(!filter_var($email1, FILTER_VALIDATE_EMAIL) && !empty($email2))
    // {
    //   echo "<script>showErrorMessage('php Please enter a valid second email address')</script>";
    // }
  
    // else if (empty($refno1)) 
    // {
    //   echo "<script>showErrorMessage('php Please provide atleast one reference number')</script>";
    // }

    
  if (empty($name)) {
    echo "<script>showErrorMessage('Please enter your name')</script>";
  }
  else if(!preg_match('/^[A-Za-z\s]*$/ ', $name))
  {
    echo "<script>showErrorMessage('Please enter a valid name')</script>";
  }

  else if (empty($contact1)) 
  {
    echo "<script>showErrorMessage('Please enter atleast first contact numbers')</script>";
  }

  else if(!preg_match('/^\d{10}$/', $contact1))
  {
    echo "<script>showErrorMessage('Please enter a valid 10-digit contact number')</script>";
  }

  else if(!preg_match('/^\d{10}$/', $contact2) && !empty($contact2))
  {
    echo "<script>showErrorMessage('Please enter a valid 10-digit contact number2')</script>";
  }

  else if(!preg_match('/^\d{11}$/', $contact3) && !empty($contact3))
  {
    echo "<script>showErrorMessage('Please enter a valid 10-digit contact number3')</script>";
  }

  // else if (empty($contact2) || !preg_match('/^\d{10}$/', $contact2)) {
  //   echo "<script>showErrorMessage('php--Please enter a valid 10-digit contact number')";
  // }

  // else if (empty($contact3) || !preg_match('/^\d{10}$/', $contact3)) 
  // {
  //   echo "<script>showErrorMessage('php--Please enter a valid 10-digit contact number')";
  // }

  else if (empty($email1)) 
  {
    echo "<script>showErrorMessage('Please enter atleast 1 email address')</script>";
  }

  else if(!filter_var($email1, FILTER_VALIDATE_EMAIL))
  {
    echo "<script>showErrorMessage('Please enter a valid email address')</script>";
  }

  else if(!filter_var($email1, FILTER_VALIDATE_EMAIL) && !empty($email2))
  {
    echo "<script>showErrorMessage('Please enter a valid second email address')</script>";
  }

  else if (empty($refno1)) 
  {
    echo "<script>showErrorMessage('Please provide atleast one reference number')</script>";
  }
  

  else{
      $query = "UPDATE `enquiry_master` SET 
      `name`='$name',
      `gender`='$gender',
      `contact`='$contact1',
      `work`='$contact2',
      `telephone`='$contact3',
      `email`='$email1',
      `alternate_email`='$email2',
      `refno1`='$refno1',
      `refno2`='$refno2',
      `type`='$type'
    WHERE `e_id`='$id'";
    $queryfire = mysqli_query($connection, $query);
    if ($queryfire) {
      echo "<script>alert('Data updated successfully!');</script>";
      echo "<script>window.location.href = 'show.php';</script>";
    } else {
      echo "<script>alert('Data has NOT been updated. Contact may be present in another enquiry');</script>";
    }
  }
}
?>
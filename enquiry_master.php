<?php
  require_once("database/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Enquiry Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
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
  .lo{
    color:#00ff00;
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
</style>
</head>
<body>


  <div class="w3-container mainc img " >
    <form action="enquiry_master.php" class="m4 center-form w3-container w3-card-4 w3-light-grey w4-padding w3-text-black w3-margin" method="post" onblur="errorhide()" onsubmit="return formSubmission()">
      <h2 class="w3-center">Enquiry Form</h2>
      <span id="error-container" style="display: none;"></span>
      <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><label for="name"><i class="w3-xxlarge lo fa fa-user" ></i></label></div>
        <div class="w3-rest"><b style="right:4%; position:relative;">*</b>
            <div class="">
              <input class="w3-input w3-border design" type="text" placeholder="Enter Your Name ...." name="name" id="name" onblur="return validateName()"  onkeypress="return onlyAlphabets(event)" autofocus required> 
            </div>
        </div>
      </div>

      <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><label for="gender"><i class="w3-xxlarge fa lo fa-venus-mars"></i></label></div>
        <div class="w3-rest">
          <input class="w3-radio" type="radio" name="gender" value="male" id="gender" required>
          <label>Male</label>

          <input class="w3-radio" type="radio" name="gender" value="female" id="gender" required>
          <label>Female</label>
        </div>
      </div>

      
      <div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><label for="contact"><i class="w3-xxlarge lo fa fa-phone"></i></label></div>
    <div class="w3-rest">
        <div class="w3-third"><b>*</b>
            <input class="w3-input w3-border design" type="tel" pattern="[6789][0-9]{9}" inputmode="numeric" placeholder="Contact" name="contact1" id="contact" onblur="return validContact()" onkeypress="return isNumber1(event)" maxlength="10" required>
        </div>
        <div class="w3-third">
            <input class="w3-input w3-border design" type="tel" pattern="[6789][0-9]{9}" inputmode="numeric" placeholder="Work" name="contact2" id="contact1" onblur="return validContact1()" onkeypress="return isNumber1(event)" maxlength="10">
        </div>
        <div class="w3-third">
            <input class="w3-input w3-border design" type="tel" pattern="[0-9]{11}" inputmode="numeric" placeholder="Telephone" name="contact3" id="contact2" onblur="return validContact2()" onkeypress="return isNumber1(event)" maxlength="11" >
        </div>
        <!-- pattern="[0-9]{4}-[0-9]{4}-[0-9]{3}"  -->
    </div>
</div>

          <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><label for="email"><i class="w3-xxlarge lo fa fa-envelope-o"></i></label></div>
            <div class="w3-rest">
              <div class="w3-third"><b>*</b>
                <input class="w3-input w3-border design" name="email1" type="text" placeholder="Email*" id="email" onblur="return validEmail()" required>
              </div>&nbsp
              <div class="w3-third">
                <input class="w3-input w3-border design" name="email2" type="text" placeholder="Alternate Email"
                  id="email1" onblur="return validEmail1()">
              </div>
            </div>

            
              <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><label for="refno1"><i class="w3-xxlarge lo fa fa-pencil"></i></label></div>
                <div class="w3-rest">
                  <div class="w3-third"><b>*</b>
                    <input class="w3-input w3-border design" type="text" placeholder="Reference No.*" name="refno1"
                      id="refno1" required>
                  </div>
                  <div class="w3-third">
                    <input class="w3-input w3-border design" type="text" placeholder="Alternatre Reference No."
                      name="refno2" id="refno2">
                  </div>
                </div>

                <div class="w3-row w3-section">
                  <div class="w3-col" style="width:50px"><label for="type"><i class="w3-xxlarge lo fa fa-user"></i></label></div>
                  <div class="w3-rest">
                    <input class="w3-radio" type="radio" name="type" value="Enquiry" id="type" checked required>
                    <label>Enquiry</label>

                    <input class="w3-radio" type="radio" name="type" value="Staff" id="type" required>
                    <label>Staff</label>
                  </div>
                </div>

                <input type="submit" value="Submit" name="btn" class="w3-black w3-button w3-block w3-section w3-blue w3-ripple w3-padding">
    </form>

    
<script type="text/javascript" src="js/enquiry_master.js" ></script>
</body>

</html>
<?php
  if (isset($_POST['btn']))
  {
    
    $name = mysqli_real_escape_string($connection, $_POST["name"]);
    $gender = mysqli_real_escape_string($connection, $_POST["gender"]);
    $contact1 = mysqli_real_escape_string($connection, $_POST["contact1"]);
    $contact2 = mysqli_real_escape_string($connection, $_POST["contact2"]);   
    if($contact2 === 0 || $contact2 === null || $contact2 === ""){$contact2=0;}
    $contact3 = mysqli_real_escape_string($connection, $_POST["contact3"]);
    if($contact3 === 0 || $contact3 === null || $contact3 === ""){$contact3=0;}
    $email1 = mysqli_real_escape_string($connection, $_POST["email1"]);
    $email2 = mysqli_real_escape_string($connection, $_POST["email2"]);
    $refno1 = mysqli_real_escape_string($connection, $_POST["refno1"]);    
    $refno2 = mysqli_real_escape_string($connection, $_POST["refno2"]);
    $type = mysqli_real_escape_string($connection, $_POST["type"]);
    // Server-side validation

  if (empty($name)) {
    echo "<script>showErrorMessage('php Please enter your name')</script>";
  }
  else if(!preg_match('/^[A-Za-z\s]*$/ ', $name))
  {
    echo "<script>showErrorMessage('php Please enter a valid name')</script>";
  }

  else if (empty($contact1)) 
  {
    echo "<script>showErrorMessage('php Please enter atleast first contact numbers')</script>";
  }

  else if(!preg_match('/^\d{10}$/', $contact1))
  {
    echo "<script>showErrorMessage('php Please enter a valid 10-digit contact number')</script>";
  }

  else if(!preg_match('/^\d{10}$/', $contact2) && !empty($contact2))
  {
    echo "<script>showErrorMessage('php Please enter a valid 10-digit work number')</script>";
  }

  else if(!preg_match('/^\d{11}$/', $contact3) && !empty($contact3))
  {
    echo "<script>showErrorMessage('php Please enter a valid 10-digit telephone number')</script>";
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
    echo "<script>showErrorMessage('php Please enter atleast 1 email address')</script>";
  }

  else if(!filter_var($email1, FILTER_VALIDATE_EMAIL))
  {
    echo "<script>showErrorMessage('php Please enter a valid alternate email address')</script>";
  }

  else if(!filter_var($email1, FILTER_VALIDATE_EMAIL) && !empty($email2))
  {
    echo "<script>showErrorMessage('php Please enter a valid second email address')</script>";
  }

  else if (empty($refno1)) 
  {
    echo "<script>showErrorMessage('php Please provide atleast one reference number')</script>";
  }

  else{
    $squery = "SELECT `e_id`,`contact` from enquiry_master where `contact` = '$contact1'";
    $sresult = mysqli_query($connection, $squery);
    if($srow=mysqli_fetch_assoc($sresult)){
      $e_id=$srow["e_id"];
      echo "<script>alert('Record present with same Contact number');</script>";
      echo "<script>window.location.href = 'enquiry_update.php?e_id=$e_id';</script>";
      // header("Location: show.php");
    }
    else{
    $query = "INSERT INTO enquiry_master (`name`, `gender`, `contact`, `work`, `telephone`, `email`, `alternate_email`, `refno1`, `refno2`, `type`, `created_at`, `updated_at`) VALUES ('$name', '$gender', '$contact1', '$contact2', '$contact3', '$email1', '$email2', '$refno1', '$refno2', '$type', current_timestamp(), current_timestamp())";

    
    $queryfire = mysqli_query($connection, $query);
    if ($queryfire) {
      echo "<script>alert('Data inserted successfully!');</script>";
    } else {
      echo "<script>alert('Data has NOT been inserted: " . mysqli_error($connection) . "');</script>";
    }
    }
  }
}
mysqli_close($connection);
?>
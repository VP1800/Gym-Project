<?php
require_once("Database/connection.php");
    $id = $_REQUEST["id"]; 
    $query = "SELECT * FROM enquiry_master WHERE e_id = '".$id."'";
    $queryfire = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($queryfire);

    ?>

<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include 'nav.php' ;?>
    <style>
    .desing{
        width:95%;
          }
    .img{
        background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.3)), url("image/enquiry.jpg");
        /* background-image: url("image/enquiry.jpg"); */
        background-size:cover;
        display: flex;
        justify-content: right;
        align-items: center;
        height: 100vh;
        /* height: 200pt; */

        }
    .w3-xxlarge{
  color:#00ff00;
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
   margin-bottom:5%;
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
  padding-top:100px;


 }
 
}


  /* ------------------tryyyyyyyyyyyyyyyy----------------------------- */

/* @media only screen and (min-width: 300px) and (max-width: 600px) 
{
.mainc 
{
margin-top:15vh;
margin-bottom:40vh;
height: 100vh;
}} */



  /* ------------------media queary end----------------------------- */


/* ----------------tryyyy------------------ */

    </style>

</head>

<body>
<div class="w3-container mainc img " style="">
<form action="" oninput="return validateForm()" onsubmit="return formSubmission()" class="m4 center-form w3-container con w3-card-4 w3-light-grey w4-padding w3-text-black w3-margin" method="post">
<h2 class="w3-center">  UPDATE ENQUIRY</h2>
 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border desing" name="name" type="text" placeholder="Enter Your Name" id="name" value="<?php echo htmlspecialchars($row['name']); ?>" >
    </div>
</div>
<!-- -------------------------Name end-------------------------------- -->
<div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-venus-double"></i></div>
        <div class="w3-rest">
          <input class="w3-radio" type="radio" name="gender" value="male"<?php if($row['gender'] =='male') echo 'checked'; ?> id="gender">
          <label>Male</label>

          <input class="w3-radio" type="radio" name="gender" value="female"<?php if($row['gender'] =='female') echo 'checked'; ?> id="gender">
          <label>Female</label>
        </div>
</div>
<!-- -------------------------Gendetr end-------------------------------- -->


<div class="w3-row-padding">
<div class="w3-row w3-section">
<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
<div class="w3-rest">
  <div class="w3-third">
    <input class="w3-input w3-border desing"  type="text" placeholder="Contact" name="contact1" id="contact1" value="<?php echo htmlspecialchars($row['contact']); ?>">
  </div>
  <div class="w3-third">
    <input class="w3-input w3-border desing"   type="text" placeholder="Work" name="contact2" id="contact2" value="<?php echo htmlspecialchars($row['work']); ?>">
  </div>
  <div class="w3-third">
    <input class="w3-input w3-border desing"   type="text" placeholder="Telephone" name="contact3" id="contact3" value="<?php echo htmlspecialchars($row['telephone']); ?>">
  </div>    
</div>
</div>
</div>
<!-- -------------------------Contact end-------------------------------- -->

<!-- <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="email" type="text" placeholder="Email">
    </div>
</div> -->



<!-- -------------------------email start-------------------------------- -->

<div class="w3-row-padding">
<div class="w3-row w3-section">
<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
<div class="w3-rest">
  <div class="w3-third">
    <input class="w3-input w3-border desing"   type="text" placeholder="Email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
  </div>
  <div class="w3-third">
    <input class="w3-input w3-border desing"   type="text" placeholder="Optional Email" id="email1" name="email1" value="<?php echo htmlspecialchars($row['alternate_email']); ?>">
  </div>
    
</div>
</div>
</div>

<!-- -------------------------email end-------------------------------- -->

<!-- 

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="phone" type="text" placeholder="Phone">
    </div>
</div> -->
<!-- -------------------------refrence start-------------------------------- -->

<div class="w3-row-padding">
<div class="w3-row w3-section">
<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
<div class="w3-rest">
  <div class="w3-third">
    <input class="w3-input w3-border desing"  type="text" placeholder="Reference" name="refno1" id="refno1" value="<?php echo htmlspecialchars($row['refno1']); ?>">
  </div>
  <div class="w3-third">
    <input class="w3-input w3-border desing"   type="text" placeholder="Second Reference" name="refno2" id="refno2" value="<?php echo htmlspecialchars($row['refno2']); ?>">
  </div>
    
</div>
</div>
</div>
<!-- -------------------------refrence end-------------------------------- -->
<!-- -------------------------Enqury start-------------------------------- -->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
  <div class="w3-rest">
    <input class="w3-radio" type="radio" name="type" value="Enquiry"<?php if($row['type'] =='Enquiry') echo 'checked'; ?> id="type">
    <label>Enquiry</label>

    <input class="w3-radio" type="radio" name="type" value="Staff"<?php if($row['type'] =='Staff') echo 'checked'; ?> id="type">
    <label>Staff</label>
  </div>
</div>



<!-- -------------------------button start-------------------------------- -->
<div style="text-align:center;">
<button class="w3-button  w3-section w3-black w3-ripple w3-padding" name="update" type="submit">Update</button>
</div>




<!-- -------------------------tryyy end-------------------------------- -->





<!-- -------------------------tryyy end-------------------------------- -->

</form>
</div>
<script>
  function showErrorMessage(message) {
    var errorContainer = document.getElementById("error-container");
    errorContainer.innerHTML = '<div class="w3-panel w3-pale-red w3-border nomargin"><p>' + message + '</p></div>';
    errorContainer.style.display = "block";
  }

  function hideErrorMessage() {
    var errorContainer = document.getElementById("error-container");
    errorContainer.style.display = "none";
  }

  function validateForm() {
    hideErrorMessage();

    var name = document.getElementById("name").value;
    var gender = document.querySelector('input[name="gender"]:checked');
    var contactFields = [document.getElementById("contact").value, document.getElementById("contact1").value, document.getElementById("contact2").value];
    var email = document.getElementById("email").value;
    var email1 = document.getElementById("email1").value;
    var reference1 = document.querySelector('input[name="refno1"]:checked');
    var reference2 = document.querySelector('input[name="refno2"]:checked');
    var type = document.querySelector('input[name="type"]:checked');


    var letters = /^[A-Za-z\s]*$/ ;
    if (!letters.test(name)) {
      showErrorMessage("Please enter a valid first name");
      return false;
    }

    var contactPattern = /^\d{10}$/;
    for (var i = 0; i < contactFields.length; i++) {
      if (!contactPattern.test(contactFields[i])) {
        showErrorMessage("Please enter valid 10-digit contact numbers");
        return false;
      }
    }

    var mailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!mailPattern.test(email)) {
      showErrorMessage("You have entered an invalid email address!");
      return false;
    }
    if (!mailPattern.test(email1)) {
      showErrorMessage("You have entered an invalid optional email address!");
      return false;
    }
    return true;
  }

  function formSubmission() {

  var name = document.getElementById("name").value;
  var gender = document.querySelector('input[name="gender"]:checked');
  var contactFields = [document.getElementById("contact").value, document.getElementById("contact1").value, document.getElementById("contact2").value];
  var email = document.getElementById("email").value;
  var email1 = document.getElementById("email1").value;
  var refno1 = document.querySelector('input[name="refno1"]:checked');
  var refno2 = document.querySelector('input[name="refno2"]:checked');
  var type = document.querySelector('input[name="type"]:checked');


  // Check for empty values in required fields
  if (name === "") {
    showErrorMessage("Please enter your name");
    return false;
  }

  if (!gender) {
    showErrorMessage("Please select a gender");
    return false;
  }

  for (var i = 0; i < contactFields.length; i++) {
    if (contactFields[i] === "") {
      showErrorMessage("Please enter contact numbers");
      return false;
    }
  }

  if (email === "") {
    showErrorMessage("Please enter an email address");
    return false;
  }

  if (!email) {
    showErrorMessage("You have entered an invalid email address!");
    return false;
  }

  if (email1 === "") {
    showErrorMessage("Please enter an alternate email address");
    return false;
  }


  if (!type) {
    showErrorMessage("Please select an Enquiry type");
    return false;
  }

  if (refno1 === "") {
    showErrorMessage("Please select a reference for field 1");
    return false;
  }

  if (refno1 === "") {
    showErrorMessage("Please select a reference for field 1");
    return false;
  }


  // if (!refno2) {
  //   showErrorMessage("Please select a reference for field 2");
  //   return false;
  // }

  return true;
}


</script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>

<?php

    if (isset($_POST["update"])) {

        $name = $_POST["name"]; 
        $gender = $_POST["gender"];
        $contact1 = $_POST["contact1"];
        $contact2 = $_POST["contact2"];
        $contact3 = $_POST["contact3"];
        $email = $_POST["email"];
        $email1 = $_POST["email1"];
        $refno1 = $_POST["refno1"];
        $refno2 = $_POST["refno2"];
        $type= $_POST["type"];
     
        $query = "UPDATE `enquiry_master` SET 
                    `name`='$name',
                    `gender`='$gender',
                    `contact`='$contact1',
                    `work`='$contact2',
                    `telephone`='$contact3',
                    `email`='$email',
                    `alternate_email`='$email1',
                    `refno1`='$refno1',
                    `refno2`='$refno2',
                    `type`='$type',
                    `updated_at`= current_timestamp()
                  WHERE `e_id`='$id'";
        
        $result = mysqli_query($connection, $query);
        if($result) 
        {
          echo "<script>window.location.href = '../show.php';</script>";
            echo "Record updated successfully.";
           // echo "<script>Window.location.href='admin.php';</script>";
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
        
    }
    ?>
    




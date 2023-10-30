<?php
require_once("Database/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="css.3 ofline/css/w3schools.com_w3css_4_w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
		/* .popup {
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgba(0, 0, 0, 0.4);
			display: none;
		}
		.popup-content {
			background-color: white;
			margin: 10% auto;
			padding: 20px;
			border: 1px solid #888888;
			width: 50%;
			font-weight: bolder;
		}
		.popup-content button {
			display: block;
			margin: 0 auto;
		} */
		.show {
			display: block;
		}
		h2 {
			color: green;
			text-align: right;
		}
        
        input[type=text], select, textarea {
			width: 100%; /* Full width */
			padding: 10px; /* Some padding */ 
			border: 1px solid #ccc; /* Gray border */
			border-radius: 4px; /* Rounded borders */
			box-sizing: border-box; /* Make sure that padding and width stays in place */
			margin-top: 6px; /* Add a top margin */
			margin-bottom: 15px; /* Bottom margin */
			resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
            }
			button
			{
			background-color: #4CAF50; /* Green */
			border: none;
			color: white;
			padding: 9px 12px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			display:inline;
            }
            .first {
            width: 50%;
            display: inline-block;
            }
  
            .second {
            width: 50%;
            display: inline-block;
            margin-top: -20px;
            }
            /* Add space between the Amount and Paymode input fields */
            .top input[type="text"] {
            margin-right: 10px; /* Adjust the spacing as needed */
            }
            @media screen and (max-width: 500px) {
                .first{
                    margin-top: 5rem;
                }
                .second{
                    position: relative;
                    top: 50%;
                }
            }
            button:on-hover{
              background: #00ff00;
            }
	</style>

</head>
<body>
<div class="w3-modal-content">
      <div class="w3-container">
        <form action="" style="padding:2rem" method="post">
        <?php
              $id = $_REQUEST["m_id"];       
              $query = "SELECT `receipt`.`r_id` as r_id,`enquiry_master`.`e_id` as e_id,`enquiry_master`.`name` as name, `enquiry_master`.`contact` as `contact`,`membership_form`.`membership_type` as `membership_type` , `membership_form`.`fees` as `fees`, `membership_form`.`amount_paid` as `amount_paid`, `membership_form`.`amount_payable` as `amount_payable`, `membership_form`.`expiry_date` as `expiry_date` from enquiry_master join membership_form on enquiry_master.e_id = membership_form.e_id  inner join `receipt` on 
              `receipt`.`r_id` = `membership_form`.`m_id`
                            where `membership_form`.`m_id`='$id'";
              $queryfire = mysqli_query($connection, $query);
              $result = mysqli_fetch_assoc($queryfire);?>  
        <div style="width: 100%;">
              <div class="first" style="width: 50%; float: left">
              <label for="name" >Name:   <?php  echo $result['name']; ?></label><br><br> 
            <!-- <input type="text" id="fname" name="name" style="width:35%"   disabled> -->
              
            <label for="contact" >Contact:  <?php  echo $result['contact']; ?></label>
            <!-- <input type="text" id="contact" name="contact" style="width:35%" disabled> -->
              </div>
              <div class="second"> 
              <h2>
                  Fitness Club<br>
                  Receipt
              </h2>
              </div>
          </div>
          <div class="con" style="width: 100%">
             <div class="top" style="width: 49%; float: left;">
                <label for="type">Membership Type</label>
                <input type="text" id="membership type" name="membership type" value="<?php  echo $result['membership_type']; ?>" disabled>
            </div>
  
            <div class="bottom" style="width: 49%; float: right">
			<label for="fees">Fees</label>
                <input type="text" id="fees" name="fees" value="<?php echo $result['fees']; ?>" disabled>
            </div>
		</div><br>
		    <div class="con" style="width: 100%">
             <div class="top" style="width: 49%; float: left;">
                <label for="paid">Paid</label>
                <input type="text" id="paid" name="paid" value="<?php echo $result['amount_paid'];?>" disabled>
            </div>
  
            <div class="bottom" style="width: 49%; float: right">
			<label for="balance">Balance</label>
                <input type="text" id="balance" name="balance" value="<?php echo $result['amount_payable'];?>" disabled>
            </div>
		</div><br>
      <br>
      
          <div class="con" style="width: 100%">
              <div class="top" style="width: 49%; float: left;">
                  <label for="name">Amount</label>
                  <input type="text" id="Amount" name="Amount" onkeyup="amountpaid();" value="" placeholder="Enter Your Amount">
              </div>
    
              <div class="bottom" style="width: 49%; float: right">
        <label for="Paymode">PayMode</label>
        <select id="Paymode" name="Paymode">
            <option value=""disabled selected hidden>Select PayMode</option>
            <option name="Paymode" value="UPI">UPI</option>
            <option name="Paymode" value="Cash">Cash</option>
            <option name="Paymode" value="Card">Card</option>
            <option name="Paymode" value="Check">Check</option>
            </select>
              </div>
      </div><br>
      <label for="description">Description</label>
      <textarea id="description" name="description" placeholder="Additional Information.." style="height:60px; width:100%; display:inline;"></textarea>
      <br><br>
      <a onclick="back()" id="type">
      <i class="fa fa-arrow-circle-left" title="Go to unpaid fees" style="font-size:20px; color:gray; cursor: pointer;">
      Back</i>
      </a>
      <a  id="type">
      <button id="Print" style="display:inline;float: right" name="receipt">Submit</button></a>
      </form>
      </div>
    </div>
  </div>
  <script>
    function amountpaid() {
        const userAmountInput = document.getElementById("Amount").value;
        const balanceInput = document.getElementById("balance").value;

        if (userAmountInput !== "" && !isNaN(userAmountInput)) {
            if (parseFloat(userAmountInput) > parseFloat(balanceInput)) {
                document.getElementById("Amount").value = balanceInput;
            }
        }
    }
    function back() {
                window.location.href = 'unpaid_fees.php';
        }
</script>
</body>
</html>
<?php
if (isset($_POST['receipt'])) {
  $m_id=$id;
      $mode= 'CASH';
      $e_id=$result['e_id'];
      $fees = $result['fees'];//25000
      $mpaid=$result['amount_paid'];//10000
      $amount_paid = $_POST['Amount'];//100
      if (isset($_POST['Paymode']))
        $mode= $_POST['Paymode'];
      $amount_payable = $result['amount_payable'];//15000
      $des = $_POST['description'];
      if(empty($amount_paid))
      {
        echo "<script>alert('Please enter amount');</script>";
      }elseif (empty($des ))
      {
          echo "<script>alert('Enter Description');</script>";
      }
      else{
      $uquery = "UPDATE `membership_form` SET `mode`='$mode',`amount_paid`='$mpaid'+'$amount_paid',`amount_payable`='$amount_payable'-'$amount_paid',
      `des`='$des' WHERE `m_id`='$m_id'";
      $iquery="INSERT INTO `receipt`(`e_id`, `m_id`, `fees`, `amount_paid`, `amount_payable`, `pay_mode`, `description`) VALUES('$e_id','$m_id','$fees','$amount_paid','$amount_payable'-'$amount_paid','$mode','$des')";

        $uresult = mysqli_query($connection, $uquery); // Corrected variable name
        $iresult = mysqli_query($connection, $iquery);
        $gquery="SELECT max(r_id) as r_id from `receipt` where m_id='$m_id'";
        $gresult=mysqli_query($connection,$gquery);
        $grow=mysqli_fetch_assoc($gresult);
        $r_id=$grow['r_id'];
        if ($uresult) {
          echo "<script>
        alert('Paid successfully');
        window.location.href='print.php?r_id=$r_id';
        </script>";
        } else {
          echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
        }}
    }
    ?>
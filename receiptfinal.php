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
              $query = "SELECT `receipt`.`r_id` as r_id,`enquiry_master`.`name` as name, `enquiry_master`.`contact` as `contact`,`membership_form`.`membership_type` as `membership_type` ,`membership_form`.`mode` as paymode, `receipt`.`fees` as `fees`, `membership_form`.`amount_paid` as `mamount_paid`, `receipt`.`amount_paid` as `ramount_paid`, `receipt`.`amount_payable` as `amount_payable`, `receipt`.`description` as `des`, `membership_form`.`expiry_date` as `expiry_date` from enquiry_master join membership_form on enquiry_master.e_id = membership_form.e_id   join `receipt` on 
              `receipt`.`m_id` = `membership_form`.`m_id`
           
                            where `membership_form`.`m_id`='$id'
                                 AND `receipt`.`r_id`=(SELECT max(r_id) from receipt where `m_id`='$id');";
              $queryfire = mysqli_query($connection, $query);
              $result = mysqli_fetch_assoc($queryfire);
              ?>  
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
                <input type="text" id="paid" name="paid" value="<?php echo $result['mamount_paid'];?>" disabled>
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
                  <input type="text" id="Amount" name="Amount" value="<?php echo $result['ramount_paid'];?>" placeholder="Enter Your Amount" disabled>
              </div>
    
              <div class="bottom" style="width: 49%; float: right">
        <label for="Paymode">PayMode</label>
        <select id="Paymode" disabled readonlyname="Paymode">
            <option value="" disabled selected hidden readonly>Select PayMode</option>
            <option value="UPI" <?php if($result['paymode']=='UPI') echo 'selected'?>>UPI</option>
            <option value="Cash" <?php if($result['paymode']=='CASH') echo 'selected'?>>CASH</option>
            <option value="Card" <?php if($result['paymode']=='CARD') echo 'selected'?>>CARD</option>
            <option value="Check" <?php if($result['paymode']=='CHEQUE') echo 'selected'?>>CHEQUE</option>
            </select>
              </div>
      </div><br>
      <br>
      <label for="description" class="con" style="float: left">Description</label>
      <textarea id="description" value="" name="description" placeholder="<?php echo $result['des'];?>" style="height:60px; width:100%; display:inline;" disabled></textarea>
      <br><br>

     <!-- <button onclick="location.href='showmembers.php';" style="display:inline; background-color: #f44336;" >Cancel</button>
      <button onclick="location.href='show.php';" id="Print" style="display:inline;float: right" name="receipt">Get Invoice</button> -->
          </div>
      </form>
      <a href="showmembers.php"><button  style="display:inline; background-color: #f44336;" >Back</button></a>
      <a href="print.php?r_id=<?php echo $result['r_id']?>"><button id="Print" style="display:inline;float: right" name="receipt">Get Invoice</button></a>
      </div>
    </div>
  </div>
</body>
</html>
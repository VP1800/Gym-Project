<?php
require_once("Database/connection.php");
session_start();
if(!isset($_SESSION['username']))
{
    echo "<script>alert('Unauthorized access');</script>";
    echo "<script>window.location.href='login.php';</script>";
}
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
    .show {
	    display: block;
    }
    h2 {
	    color: green;
	    text-align: right;
    }
   
    input[type=text], select, textarea {
	    width: 100%;
	    padding: 10px;
	    border: 1px solid #ccc;
	    border-radius: 4px;
	    box-sizing: border-box;
	    margin-top: 6px;
	    margin-bottom: 15px;
	    resize: vertical
    }
	button{
	    background-color: #4CAF50;
	    border: none;
	    color: white;
	    padding: 9px 12px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
	    display:inline;
    }
    button:on-hover{
        background: #00ff00;
    }
    .container {
        display: flex;
        flex-direction: row;
    }
    .container1{
        padding-top: 80px;
    }
    .second1{
        padding-bottom: 20px;
    }
    .first{
        flex: 1;
        margin-right: 10px;
    }
    .second{
        flex: 1;
    }
    .container-fluid{
        width: 50%;
        margin: auto;
    }
    .form{
        padding: 1rem;
    }
    .fa-arrow-circle-right:before {
        content: "\f0a9";
        float: right;
    }
    @media screen and (max-width: 500px) {
        .container{
            flex-direction: column;
        }
        .container1{
            padding-top: 0px;
        }
        .first{ 
        }
        .second{
            position: relative;
            width: 100%;
            display: inline-block;
        }
        h2{
            width: 100%;
        }
        form{
            padding: 1rem;
        }
        .container-fluid{
        width: 95%;
        margin: auto;
        }
        .first{
        margin-right: 0px;
        }
    }
</style>
</head>
<body>
    <div class="container-fluid">
            <form action="" method="post">
                <?php
                    $id = $_REQUEST["m_id"];       
                    $query = "SELECT `receipt`.`r_id` as r_id,`enquiry_master`.`name` as name, `enquiry_master`.`contact` as `contact`,`membership_form`.`membership_type` as `membership_type` ,`membership_form`.`mode` as paymode, `receipt`.`fees` as `fees`, `membership_form`.`amount_paid` as `mamount_paid`, `receipt`.`amount_paid` as `ramount_paid`, `receipt`.`amount_payable` as `amount_payable`, `receipt`.`description` as `des`, `membership_form`.`expiry_date` as `expiry_date` from enquiry_master join membership_form on enquiry_master.e_id = membership_form.e_id   join `receipt` on 
                    `receipt`.`m_id` = `membership_form`.`m_id`

                    where `membership_form`.`m_id`='$id'
                    AND `receipt`.`r_id`=(SELECT max(r_id) from receipt where `m_id`='$id');";
                    $queryfire = mysqli_query($connection, $query);
                    $result = mysqli_fetch_assoc($queryfire);
                ?>  
                <div class="container1">
                    <div class="first1">
                        <h2><?php echo $_SESSION["gymname1"]." ".$_SESSION["gymname2"]; ?> Receipt</h2>
                    </div>
                    <div class="second1">
                        <label for="name" >Name:   <?php  echo $result['name']; ?></label><br>
                        <label for="contact" >Contact:  <?php  echo $result['contact']; ?></label>
                    </div>
                </div>
                <div class="container">
                    <div class="first" style="width: 100%">
                        <label for="type">Membership Type</label>
                        <input type="text" id="membership type" name="membership type" value="<?php  echo $result['membership_type']; ?>" disabled>
                    </div>
                    <div class="second" style="width: 100%">
	            	    <label for="fees">Fees</label>
                        <input type="text" id="fees" name="fees" value="<?php echo $result['fees']; ?>" disabled>
                    </div>
	            </div>
	            <div class="container"  style="width: 100%">
                    <div class="first">
                        <label for="paid">Paid</label>
                        <input type="text" id="paid" name="paid" value="<?php echo $result['mamount_paid'];?>" disabled>
                    </div>
                    <div class="second"  style="width: 100%">
	            	    <label for="balance">Balance</label>
                        <input type="text" id="balance" name="balance" value="<?php echo $result['amount_payable'];?>" disabled>
                    </div>
	            </div>
	            <div class="container"  style="width: 100%">
                    <div class="first">
                        <label for="name">Amount</label>
                        <input type="text" id="Amount" name="Amount" value="<?php echo $result['ramount_paid'];?>" placeholder="Enter Your Amount" disabled>
                    </div>
                    <div class="second"  style="width: 100%">
                        <label for="Paymode">PayMode</label>
                        <select id="Paymode" disabled readonlyname="Paymode">
                            <option value="" disabled selected hidden readonly>Select PayMode</option>
                            <option value="UPI" <?php if($result['paymode']=='UPI') echo 'selected'?>>UPI</option>
                            <option value="Cash" <?php if($result['paymode']=='CASH') echo 'selected'?>>CASH</option>
                            <option value="Card" <?php if($result['paymode']=='CARD') echo 'selected'?>>CARD</option>
                            <option value="Check" <?php if($result['paymode']=='CHEQUE') echo 'selected'?>>CHEQUE</option>
                        </select>
                    </div>
	            </div>
                <label for="description" class="con" style="float: left">Description</label>
                <textarea id="description" value="<?php echo $result['des']?>" name="description" placeholder="<?php echo $result['des']?>" style="height:60px; width:100%; display:inline;" disabled></textarea>
                <!-- -----------------------------  / -->
                <a href="print.php?r_id=<?php echo $result['r_id']?>"><i class="fa fa-arrow-circle-right" title="Get Invoice" style="font-size:30px; display:inline;float: right; padding: top 15px; color:green; cursor: pointer;">Submit&nbsp;</i></a>
                <a href="showmembers.php"><i class="fa fa-arrow-circle-left" title="Go to membership list" style="font-size:30px; padding: top 15px; color: #CA0B00; cursor: pointer;">Back</i></a>
            </form>
    </div>
</body>
</html>
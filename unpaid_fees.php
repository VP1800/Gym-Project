<?php
require_once("Database/connection.php");
$query = "SELECT `membership_form`.`m_id` as `mid`,`enquiry_master`.`e_id` as `id`,`enquiry_master`.`name` as `name`, `enquiry_master`.`contact` as `contact`,`membership_form`.`membership_type` as `membership_type` , `membership_form`.`fees` as `fees`, `membership_form`.`amount_paid` as `amount_paid`, `membership_form`.`amount_payable` as `amount_payable`,`membership_form`.`reminder_date` as `reminder_date` ,`membership_form`.`expiry_date` as `expiry_date` from enquiry_master join membership_form on enquiry_master.e_id = membership_form.e_id where membership_form.amount_payable > 0 order by membership_form.reminder_date";
$queryfire = mysqli_query($connection, $query);
?>
<!doctype html> 
<html lang="en"> 
<?php include 'nav.php';?>
<head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title>Unpaid Fees</title> 
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="css.3 ofline/css/w3schools.com_w3css_4_w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <h1>Unpaid Fees</h1>
  </head> 
<style>
    table, td, th {
  border: 0.5px solid #E5E4E2;
  text-align: center;
  
}
body{
  background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.2)), url("image/show.jpeg");
  background-size:cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 17px;
} 
h1{
  text-align: center;
  font-family: Arial, Helvetica, sans-serif;
  margin-top: 70px; 
  text-shadow: 2px 2px 8px #FF0000;
  text-shadow: 8px 6px 8px black;
  color: white;
  font-weight: 600;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 0.5px;
}
table tbody tr:nth-child(odd){
      background: white;  
}
table tbody tr:nth-child(even){
      background: #dddddd;
      border-bottom: 1px solid #b4b4b4;
      border-top: 1px solid #b4b4b4;
}
#DataTables_Table_0_filter{
  margin-bottom: 14px;
  margin-top: 10px;
}
#DataTables_Table_0_length{
  margin-bottom: 14px;
  margin-top: 10px;
}
.container-fluid{
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}
.w3-card{
  border-radius: 0.35rem;
  background: #dddddd;
}
tr{
  background: black; 
  color: #f2f2f2;
}
td{
  color: black;
}
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: white;
    margin-left: 3px;
}
.dataTables_wrapper .dataTables_length select {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: white;
    padding: 4px;
}
</style>
<body>
<div class="container-fluid">
 <div class="w3-card w3-padding w3-margin"> 
 <div style="overflow-x: auto;">
   <table class="table table-striped"> 
     <thead>
        <tr>
          <th>Sr.No.</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Membership Type</th>
            <th>Fees</th>
            <th>Amount Paid</th>
            <th>Remaining Amount</th>
            <th>Reminder Date</th>
            <th>Expiry Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $count = 0;
         while($row = mysqli_fetch_assoc($queryfire)){?>
          <tr>
          <td><?php echo ++$count; ?></td>
          <td><?php echo $row['name'];?></td>
            <td><?php echo $row['contact'];?></td>
            <td><?php echo $row['membership_type'];?></td>
            <td><?php echo $row['fees'];?></td>
            <td><?php echo $row['amount_paid'];?></td>
            <td><?php echo $row['amount_payable'];?></td>
            <td><?php echo date('d/m/Y', strtotime($row['reminder_date']));?></td>
            <td><?php echo date('d/m/Y', strtotime($row['expiry_date']));?></td>
            <td>
                <a href="receiptpay.php?m_id=<?php echo $row['mid'];?>"><button  name="pay"  class="w3-button w3-green">&#x20b9;&nbsp;Pay</button></a> 
                  
            </td>
          </tr>
          <?php } ?>
        </tbody> 
   </table> 
 </div>
 </div> 
 <?php

if(isset($_POST["receipt"]))
{
    $id = $row['id'];
    $query = "SELECT `enquiry_master`.`name` as name, `enquiry_master`.`contact` as `contact`,`membership_form`.`membership_type` as `membership_type` , `membership_form`.`fees` as `fees`, `membership_form`.`amount_paid` as `amount_paid`, `membership_form`.`amount_payable` as `amount_payable`, `membership_form`.`expiry_date` as `expiry_date` from enquiry_master join membership_form on enquiry_master.e_id = membership_form.e_id where `enquiry_master`.`e_id`='$id';";
    $queryfire = mysqli_query($connection, $query);
    $result = mysqli_fetch_assoc($queryfire);

}

?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script> 
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> 
  <script> 
  $(document).ready( function () { 
  $('.table').DataTable(); 
  }); 
  </script>
</div>
</body> 
</html>
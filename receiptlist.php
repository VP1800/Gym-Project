<?php
require_once("Database/connection.php");
$m_id=$_REQUEST['m_id'];
$query = "SELECT r.`r_id`, e.`name`, r.`fees`, r.`amount_paid`, r.`amount_payable`, r.`pay_mode`, r.`description`, r.`created_at` FROM `receipt` r join enquiry_master e on e.e_id = r.e_id where m_id = $m_id";
$queryfire = mysqli_query($connection, $query);
$nquery = "SELECT `name` from enquiry_master where e_id = (SELECT  DISTINCT e_id from receipt where m_id = '$m_id');";
$nresult = mysqli_query($connection, $nquery);
$nrow=mysqli_fetch_assoc($nresult);
$nname = $nrow["name"];
?>
<!doctype html> 
<html lang="en"> 
<?php include 'nav.php';?>
<head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title>Receipt List</title> 
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="css.3 ofline/css/w3schools.com_w3css_4_w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
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
<h1>Receipt of <b><?php echo $nname?></b></h1>
<div class="container-fluid">
 <div class="w3-card w3-padding w3-margin"> 
 <div style="overflow-x: auto;">
   <table class="table table-striped"> 
     <thead>
        <tr>
          <th>Id</th>
            <!-- <th>Name</th> -->
            <!-- <th>Membership Type</th> -->
            <th>Fees</th>
            <th>Amount Paid</th>
            <th>Amount Payable</th>
            <th>Pay Mode</th>
            <th>Description</th>
            <th>Pay Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($queryfire)){?>
          <tr>
          <td><?php echo $row['r_id'];?></td>
          <!-- <td><?php echo $row['name'];?></td> -->
            <!-- <td><?php echo $row['membership_type'];?></td> -->
            <td><?php echo $row['fees'];?></td>
            <td><?php echo $row['amount_paid'];?></td>
            <td><?php echo $row['amount_payable'];?></td>
            <td><?php echo $row['pay_mode'];?></td>
            <td><?php echo $row['description'];?></td>
            <td><?php echo date('d/m/Y', strtotime($row['created_at']));?></td>
            <td>
                <a href="print.php?r_id=<?php echo $row['r_id'];?>"><button  name="pay"  class="w3-button w3-green">&#x20b9;&nbsp;Pay</button></a> 
                  
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
<?php 
$con=mysqli_connect('localhost','root','','gym_db'); 
$res=mysqli_query($con,"select membership_form.*,enquiry_master.name from membership_form inner join enquiry_master ON
membership_form.e_id = enquiry_master.e_id ORDER BY membership_form.created_at desc"); 
?>
<!doctype html> 
<html lang="en"> 
<?php include 'nav.php';?>
<head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title>Membership List</title> 
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="css.3 ofline/css/w3schools.com_w3css_4_w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <h1>Memberships</h1>
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
       
        <tr style="background: black; color: #f2f2f2"> 
            <th>Sr.No.</th> 
            <th>Name</th>
            <th style="width: 30%">Birth Date</th> 
            <!-- <th>Married</th>  -->
            <th>Anniversary Date</th> 
            <th>Membership Type</th> 
            <th style="width: 30%">Expiry Date</th>
            <th>Total Fees</th>
            <th>Paid Amount</th>
            <th>Remaining Amount</th>
            <th>Payment Method</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
</thead>

    
  <tbody> 
  <?php $count = 0;
    while($row=mysqli_fetch_assoc($res)){?> 
    <tr> 
      <td><?php echo ++$count; ?></td> 
      <td><?php echo $row['name']?></td>
      <td><?php echo date('d/m/Y', strtotime($row['dob']));?></td> 
      <!-- <td><?php echo $row['is_married']?></td>  -->
      <td><?php if($row['is_married'] == 'married'){ echo date('d/m/Y', strtotime($row['anniversary_date']));} else{echo 'unmarried';}?></td> 
      <td><?php echo $row['membership_type']?></td> 
      <td><?php echo date('d/m/Y', strtotime($row['expiry_date'])); ?></td> 
      <td><?php echo $row['fees']?></td>
      <td><?php echo $row['amount_paid']?></td>
      <td><?php echo $row['amount_payable']?></td>
      <td><?php echo $row['mode']?></td>
      <td><?php echo $row['des']?></td>
      <td><a href="membership_update.php?e_id=<?php echo $row['e_id']?>"><i class="fa fa-edit fa-lg" style="font-size:20px;color:blue"></i></a> &nbsp;
      <a href="receiptlist.php?m_id=<?php echo $row['m_id']?>"><i class="fa fa-print fa-lg" style="font-size:20px;color:gray"></i></a></td> 
    </tr> 
   <?php } ?> 
  </thead> 
   </table> 
 </div>
   </div> 
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
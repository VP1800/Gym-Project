<?php
require_once("Database/connection.php");
$query = "SELECT date,description,category_name,amount,payment_method,receipt FROM `expense_ledger`";
$result = mysqli_query($connection, $query);

?>
<!doctype html> 
<html lang="en"> 
<?php include 'nav.php';?>
<head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title>Unpaid Fees</title> 
  <link rel="stylesheet" href="CSS/w3.css"> 
<link rel="stylesheet" href="CSS/JQUERY/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="CSS/w3schools.com_w3css_4_w3.css">
<link rel="stylesheet" href="CSS/FONT/font-awesome.min.css">
 <h1>ledger list</h1>
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
                            
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Receipt</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            echo '<tr>
            <td>'.(++$count).' </td>
            <td>'.$row['date'].'</td>
            <td>'.$row['description'].'</td>
            <td>'.$row['category_name'].'</td>
            <td>'.$row['amount'].'</td>
            <td>'.$row['payment_method'].'</td>
            <td>'.$row['receipt'].'</td>
            </tr>';
         }
         ?>
        </tbody> 
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
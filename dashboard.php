<?php
include_once "Database/connection.php";
if(isset($_SESSION['username'])) {
  header("Location: dashboard.php"); // redirects to homepage
  exit; 
}
?>


<!DOCTYPE html>
<html>
<head>
<?php include 'nav.php'; ?>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript">
  function preventBack(){window.history.forward()};
 // setTimeout("preventBack()",0)
   window.onunload=function(){null;}
</script>

<style>
body {
  background: url(image/dashboard_bg.jpeg);
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-size: 100% 100%; 
}

.hello {
  position:sticky;
  padding-top: 45px;
  padding-left: 15px;
  text-shadow: 8px 6px 8px black;
  text-align: center;
  color: white;
  font-weight: 600;
}


/* ------------------partial pay------------------ */
 .export{
  margin-bottom: -10px;
  text-align: center;
}

/*--------------- Member Summary styles-----------------------*/
h4 {
    padding-left: 10px;
    font-size: 20px;
    color: white;
}

.w3-card{
  padding:16px;
}

/*----------------datatable-------------*/
table, td, th {
  border: 0.5px solid #E5E4E2;
  text-align: center;
}
h3 {
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    margin-top: 25px;
    margin-bottom: -20px;
}
table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 0.5px;
  border-color:#e5e4e2
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
    overflow-x: auto;
}
.h_name
{
  position: sticky;
  top:0;
  text-shadow: 8px 6px 8px black;
  color: white;
  font-weight: 600;
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

.dataTables_wrapper .dataTables_filter {
    margin-bottom: 15px;
}

.dataTables_wrapper .dataTables_length select {
    background-color: #fff;
}

.dataTables_wrapper .dataTables_filter input {
    background-color: #fff;
}
.w3-black, .w3-hover-black:hover {
    color: #fff!important;
    background-color: #000!important;
    /* margin-top: 31px; */
    /* padding-bottom: 9px; */
    margin-bottom: -60px;
}
/*------------------ Apply appropriate classes chart container elements-------------------- */
.chart-container {
  overflow-x: auto;
  display: flex;
  justify-content: center;
  align-items: left;
  padding: 5px;
}


@media screen and (max-width: 600px) {
  /* Add spacing between the cards */
  .w3-card {
    margin-bottom: 20px;
  }
}


/* Media query for mobile view */
@media screen and (max-width: 600px) {

  h3{
    text-align:center;
  }

  .chart-container {
  display: flex;
  flex-direction: column; /* Stacking charts vertically */
  align-items: right; /* Centering horizontally */
  justify-content:right; /* Centering vertically */
  margin-top: 20px; /* Add some spacing between the charts */
}

#chart_div,
#donutchart {
  width: 500px;
  margin-bottom: 20px; /* Add spacing between the charts */
}


  .table{
    width:100%;
  }

  .export{
    display: flex; 
    justify-content: center; 
    align: center;
    text-align: center;
    margin: 10px;
    padding:20;
  }

@media screen and (max-width: 600px) {
  .topnav.responsive {
    position: relative;
  }

  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
}
}
</style>
</head>
<body>
  <h1 class="hello">Hello, <?php echo $_SESSION['name']; ?>!</h1>

<div class="w3-row-padding w3-margin-bottom">
  <?php
    // Query to get count of members
    $queryTotal = "SELECT COUNT(m_id) AS total_members FROM membership_form";
    $result = mysqli_query($connection, $queryTotal);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalMembers = $row['total_members'];
    } else {
        $totalMembers = 0;
    }

    // Query to get count of active members
      $queryActive = "SELECT COUNT(m_id) AS active_members FROM membership_form WHERE expiry_date >= CURDATE()";
      $resultActive = mysqli_query($connection, $queryActive);

      if ($resultActive) {
        $rowActive = mysqli_fetch_assoc($resultActive);
        $membersActive = $rowActive['active_members'];
    } else {
        $membersActive = 0;
    }

    // Query to get count of inactive members
      $queryInactive = "SELECT COUNT(m_id) AS inactive_members FROM membership_form WHERE expiry_date < CURDATE()";
      $resultInactive = mysqli_query($connection, $queryInactive);

      if ($resultInactive) {
        $rowInactive = mysqli_fetch_assoc($resultInactive);
        $membersInactive = $rowInactive['inactive_members'];
    } else {
        $membersInactive = 0;
    }

    // Query to get count of members near expiry
    $queryExpiry = "SELECT COUNT(m_id) AS members_near_expiry FROM membership_form WHERE expiry_date > CURDATE() AND expiry_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
    $resultExpiry = mysqli_query($connection, $queryExpiry);

    if ($resultExpiry) {
        $rowExpiry = mysqli_fetch_assoc($resultExpiry);
        $membersNearExpiry = $rowExpiry['members_near_expiry'];
    } else {
        $membersNearExpiry = 0;
    }
  ?>

 <div class="w3-row-padding w3-margin-bottom">
 <h4>Member summary:</h4>
    <div class="w3-quarter">
      <div class="w3-card w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge" style="color:white;"></i></div>
        <div class="w3-right">
          <h1><?php echo $totalMembers; ?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4>Total</h4>
      </div>
    </div>

    <div class="w3-quarter">
      <div class="w3-card w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-user-circle w3-xxxlarge" style="color:white"></i></div>
        <div class="w3-right">
          <h1><?php echo $membersActive; ?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4>Active</h4>
      </div>
    </div>

    <div class="w3-quarter">
      <div class="w3-card w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-user-times w3-xxxlarge" style="color:white;"></i></div>
        <div class="w3-right">
          <h1><?php echo $membersInactive; ?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4>Inactive</h4>
      </div>
    </div>

    <div class="w3-quarter">
      <div class="w3-card w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-hourglass-end w3-xxxlarge" style="color:white;"></i></div>
        <div class="w3-right">
          <h1><?php echo $membersNearExpiry;?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4>Near expiry</h4>
      </div>
    </div>
  </div>

<!-- ------------------------partial mode datatable start---------------------------------- -->

<div class="w3-card w3-padding w3-margin"> 
<h3>Partial Payments</h3>
<div class="export">
      <form action="export.php" method="post">
        <input type="hidden" id="table-data" name="table-data">
        <button class="w3-button w3-black" type="submit" name="export-button">Export to Excel</button>
      </form>
  </div>
<div style="overflow-x: auto;">
 <table class="table table-striped"> 
    <thead> 
    <tr>
        <th>Name</th>
        <th>Fees</th>
        <th>Amount Paid</th>
        <th>Amount Payable</th>
        <th>Membership Type</th>
        <th>Mode</th>
        <th>Reminder Date</th>
        <th style="padding-right:50px">Expiry Date</th>
        <th>Contact</th>
        <th>Email</th>
    </tr>
    </thead> 
  <tbody id="Elist"> 
<?php
    $query = "SELECT em.name, em.contact, em.email, mf.membership_type, mf.expiry_date, mf.mode, mf.reminder_date, mf.fees, mf.amount_paid, mf.amount_payable
              FROM membership_form mf
              JOIN enquiry_master em ON mf.e_id = em.e_id where amount_payable > 0";

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row["name"] . '</td>
                    <td>' . $row["fees"] . '</td>
                    <td>' . $row["amount_paid"] . '</td>
                    <td>' . $row["amount_payable"] . '</td>
                    <td>' . $row["membership_type"] . '</td>
                    <td>' . $row["mode"] . '</td>
                    <td>' . date('d/m/Y', strtotime($row["reminder_date"])) . '</td>
                    <td>' . date('d/m/Y', strtotime($row["expiry_date"])) . '</td>
                    <td>' . $row["contact"] . '</td>
                    <td>' . $row["email"] . '</td>
                  </tr>';
        }
        
        echo '</tbody></table></div>';
    } else {
// $result = mysqli_query($connection, $query);
// $totalFees = 0;
// $totalAmountPaid = 0;
// $totalAmountPayable = 0;

// if ($result && mysqli_num_rows($result) > 0) {
//   while ($row = mysqli_fetch_assoc($result)) {
//     $totalFees += $row["fees"];
//     $totalAmountPaid += $row["amount_paid"];
//     $totalAmountPayable += $row["amount_payable"];
    
//     echo '<tr>
//       <td>' . $row["name"] . '</td>
//       <td>' . $row["fees"] . '</td>
//       <td>' . $row["amount_paid"] . '</td>
//       <td>' . $row["amount_payable"] . '</td>
//       <td>' . $row["membership_type"] . '</td>
//       <td>' . $row["mode"] . '</td>
//       <td>' . $row["reminder_date"] . '</td>
//       <td>' . $row["expiry_date"] . '</td>
//       <td>' . $row["contact"] . '</td>
//       <td>' . $row["email"] . '</td>
//     </tr>';
//   }

//   echo '<tr>
//     <td colspan="1"><strong>Total:</strong></td>
//     <td><strong>' . $totalFees . '</strong></td>
//     <td><strong>' . $totalAmountPaid . '</strong></td>
//     <td><strong>' . $totalAmountPayable . '</strong></td>
//     <td colspan="7"></td>
//   </tr>';
// } else {
        echo "No data available.";
    }
?>

  </thead> 
</table> 
</div>

<!-- ------------------------double-y ---------------------------------- -->
 
<div class="w3-container w3-display-container" style="display: flex; justify-content: flex-end; align-items: center;">
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
        var chartDiv = document.getElementById('chart_div');
        
        var combinedData = <?php
            $query = "SELECT
            MAX(Year) AS Year,
            MAX(Month) AS Month,
            SUM(EnquiriesCount) AS EnquiriesCount,
            SUM(MembersCount) AS MembersCount,
            SUM(TotalAmount) AS TotalAmount
        FROM (
            SELECT
                YEAR(created_at) AS Year,
                MONTH(created_at) AS Month,
                COUNT(e_id) AS EnquiriesCount,
                0 AS MembersCount,
                0 AS TotalAmount
            FROM
                enquiry_master
            GROUP BY
                Year,
                Month
            UNION ALL
            SELECT
                YEAR(created_at) AS Year,
                MONTH(created_at) AS Month,
                0 AS EnquiriesCount,
                COUNT(m_id) AS MembersCount,
                0 AS TotalAmount
            FROM
                membership_form
            GROUP BY
                Year,
                Month
            UNION ALL
            SELECT
                YEAR(created_at) AS Year,
                MONTH(created_at) AS Month,
                0 AS EnquiriesCount,
                0 AS MembersCount,
                SUM(amount_paid) AS TotalAmount
            FROM
                receipt
            GROUP BY
                Year,
                Month
        ) AS subquery
        GROUP BY
            Year,
            Month
        ORDER BY
            Year,
            Month;";

            $result = mysqli_query($connection, $query);
            $resultData = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $resultData[] = $row;
            }
            echo json_encode($resultData);// Parsing
        ?>;

        // Create the data array
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Amount');
    data.addColumn('number', 'Enquiries');
    data.addColumn('number', 'Members');

    var monthNames = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];

    for (var i = 0; i < combinedData.length; i++) {
        var monthNumber = parseInt(combinedData[i]['Month']);
        var month = monthNames[monthNumber - 1]; // Adjust month index
        data.addRow([
            month,
            parseInt(combinedData[i]['TotalAmount']),
            parseInt(combinedData[i]['EnquiriesCount']),
            parseInt(combinedData[i]['MembersCount']),
        ]);
    }


    var classicOptions = {
          width: 500,
          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1},
            2: {targetAxisIndex: 1}
          },
          title: 'Gym Performance',
          vAxes: {
            // Adds titles to each axis.
            0: {title: 'Amount'},
            1: {title: 'Conversion'}
          }
        };

    var classicChart = new google.visualization.ColumnChart(chartDiv);
    classicChart.draw(data, classicOptions);
}
</script>

<!-- ------------------------donut start---------------------------------- -->

  <?php
      $active_members_query = "SELECT COUNT(m_id) AS active_members FROM membership_form WHERE expiry_date > CURDATE()";
      $inactive_members_query = "SELECT COUNT(m_id) AS inactive_members FROM membership_form WHERE expiry_date < CURDATE()";

      $partial_payment_count_query = "SELECT COUNT(m_id) AS partial_payment_count
      FROM membership_form
      WHERE amount_payable IS NOT NULL AND amount_payable > 0";

      $full_payment_count_query = "SELECT COUNT(m_id) AS full_payment_count
      FROM membership_form
      WHERE amount_payable IS NULL OR amount_payable = 0";

      // Execute fetch results
      $active_members_result = mysqli_query($connection, $active_members_query);
      $inactive_members_result = mysqli_query($connection, $inactive_members_query);
      $partial_payment_count_result = mysqli_query($connection, $partial_payment_count_query);
      $full_payment_count_result = mysqli_query($connection, $full_payment_count_query);

      $active_members = mysqli_fetch_assoc($active_members_result)['active_members'];
      $inactive_members = mysqli_fetch_assoc($inactive_members_result)['inactive_members'];
      $partial_payment_count = mysqli_fetch_assoc($partial_payment_count_result)['partial_payment_count'];
      $full_payment_count = mysqli_fetch_assoc($full_payment_count_result)['full_payment_count'];
  ?>
        
  <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Columns', 'Count'],
          ['Active', <?php echo $active_members; ?>],
          ['Inactive', <?php echo $inactive_members; ?>],
          ['Partial Payments', <?php echo $partial_payment_count; ?>],
          ['Full Payments', <?php echo $full_payment_count; ?>]
        ]);

        var options = {
          title: 'Members and Payment Overview',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
  </script>
    
  <div class="chart-container">
  <div id="chart_div" style="width: 700px; height: 500px;"></div>
    <div id="donutchart" style="width: 700px; height: 400px;"></div>
  </div>
</div>

<!----------------------------------------table1----------------------------------------->

<div class="w3-card w3-padding w3-margin"> 
<h3>Membership Details</h3>
<div style="overflow-x: auto;">
<table class="table table-striped"> 
    <thead id="Elist">
    <tr>
    <th>Sr.No</th>
                  <th>Full Name</th>
                  <th>Fees</th>
                  <th>Amount</th>
                  <th>Membership date</th>
                  <th>Membership type</th>
                  <th>Contact</th>
    </tr>
    <tbody>
        <?php
        $query = "SELECT 
        enquiry_master.name,
        membership_form.membership_type,
        membership_form.fees,
        membership_form.amount_paid,
        DATE(membership_form.created_at) AS created_date,
        enquiry_master.contact,
        enquiry_master.work,
        enquiry_master.telephone 
      FROM enquiry_master 
      JOIN membership_form 
      ON enquiry_master.e_id=membership_form.e_id";

$result = mysqli_query($connection, $query);
$count = 0;

while ($row = mysqli_fetch_assoc($result)) {
  if($row['work']==0){$row['work']=null;}
  if($row['telephone']==0){$row['telephone']=null;}
echo '<tr>
          <td>' . (++$count) . '</td>
          <td>' . $row["name"] . '</td>
          <td>' . $row["fees"] . '</td>
          <td>' . $row["amount_paid"] . '</td>
          <td>' . date('d/m/Y', strtotime($row["created_date"])) . '</td> <!-- Display the created_date column -->
          <td>' . $row["membership_type"] . '</td>
          <td style="width: 15%;">' . $row["contact"] . ' 
          ' . $row["work"] . ' 
          ' . $row["telephone"] . '</td>
      </tr>';
}

  ?>
        </tbody>
</table>
</div>
</div>
<br>
<!-------------table2---------------->
<div class="w3-card w3-padding w3-margin"> 
<h3>List Of Members Near Expiry</h3>
 <div style="overflow-x: auto;">
 <table class="table table-striped" > 
<thead id="Elist">
<tr>
  <th>Sr.No</th>
        <th>Full Name</th>
        <th>Joining date</th>
        <th>Expiry date</th>
        <th>Contact</th>
</tr>
</thead>
<tbody>
    <?php
      $query = "SELECT
      enquiry_master.name,
      membership_form.expiry_date,
      DATE(membership_form.created_at) AS created_date,
      enquiry_master.contact,
      enquiry_master.work,
      enquiry_master.telephone
      FROM
          enquiry_master
      JOIN
          membership_form ON enquiry_master.e_id = membership_form.e_id
      WHERE
          expiry_date > CURDATE() and
          expiry_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
    $result= mysqli_query($connection,$query);
    $count=0;
    while($row=mysqli_fetch_assoc(($result))){
      if($row['work']==0){$row['work']=null;}
      if($row['telephone']==0){$row['telephone']=null;}
        echo '
              <tr>
                  <td>' . (++$count) . '</td>
                  <td>' . $row["name"] . '</td>
                  <td>' . date('d/m/Y', strtotime($row["created_date"])) . '</td>
                  <td>' . date('d/m/Y', strtotime($row["expiry_date"])) .'</td>
                  <td style="width: 15%;">' . $row["contact"] . ' 
                  ' . $row["work"] . ' 
                  ' . $row["telephone"].'</td></tr>
                  ';
    }
    ?>
</tbody>
</table>
</div>
</div>
<br>

<!----------------table3------------------------>
<div class="w3-card w3-padding w3-margin"> 
<h3>Recent Enquiries</h3>
 <div style="overflow-x: auto;">
 <table class="table table-striped" > 
<thead id="Elist">
<tr>
  
              <th>Sr.No.</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Ref No </th>
              <th>Type</th>
              
        
          
      <tbody>
          <?php
          $query = "SELECT name,gender,contact,work,telephone,email,alternate_email,refno1,refno2,type from enquiry_master where type!='Staff'
          ORDER BY created_at DESC ";
          $result = mysqli_query($connection, $query);
          $count = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            if($row['work']==0){$row['work']=null;}
            if($row['telephone']==0){$row['telephone']=null;}
              echo '
              <tr>
                  <td>' . (++$count) . '</td>
                  <td>' . $row["name"] . '</td>
                  <td>' . $row["gender"] . '</td>
                  <td style="width: 15%;">' . $row["contact"] . '
                  ' . $row["work"] . '
                  ' . $row["telephone"] . '</td>
                  <td>' . $row["email"] . '<br>
                  ' . $row["alternate_email"] . '</td>
                  <td>' . $row["refno1"] . '<br>
                  ' . $row["refno2"] . '</td>
                  <td>' . $row["type"] . '</td>
                  </tr>
              ';
          }
          ?>
      </tbody>
</table>
</div>
</div>

<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script> 
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> 
  <script> 
  $(document).ready( function () { 
  $('.table').DataTable(); 
  }); 
  </script> 

</body>
</html> 
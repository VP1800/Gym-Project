<?php 
// Load the database configuration file 
include_once 'Database/connection.php'; 

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\"/", "\"\"", $str); 
    $str = "\"" . $str . "\""; 
} 

// Excel file name for download 
$fileName = "members-data_" . date('Y-m-d') . ".csv"; 
$fileName = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '_', $fileName); // Sanitize filename

// Column names 
$fields = array('Name', 'Contact', 'Email', 'Membership Type', 'Expiry Date', 'Mode','Reminder Date','Fees','Amount Paid','Amount Payable'); 

// Display column names as the first row 
$excelData = implode(",", array_values($fields)) . "\n"; 

// Fetch records from the database 
$query = "SELECT em.name, em.contact, em.email, mf.membership_type, mf.expiry_date, mf.mode, mf.reminder_date, mf.fees, mf.amount_paid, mf.amount_payable
          FROM membership_form mf
          JOIN enquiry_master em ON mf.e_id = em.e_id";

$result = mysqli_query($connection, $query);

if($result->num_rows > 0){ 
    // Output each row of the data 
    while($row = mysqli_fetch_assoc($result)){ 
        $lineData = array(
            $row['name'], $row['contact'], $row['email'], $row['membership_type'], 
            $row['expiry_date'], $row['mode'], $row['reminder_date'], 
            $row['fees'], $row['amount_paid'], $row['amount_payable']
        ); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode(",", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...' . "\n"; 
} 

// Headers for download
header("Content-Type: text/csv"); // Use CSV content type
header("Content-Disposition: attachment; filename=\"$fileName\""); 

// Output buffering to make sure headers are set before any output is sent
ob_start();

// Render excel data 
echo $excelData; 

ob_end_flush(); // Send the output buffer

exit;
?>

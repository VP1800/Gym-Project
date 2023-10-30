<?php
require_once("Database/connection.php");
$pmode=null;
$des=null;
$pname=null;
if(isset($_REQUEST["e_id"]))
{
    $e_id=$_REQUEST["e_id"];
    $uquery = "SELECT date,category_name,party_name,amount,payment_method,description FROM `expense_ledger` where `e_id` = '$e_id'";
    $uresult = mysqli_query($connection, $uquery);
    $urow=mysqli_fetch_assoc($uresult);
    $pname=$urow["party_name"];
    $pmode=$urow["payment_method"];
     $des=$urow["description"];
    
}

    $query = "SELECT e_id,date,category_name,party_name,amount,payment_method,description FROM `expense_ledger`";
    $result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/w3.css">
    <link rel="stylesheet" href="CSS/w3schools.com_w3css_4_w3.css">
    <link rel="stylesheet" href="CSS/FONT/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/FONT/font-awesome.css">
    <link rel="stylesheet" href="CSS/JQUERY/jquery.dataTables.min.css">
    <?php include 'nav.php';?>
    <title>Expense Form</title>
    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.2)), url('image/health-club-without-people-with-exercise-equipment.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* Center content horizontally and vertically */
        .container5 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 88vh;
            padding: 20px;
        }
        /* h1{
          text-align: center;
          font-family: Arial, Helvetica, sans-serif;
          text-shadow: 2px 2px 8px #FF0000;
          text-shadow: 8px 6px 8px black;
          color: white;
          font-weight: 600;
        } */
        #container {
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            max-width: 1500px;
            width: 100%;
            margin-bottom: 15px;
        }

        .responsive-textarea {
            width: 100%;
            min-height: 50px;
            max-height: 150px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 15px;
            resize: vertical;
        }

        #expenseForm {
            padding: 20px;
        }
        #purchaseForm{
            padding: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="date"] {
            padding: 8px;
        }

        input[type="submit"] {
            background-color: black;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #00ff00;
        }

        .container1 {
        display: flex;
        flex-direction: row;
        }

        .input-container {
        display: flex;
        flex-direction: column;
        margin-right: 10px;
        }

        .input-container label {
            font-weight: bold;
        }
        .w3-red, .w3-hover-red:hover {
        color: black!important;
        background-color: #00ff00!important;
        }
        .input-container select,
        .input-container input,
        .input-container textarea {
            width: 100%;
            margin-right: 60px;
            /* padding: 10px; */
            /* padding-right: 60px; */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        /* Set a fixed height for input and select elements */
            input[type="date"],
            select,
            input[type="text"],
            input[type="number"],
            input[type="submit"],
            textarea {
                height: 50px; /* Adjust the height to your preference */
                
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
          margin-top: 19px;
        }
        #DataTables_Table_0_length{
          margin-bottom: 14px;
          margin-top: 10px;
        }
        #DataTables_Table_1_filter{
          margin-bottom: 14px;
          margin-top: 19px;
        }
        #DataTables_Table_1_length{
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
        
        table, td, th {
          border: 0.5px solid #E5E4E2;
          text-align: center;
        
        }
        .w3-button:hover{
            none;
        }
        /* Define fixed column width */
        .fixed-width-table th,
        .fixed-width-table td {
            max-width: 150px; /* Adjust the width as needed */
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            vertical-align: middle; /* Optional: vertically center content */
        }
        /* Additional styling for table header */
        .fixed-width-table th {
            background-color: black;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        /* Adjust styles for smaller screens */
        @media (max-width: 768px) {
            #container {
                width: 100%;
                margin: 20px;
            }
        }
    </style>
    
</head>
<script>
    if(window.history.replaceState)
 {
  window.history.replaceState(null,null,window.location.href);
 }
</script>

<body>

    <div class="w3-bar w3-black">
    <button class="w3-bar-item w3-button tablink" style="width:50%" onclick="openCity(event, 'London', 'expenseTab')" id="expenseTab">Expense</button>
<button class="w3-bar-item w3-button tablink" style="width:50%" onclick="openCity(event, 'Paris', 'purchaseTab')" id="purchaseTab">Purchase</button>

    </div>
    <div class="container5">
<div id="London" class="city">
    
    <div class="w3-light-grey" id="container">
    <form id="expenseForm" action="#" method="post" onblur="errorhide()" onsubmit="return formSubmission()" style="text-align: -webkit-center;">
            <div id="alertBox" class="w3-panel w3-pale-red w3-border" style="display: none; width: 20%; text-align:center; align-items:center;"><p><?php echo $message;?></p></div>
            <span id="error-container" style="display: none;"></span>
            <div class="container1">
                <div class="input-container">
                    <label for="date">Date<span style="color: red;">*</span></label>
                    <input type="date" id="date" name="date" value="<?php echo $urow['date'] ?>" autofocus>
                </div>

                <div class="input-container">
                    <label for="category_name">Category<span style="color: red;">*</span></label>
                    <select id="category_name" name="category_name">
                        <option selected disabled>Select Category</option>
                        <?php
                        $categoryQuery = "SELECT category_name FROM expense_category";
                        $categoryResult = mysqli_query($connection, $categoryQuery);
                        if ($categoryResult) {
                            while ($row = mysqli_fetch_assoc($categoryResult)) {
                                if($urow["category_name"]== $row["category_name"])
                                { 
                                    $categoryName = $row['category_name'];
                                    echo "<option value='$categoryName' selected>$categoryName</option>";
                                }
                                else
                                {
                                    $categoryName = $row['category_name'];
                                    echo "<option value='$categoryName' >$categoryName</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="input-container">
                    <label for="party_name">Party Name<span style="color: red;">*</span></label>
                    <input type="text" value="<?php echo $pname; ?>" id="party_name" onkeypress="return onlyAlphabets(event)" onblur="return validatepname()" name="party_name">

                </div>

                <div class="input-container">
                    <label for="amount">Amount<span style="color: red;">*</span></label>
                    <input type="number" id="amount" value="<?php echo $urow['amount'] ?>" onkeypress="return amtvalid(event)" name="amount" onblur="return validateAmount()">
                </div>

                <div class="input-container">
                    <label for="payment_method">Payment Method<span style="color: red;">*</span></label>
                    <select id="payment_method" name="payment_method">
                        <option <?php if(!$pmode){ echo "selected";} ?>disabled>Select Payment Method</option>
                        <option  <?php if($pmode=="CASH"){ echo "selected";} ?> value="CASH">CASH</option>
                        <option value="UPI" <?php if($pmode=="UPI"){ echo "selected";} ?>>UPI</option>
                        <option value="CHEQUE" <?php if($pmode=="CHEQUE"){ echo "selected";} ?>>CHEQUE</option>
                        <option value="CARD" <?php if($pmode=="CARD"){ echo "selected";} ?>>CARD</option>
                    </select>
                </div>

                <div class="input-container">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="responsive-textarea" onblur="return validateDes()"><?php echo $des; ?></textarea>
                </div>

                <div class="input-container" >
                <label for="description" style="color:#f1f1f1">Submit:</label>
                <input type="submit" value="Submit" name="expense_submit">
                </div>
            </div>
        </form>
    </div>
    
    <div class="container-fluid" id="container">
            <div style="overflow-x: auto;">
            <table class="table table-striped fixed-width-table">
                  <thead>
                     <tr>
                         <th>Sr.No.</th>
                         <th>Date</th>
                         <th>Category</th>
                         <th>Party Name</th>
                         <th>Amount</th>
                         <th>Payment Method</th>
                         <th>Description</th>
                         <th>Action</th>
                     </tr>
                  </thead>
                <tbody>
                     <?php 
                     $count = 0;
                     while($row = mysqli_fetch_assoc($result)){
                         echo '<tr>
                         <td>'.(++$count).' </td>
                         <td>'.$row['date'].'</td>
                         <td>'.$row['category_name'].'</td>
                         <td>'.$row['party_name'].'</td>
                         <td>'.$row['amount'].'</td>
                         <td>'.$row['payment_method'].'</td>
                         <td>'.$row['description'].'</td>
                         <td><a href="ledger.php?e_id='.$row['e_id'].'"><i class="fa fa-edit fa-lg" style="font-size:25px;color:blue"></i></a> &nbsp;&nbsp;
                             
                            <a href="javascript:void(0);" onclick="confirmlDelete('.$row['e_id'].')"><i class="fa fa-trash fa-lg" style="font-size:25px;color:red"></i></a>

                         </tr>';
                      }
                      ?>
                </tbody> 
                </table>
        </div> 
 

</div>
</div>
<?php
require_once("Database/connection.php");
$des = null;
$pname = null;
$bill_no = null; // Initialize $bill_no here
$item=null;
if (isset($_REQUEST["p_id"])) {
    $p_id = $_REQUEST["p_id"];
    $uquery = "SELECT bill_no, party_name, item, amount, date, description FROM `purchases` where `p_id` = '$p_id'";
    $uresult = mysqli_query($connection, $uquery);
    $urow = mysqli_fetch_assoc($uresult);
    $des = $urow["description"];
    $pname = $urow["party_name"];
    $item = $urow["item"];
    $bill_no = $urow["bill_no"]; // Assign value to $bill_no
}

$query = "SELECT p_id, bill_no, party_name,item, amount, date, description FROM `purchases` ";
$result = mysqli_query($connection, $query);
?>
<div id="Paris" class="city" style="display:none">
    
    <div class="w3-light-grey" id="container">
    <form id="purchaseForm" action="#" enctype="multipart/form-data" method="post"  onblur="errorhide()" onsubmit="return formSubmission()" style="text-align: -webkit-center;">
            <div id="alertBox" class="w3-panel w3-pale-red w3-border" style="display: none; width: 20%; text-align:center; align-items:center;"><p><?php echo $message;?></p></div>
            <span id="error-container" style="display: none;"></span>
            <div class="container1">
                <div class="input-container">
                        <label for="bill_no">Bill No.</label>
                        <input type="text" id="bill_no" onblur="return validateBill()" name="bill_no" value="<?php echo $bill_no; ?>">
                    </div>

                <div class="input-container">
                        <label for="party_name">Name<span style="color: red;">*</span></label>
                        <input type="text" id="party_name" onkeypress="return onlyAlphabets(event)" onblur="return validatepname()" name="party_name" value="<?php echo $pname; ?>">
                    </div>

                <!-- <div class="input-container">
                    <label for="item">Item<span style="color: red;">*</span></label>
                    <input type="file" id="item" onkeypress="" onblur="" name="item" value="<?php //echo $item; ?>">
                </div> -->
                <div class="input-container">
                    <label for="item">Item<span style="color: red;">*</span></label>
                    <input type="file" id="item" name="item" accept="image/*" title="choose an image" value="add image" onchange="">
                </div>
                <!-- <img id="imagePreview" src="' . $item . '" alt="Image Preview" style="max-width: 200px; display: none;"> -->


                <div class="input-container">
                        <label for="amount">Amount<span style="color: red;">*</span></label>
                        <input type="number" id="amount" value="<?php echo $urow['amount'] ?>" name="amount" onkeypress="return amtvalid(event)" onblur="return validateAmount()">
                    </div>

                <div class="input-container">
                        <label for="date">Date<span style="color: red;">*</span></label>
                        <input type="date" id="date" name="date" value="<?php echo $urow['date'] ?>" autofocus>
                    </div>

                <div class="input-container">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="responsive-textarea" onblur="return validateDes()"><?php echo $des; ?></textarea>
                    </div>

                <div class="input-container" >
                    <label for="submit" style="color:#f1f1f1">Submit</label>
                    <input type="submit" value="Submit" name="purchase_submit">
                </div>
            </div>
        </form>
    </div>
    
    <div class="container-fluid" id="container">
            <div style="overflow-x: auto;">
                <table class="table table-striped fixed-width-table"> 
                  <thead>
                     <tr>
                     <th>Sr.No.</th>
                            <th>Bill No</th>
                            <th>party Name</th>
                            <th>Image</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Actions</th>
                     </tr>
                  </thead>
                <tbody>
                <?php 
$count = 0;
while($row = mysqli_fetch_assoc($result)){
    echo '<tr>
    <td>'.(++$count).' </td>
    <td>'.$row['bill_no'].'</td>
    <td>'.$row['party_name'].'</td>
    <td style="max-width: 50px; max-height: 50px;"><img src="imageView.php?p_id='.$row["p_id"].'" width="100%" height="100%">
    </td>
    <td>'.$row['amount'].'</td>
    <td>'.$row['date'].'</td>
    <td>'.$row['description'].'</td>
    
    <td><a href="ledger.php?p_id='.$row['p_id'].'"><i class="fa fa-edit fa-lg" style="font-size:25px;color:blue"></i></a> &nbsp;&nbsp;
        
    <a href="javascript:void(0);" onclick="confirmpDelete('.$row['p_id'].')"><i class="fa fa-trash fa-lg" style="font-size:25px;color:red"></i></a>

</tr>';
}
?>

</tbody> 
</table>  

</div> 
</div>
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
<!-- Add this line at the beginning of your JavaScript -->
<script>
    function amtvalid(event) {
  var ikey = (event.which) ? event.which : event.keyCode;

  // Check if the key code corresponds to a digit (0-9)
  if (ikey >= 48 && ikey <= 57) {
    return true;
  }

  return false;
}
function onlyAlphabets(event) {
  var keyPressed = event.key;
  
  // Check if the pressed key is an alphabet (A-Z or a-z) or a space
  if (/^[A-Za-z ]$/.test(keyPressed)) {
    return true;
  }
  
  return false;
}
  const alertBox = document.getElementById("alertBox");

  function showAlert(message) {
    alertBox.innerHTML = message;
    alertBox.style.display = "block";
  }

  function hideAlert() {
    alertBox.innerHTML = "";
    alertBox.style.display = "none";
  }

  // Rest of your JavaScript code...
</script>

<script>
function showAlert(message) {
    alertBox.innerHTML = message;
    alertBox.style.display = "block";
  }

function hideAlert() {
    alertBox.innerHTML = "";
    alertBox.style.display = "none";
  }
  
document.addEventListener("DOMContentLoaded", function() {
    const dateInput = document.getElementById("date");
    dateInput.addEventListener("change", validateDate);
    const amountInput = document.getElementById("amount");
    amountInput.addEventListener("change", validateamt);
    hideAlert();
    function validateDate() {
        const selectedDate = new Date(dateInput.value);
        const currentDate = new Date();
        const minDate = new Date(currentDate);
        minDate.setFullYear(currentDate.getFullYear() - 1);

        if (selectedDate > currentDate) {
            showAlert("Date cannot be in the future");
            dateInput.value = currentDate.toISOString().split('T')[0]; // Clear the input
        } else if (selectedDate < minDate) {
            dateInput.value = "";
            showAlert("Date must not be less than 1 year in the past");
        } else {
            hideAlert();
        }
    }
    function validatepname() {
    var amtPattern = /^[A-Za-z\s]*$/;
    var party_name = document.getElementById("party_name"); // Get the party_name element
    var pname = party_name.value.trim(); // Trim whitespace from the input

    if (pname === "") {
        showAlert("Please enter a valid party name");
        party_name.value = ""; // Clear the input
    } else if (!amtPattern.test(pname)) {
        showAlert("Please enter a valid party name containing only letters");
        party_name.value = ""; // Clear the input
    } else {
        hideAlert();
    }
}

    function validateamt() {
        var amtPattern = /^\d+(\.\d{0,2})?$/;
        if (!amtPattern.test(amountInput.value)) {
            showAlert("Please enter a valid amount");
            amountInput.value = null;
        } else {
            hideAlert();
        }
    }
    });
    function validateDes() {
    var desInput = document.getElementById("description");
    var des = desInput.value;
    
    if (des === "") {
        showAlert("Please enter description");
        return false;
    }

    hideAlert();
    return true;
}

function validateAmount() {
    var amountInput = document.getElementById("amount");
    var amount = amountInput.value;
    var amtPattern = /^\d+(\.\d{0,2})?$/;
    
    if (amount === "") {
        showAlert("Please enter an amount");
        return false;
    }
    else if (!amtPattern.test(amount)) {
        showAlert("Please enter a valid amount");
        amountInput.value = ""; // Clear the input
        return false;
    }

    hideAlert();
    return true;
}

function confirmlDelete(e_id) {
    var confirmation = confirm("Are you sure you want to delete this record?");
    if (confirmation) {
        // Redirect to delete page or trigger AJAX to delete record
        window.location.href = 'deleteledger.php?e_id=' + e_id;
    }
}
function confirmpDelete(p_id) {
    var confirmation = confirm("Are you sure you want to delete this record?");
    if (confirmation) {
        // Redirect to delete page or trigger AJAX to delete record
        window.location.href = 'deletepurchase.php?p_id=' + p_id;
    }
}
//   $(document).ready( function () { 
//   $('.table').DataTable(); 
//   }); 
  
//     function showAlert(message) {
//     alertBox.innerHTML = message;
//     alertBox.style.display = "block";
//   }

//   function hideAlert() {
//     alertBox.innerHTML = "";
//     alertBox.style.display = "none";
//   }
  

//     function validateamt() {
//         var amtPattern = /^\d+(\.\d{0,2})?$/;
//         if (!amtPattern.test(amountInput.value)) {
//             showAlert("Please enter a valid amount");
//             amountInput.value = null;
//         } else {
//             hideAlert();
//         }
//     }
//     });
//     function validateDes() {
//     var desInput = document.getElementById("description");
//     var des = desInput.value;
    
//     if (des === "") {
//         showAlert("Please enter description");
//         return false;
//     }

//     hideAlert();
//     return true;
// }

// function validateAmount() {
//     var amountInput = document.getElementById("amount");
//     var amount = amountInput.value;
//     var amtPattern = /^\d+(\.\d{0,2})?$/;
    
//     if (amount === "") {
//         showAlert("Please enter an amount");
//         return false;
//     }
//     else if (!amtPattern.test(amount)) {
//         showAlert("Please enter a valid amount");
//         amountInput.value = ""; // Clear the input
//         return false;
//     }

//     hideAlert();
//     return true;
// }


// function validatepname() {
//     var amtPattern = /^[a-zA-Z]+$/;
//     var party_name = document.getElementById("party_name"); // Get the party_name element
//     var pname = party_name.value.trim(); // Trim whitespace from the input

//     if (pname === "") {
//         showAlert("Please enter a valid party name");
//         party_name.value = ""; // Clear the input
//     } else if (!amtPattern.test(pname)) {
//         showAlert("Please enter a valid party name containing only letters");
//         party_name.value = ""; // Clear the input
//     } else {
//         hideAlert();
//     }
// }

function validateBill() {
    var bill_noInput = document.getElementById("bill_no");
    var bill_no = bill_noInput.value;
    var numericPattern = /^[0-9]+$/;
    
    if(bill_no === "")
    {
        showAlert("Please enter Bill Name");
        return false;
    }
    else if (!numericPattern.test(bill_no)) {
        showAlert("Please enter Bill Number");
        bill_noInput.value = ""; // Clear the input
        return false;
    }
    hideAlert();
    return true;
}


//   // Function to set the active tab and its color
//   function setDefaultTab() {
//     const expenseTab = document.getElementById('expenseTab');
//     const purchaseTab = document.getElementById('purchaseTab');

//     // Set the active tab to "Expense" and change its color to red
//     expenseTab.classList.add('w3-red');
//     purchaseTab.classList.remove('w3-red');
//   }

//   // Call the function on page load
//   window.addEventListener('load', setDefaultTab);

// Function to set the active tab and its color
function setDefaultTab() {
  const expenseTab = document.getElementById('expenseTab');
  const purchaseTab = document.getElementById('purchaseTab');

  // Check the cookie to determine the active tab
  const activeTab = getCookie('activeTab');
  if (activeTab === 'purchase') {
    // If "Purchase" tab is active, set its color to red
    expenseTab.classList.remove('w3-red');
    purchaseTab.classList.add('w3-red');
  } else {
    // Otherwise, "Expense" tab is active (default), set its color to red
    expenseTab.classList.add('w3-red');
    purchaseTab.classList.remove('w3-red');
  }
}

// Function to toggle tab and update the cookie
function openCity(event, cityName, tabName) {
    hideAlert();
  const tablinks = document.getElementsByClassName('tablink');

  // Toggle tab colors
  for (const tablink of tablinks) {
    tablink.classList.remove('w3-red');
  }
  event.currentTarget.classList.add('w3-red');

  // Store the active tab in a cookie
  document.cookie = 'activeTab=' + tabName;

  // Display the corresponding content (London or Paris) as before
  // ...
}

// Call the function on page load
window.addEventListener('load', setDefaultTab);






function openCity(evt, cityName) {
    hideAlert();
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";

  if (cityName === 'London') {
    document.cookie = 'activeTab=expense';
  } else if (cityName === 'Paris') {
    document.cookie = 'activeTab=purchase';
  }
}
document.addEventListener('DOMContentLoaded', function () {
  const activeTab = getCookie('activeTab');
  if (activeTab === 'expense') {
    openCity(null, 'London'); // Show Expense form
  } else if (activeTab === 'purchase') {
    openCity(null, 'Paris'); // Show Purchase form
  }
});

// Function to get a cookie value by name
function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}

</script>
</body>
</html>
<?php

// $message = ""; // Initialize the message variable

if (isset($_POST['expense_submit'])) {
    // Expense form is submitted
    $date_input = $_POST['date'];
    $category_name = $_POST['category_name'];
    $party_name = $_POST['party_name'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $description = $_POST['description'];
    if (empty($date_input)) {
        echo '<script>showAlert("Please enter a valid Date");</script>';
    
    } elseif ($category_name == "" ) {
        echo '<script>showAlert("Please select category");</script>';
        echo '<script>showAlert("");</script>';
    } elseif (empty($party_name)) {
            echo '<script>alert("Please Enter party Name");</script>';
    } elseif (!preg_match('/^[A-Za-z\s]*$/', $party_name)) {
            echo '<script>alert("Please enter alphanumeric party Name");</script>';
    } else if(empty($amount)){
        echo '<script>showAlert("Please enter amount");</script>';
    } elseif (!is_numeric($amount) || $amount <= 0) {
        echo '<script>showAlert("Please enter a valid amount greater than zero");</script>';
    } else if(empty($payment_method))
    {
        echo '<script>showAlert("Please select payment method");</script>';
    } 
    else
    {
        if(isset($_REQUEST["e_id"]))
        {
            $query = "UPDATE `expense_ledger` SET
             `date`='$date_input',
             `category_name`='$category_name',
             `party_name`='$party_name',
             `amount`='$amount',
             `payment_method`='$payment_method',
             `description`='$description'
            WHERE `e_id` = '$e_id'";

if (mysqli_query($connection, $query)) {
    echo "<script>alert('Data updated successfully!'); window.location.href = 'ledger.php';</script>";
} else {
    echo "<script>alert('Data has NOT been updated');</script>";
}
}      
        else
        {
            $query = "INSERT INTO expense_ledger (`date`, `category_name`, `party_name`, `amount`, `payment_method`, `description`) 
          VALUES ('$date_input', '$category_name', '$party_name', '$amount', '$payment_method', '$description')";

if (mysqli_query($connection, $query)) {
    echo "<script>alert('Data inserted successfully!'); window.location.href = 'ledger.php';</script>";
} else {
    echo "<script>alert('Data has NOT been inserted');</script>";
}

            mysqli_close($connection);
    }
    }
}
?>
<?php
if (isset($_POST['purchase_submit'])) {
    // Purchase form is submitted
    $bill_no = $_POST['bill_no'];
    $party_name = $_POST['party_name'];
    //$item = $_FILES['item'];
    $imgData = file_get_contents($_FILES['item']['tmp_name']);
    $amount = $_POST['amount'];
    $date_input = $_POST['date'];
    $description = $_POST['description'];
        // // Get file info 
        // $fileName = basename($_FILES["item"]["name"]); 
        // $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // // Allow certain file formats 
        // $allowTypes = array('jpg','png','jpeg','gif'); 
        // if(in_array($fileType, $allowTypes)){ 
        //     $image = $_FILES['item']['tmp_name']; 
        //     $imgContent = addslashes(file_get_contents($image)); 
        // }
     
 if(empty($party_name)){
              echo '<script>showAlert("Please Enter party Name");</script>';
    }else if(!preg_match('/^[A-Za-z\s]*$/',$party_name)){
              echo '<script>showAlert("Please enter alphanumeric party Name");</script>';
    }else if(empty($amount)){
              echo '<script>showAlert("Please enter amount");</script>';
    }elseif (!is_numeric($amount) || $amount <= 0) {
              echo '<script>showAlert("Please enter a valid amount greater than zero");</script>';
    }elseif (empty($date_input)) {
              echo '<script>showAlert("Please enter a valid Date");</script>';
    } 
    else
    {
     //   echo '<script>alert("Hello"+$item);</script>';
        if (isset($_REQUEST["p_id"])) {
            // $query = "UPDATE `purchases` SET
            //     `bill_no` = :bill_no,
            //     `party_name` = :party_name,
            //     `item` = :item,
            //     `amount` = :amount,
            //     `date` = :date_input,
            //     `description` = :description
            //     WHERE `p_id` = :p_id";

            // $stmt = $pdo->prepare($query);
            // $stmt->bindParam(':bill_no', $bill_no);
            // $stmt->bindParam(':party_name', $party_name);
            // $stmt->bindParam(':item', $item, PDO::PARAM_LOB); // Use PDO::PARAM_LOB for binary data
            // $stmt->bindParam(':amount', $amount);
            // $stmt->bindParam(':date_input', $date_input);
            // $stmt->bindParam(':description', $description);
            // $stmt->bindParam(':p_id', $p_id);

            // if ($stmt->execute()) {
            //     echo "<script>alert('Data updated successfully!');</script>";
            // } else {
            //     echo "<script>alert('Data has NOT been inserted');</script>";
            // }

            $query = "UPDATE `purchases` SET
                `bill_no`='$bill_no',
                `party_name`='$party_name',
                `item`='$item',
                `amount`='$amount',
                `date`='$date_input',
                `description`='$description'
                where `p_id` = '$p_id'";

            if (mysqli_query($connection, $query)) {
                echo "<script>alert('Data updated successfully!');
                </script>";
            } else {
                echo "<script>alert('Data has NOT been inserted');</script>";
            }
                  mysqli_stmt_close($stmt);
        } 
        else
        {
            $sql = "INSERT INTO purchases(bill_no,party_name,item,amount,date,description) VALUES(?, ?, ?, ?, ?, ?)";
        $statement = $connection->prepare($sql);
        $statement->bind_param('ssssss', $bill_no, $party_name, $imgData, $amount, $date_input, $description);
        $current_id = $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
            if (mysqli_query($connection, $query)) {
                echo "<script>alert('Data inserted successfully!'); window.location.href = 'ledger.php';</script>";
            } else {
                echo "<script>alert('Data has NOT been inserted');</script>";
            }
                  mysqli_close($connection);
        }
    }
}

?>
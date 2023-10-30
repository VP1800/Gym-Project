<?php
require_once("Database/connection.php");

if (isset($_GET['e_id'])) {
    $e_id = $_GET['e_id'];
    $deleteQuery = "DELETE FROM `expense_ledger` WHERE `e_id` = '$e_id'";
    $deleteResult = mysqli_query($connection, $deleteQuery);

    if ($deleteResult) {
        echo "<script>alert('Data deleted successfully!');
        window.location.href = 'ledger.php';</script>";
    } else {
        echo "<script>alert('Failed to delete data');</script>";
    }
}
?>

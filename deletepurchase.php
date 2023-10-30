<?php
require_once("Database/connection.php");

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
    $deleteQuery = "DELETE FROM `purchases` WHERE `p_id` = '$p_id'";
    $deleteResult = mysqli_query($connection, $deleteQuery);

    if ($deleteResult) {
        echo "<script>alert('Data deleted successfully!');
        window.location.href = 'ledger.php';</script>";
    } else {
        echo "<script>alert('Failed to delete data');</script>";
    }
}
?>
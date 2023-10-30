<?php
require_once __DIR__ . '/Database/connection.php';
if (isset($_GET['p_id'])) {
    $sql = "SELECT item FROM purchases WHERE p_id=?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("i", $_GET['p_id']);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_connect_error());
    $result = $statement->get_result();

    $row = $result->fetch_assoc();
    // header("Content-type: " . $row["imageType"]);
    echo $row["item"];
}
?>


<?php
    include("connect_db.php");
    $messageid = $_GET["messageid"];
    $status = $_GET["category"];

    $sql = "UPDATE berichten SET STATUS='$status' WHERE MESSAGE_ID=$messageid";
    if ($conn->query($sql) === TRUE) {
    echo "Record status changed successfully";
    header("location: /index.php?manage=panel&select=open");
    }
?>

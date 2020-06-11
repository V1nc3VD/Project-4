<?php
session_start();

if ($_SESSION["userrole"] == "admin" || $_SESSION["userrole"] == "superadmin" || $_SESSION["userrole"] == "root")
{
    include("connect_db.php");
    $messageid = $_GET["messageid"];

    $sql = "DELETE FROM berichten WHERE MESSAGE_ID=$messageid";
    if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    print($_SESSION["userrole"]);
    header("location: ../index.php?manage=panel");
    }
}
else {
    print("onvoldoende rechten");
}
?>

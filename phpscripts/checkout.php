<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: ../index.php?content=login&alert=nietingelogd");
}
else {
include("./connect_db.php");
include("./functions.php");
$total=NULL;
//loop om variablen te declaren 
foreach ($_SESSION['shopping_cart'] as $key => $product) {

    $productid = $product['id'];
    $quantity = floatval($product['quantity']);
    $price = floatval($product['Prijs']);
    $producttotalprice = $product['quantity'] * $product['Prijs'];
    //gaat de loop telkens langs en voegt producttotaalprijs telkens opnieuw toe
    $total = $total + ($producttotalprice);
}


$datum = date("Y/m/d H:i:s");


$USERID = $_SESSION["USER_ID"];
$sql = "INSERT INTO `BESTELLING` (`USER_ID`, `Bestellingdatum`, `Totaalprijs`)
VALUES ('{$USERID}', '{$datum}', '{$total}')";


mysqli_query($conn, $sql);
//pakt het door auto_increment aangemaakte bestellingid van bestteling
$bestellingid = mysqli_insert_id($conn);


foreach ($_SESSION['shopping_cart'] as $key => $product) {
    $sql = "INSERT INTO `BESTELLING_PRODUCTEN` (`BestellingID`, `PyjamaID`, `Hoeveelheid`, `Producteindprijs`)
                VALUES ('{$bestellingid}','{$productid}', '{$quantity}', '{$producttotalprice}')";

    mysqli_query($conn, $sql);
}
//maakt een nieuwe lege winkelwagen aan
$_SESSION['shopping_cart'] = array();
header("location: ../index.php?content=shop&alert=success");
}


?>


<?php
session_start();
include("./connect_db.php");
include("./functions.php");
$total=NULL;
//loop om variablen te declaren 
foreach ($_SESSION['shopping_cart'] as $key => $product) {

    $productid = $product['id'];
    $quantity = $product['quantity'];
    $price = $product['Prijs'];
    $producttotalprice = number_format($product['quantity'] * $product['Prijs'], 2);
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
    echo $product['id'];
    $sql = "INSERT INTO `BESTELLING_PRODUCTEN` (`BestellingID`, `PyjamaID`, `Hoeveelheid`, `Producteindprijs`)
                VALUES ('{$bestellingid}','{$productid}', '{$quantity}', '{$producttotalprice}')";

    mysqli_query($conn, $sql);
}


?>


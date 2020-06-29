<?php

include("phpscripts/connect_db.php");
$tbody = "";



$sql = "SELECT * FROM `pyjamas`";
$result = mysqli_query($conn, $sql);

//loop dat ervoor zorgt dat elke pyjama in de database op de website komt te staan
while ($record = mysqli_fetch_assoc($result)) {
    //pakt naam van foto en zet het om naar de locatie waar de src naar moet linken
    $fotonaam = $record['Foto'];
    $fotolocatie = "../img/pyjamas/".$fotonaam;

    $productnaam = $record['Naam'];
    $beschrijving = $record['Beschrijving'];
    $prijs = "$".$record['Prijs'];
    

  $tbody .= ' 
  <div class="col-lg-4 col-md-6 mb-4">
  <div class="card h-100">
    <a href="#"><img class="card-img-top" src=" ' . $fotolocatie . ' " alt=""></a>
    <div class="card-body">
      <h4 class="card-title">
        <a href="#">'. $productnaam .'</a>
      </h4>
      <h5>' . $prijs . '</h5>
      <p class="card-text">' . $beschrijving . '</p>
    </div>
    <div class="card-footer">
        <a href="dropdown-toggle" class="btn btn-info" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Zet in winkelmand<img src="./img/shoppingcart.png" class="profielklein" alt="inloggen/registreren">
        </a>
        <br>

    </div>
  </div>
</div>';
}
echo $tbody;
?>




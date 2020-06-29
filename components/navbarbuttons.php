<!--profiel, wanneer je niet ingelogd bent kan je inloggen of registreren. Anders zie je bestellingen en instellingen-->
<?php 
            session_start();
  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
$buttons = '<a class="dropdown-item" href="./index.php?content=login">Inloggen</a>
        <a class="dropdown-item" href="./index.php?content=register">Account aanmaken</a>';
} 
else {
    $buttons = 
    '<a class="dropdown-item" href="#">Mijn bestellingen</a>
        <a class="dropdown-item" href="#">Instellingen</a>
        <a class="dropdown-item" href="../phpscripts/logout.php">Uitloggen</a>';
}
?>
<div class="dropdown profielklein btn-nav">
    <a href="dropdown-toggle" class="btn btn-light " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="./img/profile.png" class="profielklein" alt="inloggen/registreren">
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <?php print $buttons;?>
    </div>
    <a class="btn btn-light" type="button"  aria-haspopup="true" aria-expanded="false">
        <img src="./img/shoppingcart.png" class="profielklein">
    </a>
</div>
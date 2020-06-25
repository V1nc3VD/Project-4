<?php 
if (empty($_POST["email"])) {
    header("Location: ./index.php?content=message&alert=no-email");
}

else if (empty($_POST["name"])) {
    print("geen naam ingevoerd");

} 

else if (empty($_POST["password"])) {
    print("geen wachtwoord ingevoerd");
}



else {

    include("./connect_db.php");
    include("./functions.php");
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    $passwordverify = sanitize($_POST["password-verify"]);
    $name = sanitize($_POST["name"]);

    $sql = "SELECT * FROM `users` WHERE `email` = '{$email}'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)) {
        header("Location: ../index.php?content=register&alert=emailexists");
    }
    else if ($password != $passwordverify) {
        header("Location: ../index.php?content=register&alert=otherpassword");
    }
    else {
        header("Location: ../index.php?content=register&alert=success");
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
        $sql = "INSERT INTO `USERS` (`email`, `password`, `name`,`userrole`)
                VALUES ('{$email}', '{$password_hash}', '{$name}', 'customer')";

                mysqli_query($conn, $sql);
    }
}



?>
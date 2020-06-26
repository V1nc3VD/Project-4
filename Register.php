<div class="userform container">
    <h3 class="registreren text-center">Registreren</h2>
        <hr>
        <form action="./phpscripts/register_script" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Je email address</label>
                <input type="email" class="form-control registreerinput" id="email" name="email" aria-describedby="email" placeholder="">
                <label>Naam</label>
                <input type="text" class="form-control registreerinput" id="name" name="name" aria-describedby="name" placeholder="">

                <label>Kies een goed wachtwoord</label>
                <input type="password" class="form-control registreerinput" id="password" name="password" aria-describedby="password" placeholder="">
                <label>Hetzelfde wachtwoord</label>
                <input type="password" class="form-control registreerinput" id="password-verify" name="password-verify" aria-describedby="password" placeholder="">
                <div class="formbottom">
                        <button type="submit" class="btn btn-primary submitregister">Account aanmaken</button>
                        <a href="./index.php?content=login">Ik heb al een account</a>
                        <?php echo $alertmessage; ?>
                    </div>
            </div>
        </form>
</div>
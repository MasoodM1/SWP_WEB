<?php
    // Lesen der Daten aus dem Request
    $benutzer=$_REQUEST["user"];
    $passwort=$_REQUEST["pwd"];
?>
<html>
    <body>
        <p> der Benutzer
        <?php echo $benutzer ?>
        Hat sich mit dem Passwort
        <?php echo $passwort ?>
        angemenldet!
        </p>
    </body>
</html>
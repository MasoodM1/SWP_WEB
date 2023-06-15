<?php
// Parameter holen
$params = json_decode($_REQUEST["params"], false);

// Verbindung herstellen
$connection = new mysqli("localhost", "root", "", "artikeldb");
if ($connection->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $connection->connect_error);
}
// die Daten holen und JSON erzeugen:
$stmt = $connection->prepare(
    "SELECT artikelid, kopfzeile, zusammenfassung " .   //
    " FROM artikel WHERE themengebietid = ?"            //
);                                                      //
$stmt->bind_param("i", $params->id);                    // nur dieser teil ändert sich
$stmt->execute();
$resultset = $stmt->get_result();
$all = $resultset->fetch_all(MYSQLI_ASSOC);
echo json_encode($all);
?>




// Clientteil: asynchron
<script>
    function show_artikel(idvalue) {
        // Objekt mit Parameterwerten als Attribute aufbauen
        let obj = {
            id: idvalue
        };
        // und in einen String umwandeln
        let params = JSON.stringify(obj);
        // AJAX Request aufbauen
        let x = new XMLHttpRequest();
        // Was ist zu tun, wenn die Daten vom Server kommen
        x.onload = function () {
            let arr = JSON.parse(this.responseText);
            document.getElementById("artikeldiv").innerHTML =
                formatResultAsHtmlDefinitionList(arr);
        };

        // Wer am Server liest die Daten
        // true -> asynchrone Abarbeitung
        x.open("POST", "holeartikel3.php", true);
        // Definiert das Format der Parameter beim Senden
        x.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
        // Request senden mit Parameter Werten
        x.send("params=" + params);
    }

    // Nun  als HTLM Definitionlist formatieren
    function formatResultAsHtmlDefinitionList(arr) {
        let s = "<dl>";
        for (let i = 0; i < arr.length; i++) {
            let obj = arr[i];
            s += "<dt >" + obj.kopfzeile + "</dt>";
            s += "<dd>" + obj.zusammenfassung + "</dd>";
        }
        return s + "</dl>";
    }

</script>




// Clientteil: synchron | blockierend
<script>
    function show_artikel(idvalue) {

        // Objekt mit Parameterwerten als Attribute aufbauen
        let obj = { id: idvalue };
        // und in einen String umwandeln
        let params = JSON.stringify(obj);


        // Hier gehts los
        let x = new XMLHttpRequest();

        // Wer am Server liest die Daten
        x.open("POST", "holeartikel3.php", false);
        // Definiert das Format der Parameter beim Senden
        x.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
        x.send("params=" + params);  // blockiert

        let arr = JSON.parse(x.responseText);
        document.getElementById("artikeldiv").innerHTML =
            formatResultAsHtmlDefinitionList(arr);
    }
            ...
</script>
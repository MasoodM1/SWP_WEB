<?php
session_start();

$servername = "localhost";
$database = "minishop";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);

$ArtID = $_GET["ArtID"];
$UserID = $_SESSION["userid"];
$Anzahl = $_REQUEST["anzahl"];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$getPreis = "SELECT Preis FROM Artikel WHERE ID = $ArtID";
$PreisResult = mysqli_query($conn, $getPreis);
if (mysqli_num_rows($PreisResult) > 0) {
    $PreisRow = mysqli_fetch_assoc($PreisResult);
    $Preis = $PreisRow["Preis"];

    $sql = "INSERT INTO Warenkorb (UserID, ArtID, Preis, Anzahl) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $UserID, $ArtID, $Preis, $Anzahl);
    $stmt->execute();
    $stmt->close();

}

$conn->close();
header("Location: Startseite.php");
?>
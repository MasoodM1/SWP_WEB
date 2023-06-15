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

    // Check if the product is already in the shopping cart
    $checkCart = "SELECT Anzahl FROM Warenkorb WHERE UserID = $UserID AND ArtID = $ArtID";
    $cartResult = mysqli_query($conn, $checkCart);

    if (mysqli_num_rows($cartResult) > 0) {
        $cartRow = mysqli_fetch_assoc($cartResult);
        $existingQuantity = $cartRow["Anzahl"];
        $newQuantity = $existingQuantity + 1;

        // Update the quantity of the existing product in the shopping cart
        $updateCart = "UPDATE Warenkorb SET Anzahl = $newQuantity WHERE UserID = $UserID AND ArtID = $ArtID";
        mysqli_query($conn, $updateCart);
    } else {
        // Insert the product into the shopping cart with quantity 1
        $sql = "INSERT INTO Warenkorb (UserID, ArtID, Preis, Anzahl) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $UserID, $ArtID, $Preis, $Anzahl);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();
header("Location: Startseite.php");
?>
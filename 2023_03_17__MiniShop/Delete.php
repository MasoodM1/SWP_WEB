<?php
session_start();
$ArtID = $_GET["ArtID"];   // Lesen der Parameter
$UserID = $_SESSION["userid"];

// Schreiben in die DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "minishop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM warenkorb WHERE UserID = $UserID AND ArtID = $ArtID";
if ($conn->query($sql) === TRUE) {
    // Redirect to datenholen.php page
    header("Location: WarenkorbSeite.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
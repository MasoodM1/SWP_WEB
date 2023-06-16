<?php
session_start();

$servername = "localhost";
$database = "minishop";
$username = "root";
$password = "";

// Establish a secure connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve UserID from the session variable, if it exists
$UserID = $_SESSION["userid"];

// Fetch the price of the item from the database
$getWaren = "SELECT * FROM Warenkorb WHERE UserID = ?";
$stmt = mysqli_prepare($conn, $getWaren);
mysqli_stmt_bind_param($stmt, "i", $UserID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ArtID = $row["ArtID"];
        $ArtName = $row["ArtName"];
        $Preis = $row["Preis"];
        $Bild = $row["Bild"];
        $Anzahl = $row["Anzahl"];
        // Insert a new item into the shopping history
        $insertQuery = "INSERT INTO gekaufteartikel (UserID, ArtID, ArtName, Preis, Bild, Anzahl, Zeitpunkt) VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "iisisi", $UserID, $ArtID, $ArtName, $Preis, $Bild, $Anzahl);
        mysqli_stmt_execute($insertStmt);
        mysqli_stmt_close($insertStmt);
    }
}
$row = mysqli_fetch_assoc($result);
$delete = "DELETE FROM Warenkorb WHERE UserID = ?";
$deleteStmt = mysqli_prepare($conn, $delete);
mysqli_stmt_bind_param($deleteStmt, "i", $UserID);
mysqli_stmt_execute($deleteStmt);
mysqli_stmt_close($deleteStmt);

// Close the database connection
mysqli_close($conn);

// Redirect the user to the start page
header("Location: Startseite.php");
?>
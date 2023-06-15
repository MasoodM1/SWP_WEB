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

// Retrieve and sanitize input values
$ArtID = $_GET["ArtID"];
$Anzahl = $_REQUEST["anzahl"];

// Retrieve UserID from the session variable, if it exists
$UserID = $_SESSION["userid"];

// Fetch the price of the item from the database
$getWare = "SELECT * FROM Artikel WHERE ID = ?";
$stmt = mysqli_prepare($conn, $getWare);
mysqli_stmt_bind_param($stmt, "i", $ArtID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $ArtName = $row["ArtName"];
    $Preis = $row["Preis"];
    $Bild = $row["Bild"];

    // Check if the item already exists in the shopping cart
    $checkCartQuery = "SELECT * FROM Warenkorb WHERE UserID = $UserID AND ArtID = $ArtID";
    $checkCartStmt = mysqli_query($conn, $checkCartQuery);
    //$checkCartResult = mysqli_fetch_assoc($checkCartStmt);

    if (mysqli_num_rows($checkCartStmt) > 0) {
        // Update the quantity of the existing item in the shopping cart
        $updateQuery = "UPDATE Warenkorb SET Anzahl = Anzahl + ? WHERE UserID = ? AND ArtID = ?";
        $updateStmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, "iii", $Anzahl, $UserID, $ArtID);
        mysqli_stmt_execute($updateStmt);
        mysqli_stmt_close($updateStmt);
    } else {
        // Insert a new item into the shopping cart
        $insertQuery = "INSERT INTO Warenkorb (UserID, ArtID, ArtName, Preis, Bild, Anzahl) VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "iisisi", $UserID, $ArtID, $ArtName, $Preis, $Bild, $Anzahl);
        mysqli_stmt_execute($insertStmt);
        mysqli_stmt_close($insertStmt);
    }
}

// Close the database connection
mysqli_close($conn);

// Redirect the user to the start page
header("Location: Startseite.php");
?>

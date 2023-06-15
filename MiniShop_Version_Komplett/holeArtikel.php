<?php
$servername = "localhost";
$database = "minishop";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

$params = json_decode($_REQUEST["params"], false);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt=$conn->prepare("SELECT ID, ArtName, Preis, Bild from Artikel WHERE KatID = ?");
$stmt->bind_param("i", $params->id);
$stmt->execute();
$resultset = $stmt->get_result();
$all = $resultset->fetch_all(MYSQLI_ASSOC);
echo json_encode($all);
$conn->close();
?>
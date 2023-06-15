<?php
$vname = $_REQUEST["vname"];
$nname = $_REQUEST["nname"];
$e_mail = $_REQUEST["e-mail"];

// Schreiben in die DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "2023_02_10_Prj_Web_NEWSLETTER";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "insert into user_data(vname,nname,e_mail) values ('$vname','$nname','$e_mail')";
$result = $conn->query($sql);

$conn->close();

// Seite datenholen.php anzeigen
header("Location: datenholen1.php");
?>
<?php
$username = $_REQUEST["username"];   // Lesen der Parameter
$pwd = $_REQUEST["pwd"];
$email = $_REQUEST["email"];


$servername = "localhost";
$usernamedb = "root";
$password = "";
$dbname = "minishop";


$conn = new mysqli($servername, $usernamedb, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "insert into user (username, pwd, email) values ('$username','$pwd','$email')";
$result = $conn->query($sql);

$conn->close();

header("Location: Login.html");
?>
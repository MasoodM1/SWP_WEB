<?php
session_start();
$servername = "localhost";
$database = "minishop";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username1 = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['pwd']);

$sql = "SELECT * FROM user WHERE username = '$username1' AND email = '$email' AND pwd = '$password'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $getUserID = "SELECT ID FROM user where username = '$username1' AND email = '$email' AND pwd = '$password'";
    $userid = mysqli_query($conn, $getUserID);
    $UserID = mysqli_fetch_assoc($userid);
    $_SESSION["userid"] = $UserID["ID"];
    header("Location: Startseite.php");
} else {
    header("Location: Login!.html");
}
$conn->close();
?>
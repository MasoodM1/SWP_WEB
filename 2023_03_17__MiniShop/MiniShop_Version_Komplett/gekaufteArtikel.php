<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>SigmaElectronics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --bs-blue: #1505fa
        }

        .header div {
            background-color: var(--bs-blue)
        }

        .h4Inline {
            float: right;
        }

        .header div {
            color: white;
            background-color: #5F9EA0;
        }

        nav {
            margin: 27px auto 0;

            position: sticky;
            top: 30px;
            width: 590px;
            height: 50px;
            background-color: #34495e;
            border-radius: 8px;
            font-size: 0;
        }

        nav a {
            line-height: 50px;
            height: 100%;
            font-size: 15px;
            display: inline-block;
            position: relative;
            z-index: 1;
            text-decoration: none;
            text-transform: uppercase;
            text-align: center;
            color: white;
            cursor: pointer;
        }

        nav .animation {
            position: absolute;
            height: 100%;
            top: 0;
            z-index: 0;
            transition: all .5s ease 0s;
            border-radius: 8px;
        }

        a:nth-child(1) {
            width: 100px;
        }

        a:nth-child(2) {
            width: 110px;
        }

        a:nth-child(3) {
            width: 100px;
        }

        a:nth-child(4) {
            width: 160px;
        }

        a:nth-child(5) {
            width: 120px;
        }

        nav .start-home,
        a:nth-child(1):hover~.animation {
            width: 100px;
            left: 0;
            background-color: #5F9EA0;
        }

        nav .start-about,
        a:nth-child(2):hover~.animation {
            width: 110px;
            left: 100px;
            background-color: #5F9EA0;
        }

        nav .start-blog,
        .dropdown:nth-child(3):hover~.animation {
            width: 100px;
            left: 210px;
            background-color: #5F9EA0;
        }

        nav .start-portefolio,
        a:nth-child(4):hover~.animation {
            width: 160px;
            left: 310px;
            background-color: #5F9EA0;
        }

        nav .start-contact,
        a:nth-child(5):hover~.animation {
            width: 120px;
            left: 470px;
            background-color: #5F9EA0;
        }

        body {
            font-size: 12px;
            font-family: sans-serif;
            background: #2c3e50;
        }

        a:hover {
            text-decoration: none;
            color: white;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #34495e;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .navlink:hover {
            background-color: #5F9EA0;
        }

        .Artikel {
            color: white;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.3);
            min-height: 550px;
        }

        .Artikel img {
            max-height: 50%;
            max-width: 50%;
            min-height: 300px;
            min-width: 300px;
        }

        .Artikel h5,
        h3, h6 {
            padding: 10px;
        }

        .btn {
            background-color: #5F9EA0;
            color: white;
            min-width: 50px;
            min-height: 50px;
            max-height: 50px;
        }

        .btn:hover {
            background-color: white;
            color: #5F9EA0;
        }

        input {
            border-color: black;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            min-height: 50px;
            max-width: 50px;
            text-align: center;
            font-size: 15px;
        }
    </style>
</head>



<body>
    <div class="header">
        <div class="container-fluid p-5 text-center">
            <img class="img-fluid" src="Bilder/Logo1.png" width="10%" height="10%">
        </div>
    </div>

    <nav>
        <a href="Startseite.php">Home</a>
        <a href="WarenkorbSeite.php">Cart</a>
        <div class="dropdown">
            <a href="#">Categorys</a>
            <div class="dropdown-content">
                <?php
                $servername = "localhost";
                $database = "minishop";
                $username = "root";
                $password = "";

                $conn = mysqli_connect($servername, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "SELECT ID, KatName from Kategorie";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<a href='Startseite.php' class = 'navlink' onclick='showArticle(" . $row["ID"] . ")'>" . $row["KatName"] . "</a>";
                    }
                }

                $conn->close();
                ?>
            </div>
        </div>
        <a href="gekaufteArtikel.php">Bestellungen</a>
        <a href="Logout.php">Logout</a>
        <div class="animation start-portefolio"></div>
    </nav>

    <div class="container mt-5">
        <div id="artikeldiv" class="row">
            <?php
            $servername = "localhost";
            $database = "minishop";
            $username = "root";
            $password = "";

            $conn = mysqli_connect($servername, $username, $password, $database);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $UserID = $_SESSION["userid"];

            $getWaren = "SELECT * FROM gekaufteartikel WHERE UserID = ?";
            $stmt = mysqli_prepare($conn, $getWaren);
            mysqli_stmt_bind_param($stmt, "i", $UserID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-6 col-sm-12 text-center'>";
                    echo "<div class='Artikel'>";
                    echo "<h3>" . $row["ArtName"] . "</h3>";
                    echo "<img src='" . $row["Bild"] . "' alt='" . $row["ArtName"] . "' width=50%>";
                    echo "<h6>Preis: " . $row["Preis"] . "€</h6>";
                    echo "<h5>Preis: " . $row["Preis"] * $row["Anzahl"] . "€ gesammt</h5>";
                    echo "<h6>Stück: " . $row["Anzahl"] . "</h6>";
                    echo "<h5>Gekauft am: " . $row["Zeitpunkt"] . "</h5>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            $conn->close();
            ?>
        </div>
    </div>

</body>

</html>
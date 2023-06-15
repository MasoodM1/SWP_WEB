
<html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .h4Inline {
            float: right;
        }

        .navbar {
            position: sticky;
            z-index: 100;
            top: 10px;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 30px;
            background-color: #446383;
            border-radius: 2em;
        }

        .dropbtn {
            background-color: #00000000;
            color: rgb(255, 255, 255);
            padding: 10px 16px;
            border: none;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            min-width: 160px;
            z-index: 1;
        }

        .dropdown-content a {
            background-color: #446383;
            padding: 10px 10px;
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #000000;
            color: rgb(255, 247, 0);
        }

        .nav-link {
            display: block;
            color: rgb(255, 255, 255);
            padding: 10px 16px;

        }

        .nav-link:hover {
            background-color: rgb(0, 0, 0);
            color: rgb(238, 255, 0) !important;
            margin: 0px;
        }
    </style>

  </head>
<body>

<div class="head">
        <div class="container-fluid p-2 bg-primary text-white">
            <img src="HTL_LOGO_und_Name.png" width="30%">
            <h6 class="h4Inline">Ausbildung mit Mehrwert</h6>
        </div>
    </div>

    <nav class="navbar navbar-expand-sm">

        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="_2022_12_16__Bootstramp_Projekt.html">Startseite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://htlinn.ac.at/">Home</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="dropbtn">Abteilungen</button>
                        <div class="dropdown-content">
                            <a class="nav-link"
                                href="https://htlinn.ac.at/ausbildung/elektronik-technische-informatik/hoehere-abteilung">Elektronik</a>
                            <a class="nav-link"
                                href="https://htlinn.ac.at/ausbildung/elektrotechnik-prozessinformatik/hoehere-abteilung">Elektrotechnik</a>
                            <a class="nav-link"
                                href="https://htlinn.ac.at/ausbildung/maschinenbau-robotic-centre/hoehere-abteilung">Maschinenbau</a>
                            <a class="nav-link"
                                href="https://htlinn.ac.at/ausbildung/wirtschaftsingenieure-betriebsinformatik/hoehere-abteilung">Wirtschaftsingenieure</a>
                            <a class="nav-link"
                                href="https://htlinn.ac.at/ausbildung/biomedizin-gesundheitstechnik/hoehere-ausbildung">Biomedizin</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://htlinn.ac.at/schule/htl-anichstrasse/kontakt">Kontakt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://htlinn.ac.at/schule/htl-anichstrasse/downloads">Downloads</a>
                </li>
            </ul>
            <div class="container-fluide">
                <a class="container-fluide" href="https://www.youtube.com/@htlinnit1287"><img src="1384060.png"
                        width="40px"></a>
                <a class="container-fluide" href="https://www.instagram.com/masood2.0/"><img
                        src="Instagram_icon.png.webp" width="35px"></a>
            </div>
        </div>

    </nav>

    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-6 col-md-4 text-center">
                <div class="left">
                  <h2>Gespeicherte Daten</h2>  
                  <br>
                  <?php
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

                  $sql = "SELECT id,vname,nname, e_mail FROM user_data";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    echo "<ul>";
                    while($row = $result->fetch_assoc()) {
                      // output data of each row"
                      echo"<li>";
                      echo"<table>";
                      echo"<tr>";
                      echo "<td>" . $row["id"] .  "</td>";
                      echo "<td>" . " | " . "</td>";
                      echo "<td>  " . $row["vname"] . "</td>";
                      echo "<td>" . " | " . "</td>";
                      echo "<td>  " . $row["nname"] . "</td>";
                      echo "<td>" . " | " . "</td>";
                      echo "<td>" . $row["e_mail"] . "</td>";
                      echo "<td>" . " | " . "</td>";
                      echo "<td> <a href='delete1.php?id=" . $row["id"] ."'>Löschen</a></td>";
                      echo"</tr>";
                      echo "</table>";
                      echo"</li>";
                  }
                    echo "</ul>";
                  } else {
                    echo "<h5>0 User-Daten gefunden</h5>";
                  }
                  $conn->close();
                  ?>
                  <br>
                  <h5><a href="Newsletter.html">Neuer Eintrag</a></h5>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 text-center">
                <div class="right">
                    <h4>Datenschutz</h4>
                    <br>
                    <p>Die Sicherheit ihrer Daten ist uns sehr wichtig
                    und wird deshalb nicht an Drittanbieter weiter gegeben oder damit gearbeitet.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

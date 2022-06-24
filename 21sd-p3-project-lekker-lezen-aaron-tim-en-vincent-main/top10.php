<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- maakt verbinding met de database en haalt de gegevens op -->
        <?php
    include "navbar.php";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lekkerlezen";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?> <script>
            console.log("connection succesfull")
        </script>
    <?php
    } catch (PDOException $e) {
        echo "Connectie gefaald: " . $e->getMessage();
    }

    $statement = $conn->prepare("SELECT auteur, naam, uitgever, foto, genre, prijs, beoordeling FROM top10boeken ORDER BY beoordeling DESC ");
    $statement->execute();
    $tables = $statement->fetchAll();
    //print de divs met boeken cover, naam, titel, uitgever, auteur en prijs weer
    foreach ($tables as $table) {
    ?>
        <div class="bookpadding">
            <div class="bookcontainer">
                <div class="bookbox">
                    <div class="bookcover">
                        <img src="<?php print_r($table["foto"]);?>" class="bookimage">
                    </div>
                    <div class="bookinfo">
                        <div class="bname">
                            <?php
                            print_r($table["naam"]);
                            ?>
                        </div>
                        <div class="bauthor">
                        <?php
                            print_r($table["auteur"]);
                            ?>
                        </div>
                        <div class="bstore">
                            <?php
                            echo "Uitgever: ";
                            print_r($table["uitgever"]);
                            ?>
                        </div>
                        <div class="bprice">
                            <?php
                            echo "€";
                            print_r($table["prijs"]);
                            ?>
                        </div>
                        <div class="beoordeling">
                        <?php
                        // telt af met de beoordeling totdat hij nul is
                            while ($table["beoordeling"] > 0){
                                if ($table["beoordeling"] != 0.5){
                                    echo "<div style='float: left; display: inline;'><img src='img/FullStar.png' style='width: 10px; height: 10px;'></div>";
                                    $table["beoordeling"] = $table["beoordeling"] - 1;
                                }
                                if ($table["beoordeling"] == 0.5){
                                    echo "<div style='float: left; display: inline;'><img src='img/HalfStar.png' style='width: 10px; height: 10px;'></div>";
                                    $table["beoordeling"] = $table["beoordeling"] - 0.5;
                                }
                            }

                            ?>
                            <div class="star" style="display: none;">
                                <img src="img/FullStar.png" style="height: 10px; width: 10px; float:left">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    ?>
</body>
</html>
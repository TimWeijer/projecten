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
    <?php
    include "navbar.php";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lekkerlezen";

    // pdo connection
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

    // function die alle prijzen uit de database van laag naar hoog sorteert
    $statement = $conn->prepare("SELECT auteur, naam, uitgever, genre, foto, prijs, genre FROM boekeninfo ORDER BY prijs ASC");
    $statement->execute();
    $tables = $statement->fetchAll();
    ?>

    <button onclick="location.href='priceasc.php'">Prijs laag-hoog</button>
    <button onclick="location.href='pricedesc.php'">Prijs hoog-laag</button><br>

    <?php
    foreach ($tables as $table) {
    ?>
        <div class="bookpadding">
            <div class="bookcontainer">
                <div class="bookbox">
                    <div class="bookcover">
                        <img src="<?php print_r($table["foto"]); ?>" class="bookimage">
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
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "navbargenre.php";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lekkerlezen";
    // pdo connectie
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
    // haald alle boeken op
    $statement = $conn->prepare("SELECT auteur, naam, uitgever, genre, foto, prijs, genre FROM boekeninfo ORDER BY prijs ASC");
    $statement->execute();
    $tables = $statement->fetchAll();
    // haalt alle boeken met de bepaalde genre op
    function find_book_by_title(\PDO $pdo, string $keyword): array
    {
        $pattern = '%' . $keyword . '%';

        $sql = 'SELECT id, naam, auteur, foto, genre, prijs, uitgever, genre
    FROM boekeninfo 
    WHERE genre LIKE :pattern';

        $statement1 = $pdo->prepare($sql);
        $statement1->execute([':pattern' => $pattern]);
        return $statement1->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>

    <button onclick="location.href='../priceasc.php'">Prijs laag-hoog</button>
    <button onclick="location.href='../pricedesc.php'">Prijs hoog-laag</button><br>

    <?php
    // zet alle boeken met de genre roman neer
    $books = find_book_by_title($conn, "roman");
    foreach ($books as $book) {
    ?>
        <div class="bookpadding">
            <div class="bookcontainer">
                <div class="bookbox">
                    <div class="bookcover">
                        <img src="<?php print_r($book["foto"]); ?>" class="bookimage">
                    </div>
                    <div class="bookinfo">
                        <div class="bname">
                            <?php
                            print_r($book["naam"]);
                            ?>
                        </div>
                        <div class="bauthor">
                            <?php
                            print_r($book["auteur"]);
                            ?>
                        </div>
                        <div class="bstore">
                            <?php
                            echo "Uitgever: ";
                            print_r($book["uitgever"]);
                            ?>
                        </div>
                        <div class="bprice">
                            <?php
                            echo "€";
                            print_r($book["prijs"]);
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
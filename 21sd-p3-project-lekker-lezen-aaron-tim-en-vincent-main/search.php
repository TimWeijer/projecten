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
    ?>
        <script>
            console.log("connection succesfull")
        </script>
    <?php
    } catch (PDOException $e) {
        echo "Connectie gefaald: " . $e->getMessage();
    }

    // haalt alle boeken op
    $statement = $conn->prepare("SELECT auteur, naam, uitgever, genre, foto, prijs, genre FROM boekeninfo");
    $statement->execute();
    $tables = $statement->fetchAll();

    $search = $_POST["userinput"];

    // function waarom je kan zoeken op titel
    function find_book_by_title(\PDO $pdo, string $keyword): array
    {
        $pattern = '%' . $keyword . '%';

        $sql = 'SELECT id, naam, auteur, foto, genre, prijs, uitgever, genre
        FROM boekeninfo 
        WHERE naam LIKE :pattern';

        $statement = $pdo->prepare($sql);
        $statement->execute([':pattern' => $pattern]);

        return  $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // function waarmee je kan zoeken op auteur
    function find_book_by_author(\PDO $pdo, string $keyword): array
    {
        $pattern = '%' . $keyword . '%';

        $sql = 'SELECT id, naam, auteur, foto, genre, prijs, uitgever, genre
        FROM boekeninfo 
        WHERE auteur LIKE :pattern';

        $statement = $pdo->prepare($sql);
        $statement->execute([':pattern' => $pattern]);

        return  $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // function waarmee je kan zoeken op publisher (not working yet)
    function find_book_by_publisher(\PDO $pdo, string $keyword): array
    {
        $pattern = '%' . $keyword . '%';

        $sql = 'SELECT id, naam, auteur, foto, genre, prijs, uitgever, genre
        FROM boekeninfo 
        WHERE uitgever LIKE :pattern';

        $statement = $pdo->prepare($sql);
        $statement->execute([':pattern' => $pattern]);

        return  $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>

    <?php
    // find books with the title matches 'es'
    $books = find_book_by_title($conn, $search);
    $authors = find_book_by_author($conn, $search);
    $publisher = find_book_by_publisher($conn, $search);

    // for each loop die alle boeken langs gaat afhankelijk van welke functie je gebruikt hebt
    if (empty($books)) {
        foreach ($authors as $author) {
    ?>
            <div class="bookpadding">
                <div class="bookcontainer">
                    <div class="bookbox">
                        <div class="bookcover">
                            <img src="<?php print_r($author["foto"]); ?>" class="bookimage">
                        </div>
                        <div class="bookinfo">
                            <div class="bname">
                                <?php
                                print_r($author["naam"]);
                                ?>
                            </div>
                            <div class="bauthor">
                                <?php
                                print_r($author["auteur"]);
                                ?>
                            </div>
                            <div class="bstore">
                                <?php
                                echo "Uitgever: ";
                                print_r($author["uitgever"]);
                                ?>
                            </div>
                            <div class="bprice">
                                <?php
                                echo "€";
                                print_r($author["prijs"]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
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
                                echo "Uitgever:";
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
    } 
    ?>





</body>

</html>
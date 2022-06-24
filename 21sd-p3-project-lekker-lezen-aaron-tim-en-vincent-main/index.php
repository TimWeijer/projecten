<?php 
    session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
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
 
   
    // haald alle boeken op uit de database
    $statement = $conn->prepare("SELECT auteur, naam, uitgever, foto, genre, prijs, beoordeling FROM boekeninfo");
    $statement->execute();
    $tables = $statement->fetchAll();
    // haald de genre's op zodat je kan filteren op genre
    $array = array();
    $pattern = '%%';
    $statement1 = $conn->prepare("SELECT genre FROM boekeninfo WHERE genre LIKE :pattern ORDER BY prijs ASC");
    $statement1->execute([':pattern' => $pattern]);
    $tables1 = $statement1->fetchAll();
    // zet alle gekregen genre's in een array en filtered de duplicates
    foreach ($tables1 as $table1) {
        array_push($array, $table1["genre"]);
    }
    $filteredarray = array_unique($array);
    $encode = json_encode($filteredarray);
    $decode = json_decode($encode, true);
    
    ?>

<!-- buttons voor order op prijs -->
<button onclick="location.href='priceasc.php'">Prijs laag-hoog</button>
<button onclick="location.href='pricedesc.php'">Prijs hoog-laag</button><br>

<!-- dropdown menu voor sorteren op category -->
<div class="dropdown">
	  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		Genres
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <?php
        foreach ($decode as $array => $vararry) {
            echo "<li><a class='dropdown-item' href='";
            print_r("genresites/" . $vararry . ".php");
            echo "'>";
            print_r($vararry);
            echo "</a></li>";
        }
        ?>
	  </ul>
	</div>
<!-- print de divs met boeken cover, naam, titel, uitgever, auteur en prijs weer -->
    <?php
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
                            <div class="star">
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
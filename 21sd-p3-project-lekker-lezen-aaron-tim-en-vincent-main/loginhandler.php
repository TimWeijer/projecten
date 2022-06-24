<link rel="stylesheet" href="css/loginhandler.css">
<?php 
    if(!isset($_POST["email"])){
        header("location: login.php");
    }
?>
<h1>admin page</h1>
<div id="loginstatus">
    <?php
        if($_POST["email"] == "admin@gmail.com" && $_POST["password"] == "12345") {
            echo "Succesvol ingelogd!";
        } else {
            echo "you are not logged in";
        }
    ?>
</div>
<?php
// maakt verbinding met database
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

// functie die de variabelen van de form pakt en ze upload naar de database
function set_books($naam, $auteur, $uitgever, $foto, $genre, $prijs, $beoordeling, $conn) {
    $sql = "INSERT INTO boekeninfo (naam, auteur, uitgever, foto, genre, prijs, beoordeling) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$naam, $auteur, $uitgever, $foto, $genre, $prijs, $beoordeling]);
}
?>
<!-- form waar werknemers informatie over het boek kunnen plaatsen -->
<div id="form">
    <form method="POST">
        <br>
        <label for="auteur">auteur:</label>
        <br>
        <input type="text" name="auteur" required>
        <br>
        <label for="boeknaam">naam boek:</label>
        <br>
        <input type="text" name="boeknaam" id="boeknaam" required>
        <br>
        <label for="uitgever">uitgever:</label>
        <br>
        <input type="text" name="uitgever" id="uitgever" required>
        <br>
        <label for="foto">foto: (link naar bestandslocatie)</label>
        <br>
        <input type="text" name="foto" id="foto" required>
        <br>
        <label for="genre">genre:</label>
        <br>
        <input type="text" name="genre" id="genre" required>
        <br>
        <label for="prijs">prijs:</label>
        <br>
        <input type="text" name="prijs" id="prijs" required>
        <br>
        <label for="beoordeling">beoordeling: (1-5)</label>
        <br>
        <input type="number" name="beoordeling" id="beoordeling" required>
        <br>
        <button type="submit" name="submit">submit</button>
    </form>
</div>
<a href="index.php">
<div id="logout">
logout
</div>
</a>
<?php
// checkt of de form ingevuld is en plaats de waarden van de form in variabelen
if (isset($_POST["genre"])) {
    $auteur = $_POST["auteur"];
    $boeknaam = $_POST["boeknaam"];
    $uitgever = $_POST["uitgever"];
    $foto = $_POST["foto"];
    $genre = $_POST["genre"];
    $prijs = $_POST["prijs"];
    $beoordeling = $_POST["beoordeling"];
    set_books($boeknaam, $auteur, $uitgever, $foto, $genre, $prijs, $beoordeling, $conn);
}
?>
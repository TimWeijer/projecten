<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(255, 255, 255, 0.8);">
    <div class="mx-auto px-10 container-fluid">
        <ul class="navbar-nav mr-auto"> 
            <li class="nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="../../top10.php">top 10 boeken</a></li>
            <li class="nav-item"><a class="nav-link" href="../../login.php">login</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">contact</a></li>
        </ul>
        <div>
            <form method="POST" action="search.php">
                <input type="text" placeholder="zoeken.." name="userinput">
                <button type="submit" name="submit">Zoeken</button>
            </form>
        </div>
    </div>
</nav>    
</body>
</html>

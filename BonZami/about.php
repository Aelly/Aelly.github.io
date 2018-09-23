<?php session_start() ?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main2.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <title>About</title>
</head>

<body>

</body>

<?php
if(isset($_SESSION['pseudo'])){
    include 'menu_authenticated.php';
}
else{
    include 'menu_unauthenticated.php';
}
?>

<div class="container">
    <div class="row">
        <div class="center-block">
            <p>
                Site créé dans le cadre d'un projet personnel visant à améliorer mes compétences en web development. Ce site utilise le framework BootStrap.
                L'intégralité du code source ainsi que mes autres projets sont disponibles sur mon git (https://github.com/Aelly/sitePerso) dans le dossier BonZami.
            </p>
            <p>
                Créé en juin 2018 par Aely
            </p>
            <p>
                Contact: AelyContact@gmail.com
            </p>
            </div>
        </div>
    </div>
    </html>

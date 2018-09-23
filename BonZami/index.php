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
    <title>Accueil</title>
</head>

<body>


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
                <h1>Qu'est ce que BonZami ?</h1>
                <p><b>BonZami</b> est un site permettant de gérer les comptes d'un groupe d'ami. Il peut être utilisé lors d'un voyage ou d'une sortie et a pour but d'équilibrer les dépenses de chaque membre du groupe.</p>
                <p>Lors du voyage chaque dépense est noté sur le site ainsi que la personne ayant payé, tout au long du voyage on peut donc suivre les dépenses de chaque personne.</p>
                <p>A la fin du voyage on calcule pour vous les échanges permettant d'équilibrer les dépenses de tout le monde</p>

                <h1>Inscription</h1>
                <p>
                    Rapide et gratuite !
                    <!-- https://www.w3schools.com/css/css3_buttons.asp -->
                    <!-- https://www.w3schools.com/howto/howto_css_hero_image.asp -->
                    <div class="block-bouton">
                        <img src="img/mountains.png" alt="Image_inscription" style="width:100%">
                        <button class="btn">M'inscrire</button>
                    </div>
                </p>

                <h1>Comment l'utiliser ?</h1>
                <!-- https://www.w3schools.com/bootstrap/bootstrap_carousel.asp -->
                <div id="HowToUseCarousel" class="carousel slide" >
                    <ol class="carousel-indicators">
                        <li data-target="#HowToUseCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#HowToUseCarousel" data-slide-to="1"></li>
                        <li data-target="#HowToUseCarousel" data-slide-to="2"></li>
                        <li data-target="#HowToUseCarousel" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner" roll="listbox">
                        <div class="carousel-item active">
                            <img class="d-block w-75" src="img/guide1.jpg" alt="Inscription/Connexion">
                            <div class="carousel-caption">
                                <h3>1.</h3>
                                <p>Inscrivez et connectez vous</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-75" src="img/guide2.jpg" alt="Mes_voyages">
                            <div class="carousel-caption">
                                <h3>2.</h3>
                                <p>Créez et sélectionez votre voyage</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-75" src="img/guide3.jpg" alt="Participant/Paiement">
                            <div class="carousel-caption">
                                <h3>3.</h3>
                                <p>Ajoutez les participants et les paiements</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-75" src="img/guide4.jpg" alt="Participant/Paiement">
                            <div class="carousel-caption">
                                <h3>4.</h3>
                                <p>Cliquer sur "calcul des transactions" et effectuez les transactions affichées</p>
                            </div>
                        </div>

                        <a class="carousel-control-prev" href="#HowToUseCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#HowToUseCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>

</html>

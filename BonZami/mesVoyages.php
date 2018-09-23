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
    <title>Mes voyages</title>

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

    <div class="bg">
        <div class="container">
            <div class="row">
                <div class="center-block">
                    <?php echo "<h1>" . $_SESSION['pseudo'] . "</h1>"; ?>
                    <h2>Mes voyages</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <?php
                                try{
                                    $bdd = new PDO('mysql:host=localhost;dbname=BonZami;charset=utf8','root','');
                                }catch(Exception $e){
                                    die('Erreur : '  . $e->getMessage());
                                }
                                $reponse = $bdd->query('SELECT * FROM voyage WHERE id_utilisateur = ' . $_SESSION['id']);

                                while($donnees = $reponse->fetch()){
                                    ?>
                                    <tr onclick="window.location.assign(<?php echo "'" . "voyage.php?pseudo=" . urlencode($_SESSION['pseudo']) . "&amp;nomVoyage=" . urlencode($donnees['nom']) . "'" ?>);" style="cursor: pointer">
                                        <td><?php echo $donnees['nom']; ?></td>
                                    </tr>


                                    <?php
                                }
                                $reponse->closeCursor();
                                ?>
                            </tbody>
                        </table>

                        <script>
                        function click(){
                            alert("Test");
                        }
                        </script>
                    </div>

                    <?php
                    $ID = $_SESSION['id'];
                    $pseudo = $_SESSION['pseudo'];
                    ?>

                    <h2>Créer un nouveau voyage</h2>
                    <form method="post">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom">
                        </div>
                        <button type="submit" >Ok</button>
                    </form>

                </div>
            </div>
        </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

<?php
//Ajout d'un nouveau voyage
if(!empty($_POST['nom'])){
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=BonZami;charset=utf8','root','');
    }catch(Exception $e){
        die('Erreur : '  . $e->getMessage());
    }
    $req = $bdd->prepare('INSERT INTO voyage (nom,id_utilisateur) VALUES (:nom, :id_utilisateur)');
    $req->execute(array(
        'nom' => $_POST['nom'],
        'id_utilisateur' => $_SESSION['id']));
        header("Refresh:0");
    }

    ?>

    </html>

<?php
if(!empty($_POST['pseudo'])){
    //Connexion à la bdd
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=id6713174_bonzami;charset=utf8','id6713174_aely','bonzamibdd10');
    }catch(Exception $e){
        die('Erreur : '  . $e->getMessage());
    }

    //Récupération de l'utilisateur et de son pass haché
    $req = $bdd->prepare('SELECT id, pass FROM membre WHERE pseudo = :pseudo');
    $req->execute(array(
        'pseudo' => $_POST['pseudo']));
        $resultat = $req->fetch();

        //Comparaison de pass envoyé avec la base
        $isPwdCorrect = password_verify($_POST['pwd'],$resultat['pass']);

        if(!$resultat){
            alert("Mauvais pseudo ou mot de passe");
        }else{
            if($isPwdCorrect){
                session_start();
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['pseudo'] = $_POST['pseudo'];
                header('Location: index.php');
            }else{
                alert("Mauvais pseudo ou mot de passe");
            }
        }
    }

    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    ?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main2.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <title>Connexion</title>
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
                <div class="center-block">
                    <h1>Connexion</h1>
                    <form method="post">
                        <div class="form-group">
                            <label for="pseudo">Pseudo: </label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mot de passe:</label>
                            <input type="password" class="form-control" id="pwd" name="pwd">
                        </div>
                        <button type="submit">Ok</button>
                    </form>
                </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>


    </html>

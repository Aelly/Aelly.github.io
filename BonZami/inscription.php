<?php session_start(); ?>
<!DOCTYPE html>
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
    <title>Inscription</title>
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
                <h1>Inscription</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="pseudo">Pseudo: </label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mot de passe:</label>
                        <input type="password" class="form-control" id="pwd" name="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd2">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="pwd2" name="pwd2">
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

<?php
if(!empty($_POST['pseudo'])){
    //-----------------------------Verification de la validité des informations--------------------------
    //Connexion à la bdd
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=BonZami;charset=utf8','id6713174_aely','bonzamibdd10');
    }catch(Exception $e){
        die('Erreur : '  . $e->getMessage());
    }
    //Mot de passe identique
    $identique = false;
    if(strcmp($_POST['pwd'],$_POST['pwd2'])==0){
        //Pseudo déjà utilisé
        $reponse = $bdd->query('SELECT * FROM membre');
        while($donnees = $reponse->fetch()){
            if (strcmp($donnees['pseudo'],$_POST['pseudo'])==0){
                $identique = true;
                alert("Pseudo déjà utilisé");
                break;
            }
        }

        if(!$identique){
            //--------------------Insertion dans la bdd------------------------------------------
            //Hachage
            $pass_hach = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
            //Insertion
            $req = $bdd->prepare('INSERT INTO membre (pseudo, pass,email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
            $req->execute(array(
                'pseudo' => $_POST['pseudo'],
                'pass' => $pass_hach,
                'email' => $_POST['email']));
                //Redirection
                header('Location: index.php');
            }
        }
        else{
            alert("Les mots de passe ne sont pas identique");
        }
    }


    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    ?>

    </html>

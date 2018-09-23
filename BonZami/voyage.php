<?php session_start() ?>
<?php
//Recup information
$pseudo = urldecode($_GET['pseudo']);
$id = $_SESSION['id'];
$nomVoyage = urldecode($_GET['nomVoyage']);
try{
     $bdd = new PDO('mysql:host=localhost;dbname=id6713174_bonzami;charset=utf8','id6713174_aely','bonzamibdd10');
}catch(Exception $e){
    die('Erreur : '  . $e->getMessage());
}
$reponse = $bdd->query('SELECT id FROM voyage WHERE nom=' . "'" . $nomVoyage . "'" . " AND id_utilisateur='" . $id . "'");
$row = $reponse->fetch();
$idVoyage = $row['id'];

//Handle post
if(!empty($_POST)){
    if ($_POST['step'] == 1) {
        //Ajout participant
        $req = $bdd->prepare('INSERT INTO personne (nom,idVoyage) VALUES (?,?)');
        $req->execute(array($_POST['nomP'],$idVoyage));
        header("Refresh:0");
    }else if ($_POST['step'] == 2) {
        //Ajout paiement
        $req = $bdd->prepare('INSERT INTO detail (nom,montant,label,idVoyage) VALUES (?,?,?,?)');
        $req->execute(array($_POST['nom'],$_POST['montant'],$_POST['label'],$idVoyage));
        header("Refresh:0");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voyage</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
</head>

<body>
    <?
    //Menu
    if(isset($_SESSION['pseudo'])){
        include 'menu_authenticated.php';
    }
    else{
        include 'menu_unauthenticated.php';
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-5">
                        <h2><?php echo $nomVoyage; ?></h2>
                    </div>
                    <div class="col-md-7">
                        <form method="post">
                            <h3>Ajout de participant</h3>
                                <input type="hidden" name="step" value="1"/>
                                <label for="nomP">Nom: </label><input type="text" name="nomP" id="nomP"/>
                                <input type="submit" value="Ajout du participant"/>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-striped">
                            <tr>
                                <th>Nom</th>
                                <th>Montant</th>
                                <th>Label</th>
                            </tr>

                            <?php
                            $reponse = $bdd->query('SELECT * FROM detail WHERE idVoyage=' . "'" . $idVoyage . "'");

                            while($donnees = $reponse->fetch()){
                                ?>
                                    <tr>
                                        <td><?php echo $donnees['nom']; ?></td>
                                        <td><?php echo number_format((float)$donnees['montant'],2,'.',''); ?></td>
                                        <td><?php echo $donnees['label']; ?></td>
                                    </tr>
                                <?php
                            }
                            $reponse->closeCursor();
                            ?>

                        </table>
                    </div>
                </div>

                <div class="col-md-4">
                    <form class ="column" method="post">
                        <input type="hidden" name="step" value="2"/>
                        <h3>Ajout de paiement</h3>
                        <html lang="en-US">
                        <p>
                            <label for="nom">Nom:
                                <select class ="right" name="nom" id="nom">
                                    <?php
                                    $reponse = $bdd->query('SELECT * FROM personne WHERE idVoyage=' . "'" . $idVoyage . "'");
                                    while($donnees = $reponse->fetch()){
                                        echo '<option value="' . $donnees['nom'] . '">' . $donnees['nom'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                        </p>
                        <p>
                            <label for="montant">Montant:
                                <input class="right" type="number" name="montant" placeholder="Ex: 25.62" min ="0.00" step="0.01"/>
                            </label>
                        </p>
                        <p>
                            <label for="label">Label:
                                <input class="right" type="text" name="label" id="label"/>
                            </label>
                        </p>
                        <p>
                            <input type="submit" value="Ajout de paiement" />
                        </p>
                    </form>

                    <?php
                    //Get the total of each person and store it in an array
                    $reponse = $bdd->query('SELECT * FROM personne WHERE idVoyage=' . "'" . $idVoyage . "'");
                    if($reponse === FALSE){
                        die(mysql_error());
                    }
                    $size = $reponse->rowCount();

                    $nom = array();
                    while($row = $reponse->fetch()){
                        $nom[] = $row['nom'];
                    }
                    $total = array_fill(0,$size,0);

                    $reponse = $bdd->query('SELECT * FROM detail WHERE idVoyage=' . "'" . $idVoyage . "'");
                    while($row = $reponse->fetch()){
                        for($i = 0; $i < $size; $i++){
                            if(strcmp($row['nom'],$nom[$i])==0){
                                $total[$i] += $row['montant'];
                            }
                        }
                    }
                    ?>

                    <h3>Total</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nom</th>
                                    <th>Total</th>
                                </tr>
                                <?php
                                for($i = 0; $i < $size; $i++){
                                    echo "<tr>";
                                    echo "<td>" . $nom[$i] . "</td>";
                                    echo "<td>" . $total[$i] . "</td>";
                                    echo "</td>";
                                }
                                ?>
                            </table>
                        </div>

                        <h3>Fin du voyage</h2>
                            <button type="button" class="btn btn-default btn-outline-success btn-lg" data-toggle="modal" data-target="#myModal">Calcul des transactions</button>
                            <!-- Modal -->
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <?php include("calculTransaction.php"); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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
</html>

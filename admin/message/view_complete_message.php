<?php
    
/* connexion en tant qu'admin sinon redirection */

session_start();

if ($_SESSION['username'] !='Kevin')
{
    header('Location: ../../login.php');
}
else if (!$_SESSION['username'])
{
    header('Location: view.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Message complet</title>
        <meta charset="utf-8"/>   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body id="messComplet">
    
        <!-- section message complet -->
        
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        
                        <?php
                        
                        require '../../connexion.php';
                            
                        $nom = $prenom = $email = $id_personne = "";
                        
                        $id = verifyInput($_GET['id']);
                        $db = connect();
                        
                        /* select infos personnes */
                        
                        $statement = $db->prepare("SELECT * FROM personnes WHERE id_personne =?;");
                        $statement->execute(array($id));
                        $row = $statement->fetch();
                        $id_personne        = $row['id_personne'];
                        $nom                = $row['nom'];
                        $prenom             = $row['prenom'];
                        $email              = $row['email'];
                        
                        /* select messages */
                        
                        $statement = $db->prepare("SELECT * FROM messages WHERE id_message =?;");
                        $statement->execute(array($id));
                        $row = $statement->fetch();
                        $sujet              = $row['sujet'];
                        $message            = $row['message'];
                        
                        $db = disconnect();
                        
                        /* afficher le tout */
                        
                        echo "<div class='affichageMes'>
                            <h4 class='h4Qui'>Message n°$id_personne de : $nom $prenom - $email</h4>
                            <h4>Sujet : $sujet</h4>
                            <h4 class='h4Message'>Message : </h4>
                            <h4><span class='glyphicon glyphicon-arrow-right'></span> $message</h4>
                        </div>";
                        
                        ?>
                        
                        <!-- bouton retour et répondre -->
            
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-actions">
                                <a class="btn btn-primary" href="view_message.php">Retour</a>
                                <a class="btn btn-primary" href='mailto:<?php echo $email; ?>'>Répondre</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> 
            
        </section>
        
    </body>
</html>
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
        <title>Affichage des messages</title>
        <meta charset="utf-8"/>   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body id="gMessage">
        
        <!-- section view_message -->
        
        <section id="view_message">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="h1Messages">Liste des messages</h1>
                    </div>
                
                    <!-- tableau -->
                    
                    <table class="table table-bordered tableauMesssage">
                        
                        <!-- titre -->
                        
                        <tr class="titreTableau">
                            <td>NUMERO</td>
                            <td>SUJET</td>
                            <td>GÉRER</td>
                        </tr>
                        
                        <!-- contenu -->
                        
                        <?php
                        
                        require '../../connexion.php';
                        
                        $db = connect();
                        
                        $statement = $db -> query("SELECT id_message, sujet FROM messages");
                        
                        /* boucle permettant d'afficher tous les messages */
                    
                        while ($row = $statement -> fetch()) 
                        {
                        
                        ?>
                        
                        <tr class="contenuTableau">
                            <td><?php echo $row['id_message'];?></td>
                            <td><?php echo $row['sujet'];?></td>
                            <td>
                                <a href="view_complete_message.php?id=<?php echo $row['id_message']?>" role="button" class="btn btn-primary">Consulter</a><br>
                                <a href="delete_message.php?id=<?php echo $row['id_message']?>" role="button" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                        
                        <!-- fermeture de la boucle -->
                        
                        <?php 

                        }

                        disconnect()

                        ?>
                        
                    </table>
                    
                </div>
                    
            </div>
            
            <!-- bouton retour -->
            
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-actions">
                    <a class="btn btn-primary" href="../choix.php">Retour</a>
                </div>
            </div>
            
        </section>
        
    </body>
</html>
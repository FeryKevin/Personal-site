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
        <title>Affichage des projets</title>
        <meta charset="utf-8"/>   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    
    <body>
        
        <!-- section view -->
        
        <section id="view">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="h1Projet">Liste des projets</h1>
                    </div>
                    
                    <?php 

                    /* connexion bade de donnée et requete selectionnant l'ensemble des projets */
                    
                    require '../../connexion.php';    

                    $db = connect();

                    $statement = $db -> query("SELECT * FROM projets");

                    /* boucle permettant d'afficher tous les projets */
                    
                    while ($row = $statement -> fetch()) 
                    {
                    
                    ?>

                    <!-- mettre le projet sur la page view -->
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="thumbnail">

                            <h4 class="h4Projet"><?php echo $row['titre'];?></h4>
                            <img src="<?php echo '../../images/'.$row['image'];?>" alt="projets<?php echo $row['titre'];?>">
                            <p class="pProjetBO"><?php echo $row['description'];?></p>
                            <p class="pDetailProjet"><span class="glyphicon glyphicon-calendar"></span>&emsp;<?php echo $row['date'];?></p>
                            <p class="pDetailProjet"><span class="glyphicon glyphicon-time"></span>&emsp;<?php echo $row['temps'];?></p>
                            <p class="pDetailProjet"><span class="glyphicon glyphicon-education"></span>&emsp;<?php echo $row['cadre'];?></p>
                            <p class="pDetailProjet"><span class="glyphicon glyphicon-wrench"></span>&emsp;<?php echo $row['stack_technique'];?></p>

                            <!-- bouton update et delete -->
                            
                            <a href="update.php?id=<?php echo $row['id_projet']?>" class="btnModifier" role="button">Modifier</a>
                            <a href="delete.php?id=<?php echo $row['id_projet']?>" class="btnSupprimer" role="button">Supprimer</a>

                        </div>
                    </div>

                    <!-- fermeture de la boucle -->
                    
                    <?php 

                    }
                    
                    disconnect()

                    ?>

                    <!-- bouton ajouter un projet et retour -->
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-actions">
                            <a class="btn btn-primary" href="insert.php">Ajouter un projet</a>  
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-actions">
                            <a class="btn btn-primary" href="../choix.php">Retour</a> 
                        </div>
                    </div>
                    
                </div>  
            </div>
        </section>
    </body>
</html>
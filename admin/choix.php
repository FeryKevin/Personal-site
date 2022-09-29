<?php

/* connexion en tant qu'admin sinon redirection */

session_start();

if ($_SESSION['username'] !='Kevin')
{
    header('Location: ../login.php');
}
else if (!$_SESSION['username'])
{
    header('Location: view.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Choix</title>
        <meta charset="utf-8"/>   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body id="choix">
        
        <!-- section choix -->

        <section>
            <div class="container">
                <div class="row">

                    <!-- titre choix -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="h1Choix">Choix</h1>
                    </div>

                    <!-- choix 1 -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="btnchoix"> 
                            <a href="message/view_message.php"><h1 class="gestion">Gérer les messages</h1></a>
                        </div>
                    </div>

                    <!-- choix 2 -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="btnchoix">
                            <a href="gestion_projet/view.php"><h1 class="gestion">Gérer les projets</h1></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- bouton retour vers la page d'acceuil -->

        <section id="footerBO">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <a href="../logout.php"> 
                    <span class="glyphicon glyphicon-chevron-left">Déconnexion</span>
                </a>
            </div>
        </section>    
        
    </body>
</html>
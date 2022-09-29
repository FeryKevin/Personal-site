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

/* require connexion */

require '../../connexion.php';

$id = "";

if(!empty($_GET['id'])) 
{
    $id = verifyInput($_GET['id']);
}

/* requete delete */

if(!empty($_POST['id'])) 
{
    $id = verifyInput($_POST['id']);

    $db = connect();

    $sql = "DELETE FROM projets WHERE id_projet = ?";
    $statement= $db->prepare($sql);
    $statement->execute(array($id));

    disconnect();

    header("Location: view.php"); 
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Suppression d'un projet</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>
        
        <section id="delete">
            
            <!-- titre supprimer un projet -->

             <div class="container">
                <div class="row">

                    <!-- titre section -->

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="h1Delete">Supprimer un projet</h1>
                    </div>

                    <!-- formulaire suppression projet -->

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form class="form" action="delete.php" role="form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id;?>"/>
                            <p class="alert alert-danger">Êtes-vous sur de vouloir supprimer le projet ?</p>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-danger">Oui</button>
                                <a class="btn btn-default" href="view.php">Non</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
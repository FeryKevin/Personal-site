<?php

require '../connexion.php';

/* création de l'id pour trouver la bonne page */

if(!empty($_GET['id'])) 
{
    $id = verifyInput($_GET['id']);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Fiche projet</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    
    <body>
    
        <!-- section header projet -->
            
        <?php require '../header.php';?>
        
        <!-- section presentation projet -->
        
        <section id="presentationProjet">
            <div class="container">
                <div class="row">
                    
                    <!-- création du block projet  -->
                    
                    <?php
        
                    $titre = $description = $date = $temps = $cadre = $stack_technique = $image = "";

                    $db = connect();

                    $statement = $db->prepare("SELECT * FROM projets WHERE id_projet = ?");
                    $statement->execute(array($id));
                    $row = $statement->fetch();

                    /* affichage dynamique des projets */

                    echo"<div class='col-lg-6 col-md-6 col-sm-12'>
                        <div class='projet-block'>
                            <h3>".$row['titre']."</h3>
                            <h4>Contexte : </h4>
                            <div class='col-lg-12 col-md-12 col-sm-12'>
                                <p class='pDetailProjet1'>".$row['description']."</p><br>
                            </div>
                            <h4>Détails :</h4>
                            <div class='col-lg-6 col-md-6 col-sm-6'>
                                <p class='pDetailProjet'><span class='glyphicon glyphicon-calendar'></span>&emsp; ".$row['date']."</p>
                                <p class='pDetailProjet'><span class='glyphicon glyphicon-time'></span>&emsp;".$row['temps']."</p>
                            </div>
                            <div class='col-lg-6 col-md-6 col-sm-6'>
                                <p class='pDetailProjet'><span class='glyphicon glyphicon-education'></span>&emsp;".$row['cadre']."</p>
                                <p class='pDetailProjet'><span class='glyphicon glyphicon-wrench'></span>&emsp;".$row['stack_technique']."</p>
                            </div>";?>
                            <a href='<?php echo '../projets_zip/'.$row['zip'];?>' download='<?php echo $row['titre'];?>' class='buttonpro'><span class='glyphicon glyphicon-download-alt'></span>&emsp;Télécharger le projet (zip)</a><?php
                        echo "</div>
                    </div>
                    
                    <div class='col-lg-6 col-md-6 col-sm-12'>
                        <br> <br>
                        <a class='thumbnail'>";?>
                            <img src="<?php echo '../images/'.$row['image'];?>" class="imageprojet" alt="<?php echo $row['titre'];?>"><?php
                        echo"</a>
                    </div>";
                                            
                    disconnect();

                    ?>
                    
                </div>
            </div>
        </section>
        
        <!-- section images projet -->
        
        <section id="imagesProjet">
            <div class="container">
                <div class="row">
                    
                    <!-- titre section -->

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="h2Photos">PHOTOS</h2>
                    </div>
                </div>
                    
                <!-- création du carousel -->
                    
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div id="carousel" class="carousel slide" data-ride="carousel" style="max-width:800px;">
                            <ul class="carousel-indicators">
                                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel" data-slide-to="1"></li>
                                <li data-target="#carousel" data-slide-to="2"></li>
                                <li data-target="#carousel" data-slide-to="3"></li>
                            </ul>    

                            <!-- création des éléments du carousel -->

                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="<?php echo '../images/'.$row['image1'];?>" alt="<?php echo $row['titre'];?>">
                                </div> 
                                <div class="item">   
                                    <img src="<?php echo '../images/'.$row['image2'];?>" alt="<?php echo $row['titre'];?>">
                                </div>
                                <div class="item">   
                                    <img src="<?php echo '../images/'.$row['image3'];?>" alt="<?php echo $row['titre'];?>">
                                </div>
                                <div class="item">   
                                    <img src="<?php echo '../images/'.$row['image4'];?>" alt="<?php echo $row['titre'];?>">
                                </div>
                            </div>    

                            <!-- création des boutons du carousel -->

                            <a href="#carousel" class="left carousel-control" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a href="#carousel" class="right carousel-control" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>    
                        </div> 
                    </div>   
                </div>
            </div>
        </section>

        <!-- footer -->
        
        <?php require '../footer.php';?>
        
    </body>
</html>
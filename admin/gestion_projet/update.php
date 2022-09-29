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

/* déclation des variables */

$id_projet = $titreError = $descriptionError = $dateError = $tempsError = $cadreError = $stack_techniqueError = $imageError = $image1Error = $image2Error = $image3Error = $image4Error = $zipError = $titre = $description = $date = $temps = $cadre = $stack_technique = $image = $image1 = $image2 = $image3 = $image4 = $zip = "";

/* requete select pour préremplir les inputs */

if(!empty($_GET['id'])) 
{
    $id = verifyInput($_GET['id']);
    $db = connect();
    $statement = $db->prepare("SELECT * FROM projets WHERE id_projet =?;");
    $statement->execute(array($id));
    $row = $statement->fetch();
    $titre              = $row['titre'];
    $description        = $row['description'];
    $date               = $row['date'];
    $temps              = $row['temps'];
    $cadre              = $row['cadre'];
    $stack_technique    = $row['stack_technique'];
    $image              = $row['image'];
    $image1             = $row['image1'];
    $image2             = $row['image2'];
    $image3             = $row['image3'];
    $image4             = $row['image4'];
    $zip                = $row['zip'];
    $db = disconnect();
}

/* controle des champs */

if(!empty($_POST['titre']))
{
    $titre              = verifyInput($_POST['titre']);
    $description        = verifyInput($_POST['description']);
    $date               = verifyInput($_POST['date']);
    $temps              = verifyInput($_POST['temps']);
    $cadre              = verifyInput($_POST['cadre']);
    $stack_technique    = verifyInput($_POST['stack_technique']);
    
    /* image */
    
    $image              = verifyInput($_FILES["image"]["name"]);
    $imagePath          = '.../../images/'. basename($image);
    $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
    
    /* image1 */
    
    $image1             = verifyInput($_FILES["image1"]["name"]);
    $imagePath1         = '.../../images/'. basename($image1);
    $imageExtension1    = pathinfo($imagePath1,PATHINFO_EXTENSION);
    
    /* image2 */
    
    $image2             = verifyInput($_FILES["image2"]["name"]);
    $imagePath2         = '.../../images/'. basename($image2);
    $imageExtension2    = pathinfo($imagePath2,PATHINFO_EXTENSION);
    
    /* image3 */
    
    $image3             = verifyInput($_FILES["image3"]["name"]);
    $imagePath3         = '.../../images/'. basename($image3);
    $imageExtension3    = pathinfo($imagePath3,PATHINFO_EXTENSION);
    
    /* image4 */
    
    $image4             = verifyInput($_FILES["image4"]["name"]);
    $imagePath4         = '.../../images/'. basename($image4);
    $imageExtension4    = pathinfo($imagePath4,PATHINFO_EXTENSION);
    
    /* zip */
    
    $zip                = verifyInput($_FILES["zip"]["name"]);
    $imagePathz         = '.../../projets_zip/'. basename($zip);
    $imageExtensionz    = pathinfo($imagePathz,PATHINFO_EXTENSION);
    
    /* autres : préparation */
    
    $isSuccess          = true;
    $isUploadSuccess    = true;
    $isUpload2Success   = true;
    
    /* controle champs vide */
    
    if(empty($titre)) 
    {
        $titreError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(empty($description)) 
    {
        $descriptionError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    } 

    if(empty($date)) 
    {
        $dateError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(empty($temps)) 
    {
        $tempsError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(empty($cadre)) 
    {
        $cadreError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    
    /* vérification image */    

    if(empty($image) || empty($image1) || empty($image2) || empty($image3) || empty($image4) || empty($zip))
    {
        /* image vide */
        if(empty($image))
        {
            $isImageUpdated = false;
        }
        else
        {
            $isImageUpdated = true;
        }

        /* image1 vide */
        if(empty($image1))
        {
            $isImageUpdated1 = false;
        }
        else
        {
            $isImageUpdated1 = true;
        }

        /* image2 vide */
        if(empty($image2))
        {
            $isImageUpdated2 = false;
        }
        else
        {
            $isImageUpdated2 = true;
        }

        /* image3 vide */
        if(empty($image3))
        {
            $isImageUpdated3 = false;
        }
        else
        {
            $isImageUpdated3 = true;
        }

        /* image4 vide */
        if(empty($image4))
        {
            $isImageUpdated4 = false;
        }
        else
        {
            $isImageUpdated4 = true;
        }

        /* zip vide */
        if(empty($zip))
        {
            $isImageUpdatedZip = false;
        }
        else
        {
            $isImageUpdatedZip = true;
        }
    }
    else
    {
        /* extension */
        
        /* extension base */
        if($isImageUpdated = true)
        {
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
            {
                $imageError = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
        
        /* extension1 */
        if($isImageUpdated1 = true)
        {
            if($imageExtension1 != "jpg" && $imageExtension1 != "png" && $imageExtension1 != "jpeg" && $imageExtension1 != "gif")
            {
                $image1Error = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
        
        /* extension2 */
        if($isImageUpdated2 = true)
        {
            if($imageExtension2 != "jpg" && $imageExtension2 != "png" && $imageExtension2 != "jpeg" && $imageExtension2 != "gif")
            {
                $image2Error = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
        
        /* extension3 */
        if($isImageUpdated3 = true)
        {
            if($imageExtension3 != "jpg" && $imageExtension3 != "png" && $imageExtension3 != "jpeg" && $imageExtension3 != "gif")
            {
                $image3Error = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
        
        /* extension4 */
        if($isImageUpdated4 = true)
        {
            if($imageExtension4 != "jpg" && $imageExtension4 != "png" && $imageExtension4 != "jpeg" && $imageExtension4 != "gif")
            {
                $image4Error = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
        
        /* extension zip */
        if($isImageUpdatedZip = true)
        {
            if($imageExtensionz != "zip")
            {
                $zipError = "Le fichier autorisé est un .zip";
                $isUpload2Success = false;
            }
        }

        /* dossier existe */
        
        /* dossier base */
        if(file_exists($imagePath))
        {
            $imageError = "Le fichier existe déjà";
            $isUploadSuccess = false;
        }
        
        /* dossier 1 */
        if(file_exists($imagePath1))
        {
            $image1Error = "Le fichier existe déjà";
            $isUploadSuccess = false;
        }
        
        /* dossier 2 */
        if(file_exists($imagePath2))
        {
            $image2Error = "Le fichier existe déjà";
            $isUploadSuccess = false;
        }
        
        /* dossier 3 */
        if(file_exists($imagePath3))
        {
            $image3Error = "Le fichier existe déjà";
            $isUploadSuccess = false;
        }
        
        /* dossier 4 */
        if(file_exists($imagePath4))
        {
            $image4Error = "Le fichier existe déjà";
            $isUploadSuccess = false;
        }
        
        /* dossier 5 */
        if(file_exists($imagePathz))
        {
            $zipError = "Le fichier existe déjà";
            $isUpload2Success = false;
        }
        
        /* taille */

        /* taille base */
        if($_FILES["image"]["size"] > 1000000) 
        {
            $imageError = "Le fichier ne doit pas dépasser les 1000KB";
            $isUploadSuccess = false;
        }
        
        /* taille 1 */
        if($_FILES["image1"]["size"] > 1000000) 
        {
            $image1Error = "Le fichier ne doit pas dépasser les 1000KB";
            $isUploadSuccess = false;
        }
        
        /* taille 2 */
        if($_FILES["image2"]["size"] > 1000000) 
        {
            $image2Error = "Le fichier ne doit pas dépasser les 1000KB";
            $isUploadSuccess = false;
        }
        
        /* taille 3 */
        if($_FILES["image3"]["size"] > 1000000) 
        {
            $image3Error = "Le fichier ne doit pas dépasser les 1000KB";
            $isUploadSuccess = false;
        }
        
        /* taille 4 */
        if($_FILES["image4"]["size"] > 1000000) 
        {
            $image4Error = "Le fichier ne doit pas dépasser les 1000KB";
            $isUploadSuccess = false;
        }
        
        /* erreur supplémentaires */
        
        if($isUploadSuccess && $isUpload2Success)
        {
            /* erreur base */
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $image))
            {
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
                $isUpload2Success = false;
            }
            
             /* erreur 1 */
            if(!move_uploaded_file($_FILES["image1"]["tmp_name"], $image1))
            {
                $image1Error = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
                $isUpload2Success = false;
            }
            
             /* erreur 2 */
            if(!move_uploaded_file($_FILES["image2"]["tmp_name"], $image2))
            {
                $image2Error = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
                $isUpload2Success = false;
            }
            
             /* erreur 3 */
            if(!move_uploaded_file($_FILES["image3"]["tmp_name"], $image3))
            {
                $image3Error = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
                $isUpload2Success = false;
            }
            
             /* erreur 4 */
            if(!move_uploaded_file($_FILES["image4"]["tmp_name"], $image4))
            {
                $image4Error = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
                $isUpload2Success = false;
            }
        } 
    }

    /* requete update si les champs sont correct */   
        
    if(($isSuccess && $isImageUpdated && $isUploadSuccess && $isUpload2Success) || ($isSuccess && $isImageUpdated1 && $isUploadSuccess && $isUpload2Success) || ($isSuccess && $isImageUpdated2 && $isUploadSuccess && $isUpload2Success) || ($isSuccess && $isImageUpdated3 && $isUploadSuccess && $isUpload2Success) || ($isSuccess && $isImageUpdated4 && $isUploadSuccess && $isUpload2Success) || ($isSuccess && $isImageUpdatedZip && $isUploadSuccess && $isUpload2Success) || ($isSuccess && !$isImageUpdated))
    { 
        $db = connect();

        if($isImageUpdated || $isImageUpdated1 || $isImageUpdated2 ||$isImageUpdated3 || $isImageUpdated4 || $isImageUpdatedZip)
        {
            /* update image */
            if($isImageUpdated)
            {
                $statement = $db->prepare("UPDATE projets set titre =?, description =?, date =?, temps =?, cadre =?, stack_technique =?, image =? WHERE id_projet =?");
                $statement->execute(array($titre, $description, $date, $temps, $cadre, $stack_technique, $image, $id));
            }

            /* update image1 */
            if($isImageUpdated1)
            {
                $statement = $db->prepare("UPDATE projets set titre =?, description =?, date =?, temps =?, cadre =?, stack_technique =?, image1 =? WHERE id_projet =?");
                $statement->execute(array($titre, $description, $date, $temps, $cadre, $stack_technique, $image1, $id));
            }

            /* update image2 */
            if($isImageUpdated2)
            {
                $statement = $db->prepare("UPDATE projets set titre =?, description =?, date =?, temps =?, cadre =?, stack_technique =?, image2 =? WHERE id_projet =?");
                $statement->execute(array($titre, $description, $date, $temps, $cadre, $stack_technique, $image2, $id));
            }

            /* update image3 */
            if($isImageUpdated3)
            {
                $statement = $db->prepare("UPDATE projets set titre =?, description =?, date =?, temps =?, cadre =?, stack_technique =?, image3 =? WHERE id_projet =?");
                $statement->execute(array($titre, $description, $date, $temps, $cadre, $stack_technique, $image3, $id));
            }

            /* update image4 */
            if($isImageUpdated4)
            {
                $statement = $db->prepare("UPDATE projets set titre =?, description =?, date =?, temps =?, cadre =?, stack_technique =?, image4 =? WHERE id_projet =?");
                $statement->execute(array($titre, $description, $date, $temps, $cadre, $stack_technique, $image4, $id));
            }

            /* update zip */
            if($isImageUpdatedZip)
            {
                $statement = $db->prepare("UPDATE projets set titre =?, description =?, date =?, temps =?, cadre =?, stack_technique =?, zip =? WHERE id_projet =?");
                $statement->execute(array($titre, $description, $date, $temps, $cadre, $stack_technique, $zip, $id));
            }    
        }
        else
        {
            /* update sans image ni de zip */
            $statement = $db->prepare("UPDATE projets set titre =?, description =?, date =?, temps =?, cadre =?, stack_technique =? WHERE id_projet =?");
            $statement->execute(array($titre, $description, $date, $temps, $cadre, $stack_technique, $id));
        }

        $db = disconnect();
        header("Location: view.php");
    }
    else 
    {
        /* select image */
        if($isImageUpdated && !$isUploadSuccess)
        {
            $db = connect();
            $statement = $db->prepare("SELECT image FROM projets WHERE id_projet =?;");
            $statement->execute(array($id));
            $row = $statement->fetch();
            $image = $row['image'];
            $db = disconnect();
        }
        
        /* select image1 */
        if($isImageUpdated1 && !$isUploadSuccess)
        {
            $db = connect();
            $statement = $db->prepare("SELECT image1 FROM projets WHERE id_projet =?;");
            $statement->execute(array($id));
            $row = $statement->fetch();
            $image1 = $row['image1'];
            $db = disconnect();
        }
        
        /* select image2 */
        if($isImageUpdated2 && !$isUploadSuccess)
        {
            $db = connect();
            $statement = $db->prepare("SELECT image2 FROM projets WHERE id_projet =?;");
            $statement->execute(array($id));
            $row = $statement->fetch();
            $image2 = $row['image2'];
            $db = disconnect();
        }
        
        /* select image3 */
        if($isImageUpdated3 && !$isUploadSuccess)
        {
            $db = connect();
            $statement = $db->prepare("SELECT image3 FROM projets WHERE id_projet =?;");
            $statement->execute(array($id));
            $row = $statement->fetch();
            $image3 = $row['image3'];
            $db = disconnect();
        }
        
        /* select image4 */
        if($isImageUpdated4 && !$isUploadSuccess)
        {
            $db = connect();
            $statement = $db->prepare("SELECT image4 FROM projets WHERE id_projet =?;");
            $statement->execute(array($id));
            $row = $statement->fetch();
            $image4 = $row['image4'];
            $db = disconnect();
        }
        
        /* select zip */
        if($isImageUpdatedZip && !$isUploadSuccess)
        {
            $db = connect();
            $statement = $db->prepare("SELECT zip FROM projets WHERE id_projet =?;");
            $statement->execute(array($id));
            $row = $statement->fetch();
            $zip = $row['zip'];
            $db = disconnect();
        }   
    }    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modification d'un projet</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>
       
        <section id="update">
             <div class="container">
                <div class="row">

                    <!--- titre section-->

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="hModifier" >Modifier un projet</h1>
                    </div>

                    <!-- formulaire update -->
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">

                        <form class="form" role="form" action="<?php echo 'update.php?id=' . $id; ?>" method="post" enctype="multipart/form-data">

                            <!-- titre -->

                            <label for="titre" class="labelFormulaireProjet">Titre :</label>
                            <input type="text" class="form-control" id="titre" class="form-control" name="titre" placeholder="Titre du projet :" value="<?php echo $titre;?>">
                            <span class="help-inline"><?php echo $titreError;?></span>

                            <!-- description -->

                            <div class="form-group">
                                <label for="description" class="labelFormulaireProjet">Déscription :</label>
                                <input type="text" class="form-control" id="description" class="form-control" name="description" placeholder="Description du projet :" value="<?php echo $description;?>">
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            </div>

                            <!-- date -->

                            <div class="form-group">
                                <label for="date" class="labelFormulaireProjet">Date :</label>
                                <input type="text" class="form-control" id="date" class="form-control" name="date" placeholder="Date du projet :" value="<?php echo $date;?>">
                                <span class="help-inline"><?php echo $dateError;?></span>
                            </div>

                            <!-- temps -->

                            <div class="form-group">
                                <label for="temps" class="labelFormulaireProjet">Temps :</label>
                                <input type="text" class="form-control" id="temps" class="form-control" name="temps" placeholder="Temps de réalisation du projet :" value="<?php echo $temps;?>">
                                <span class="help-inline"><?php echo $tempsError;?></span>
                            </div>

                            <!-- cadre -->

                            <div class="form-group">
                                <label for="cadre" class="labelFormulaireProjet">Cadre :</label>
                                <input type="text" class="form-control" id="cadre" class="form-control" name="cadre" placeholder="Cadre du projet :" value="<?php echo $cadre;?>">
                                <span class="help-inline"><?php echo $cadreError;?></span>
                            </div>                       

                            <!-- stack technique -->

                            <div class="form-group">
                                <label for="stack_tecnhique" class="labelFormulaireProjet">Stack tecnhique :</label>
                                <input type="text" class="form-control" id="stack_technique" class="form-control" name="stack_technique" placeholder="Stack technique du projet :" value="<?php echo $stack_technique;?>">
                                <span class="help-inline"><?php echo $stack_techniqueError;?></span>
                            </div>

                            <!-- image -->

                            <div class="form-group">
                                <label class="labelFormulaireProjet">Image :</label>
                                <p class="imagePng"><?php echo $image;?></p>
                                <label for="image" class="labelFormulaireProjet">Sélectionner une image:</label>
                                <input type="file" id="image" name="image" class="btnImageProjet"> 
                                <span class="help-inline"><?php echo $imageError;?></span>
                            </div>
                            
                            <!-- image 1 -->

                            <div class="form-group">
                                <label class="labelFormulaireProjet">Image 1 :</label>
                                <p class="imagePng"><?php echo $image1;?></p>
                                <label for="image" class="labelFormulaireProjet">Sélectionner une image 1 :</label>
                                <input type="file" id="image1" class="btnImageProjet" name="image1"> 
                                <span class="help-inline"><?php echo $image1Error;?></span>
                            </div>
                            
                            <!-- image 2 -->

                            <div class="form-group">
                                <label class="labelFormulaireProjet">Image 2 :</label>
                                <p class="imagePng"><?php echo $image2;?></p>
                                <label for="image" class="labelFormulaireProjet">Sélectionner une image 2 :</label>
                                <input type="file" id="image2" class="btnImageProjet" name="image2"> 
                                <span class="help-inline"><?php echo $image2Error;?></span>
                            </div>
                            
                            <!-- image 3 -->

                            <div class="form-group">
                                <label class="labelFormulaireProjet">Image 3 :</label>
                                <p class="imagePng"><?php echo $image3;?></p>
                                <label for="image" class="labelFormulaireProjet">Sélectionner une image 3 :</label>
                                <input type="file" id="image3" class="btnImageProjet" name="image3"> 
                                <span class="help-inline"><?php echo $image3Error;?></span>
                            </div>
                            
                            <!-- image 4 -->

                            <div class="form-group">
                                <label class="labelFormulaireProjet">Image 4 :</label>
                                <p class="imagePng"><?php echo $image4;?></p>
                                <label for="image" class="labelFormulaireProjet">Sélectionner une image 4 :</label>
                                <input type="file" id="image4" class="btnImageProjet" name="image4"> 
                                <span class="help-inline"><?php echo $image4Error;?></span>
                            </div>
                            
                            <!-- zip -->

                            <div class="form-group">
                                <label class="labelFormulaireProjet">Zip :</label>
                                <p class="imagePng"><?php echo $zip;?></p>
                                <label for="image" class="labelFormulaireProjet">Sélectionner un zip :</label>
                                <input type="file" id="zip" class="btnImageProjet" name="zip"> 
                                <span class="help-inline"><?php echo $zipError;?></span>
                            </div>
                            
                            <!-- bouton modifier -->

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-actions">
                                    <button type="submit" class="btnModifier">Modifier</button>
                                </div>
                            </div>
                            
                        </form>    
                    </div>
                    
                    <!-- thumbnail update -->
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <br><br>
                        <div class="thumbnail">
                            <h4 class="h4Projet"><?php echo $row['titre'];?></h4>
                            <img src="<?php echo '../../images/'.$row['image'];?>" alt="projets<?php echo $row['titre'];?>">
                            <p class="pProjetBO"><?php echo $row['description'];?></p>
                            <p class="pDetailProjet"><span class="glyphicon glyphicon-calendar"></span>&emsp;<?php echo $row['date'];?></p>
                            <p class="pDetailProjet"><span class="glyphicon glyphicon-time"></span>&emsp;<?php echo $row['temps'];?></p>
                            <p class="pDetailProjet"><span class="glyphicon glyphicon-education"></span>&emsp;<?php echo $row['cadre'];?></p>
                            <p class="pDetailProjet"><span class="glyphicon glyphicon-wrench"></span>&emsp;<?php echo $row['stack_technique'];?></p>
                            <p class="pDetailProjet"><span class="glyphicon glyphicon-download"></span>&emsp;<?php echo $row['zip'];?></p>
                            <img src="<?php echo '../../images/'.$row['image1'];?>" alt="projets<?php echo $row['titre'];?>"><br>
                            <img src="<?php echo '../../images/'.$row['image2'];?>" alt="projets<?php echo $row['titre'];?>"><br>
                            <img src="<?php echo '../../images/'.$row['image3'];?>" alt="projets<?php echo $row['titre'];?>"><br>
                            <img src="<?php echo '../../images/'.$row['image4'];?>" alt="projets<?php echo $row['titre'];?>"><br>
                        </div>
                    </div>
                </div>  
            </div>
        </section>
            
        <!-- bouton retour vers la page d'acceuil -->
                    
        <section id="footerBO3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <a href="view.php"> 
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
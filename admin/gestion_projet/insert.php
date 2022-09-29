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

/* déclaration des variables */

$titreError = $descriptionError = $dateError = $tempsError = $cadreError = $stack_techniqueError = $imageError = $image1Error = $image2Error = $image3Error = $image4Error = $zipError = $titre = $description = $date = $temps = $cadre = $stack_technique = $image = $image1 = $image2 = $image3 = $image4 = $zip = "";

/* vérification des variables/champs et insert */

if(!empty($_POST)) 
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
    
    $isSuccess          = true;
    $isUploadSuccess    = false;
    $isUpload2Success    = false;
    
    /* vérification de toutes les variables */
    
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

    if(empty($stack_technique)) 
    {
        $stack_techniqueError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    
    /* vérification image logo */
    
    if(empty($image) || empty($image1) || empty($image2) || empty($image3) || empty($image4) || empty($zip))
    {
        /* image vide */
        if(empty($image))
        {
            $imageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
            $is = false;
        }
        else
        {
            $is = true;
        }

        /* image1 vide */
        if(empty($image1))
        {
            $image1Error = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
            $is1 = false;
        }
        else
        {
            $is1= true;
        }

        /* image2 vide */
        if(empty($image2))
        {
            $image2Error = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
            $is2 = false;
        }
        else
        {
            $is2= true;
        }

        /* image3 vide */
        if(empty($image3))
        {
            $image3Error = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
            $is3 = false;
        }
        else
        {
            $is3= true;
        }

        /* image4 vide */
        if(empty($image4))
        {
            $image4Error = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
            $is4 = false;
        }
        else
        {
            $is4 = true;
        }

        /* zip vide */
        if(empty($zip))
        {
            $zipError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
            $isz = false;
        }
        else
        {
            $isz= true;
        }
    }
    else
    {
        $isUploadSuccess = true;
        $isUpload2Success = true;

        /* extension */
        
        /* extensionBase */
        if($is = true)
        {
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
            {
                $imageError = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
        
        /* extension1 */
        if($is1 = true)
        {
            if($imageExtension1 != "jpg" && $imageExtension1 != "png" && $imageExtension1 != "jpeg" && $imageExtension1 != "gif")
            {
                $image1Error = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
          
        /* extension2 */
        if($is2 = true)
        {
            if($imageExtension2 != "jpg" && $imageExtension2 != "png" && $imageExtension2 != "jpeg" && $imageExtension2 != "gif")
            {
                $image2Error = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
        
        /* extension3 */
        if($is3 = true)
        {
            if($imageExtension3 != "jpg" && $imageExtension3 != "png" && $imageExtension3 != "jpeg" && $imageExtension3 != "gif")
            {
                $image3Error = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
        
        /* extension4 */
        if($is4 = true)
        {
            if($imageExtension4 != "jpg" && $imageExtension4 != "png" && $imageExtension4 != "jpeg" && $imageExtension4 != "gif")
            {
                $image4Error = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
        }
        
        /* extensionZip */
        if($isz = true)
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
        
        /* dossier zip */
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
    
    /* requete insert */

    if($isSuccess && $isUploadSuccess) 
    {
        $db = connect();
        
        $statement = $db->prepare("INSERT INTO projets (titre, description, date, temps, cadre, stack_technique, image, image1, image2, image3, image4, zip) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->execute(array($titre, $description, $date, $temps, $cadre, $stack_technique, $image, $image1, $image2, $image3, $image4, $zip));
        
        $db = disconnect();
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Insertion d'un projet</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    
    <body>
        
        <!-- section insert -->
        
        <section id="insert">
            <div class="container">
                <div class="row">
                    
                    <!-- titre ajout d'un projet -->
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="h1ajouterProjet">Ajouter un projet</h1>
                    </div>
                    
                    <!-- formulaire ajout d'un projet -->
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form class="form" action="" role="form" method="post" enctype="multipart/form-data">

                            <!-- titre -->

                            <div class="form-group">
                                <label for="name" class="labelFormulaireProjet">Titre :</label>
                                <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre du projet :" value="<?php echo $titre;?>">
                                <span class="help-inline"><?php echo $titreError;?></span>
                            </div>

                            <!-- description -->

                            <div class="form-group">
                                <label for="description" class="labelFormulaireProjet">Déscription :</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Déscription du projet :" value="<?php echo $description;?>">
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            </div>

                            <!-- date -->

                            <div class="form-group">
                                <label for="date" class="labelFormulaireProjet">Date :</label>
                                <input type="text" class="form-control" id="date" name="date" placeholder="Date du projet :" value="<?php echo $date;?>">
                                <span class="help-inline"><?php echo $dateError;?></span>
                            </div>

                            <!-- temps -->

                            <div class="form-group">
                                <label for="temps" class="labelFormulaireProjet">Temps :</label>
                                <input type="text" class="form-control" id="temps" name="temps" placeholder="Temps de réalisation du projet :" value="<?php echo $temps;?>">
                                <span class="help-inline"><?php echo $tempsError;?></span>
                            </div>

                            <!-- cadre -->

                            <div class="form-group">
                                <label for="cadre" class="labelFormulaireProjet">Cadre :</label>
                                <input type="text" class="form-control" id="cadre" name="cadre" placeholder="Cadre du projet :" value="<?php echo $cadre;?>">
                                <span class="help-inline"><?php echo $cadreError;?></span>
                            </div>

                            <!-- stack technique -->

                            <div class="form-group">
                                <label for="stack_tecnhique" class="labelFormulaireProjet">Stack technique :</label>
                                <input type="text" class="form-control" id="stack_technique" name="stack_technique" placeholder="Stack technique du projet :" value="<?php echo $stack_technique;?>">
                                <span class="help-inline"><?php echo $stack_techniqueError;?></span>
                            </div>

                            <!-- image fond -->

                            <div class="form-group">
                                <label for="image" class="labelFormulaireProjet">Sélectionner une image (logo) :</label>
                                <input type="file" id="image" class="btnImageProjet" name="image"> 
                                <span class="help-inline"><?php echo $imageError;?></span>
                            </div>                   
                            
                            <!-- image 1 -->

                            <div class="form-group">
                                <label for="image1" class="labelFormulaireProjet">Sélectionner une image (1) :</label>
                                <input type="file" id="image1" class="btnImageProjet" name="image1"> 
                                <span class="help-inline"><?php echo $image1Error;?></span>
                            </div>
                            
                            <!-- image 2 -->

                            <div class="form-group">
                                <label for="image2" class="labelFormulaireProjet">Sélectionner une image (2) :</label>
                                <input type="file" id="image2" class="btnImageProjet" name="image2"> 
                                <span class="help-inline"><?php echo $image2Error;?></span>
                            </div>
                            
                            <!-- image 3 -->

                            <div class="form-group">
                                <label for="image3" class="labelFormulaireProjet">Sélectionner une image (3) :</label>
                                <input type="file" id="image3" class="btnImageProjet" name="image3"> 
                                <span class="help-inline"><?php echo $image3Error;?></span>
                            </div>
                            
                            <!-- image 4 -->

                            <div class="form-group">
                                <label for="image4" class="labelFormulaireProjet">Sélectionner une image (4) :</label>
                                <input type="file" id="image4" class="btnImageProjet" name="image4"> 
                                <span class="help-inline"><?php echo $image4Error;?></span>
                            </div>
                            
                            <!-- zip -->

                            <div class="form-group">
                                <label for="zip" class="labelFormulaireProjet">Sélectionner le zip du projet :</label>
                                <input type="file" id="zip" class="btnImageProjet" name="zip"> 
                                <span class="help-inline"><?php echo $zipError;?></span>
                            </div>
                            
                            <!-- bouton ajouter -->

                            <div class="form-actions">
                                <button type="submit" class="btnajouter">Ajouter</button>
                            </div>

                        </form> 
                    </div>
                    
                    <!-- bouton retour vers la page d'acceuil -->
                    
                    <section id="footerBO2">
                        <a href="view.php"> 
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    </section>
                </div>
            </div>
        </section> 
    </body>
</html>
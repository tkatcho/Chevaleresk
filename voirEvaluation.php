<?php
require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

//Récupère l'item concerné
if (isset($_GET["idItem"])) {
    $id = $_GET["idItem"];
    $item = ItemsTable()->get($id);
    if ($item == null)
        redirect('details.php');
} else {
    redirect('details.php');
}

$viewTitle = "Les évaluations";
$viewMenu = "";

//Le container de l'item & évaluations
$itemsDisplay = <<<HTML
    <div class="évaluationsContainer">
HTML;

//ÉTOILES : PROGRESS-BAR
$évaluations_nbÉtoiles=<<<HTML
HTML;

//Nb évaluations au total

$toutesévaluations = EvaluationsTable()->selectall();
$nbÉvaluationsTotales =count($toutesévaluations);


//Pourcentage 
function pourcentage($nbÉtoiles, $nbÉvaluationsTotales)
{
    $évaluations = EvaluationsTable()->selectWhere("Etoile = $nbÉtoiles");
    $pourcentage=0;
    foreach($évaluations as $eval){
        $pourcentage ++;
    }
    return (int) (($pourcentage / $nbÉvaluationsTotales) * 100);
}

for($x=5; $x>=1; $x--){  //Pour chaque nb étoiles : nb étoile | progress-bar | pourcentage %
    $pourcentage = pourcentage($x, $nbÉvaluationsTotales );

    $évaluations_nbÉtoiles .=<<<HTML
    <div class="évaluationsRow">
    <div class="évalutionsNbÉtoiles">
        <div>$x  <i class="fa fa-star étoileChecked "></i></div>
    </div>
    <div class="évaluationsProgress-bar">
        <div class="bar-container">  
            <div style="width: $pourcentage%; height: 18px; background-color: #04AA6D; " ></div> <!--La progress-bar -->
        </div> 
    </div>
    <div class="évalutionsNbÉtoiles évaluationsPourcentage ">
        <div>$pourcentage %</div>  
    </div>
    <br>
    </div>

HTML;
}


//Moyenne
$moyenne =DB()->querySqlCmd("SELECT moyenneEvaluation();")[0];


$étoilesCochées=<<<HTML
HTML;
for($x=0;$x< $moyenne[0]; $x++){
    $étoilesCochées.=<<<HTML
    <span class="fa fa-star étoileChecked"></span>
HTML;
}
for($x=$moyenne[0];$x< 5; $x++){
    $étoilesCochées.=<<<HTML
    <span class="fa fa-star"></span>
HTML;
}
//COMMENTAIRES
//Avatar des joueurs + commentaires
$évaluations = EvaluationsTable()->selectAll();

$avatarJoueurEtCommentaire =<<<HTML
HTML;
$commentairesHTML = <<<HTML
 
HTML;


//Pour chaque évaluations
foreach($évaluations as $eval){ 
  
    if($eval->Commentaire !=null){
        $joueur = JoueursTable()->selectWhere("id = $eval->IdJoueur")[0];
        $isAdmin = $joueur->isAdmin();
	    $isAlchimiste = $joueur->isAlchimiste();
        $commentaire = $eval->Commentaire;
        
        if($isAdmin){
            $avatarJoueurEtCommentaire =<<<HTML
                <div class="chip">
                    <img src="./images/admin.png" alt="$joueur->Alias" width="96" height="96">
                    $joueur->Alias :        <!--Avatar selon admin/alchimiste/normal -->
                    $commentaire            <!--Commentaire-->
                </div>
                <br>
HTML;
        }else if ($isAlchimiste){
            $avatarJoueurEtCommentaire =<<<HTML
                <div class="chip">
                    <img src="./images/alchimiste.png" alt="$joueur->Alias" width="96" height="96">
                    $joueur->Alias :        <!--Avatar selon admin/alchimiste/normal -->
                    $commentaire            <!--Commentaire-->
                </div>
            <br>
HTML;
        } else{
            $avatarJoueurEtCommentaire =<<<HTML
            <div class="chip">
                <img src="./images/chevalier.png" alt="$joueur->Alias" width="96" height="96">
                $joueur->Alias :           <!--Avatar selon admin/alchimiste/normal -->
                $commentaire              <!--Commentaire-->
            </div>
            <br>
HTML;
        }

        $commentairesHTML .= $avatarJoueurEtCommentaire;
    }
}

$moyenne= sanitizeString($moyenne[0]);

if ($item != null) {
        $itemsDisplay .= <<<HTML
            <div class="évaluationsContainerItem">
                <div class="évaluationsImg">
                    <div style="background-image:url('$item->Photo')"></div>
                </div>
            </div>

            <div class="évaluationsContainerItem width">
                <p style=" font-size: 16px; margin-left:4px;">$item->Nom</p> 
                <hr>
                <div class="étoilesContainer">
                    <div class="étoilesContainerItem">
                        $étoilesCochées
                    </div>
                    <span> $moyenne / 5 </span>
                </div>
                <p style="margin-top:10px;">$nbÉvaluationsTotales évaluations au total</p>
                <hr>
                
                <!--Nb étoiles & progress-bar-->
                $évaluations_nbÉtoiles
        
                <hr>

                <!--Les commentaires-->
                <p style="margin-top:10px;">Les commentaires</p>
                <div class="commentaireContainer">
                    $commentairesHTML
                </div>
            </div> 
        </div>
HTML;
    }

$content = $itemsDisplay;

include 'views/master.php';
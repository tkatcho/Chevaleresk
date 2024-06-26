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

//Nb évaluations au total
$toutesévaluationsItem = EvaluationsTable()->selectWhere("idItem = $id");
$nbÉvaluationsTotales = count($toutesévaluationsItem);

//MOYENNE & AFFICHER LES ÉTOILES
$étoilesCochées = <<<HTML
HTML;

$moyenne = DB()->querySqlCmd("SELECT moyenneEvaluation($id);")[0];


for ($x = 0; $x < 5; $x++) {
    if ($x < $moyenne[0]) {
        $étoilesCochées .= <<<HTML
            <span class="fa fa-star étoileChecked"></span>
HTML;
    } else {
        $étoilesCochées .= <<<HTML
            <span class="fa fa-star"></span>
HTML;
    }
}

$moyenne = sanitizeString($moyenne[0]);
if ($nbÉvaluationsTotales == 0)
    $moyenne = 0;

//ÉTOILES : PROGRESS-BAR
$évaluations_nbÉtoiles = <<<HTML
HTML;

//Pourcentage 

function pourcentage($nbÉtoiles, $nbÉvaluationsTotales, $id)
{
    $évaluations = EvaluationsTable()->selectWhere("Etoile = $nbÉtoiles and idItem = $id");
    $pourcentage = 0;
    foreach ($évaluations as $eval) {
        $pourcentage++;
    }
    return (int) (($pourcentage / $nbÉvaluationsTotales) * 100);
}

if ($nbÉvaluationsTotales != 0) {
    for ($x = 5; $x >= 1; $x--) {  //Pour chaque nb étoiles : nb étoile | progress-bar | pourcentage %
        $pourcentage = pourcentage($x, $nbÉvaluationsTotales, $id);

        $évaluations_nbÉtoiles .= <<<HTML
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
}

//COMMENTAIRES
//Avatar des joueurs + commentaires

$avatarJoueurEtCommentaire = <<<HTML
HTML;
$commentairesHTML = <<<HTML
HTML;

//Pour chaque évaluations: alias + commentaire
if ($nbÉvaluationsTotales != 0) {
    foreach ($toutesévaluationsItem as $eval) {

        if ($eval->Commentaire != null) {
            $joueur = JoueursTable()->selectWhere("id = $eval->idJoueur")[0];
            $isAdmin = $joueur->isAdmin();
            $isAlchimiste = $joueur->isAlchimiste();
            $commentaire = $eval->Commentaire;
            //avatar
            $avatar = "./images/chevalier.png";
            if ($isAdmin) {
                $avatar = "./images/admin.png";
            } else if ($isAlchimiste) {
                $avatar = "./images/alchimiste.png";
            }

            if ($eval->idJoueur == $_SESSION['id'] || $_SESSION['isAdmin'] == 1) {
                $avatarJoueurEtCommentaire = <<<HTML
                                    <div class="chip interactive data-eval-id='$eval->Id'" value="$eval->Id">
                                        <img src=$avatar alt="$joueur->Alias" width="96" height="96">
                                            $joueur->Alias :
                                            <span maxlength="22"class="comment-text">$commentaire</span>         
                                            <span class="delete">&#10006;</span>
                                    </div>
                            <br>
HTML;
            } else {
                $avatarJoueurEtCommentaire = <<<HTML
                    <div class="chip data-eval-id='$eval->Id'">
                        <img src=$avatar alt="$joueur->Alias" width="96" height="96">
                            $joueur->Alias :        
                            <span class="comment-text" maxlength="22">$commentaire</span>      
                    </div>
            <br>
            
HTML;
            }
            $commentairesHTML .= $avatarJoueurEtCommentaire;
        }
    }
}



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

$scripts =
    <<<HTML
        <script>
            document.addEventListener('DOMContentLoaded',function(){const deleteButtons=document.querySelectorAll('.delete');deleteButtons.forEach(button=>{button.addEventListener('click',function(event){const chipId=this.parentElement;const confirmDeletion=confirm('Voulez-vous supprimer ce commentaire?');let id=chipId.getAttribute('value')
            const comment=chipId.querySelector('.comment-text').textContent;const image=chipId.querySelector('img');if(confirmDeletion){deleteChip(image,comment,id)}})})});function deleteChip(element,comment,id){const altValue=element.getAttribute('alt');$.ajax({url:'./delete-comment.php',method:'POST',data:{alias:altValue,idComment:id,},success:(response)=>{console.log(response)},error:(xhr,status,error)=>{alert('Erreur survenu, commentaire pas modifier')}})}
        </script>

        <script>
            document.addEventListener('DOMContentLoaded',function(){const commentTexts=document.querySelectorAll('.comment-text');commentTexts.forEach(text=>{text.addEventListener('click',function(event){this.setAttribute('contenteditable','true');this.focus()});text.addEventListener('keypress',function(event){if(event.key==='Enter'){event.preventDefault();this.setAttribute('contenteditable','false');var newstr=$(this).text().substring(0,22);$(this).text(newstr);updateComment(this)}})})});function updateComment(element){const evalId=element.parentElement.querySelector('img');const altValue=evalId.getAttribute('alt');const updatedText=element.textContent;$.ajax({url:'./update-comment.php',method:'POST',data:{alias:altValue,itemId:$id,comment:updatedText},success:(response)=>{},error:(xhr,status,error)=>{alert('Erreur survenu, commentaire pas modifier')}})}
        </script>
HTML;
$content .= $scripts;

include 'views/master.php';

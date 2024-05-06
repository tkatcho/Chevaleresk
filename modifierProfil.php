<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

$viewTitle = "Modifier votre profil";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];
/*$isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];*/

$scripts = <<<HTML
    <script src="./js/modProfil.js"></script>
HTML;

$styles = <<<HTML
    <link rel="stylesheet" href="./css/modProfil.css">
HTML;

if ($isConnected) {

	//Faire une condition pour savoir si admin ou si joueur (les boutons ne seront pas les mêmes)
	$joueur = JoueursTable()->selectById($_SESSION['id'])[0];
	$isAdmin = $joueur->estAdmin;
	$isAlchimiste = $joueur->estAlchimiste;
	$niveau = "";
	if ($isAlchimiste == 1) {
		$niveau = <<<HTML
		<span class="optionsJeuNiveauIcone"><i class="fa-solid fa-hat-wizard"></i></span>
		<p>Niveau : $joueur->Niveau</p>

HTML;
		$image = <<<HTML
		<div style="background-image:url('./images/alchimiste.png')"></div>
HTML;
	}
	if ($isAdmin) {
		$niveau = <<<HTML
		<div class="optionsJeuNiveauIcone">
			<i class= "fa fa-hammer"></i> 
			<i class= "fa fa-flask"></i> 
		</div>
HTML;
		$image =<<<HTML
		<div style="background-image:url('./images/admin.png')"></div>
HTML;
	}
	if ($isAlchimiste == 0 && !$isAdmin) {
		$niveau = <<<HTML
		<span class="optionsJeuNiveauIcone"><i class='fas fa-user-shield'></i></span>
HTML;
		$image = <<<HTML
		<div style="background-image:url('./images/chevalier.png')"></div>
HTML;
	}
	$content = <<<HTML
        <div class="">
            <div class="optionsBackgroundModProfil">
                <div class="optionsBackgroundBleuProfilImg">
                    $image
                </div>
                <div class="champ"><p>Alias: </p><p id="modAlias">$joueur->Alias<i class="fa-solid fa-pencil"></i></p></div>
                <div class="champ"><p>Prénom: </p><p id="modPrenom">$joueur->Nom<i class="fa-solid fa-pencil"></i></p></div>
                <div class="champ"><p>Nom: </p><p id="modNom">$joueur->Prenom<i class="fa-solid fa-pencil"></i></p></div>
                <button id="btnModPassword">Modifier le mot de passe</button>
            </div>
        </div>
HTML;
} else {
	redirect("index.php");
}

include 'views/master.php';

<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

$viewTitle = "Bienvenue à Chevaleresk";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];
/*$isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];*/


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
		$image = <<<HTML
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
	if ($isAdmin) {
		$content = <<<HTML
	<!---------------------------Options pour admin-------------------------------->
	<!--Le profil à gauche-->
	<div class="optionsJeu">
	  <div class="optionsBackgroundGrisProfil">
		  <strong>Profil</strong>
		  <div class="optionsBackgroundBleuProfilImg">
			  $image
		  </div>
		  <p>$joueur->Alias</p>
		  $niveau
	  </div>
	  
	  <!--Les options à droite-->
	  <div class="optionsBtn" >
		  <button onclick="location.href='index.php'">
			  <a class="optionsBtnIcon" href ="index.php">
			  Achat <i class="fa fa-money"></i>
			</a>
		  </button>            

			<button onclick="location.href='inventaire.php'">
				<a class="optionsBtnIcon" href ="inventaire.php">
				Inventaire <i class="fa fa-id-card-o"></i>
				</a>
			</button>
			<button onclick="location.href='newItem.php'">
				<a class="optionsBtnIcon" href ="newItem.php">
				Nouveau item <i class="fa fa-money"></i>
				</a>
			</button>
			<button onclick="location.href='moderationCommentaires.php'">
				<a class="optionsBtnIcon" href ="moderationCommentaires.php">
				Modération des commentaires <i class="fa-solid fa-comment"></i>
				</a>
			</button>
			<button onclick="location.href='modifierProfilForm.php'">
				<a class="optionsBtnIcon" href ="modifierProfilForm.php">
				Modifier Profil <i class="fa fa-user"></i>
				</a>
			</button>
			<button onclick="location.href='optionsGagnerArgent.php'">
				<a class="optionsBtnIcon" href ="optionsGagnerArgent.php">
				Argent <i class="fa fa-gift"></i>
				</a>
			</button>
			<button onclick="location.href='logout.php'">
				<a class="optionsBtnIcon" href ="logout.php">
				Déconnexion <i class="fa fa-sign-out"></i>
				</a>
			</button>
		</div>
	</div>
  
HTML;
	} else {


		$content = <<<HTML
	<!---------------------------Options pour joueur-------------------------------->
	<!--Le profil à droite-->
	<div class="optionsJeu">
		<div class="optionsBackgroundGrisProfil">
			<strong>Profil</strong>
			<div class="optionsBackgroundBleuProfilImg">
				$image
			</div>
			<p>$joueur->Alias $niveau</p>
			<p>Nombre écus: <span>$joueur->Solde</span>$</p>
		</div>
		
		<!--Les options à gauche-->
		<div class="optionsBtn" >
			<button onclick="location.href='index.php'">
				<a class="optionsBtnIcon" href ="index.php">
				Achat <i class="fa fa-money"></i>
				</a>
			</button>

			<button onclick="location.href='inventaire.php'">
				<a class="optionsBtnIcon" href ="inventaire.php">
				Inventaire <i class="fa fa-id-card-o"></i>
				</a>
			</button>
			<button onclick="location.href='modifierProfilForm.php'">
				<a class="optionsBtnIcon" href ="modifierProfilForm.php">
				Modifier Profil <i class="fa fa-user"></i>
				</a>
			</button>
			<button onclick="location.href='optionsGagnerArgent.php'">
				<a class="optionsBtnIcon" href ="optionsGagnerArgent.php">
				Argent <i class="fa fa-gift"></i>
				</a>
			</button>
			<button onclick="location.href='logout.php'">
				<a class="optionsBtnIcon" href ="logout.php">
				Déconnexion <i class="fa fa-sign-out"></i>
				</a>
			</button>
		</div>
	</div>
  
HTML;
	}
} else {
	redirect("index.php");
}

include 'views/master.php';

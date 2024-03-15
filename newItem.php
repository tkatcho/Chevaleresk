<?php
require 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';

//adminAccess();
$sizesArmures = ["Petit", "Moyen", "Grand"];
$genresArmes = ["Epee","Arc","Bouclier"];
$efficaciteArme = ["Mauvais","Bon","Excellent","Legendaire"];
$effetPotion = ["Poison","Sante","Vitesse","Defense","Attaque"];
$typeElem = ["Eau","Feu","Vent","Terre"];
$rareteElem = ["Commun","Rare","Epic","Legendaire"];
$dangerositeElem = ["Aucun","Faible","Moyen","Grand"];


$jsonEffets = json_encode($effetPotion);
$jsonGenres = json_encode($genresArmes);
$jsonEff = json_encode($efficaciteArme);
$jsonSizes = json_encode($sizesArmures);
$jsonTypes = json_encode($typeElem);
$jsonRarete = json_encode($rareteElem);
$jsonDangerosite = json_encode($dangerositeElem);


$pageTitle = "Ajout d'item";
$viewTitle = "Ajout d'item";

$stylesBundle = "";
if (file_exists("views/stylesBundle.html")) {
    $stylesBundle = file_get_contents("views/stylesBundle.html");
}

$scriptsBundle = "";
if (file_exists("views/scriptsBundle.html")) {
    $scriptsBundle = file_get_contents("views/scriptsBundle.html");
}

$content = <<<HTML
            <form method="POST">
            <input type="radio" id="armure" name="typeItem" value="armure" required>
            <label for="armure">armure</label>
            <input type="radio" id="arme" name="typeItem" value="arme">
            <label for="arme">arme</label>
            <input type="radio" id="potion" name="typeItem" value="potion">
            <label for="potion">potion</label>
            <input type="radio" id="élément" name="typeItem" value="élément">
            <label for="élément">élément</label><br>

            <br>
            <input type="text" placeholder="Nom" required><br>
            <input type="number" placeholder="Quantite" min="1" max="999" required><br>
            <input type="number" placeholder="prix" min="1" max="999" required><br>


            <div id="formContent">
            </div>
            <input type="submit">
            </form>
            <script>
                var sizesArmures = JSON.parse('$jsonSizes');
                let efficacites = JSON.parse('$jsonEff');
                let genresArmes = JSON.parse('$jsonGenres');
                let effets = JSON.parse('$jsonEffets');

                let type = JSON.parse('$jsonTypes');
                let rarete = JSON.parse('$jsonRarete');
                let dangerosite = JSON.parse('$jsonDangerosite');


                document.querySelectorAll('input[name="typeItem"]').forEach((elem) => {
                    elem.addEventListener("change", function(event) {
                        var value = event.target.value;
                        var formContent = document.getElementById('formContent');
                        var htmlContent = '';

                        switch (value) {
                            case "armure":
                                htmlContent += '<input type="text" placeholder="Matière" required><br>';

                                htmlContent+='<label for="taille">Taille:</label>';
                                htmlContent += '<select id="taille" name="taille" required>';
                                sizesArmures.forEach(function(size) {
                                    htmlContent += '<option value="' + size + '">' + size + '</option>';
                                });
                                htmlContent += '</select><br>';
                                break;
                            
                            case "arme":
                                htmlContent+='<label for="Efficacite">Efficacite:</label>';
                                htmlContent+='<select id="Efficacite" name="Efficacite" required>';
                                efficacites.forEach(function(efficaciteArme) {
                                    htmlContent += '<option value="' + efficaciteArme + '">' + efficaciteArme + '</option>';
                                });
                                htmlContent += '</select><br> <label for="Genre">Genre:</label><select id = "Genre" name="Genre>';

                                genresArmes.forEach(function(genre) {
                                    htmlContent += '<option value="' + genre + '">' + genre + '</option>';
                                });
                                htmlContent += '</select><br>';
                                htmlContent+='  <textarea id="weaponDescription" name="weaponDescription" rows="4" cols="50" placeholder="Description..."></textarea><br>';
                                break;
                            case "potion":
                                htmlContent+='<label for="Effets">Effets:</label>';
                                htmlContent+='<select id="Effets" name="Effets" required>';
                                effets.forEach(function(effetPotion) {
                                    htmlContent += '<option value="' + effetPotion + '">' + effetPotion + '</option>';
                                });
                                htmlContent += '</select><br>';

                                htmlContent+= '<input type="checkbox" id="estAttaque" name = "estAttaque" value="estAttaque>';
                                htmlContent+= '<label for="estAttaque>Est Attaque</label><br>';
                                htmlContent+='<input type="number" placeholder ="Duree">'
                                break;
                            case "élément":
                                htmlContent+='<label for="Type">Type:</label>';
                                htmlContent+='<select id="Type" name="Type" required>';
                                type.forEach(function(type) {
                                    htmlContent += '<option value="' + type + '">' + type + '</option>';
                                });
                                htmlContent += '</select><br>';

                                htmlContent+='<label for="Rarete">Rarete:</label>';
                                htmlContent+='<select id="Rarete" name="Rarete" required>';
                                rarete.forEach(function(rarete) {
                                    htmlContent += '<option value="' + rarete + '">' + rarete + '</option>';
                                });
                                htmlContent += '</select><br>';
                                
                                htmlContent+='<label for="Dangerosite">Dangerosite:</label>';
                                htmlContent+='<select id="Dangerosite" name="Dangerosite" required>';
                                dangerosite.forEach(function(dangerosite) {
                                    htmlContent += '<option value="' + dangerosite + '">' + dangerosite + '</option>';
                                });
                                htmlContent += '</select><br>';
                                break;
                            default:
                                break;
                        }
                        formContent.innerHTML = htmlContent;
                    });
                });
            </script>
HTML;

$jsonSizes = json_encode($sizesArmures); // Convert sizesArmures$sizesArmures array to JSON
$jsonEff = json_encode($efficaciteArme);
$jsonGenres = json_encode($genresArmes);
$content = str_replace('$jsonSizes', $jsonSizes, $content); // Inject JSON into the script

include 'views/master.php';
?>

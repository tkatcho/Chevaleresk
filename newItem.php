<?php
require 'php/sessionManager.php';
require_once 'php/config.php';

//adminAccess();
$jsonEffets = json_encode($effetPotion);
$jsonGenres = json_encode($genresArmes);
$jsonEff = json_encode($efficaciteArme);
$jsonSizes = json_encode($sizesArmures);
$jsonTypes = json_encode($typeElem);
$jsonRarete = json_encode($rareteElem);
$jsonDangerosite = json_encode($dangerositeElem);


$stylesBundle = "";
if (file_exists("views/stylesBundle.html")) {
    $stylesBundle = file_get_contents("views/stylesBundle.html");
}

$scriptsBundle = "";
if (file_exists("views/scriptsBundle.html")) {
    $scriptsBundle = file_get_contents("views/scriptsBundle.html");
}

$content = <<<HTML
            <form action="verifItemInsertion.php" method="POST">
            <input type="radio" id="armure" name="typeItem" value="A" required>
            <label for="armure">armure</label>
            <input type="radio" id="arme" name="typeItem" value="W">
            <label for="arme">arme</label>
            <input type="radio" id="potion" name="typeItem" value="P">
            <label for="potion">potion</label>
            <input type="radio" id="élément" name="typeItem" value="E">
            <label for="élément">élément</label><br>

            <hr>
            <input  type="text" 
                          name="nom" 
                          id="nom"
                          placeholder="Nom" 
                          required 
                          RequireMessage = 'Veuillez entrer le nom'
                          InvalidMessage = 'Nom invalide'
                          CustomErrorMessage ="Ce nom est deja utilise"/>
            <br>

            <input type="number" name="quantiteStock" id="quantiteStock" placeholder="Quantite" min="1" max="999" required><br>
            <input type="number" name="prix" id="prix" placeholder="prix" min="1" max="999" required><br>


            <div id="formContent"></div>

            <legend>Avatar</legend>
            <div class='imageUploader' 
                newImage='true' 
                controlId='photo' 
                imageSrc='images/no_Avatar.jpg' 
                waitingImage="images/Loading_icon.gif"
                name="photo">
            </div>

            <input type="submit" name="submit">
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
                            case "A":
                                htmlContent += '<input type="text" name="Matiere" placeholder="Matière" required><br>';

                                htmlContent+='<label for="taill  e">Taille:</label>';
                                htmlContent += '<select id="taille" name="Taille" required>';
                                sizesArmures.forEach(function(size) {
                                    htmlContent += '<option value="' + size + '">' + size + '</option>';
                                });
                                htmlContent += '</select><br>';
                                break;
                            
                            case "W":
                                htmlContent+='<label for="efficacite">Efficacite:</label>';
                                htmlContent+='<select id="efficacite" name="efficacite" required>';
                                efficacites.forEach(function(efficaciteArme) {
                                    htmlContent += '<option value="' + efficaciteArme + '">' + efficaciteArme + '</option>';
                                });
                                htmlContent += '</select><br> <label for="Genre">Genre:</label><select id = "Genre" name="genre>';

                                genresArmes.forEach(function(genre) {
                                    htmlContent += '<option value="' + genre + '">' + genre + '</option>';
                                });
                                htmlContent += '</select><br>';
                                htmlContent+='  <textarea id="description" name="description" rows="4" cols="50" placeholder="Description..."></textarea><br>';
                                break;
                            case "P":
                                htmlContent+='<label for="effet">Effets:</label>';
                                htmlContent+='<select id="effet" name="effet" required>';
                                effets.forEach(function(effetPotion) {
                                    htmlContent += '<option value="' + effetPotion + '">' + effetPotion + '</option>';
                                });
                                htmlContent += '</select><br>';

                                htmlContent+= '<input type="checkbox" id="estAttaque" name = "estAttaque" value="estAttaque>';
                                htmlContent+= '<label for="estAttaque>Est Attaque</label><br>';
                                htmlContent+='<input type="number" placeholder ="Duree">'
                                break;
                            case "E":
                                htmlContent+='<label for="type">Type:</label>';
                                htmlContent+='<select id="type" name="type" required>';
                                type.forEach(function(type) {
                                    htmlContent += '<option value="' + type + '">' + type + '</option>';
                                });
                                htmlContent += '</select><br>';

                                htmlContent+='<label for="rarete">Rarete:</label>';
                                htmlContent+='<select id="rarete" name="rarete" required>';
                                rarete.forEach(function(rarete) {
                                    htmlContent += '<option value="' + rarete + '">' + rarete + '</option>';
                                });
                                htmlContent += '</select><br>';
                                
                                htmlContent+='<label for="dangerosite">Dangerosite:</label>';
                                htmlContent+='<select id="dangerosite" name="dangerosite" required>';
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
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script src="js/ImageControl.js"></script>

HTML;

include 'views/master.php';

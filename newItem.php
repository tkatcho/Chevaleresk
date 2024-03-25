<?php
require 'php/sessionManager.php';
require 'php/config.php';

#region code

//TODO, UNCOOMMENT ADMINACCESS() LINE

//adminAccess();
$messageHtml = '';

if (isset($_SESSION['success'])) {
    $messageHtml = '<h1 style="color: green;">' . htmlspecialchars($_SESSION['success']) . '</h1>';
    unset($_SESSION['success']);
} elseif (isset($_SESSION['error'])) {
    $messageHtml = '<h1 style="color: red;">' . htmlspecialchars($_SESSION['error']) . '</h1>';
    unset($_SESSION['error']);
}


$jsonEffets = json_encode($effetPotion);
$jsonGenres = json_encode($genresArmes);
$jsonEff = json_encode($efficaciteArme);
$jsonSizes = json_encode($sizesArmures);
$jsonTypes = json_encode($typeElem);
$jsonRarete = json_encode($rareteElem);
$jsonDangerosite = json_encode($dangerositeElem);
$jsonMatiere = json_encode($matiere);
$jsonNom = json_encode($noms);

print_r($jsonEffets);

$stylesBundle = "";
if (file_exists("views/stylesBundle.html")) {
    $stylesBundle = file_get_contents("views/stylesBundle.html");
}
$scriptsBundle = "";
if (file_exists("views/scriptsBundle.html")) {
    $scriptsBundle = file_get_contents("views/scriptsBundle.html");
}
#endregion

$content = <<<HTML

            
    <form action="verifItemInsertion.php" method="POST" autocomplete="off">
    <input type="radio" id="armure" name="typeItem" value="A" required>
    <label for="armure">armure</label>
    <input type="radio" id="arme" name="typeItem" value="W">
    <label for="arme">arme</label>
    <input type="radio" id="potion" name="typeItem" value="P">
    <label for="potion">potion</label>
    <input type="radio" id="élément" name="typeItem" value="E">
    <label for="élément">élément</label><br>

    <hr>
    <input type="text" name="nom" id="nom" placeholder="Nom" required><br>
    <input type="number" name="quantiteStock" id="quantiteStock" placeholder="Quantite" min="1" max="999" required><br>
    <input type="number" name="prix" id="prix" placeholder="prix" min="1" max="999" required><br>

    <div id="formContent"></div>

    <legend>Avatar</legend>
    <div class='imageUploader' newImage='true' controlId='photo' imageSrc='images/no_Avatar.jpg' waitingImage="images/Loading_icon.gif" name="photo"></div>
    <input type="submit" name="submit">
    $messageHtml
</form>
<script>
    var sizesArmures = JSON.parse('$jsonSizes');
    let efficacites = JSON.parse('$jsonEff');
    let genresArmes = JSON.parse('$jsonGenres');
    let effets = JSON.parse('$jsonEffets');

    let matiere = JSON.parse('$jsonMatiere')
    let type = JSON.parse('$jsonTypes');
    let rarete = JSON.parse('$jsonRarete');
    let dangerosite = JSON.parse('$jsonDangerosite');
    let noms = JSON.parse('$jsonNom')

    document.querySelectorAll('input[name="typeItem"]').forEach((elem) => {
        elem.addEventListener("change", function(event) {
            var value = event.target.value;
            var formContent = document.getElementById('formContent');
            var htmlContent = '';

            switch (value) {
                case "A":
                    htmlContent += '<input type="text" id="Matiere" name="Matiere" placeholder="Matière" required><br>';
                    htmlContent += '<input type="text" name="Taille" id="taille" placeholder="Taille" class="autocomplete" required><br>';
                    break;
                
                case "W":
                    htmlContent += '<input type="text" name="efficacite" id="efficacite" placeholder="Efficacite" class="autocomplete" required><br>';
                    htmlContent += '<input type="text" name="genre" id="Genre" placeholder="Genre" class="autocomplete" required><br>';
                    htmlContent += '<textarea id="description" name="description" rows="4" cols="50" placeholder="Description..."></textarea><br>';
                    break;

                case "P":
                    htmlContent += '<input type="text" name="effet" id="effet" placeholder="Effet" class="autocomplete" required><br>';
                    htmlContent += '<input type="checkbox" id="estAttaque" name="estAttaque" value="estAttaque><label for="estAttaque">Est Attaque</label><br>';
                    htmlContent += '<input type="number" name="duree" min="1" placeholder="Duree"><br>';
                    break;

                case "E":
                    htmlContent += '<input type="text" name="type" id="type" placeholder="Type" class="autocomplete" required><br>';
                    htmlContent += '<input type="text" name="rarete" id="rarete" placeholder="Rarete" class="autocomplete" required><br>';
                    htmlContent += '<input type="text" name="dangerosite" id="dangerosite" placeholder="Dangerosite" class="autocomplete" required><br>';
                    break;

                default:
                    break;
            }
            formContent.innerHTML = htmlContent;
            applyAutocomplete();
        });
    });
    function addCss(){
     $('.ui-autocomplete').css({
     'background-color': '#f5f5f5', 
     'max-width': '300px', 
     'max-heigth': '50px',
     'border': '1px solid #ccc',
     'box-shadow': '0 2px 4px rgba(0,0,0,0.1)'
     });

    }
    function applyAutocomplete() {
     $('#taille').autocomplete({
        source:sizesArmures
    });
    $('#Matiere').autocomplete({
        source:matiere
    });

    $('#efficacite').autocomplete({
       source:efficacites
    });

    $('#Genre').autocomplete({
        source:genresArmes
    });

    $('#effet').autocomplete({
        source:effets
    });

    $('#typeElement').autocomplete({
        source:type
    });

    $('#rarete').autocomplete({
        source:rarete
    });

    $('#type').autocomplete({
        source:type
    });
    $('#dangerosite').autocomplete({
        source: dangerosite,
    });
}

</script>
<script src="js/ImageControl.js"></script>


HTML;



include 'views/master.php';

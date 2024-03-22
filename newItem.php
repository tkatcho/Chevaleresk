<?php
require 'php/sessionManager.php';
require_once 'php/config.php';

#region code
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
            <input  type="text" 
                          name="nom" 
                          id="nom"
                          placeholder="Nom" 
                          required />
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
            $messageHtml
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

                                htmlContent+= '<div class="autocomplete" style="width:300px;">' +
                                    '<input id="taille" type="text" name="Taille" placeholder="Taille"></input>'+
                                '</div>';
                                // htmlContent += '<select id="taille" name="Taille" required>';
                                // sizesArmures.forEach(function(size) {
                                //     htmlContent += '<option value="' + size + '">' + size + '</option>';
                                // });
                                // htmlContent += '</select><br>';
                                break;
                            
                            case "W":
                                htmlContent+='<label for="efficacite">Efficacite:</label>';
                                htmlContent+='<select id="efficacite" name="efficacite" required>';
                                efficacites.forEach(function(efficaciteArme) {
                                    htmlContent += '<option value="' + efficaciteArme + '">' + efficaciteArme + '</option>';
                                });
                                htmlContent += '</select><br> <label for="Genre">Genre:</label><select id = "Genre" name="genre">';

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
            <script>
            function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
           </script>
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script src="js/ImageControl.js"></script>

HTML;



include 'views/master.php';

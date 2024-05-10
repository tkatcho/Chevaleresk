$(() => {
    
    $('#modAlias').on('click', () => {
        Swal.fire({
            title: "Entrez un nouvel alias",
            html: `
                <input id="modAliasInput" class="swal2-input" type="text" name="alias" maxlength="32">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Modifier",
            cancelButtonText: "Annuler",
            preConfirm: () => {

                const alias = Swal.getPopup().querySelector('#modAliasInput').value;

                if (!alias || /[^a-zA-Z]/.test(alias)) {
                    Swal.showValidationMessage('Veuillez entrer un alias valide');
                } else {
                    return $.ajax({
                        url: "./modAlias.php",
                        type: "POST",
                        data: {
                            alias: $('#modAliasInput').val(),
                        },
                        success: (response) => {
                            Swal.fire("Alias modifié", response.message, "success");
                            $('#modAlias').html(alias + '<i class="fa-solid fa-pencil">');
                        },
                        error: (xhr, status, error) => {
                            Swal.fire("Erreur", `Alias non-modifié: ${error}`, "error");
                        }
                    });
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    });

    $('#modPrenom').on('click', () => {
        Swal.fire({
            title: "Entrez un nouveau prénom",
            html: `
                <input id="modPrenomInput" class="swal2-input" type="text" name="prenom" maxlength="32">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Modifier",
            cancelButtonText: "Annuler",
            preConfirm: () => {

                const prenom = Swal.getPopup().querySelector('#modPrenomInput').value;

                if (!prenom || /[^a-zA-Z]/.test(prenom)) {
                    Swal.showValidationMessage('Veuillez entrer un prénom valide');
                } else {
                    return $.ajax({
                        url: "./modPrenom.php",
                        type: "POST",
                        data: {
                            prenom: $('#modPrenomInput').val(),
                        },
                        success: (response) => {
                            Swal.fire("Prénom modifié", response.message, "success");
                            $('#modPrenom').html(prenom + '<i class="fa-solid fa-pencil">');
                        },
                        error: (xhr, status, error) => {
                            Swal.fire("Erreur", `Prénom non-modifié: ${error}`, "error");
                        }
                    });
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    });

    $('#modNom').on('click', () => {
        Swal.fire({
            title: "Entrez un nouveau nom",
            html: `
                <input id="modNomInput" class="swal2-input" type="text" name="nom" maxlength="32">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Modifier",
            cancelButtonText: "Annuler",
            preConfirm: () => {

                const nom = Swal.getPopup().querySelector('#modNomInput').value;

                if (!nom || /[^a-zA-Z]/.test(nom)) {
                    Swal.showValidationMessage('Veuillez entrer un nom valide');
                } else {
                    return $.ajax({
                        url: "./modNom.php",
                        type: "POST",
                        data: {
                            nom: $('#modNomInput').val(),
                        },
                        success: (response) => {
                            Swal.fire("Nom modifié", response.message, "success");
                            $('#modNom').html(nom + '<i class="fa-solid fa-pencil">');
                        },
                        error: (xhr, status, error) => {
                            Swal.fire("Erreur", `Nom non-modifié: ${error}`, "error");
                        }
                    });
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    });

    $('#btnModPassword').on('click', () => {
        Swal.fire({
            title: "Modifiez votre mot de passe",
            html: `
                <label for="modPasswordCurrentInput">Mot de passe courant</label>
                <input id="modPasswordCurrentInput" class="swal2-input" type="password" name="mdpCourant">

                <label for="modPasswordInput">Nouveau mot de passe</label>
                <input id="modPasswordInput" class="swal2-input" type="password" name="mdp">

                <label for="modPasswordConfirmInput">Nouveau mot de passe</label>
                <input id="modPasswordConfirmInput" class="swal2-input" type="password" name="mdpConfirm">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Modifier",
            cancelButtonText: "Annuler",
            preConfirm: () => {

                const mdpCourant = Swal.getPopup().querySelector('#modPasswordCurrentInput').value;
                const mdp = Swal.getPopup().querySelector('#modPasswordInput').value;
                const mdpConfirm = Swal.getPopup().querySelector('#modPasswordConfirmInput').value;

                if (!mdpCourant || !mdp || !mdpConfirm || mdp != mdpConfirm) {
                    if (!mdpCourant || !mdp || !mdpConfirm) {
                        Swal.showValidationMessage('Veuillez remplir tout les champs');
                    }
                    if (mdp != mdpConfirm && !(!mdpCourant || !mdp || !mdpConfirm)) {
                        Swal.showValidationMessage('Les mot de passes ne correspondent pas');
                    }
                } else {
                    return $.ajax({
                        url: "./modPassword.php",
                        type: "POST",
                        data: {
                            mdpCourant: $('#modPasswordCurrentInput').val(),
                            mdp: $('#modPasswordInput').val(),
                        },
                        success: (response) => {
                            Swal.fire("Mot de passe modifié", response.message, "success");
                        },
                        error: (xhr, status, error) => {
                            Swal.fire("Erreur", `Le mot de passe courant est érroné`, "error");
                        }
                    });
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    });

});
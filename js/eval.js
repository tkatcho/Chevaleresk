$(() => {

    const urlParams = new URLSearchParams(window.location.search);
    const itemId = urlParams.get('idItem');

    $('.btnÉvaluerCommenter:nth-of-type(1)').click(function() {
        Swal.fire({
            title: "Évaluation",
            html: `
                <input type="hidden" id="itemIdForm" value="${itemId}">
                <label for="starsForm">Nombre d'étoiles</label></br>
                <input type="hidden" id="starsForm" name="stars" value="0">
                <div class="starsContainer">
                    <button class="etoile" id="etoile_1" valeur_etoile="1"><i class="fa-regular fa-star"></i></button>
                    <button class="etoile" id="etoile_2" valeur_etoile="2"><i class="fa-regular fa-star"></i></button>
                    <button class="etoile" id="etoile_3" valeur_etoile="3"><i class="fa-regular fa-star"></i></button>
                    <button class="etoile" id="etoile_4" valeur_etoile="4"><i class="fa-regular fa-star"></i></button>
                    <button class="etoile" id="etoile_5" valeur_etoile="5"><i class="fa-regular fa-star"></i></button>
                </div>
                <label for="commentForm">Commentaire</label>
                <textarea id="commentForm" name="comment"></textarea>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Publier",
            cancelButtonText: "Annuler",
            preConfirm: () => {

                const comment = Swal.getPopup().querySelector('#commentForm').value;
                const stars = Swal.getPopup().querySelector('#starsForm').value;

                if (!comment || stars == 0 || stars > 5) {
                    Swal.showValidationMessage('Veuillez entrer un commentaire et un nombre d\'étoiles');
                } else {
                    return $.ajax({
                        url: "./rateItem.php",
                        type: "POST",
                        data: {
                            itemId: $('#itemIdForm').val(),
                            stars: $('#starsForm').val(),
                            comment: $('#commentForm').val()
                        },
                        success: (response) => {
                            Swal.fire("Évaluation publié", response.message, "success");
                            $('.btnÉvaluerCommenter:nth-of-type(1)').addClass('btnDejaEvaluer');
                            $('.btnÉvaluerCommenter:nth-of-type(1)').prop('disabled', true);
                            $('.btnÉvaluerCommenter:nth-of-type(1) a').text('Vous avez déja commenté');
                        },
                        error: (xhr, status, error) => {
                            Swal.fire("Erreur", `Évaluation non-publié: ${error}`, "error");
                        }
                    });
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        });

        $('#stars').text($('#starsForm').val());

        $('#starsForm').on('input', function() {
            var rangeValue = $(this).val();
            $('#stars').text(rangeValue);
        });

        $('.etoile').on('click', (event) => {
            switch($(event.currentTarget).attr('valeur_etoile')) {
                case "1":
                    $('#etoile_1').html('<i class="fa-solid fa-star">');
                    $('#etoile_1').addClass('etoileSel');

                    $('#etoile_2').html('<i class="fa-regular fa-star">');
                    $('#etoile_2').removeClass('etoileSel');

                    $('#etoile_3').html('<i class="fa-regular fa-star">');
                    $('#etoile_3').removeClass('etoileSel');

                    $('#etoile_4').html('<i class="fa-regular fa-star">');
                    $('#etoile_4').removeClass('etoileSel');

                    $('#etoile_5').html('<i class="fa-regular fa-star">');
                    $('#etoile_5').removeClass('etoileSel');

                    $('#starsForm').val('1');

                    break;
                case "2":
                    $('#etoile_1').html('<i class="fa-solid fa-star">');
                    $('#etoile_1').addClass('etoileSel');

                    $('#etoile_2').html('<i class="fa-solid fa-star">');
                    $('#etoile_2').addClass('etoileSel');

                    $('#etoile_3').html('<i class="fa-regular fa-star">');
                    $('#etoile_3').removeClass('etoileSel');

                    $('#etoile_4').html('<i class="fa-regular fa-star">');
                    $('#etoile_4').removeClass('etoileSel');

                    $('#etoile_5').html('<i class="fa-regular fa-star">');
                    $('#etoile_5').removeClass('etoileSel');

                    $('#starsForm').val('2');

                    break;
                case "3":
                    $('#etoile_1').html('<i class="fa-solid fa-star">');
                    $('#etoile_1').addClass('etoileSel');

                    $('#etoile_2').html('<i class="fa-solid fa-star">');
                    $('#etoile_2').addClass('etoileSel');

                    $('#etoile_3').html('<i class="fa-solid fa-star">');
                    $('#etoile_3').addClass('etoileSel');

                    $('#etoile_4').html('<i class="fa-regular fa-star">');
                    $('#etoile_4').removeClass('etoileSel');

                    $('#etoile_5').html('<i class="fa-regular fa-star">');
                    $('#etoile_5').removeClass('etoileSel');

                    $('#starsForm').val('3');

                    break;
                case "4":
                    $('#etoile_1').html('<i class="fa-solid fa-star">');
                    $('#etoile_1').addClass('etoileSel');

                    $('#etoile_2').html('<i class="fa-solid fa-star">');
                    $('#etoile_2').addClass('etoileSel');

                    $('#etoile_3').html('<i class="fa-solid fa-star">');
                    $('#etoile_3').addClass('etoileSel');

                    $('#etoile_4').html('<i class="fa-solid fa-star">');
                    $('#etoile_4').addClass('etoileSel');

                    $('#etoile_5').html('<i class="fa-regular fa-star">');
                    $('#etoile_5').removeClass('etoileSel');

                    $('#starsForm').val('4');

                    break;
                case "5":
                    $('#etoile_1').html('<i class="fa-solid fa-star">');
                    $('#etoile_1').addClass('etoileSel');

                    $('#etoile_2').html('<i class="fa-solid fa-star">');
                    $('#etoile_2').addClass('etoileSel');

                    $('#etoile_3').html('<i class="fa-solid fa-star">');
                    $('#etoile_3').addClass('etoileSel');

                    $('#etoile_4').html('<i class="fa-solid fa-star">');
                    $('#etoile_4').addClass('etoileSel');

                    $('#etoile_5').html('<i class="fa-solid fa-star">');
                    $('#etoile_5').addClass('etoileSel');

                    $('#starsForm').val('5');

                    break;
            }
        });

    });

});
$(() => {

    const urlParams = new URLSearchParams(window.location.search);
    const itemId = urlParams.get('idItem');

    $('.btnÉvaluerCommenter:nth-of-type(1)').click(function() {
        Swal.fire({
            title: "Évaluation",
            html: `
                <input type="hidden" id="itemIdForm" value="${itemId}">
                <label for="starsForm">Nombre d'étoiles</label></br>
                <input id="starsForm" type="range" min="1" max="5" value="5" name="stars">
                <p id="stars"></p>
                <label for="commentForm">Commentaire</label>
                <textarea id="commentForm" name="comment"></textarea>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Publier",
            cancelButtonText: "Annuler",
            preConfirm: () => {

                const comment = Swal.getPopup().querySelector('#commentForm').value;

                if (!comment) {
                    Swal.showValidationMessage('Veuillez entrer un commentaire');
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

    });
});
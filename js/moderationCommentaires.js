$(() => {

    $('.supprimerCommentaire').on('click', function () {
        const idEval = $(this).attr('commentaireId');

        Swal.fire({
            title: "Voulez vous supprimer ce commentaire?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Non",
            confirmButtonText: "Oui"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "./supprimerEvaluation.php",
                    type: "POST",
                    data: {
                        idEval: idEval
                    },
                    success: (response) => {
                        $('#' + idEval).remove();
                    },
                    error: (xhr, status, error) => {
                        Swal.fire("Erreur", `Commentaire non-supprimé: ${error}`, "error");
                    }
                });
            }
          });
    });

});
$(document).ready(function() {

    $('.ckDif').on('click', function () {
        let premierArg = "?d=";
        if (document.URL.indexOf('?') > - 1)
            premierArg = "";
        if (document.URL.indexOf($(this).attr('d')) > - 1) {
            window.location.href = document.URL.replace($(this).attr('d'), '');
        } else {
            window.location.href = document.URL + premierArg + $(this).attr('d');
        }
    });

});
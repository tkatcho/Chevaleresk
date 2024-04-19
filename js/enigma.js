$(document).ready(function() {

    $('.ckDif').on('click', function () {
        let premierArg = "?d=";
        if (document.URL.indexOf('?d') > - 1)
            premierArg = "";
        if(document.URL.indexOf('?t') > - 1)
            premierArg="&d=";
        if (document.URL.indexOf($(this).attr('d')) > - 1) {
            window.location.href = document.URL.replace($(this).attr('d'), '');
        } else {
            window.location.href = document.URL + premierArg + $(this).attr('d');
        }
    });

    $('.ckType').on('click', function () {
        let premierArg = "?t=";
        if (document.URL.indexOf('?t') > - 1)
            premierArg = "";
        if(document.URL.indexOf('?d') > - 1)
            premierArg="&t=";
        if (document.URL.indexOf($(this).attr('t')) > - 1) {
            window.location.href = document.URL.replace($(this).attr('t'), '');
            
        } else {
            window.location.href = document.URL + premierArg + $(this).attr('t');
        }
    });

});
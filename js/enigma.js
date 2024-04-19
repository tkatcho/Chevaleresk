$(document).ready(function() {

    $('.ckDif').on('click', function () {
        let premierArg = "?d=";
        if (document.URL.indexOf('?') > - 1)
            premierArg="&d=";
        if (document.URL.indexOf('?d') > - 1 || document.URL.indexOf('&d') > - 1)
            premierArg = "";
        if (document.URL.indexOf($(this).attr('d')) > - 1) {
            window.location.href = document.URL.replace($(this).attr('d'), '');
        } else {
            if (premierArg != "") {
                window.location.href = document.URL + premierArg + $(this).attr('d');
            } else {
                url = document.URL.split("d=");
                window.location.href = url[0] + "d=" + premierArg + $(this).attr('d') + url[1];
            }
        }
    });

    $('.ckType').on('click', function () {
        let premierArg = "?t=";
        if (document.URL.indexOf('?') > - 1)
            premierArg="&t=";
        if (document.URL.indexOf('?t') > - 1 || document.URL.indexOf('&t') > - 1)
            premierArg = "";
        if (document.URL.indexOf($(this).attr('t')) > - 1) {
            window.location.href = document.URL.replace($(this).attr('t'), '');
        } else {
            if (premierArg != "") {
                window.location.href = document.URL + premierArg + $(this).attr('t');
            } else {
                url = document.URL.split("t=");
                window.location.href = url[0] + "t=" + premierArg + $(this).attr('t') + url[1];
            }
        }
    });

});
$(document).ready(function() {

    //La difficulté
    $('.ckDif').on('click', function () {
        let premierArg = "?d=";
        let estPremierArgChecked= (document.URL.indexOf("?d=" +$(this).attr('d')) > - 1) ;
        let estPasPremierArgChecked= (document.URL.indexOf("&d=" +$(this).attr('d')) > - 1);
        let typeDansURL = (document.URL.indexOf("&t=") > - 1);

        if (document.URL.indexOf('?t=') > - 1 || document.URL.indexOf('?d=') > - 1)     //Il y a déjà une condition dans l'URL
            premierArg = "&d=";

        if (estPremierArgChecked ) {               //Il y a un ?d=
            if(typeDansURL) {      //Il y a un &t=
                window.location.href = document.URL.replace("?d="+$(this).attr('d') + "&t=", '?t=');
            }
            else {
                window.location.href = document.URL.replace("?d="+$(this).attr('d'), '');
            }     
        } 
        if(estPasPremierArgChecked) {                  //Il y a un &d=
            window.location.href = document.URL.replace("&d="+$(this).attr('d'), '');
        }
        if(!estPremierArgChecked  && !estPasPremierArgChecked) {                   //URL vide
            window.location.href = document.URL + premierArg + $(this).attr('d');
        }
    });


    //Le type
    $('.ckType').on('click', function () {
       let premierArg = "?t=";
        let estPremierArgChecked= (document.URL.indexOf("?t=" +$(this).attr('t')) > - 1) ;
        let estPasPremierArgChecked= (document.URL.indexOf("&t=" +$(this).attr('t')) > - 1);
        let difDansURL = (document.URL.indexOf("&d=") > - 1);

        if (document.URL.indexOf('?t=') > - 1 || document.URL.indexOf('?d=') > - 1)    //Il y a déjà une condition dans l'URL
            premierArg = "&t=";
        
        if (estPremierArgChecked ) {               //Il y a un ?t=
            if(difDansURL)       //Il y a un &d=
                window.location.href = document.URL.replace("?t="+$(this).attr('t') + "&d=", '?d=');
            else 
                window.location.href = document.URL.replace("?t="+$(this).attr('t'), '');
        } 
        if(estPasPremierArgChecked) {                  //Il y a un &t=
            window.location.href = document.URL.replace("&t="+$(this).attr('t'), ''); 
        }
        if(!estPremierArgChecked  && !estPasPremierArgChecked) {           //URL vide
            window.location.href = document.URL + premierArg + $(this).attr('t');
        }
    });

});
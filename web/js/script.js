
var recharger = false

function resultatlien(html,status,xhr){
    console.log(status);
    console.log(xhr.status);
    console.log(html);

    if(recharger){
        $.ajax({
            url : "index.php?r=site%2Fnavbar",
            success: function (result){
                $('nav').html(result);
            },
            error: erreurlien,
        });
    }

    $('#content').html(html);

    document.getElementById("alert-text").innerHTML = "";
}

function erreurlien(xhr,status,error){
    console.log("erreur")
    console.log(status);
    console.log(xhr.status);
    console.log(error);
    console.log(xhr);

    document.getElementById("alert").className = "text-light d-flex align-items-center justify-content-center bg-danger";

    document.getElementById("alert-text").innerHTML = "Problème de connexion avec le serveur";
}

function requete(lien,nav=false){
    console.log(lien);

    recharger = nav;

    $.ajax({
        url : lien,
        success: resultatlien,
        error: erreurlien
    });
}
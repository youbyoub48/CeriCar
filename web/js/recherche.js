console.log("test");


function resultat(html,status,xhr){
    console.log(status);
    console.log(xhr.status);
    console.log(html);
    $('#result').html(html);

    document.getElementById("alert").className = "text-light d-flex align-items-center justify-content-center bg-success";
    document.getElementById("alert-text").innerHTML = "Voyage trouvé";
}

function erreur(xhr,status,error){
    console.log("erreur")
    console.log(status);
    console.log(xhr.status);
    console.log(error);

    document.getElementById("alert").className = "text-light d-flex align-items-center justify-content-center bg-danger";

    if(xhr.status == 406) document.getElementById("alert-text").innerHTML = "Trajet non trouvé";
    else if(xhr.status == 404) document.getElementById("alert-text").innerHTML = "Aucun voyages trouvé";
    else document.getElementById("alert-text").innerHTML = "Problème de connexion avec le serveur";

    $('#result').html("");
}

function rechercher(){
    let depart =  document.getElementById("depart").value;
    let arrivee =  document.getElementById("arrivee").value;
    let personnes =  document.getElementById("personnes").value;

    console.log(depart);
    console.log(arrivee);
    console.log(personnes);

    $.ajax({
        url : "https://pedago.univ-avignon.fr/~uapv2305363/cericar/web/index.php?r=site%2Fsearch&depart="+depart+"&arrivee="+arrivee+"&personnes="+personnes,
        success: resultat,
        error: erreur
    });
}
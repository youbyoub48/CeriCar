
function resultat(html,status,xhr){
    console.log(status);
    console.log(xhr.status);
    console.log(html);
    $('#content').html(html);

    document.getElementById("alert").className = "text-light d-flex align-items-center justify-content-center bg-success";
    document.getElementById("alert-text").innerHTML = "Inscription réussi";
}

function erreur(xhr,status,error){
    console.log("erreur")
    console.log(status);
    console.log(xhr.status);
    console.log(error);
    console.log(xhr);

    document.getElementById("alert").className = "text-light d-flex align-items-center justify-content-center bg-danger";

    if(xhr.status == 406) document.getElementById("alert-text").innerHTML = "Veuillez remplir tous les champs et tels qui sont attendus";
    else document.getElementById("alert-text").innerHTML = "Problème de connexion avec le serveur";
}



function proposer(){
    let depart = document.getElementById("ville_depart").value;
    let arrivee = document.getElementById("ville_arrivee").value;
    let heure = document.getElementById("heure_depart").value;
    let places = document.getElementById("nb_places").value;
    let tarif = document.getElementById("tarif").value;
    let baggage = document.getElementById("nb_bagages").value;
    let type = document.getElementById("type_voiture").value;
    let marque = document.getElementById("marque_voiture").value;
    let contraintes = document.getElementById("contraintes").value;

    heure = heure.split(":")[0];

    console.log(depart);
    console.log(arrivee);
    console.log(heure);
    console.log(places);
    console.log(tarif);
    console.log(baggage);
    console.log(type);
    console.log(marque);
    console.log(contraintes);

    $.ajax({
        url : "index.php?r=site%2Fproposer",
        type : "POST",
        data: {"depart": depart, "arrivee": arrivee, "idtypev": type, "idmarquev": marque, "tarif": tarif, "nbplacedispo": places, "nbbagage": baggage, "heuredepart": heure, "contraintes": contraintes},
        success: resultat,
        error: erreur
    });
}
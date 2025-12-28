
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

    if(xhr.status == 406) document.getElementById("alert-text").innerHTML = "Veuillez remplir tous les champs";
    else document.getElementById("alert-text").innerHTML = "Problème de connexion avec le serveur";
}

function inscrire(){
    let nom = document.getElementById("nom").value;
    let prenom = document.getElementById("prenom").value
    let pseudo = document.getElementById("pseudo").value
    let permis = document.getElementById("permis").value
    let mail = document.getElementById("mail").value
    let photo = document.getElementById("photo").value
    let pass = document.getElementById("pass").value

    console.log(nom);
    console.log(prenom);
    console.log(pseudo);
    console.log(permis);
    console.log(mail);
    console.log(photo); 

    $.ajax({
        url : "index.php?r=site%2Fsignup",
        type : "POST",
        data: {"nom": nom, "prenom": prenom, "pseudo": pseudo, "permis": permis, "mail": mail, "photo": photo, "pass": pass},
        success: resultat,
        error: erreur
    });
}
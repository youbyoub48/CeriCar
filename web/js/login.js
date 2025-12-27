
function resultat(html,status,xhr){
    console.log(status);
    console.log(xhr.status);
    console.log(html);
    $('#content').html(html);
    $('#navaccount').html(
        `<li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-1" href="index.php?r=site%2Flogout" data-method="post">
                <span class="material-symbols-outlined">logout</span> Déconnexion
            </a>
        </li>
    `);

    document.getElementById("alert").className = "text-light d-flex align-items-center justify-content-center bg-success";
    document.getElementById("alert-text").innerHTML = "Connexion réussi";
}

function erreur(xhr,status,error){
    console.log("erreur")
    console.log(status);
    console.log(xhr.status);
    console.log(error);
    console.log(xhr);

    document.getElementById("alert").className = "text-light d-flex align-items-center justify-content-center bg-danger";

    if(xhr.status == 406) document.getElementById("alert-text").innerHTML = "Veuillez remplir tous les champs";
    else if(xhr.status == 404) document.getElementById("alert-text").innerHTML = "Email ou mot de passe incorrecte";
    else document.getElementById("alert-text").innerHTML = "Problème de connexion avec le serveur";
}

function connexion(){
    let email = document.getElementById("email").value;
    let pass = document.getElementById("pass").value;

    console.log(email);

    $.ajax({
        url : "index.php?r=site%2Flogin",
        type : "POST",
        data: {"mail" : email, "pass" : pass},
        success: resultat,
        error: erreur
    });
}

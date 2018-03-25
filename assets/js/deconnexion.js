function deco() {
    swal({
        text: "Vous vous êtes déconnecté.",
        type : "success"
    }).then(function(){
        window.location.replace("http://localhost/projet/authent.php");
    });
}

function messageParticipationDenied($a) {
        swal({
            text: "Vous avez arrêté de participer à la formation "+$a,
            type : "success"
            });
}
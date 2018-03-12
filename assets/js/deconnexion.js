function deco() {
    window.location.replace("http://localhost/projet/authent.php");
    alert("Vous vous êtes déconnecté.");
}

function messageParticipationDenied($a) {
    alert("Vous avez annulé votre participation à la formation "+$a);
}
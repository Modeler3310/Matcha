var error = {
    '-11' : 'Veuillez remplir le formulaire en entier',
    '-1' : 'L\'utilisateur n\'existe pas',
    '-4' : 'Veuillez valider votre email',
    '-10' : 'Veuillez valider votre email, vous avez été report',
    '0' : 'Mot de passe incorrect',
    '-2' : 'L\'utilisatuer existe déjà',

};

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(pass) {
    var re = /^.*(?=.{8,})((?=.*[!@#$%^&*()\-_=+{};:,<.>]){1})(?=.*\d)((?=.*[a-z]){1})((?=.*[A-Z]){1}).*$/;
    return re.test(String(pass));
}
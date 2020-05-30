//Funciones a utilizar para validaciones JavaScript

function usernameCheck(username) {
    if(username.length < 1) {
        alert("El nombre de usuario no puede estar vacío.");
        return false;
    } else {
        return true;
    }
}

function emailCheck(email) {
    var emailRegex = /^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

    if (email.length < 1) {
        alert("La dirección de email no puede estar vacía.");
        return false;
    } else if(! emailRegex.test(email)) {
        alert("La dirección de email es incorrecta.");
        return false;
    } else {
        return true;
    }
}

function telefonoCheck(tlfn) {
    // Sólo números
    var phoneNumberRegex = /^\d*$/;

    if(tlfn.length != 9 || !phoneNumberRegex.test(tlfn)) {
        alert("Telefono no válido.");
        return false;
    } else {
        return true;
    }
}

function passwordCheck(password) {
    if(password.length < 5) {
        alert("La contraseña debe tener al menos 5 caracteres.");
        return false;
    } else {
        return true;
    }
}

function newPasswordCheck(password1, password2) {
    if(password1 != password2) {
        alert("Las contraseñas no coinciden.");
        return false;
    } else {
        return true;
    }
}

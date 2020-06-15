// Walidacja formularza

let error = 0;
let errorLogin = 0;
let errorPassword = 0;
let errorPasswordRepeat = 0;
let errorEmail = 0;

document.getElementById("loginInput").addEventListener("focusout", loginCheck);
document.getElementById("loginInput").addEventListener("focus", function() {
    if (errorLogin == 0) {
        document.getElementById("badLogin").style.display = "none";
    }
    if (errorPassword == 0) {
        document.getElementById("badPassword").style.display = "none";
    }
    if (errorPasswordRepeat == 0) {
        document.getElementById("badRepeatPassword").style.display = "none";
    }
    if (errorEmail == 0) {
        document.getElementById("badEmail").style.display = "none";
    }
});

document.getElementById("pass").addEventListener("focusout", passwordCheck);
document.getElementById("pass").addEventListener("focus", function() {
    if (errorLogin == 0) {
        document.getElementById("badLogin").style.display = "none";
    }
    if (errorPassword == 0) {
        document.getElementById("badPassword").style.display = "none";
    }
    if (errorPasswordRepeat == 0) {
        document.getElementById("badRepeatPassword").style.display = "none";
    }
    if (errorEmail == 0) {
        document.getElementById("badEmail").style.display = "none";
    }
});

document.getElementById("pass2").addEventListener("focusout", passwordRepeatCheck);
document.getElementById("pass2").addEventListener("focus", function() {
    if (errorLogin == 0) {
        document.getElementById("badLogin").style.display = "none";
    }
    if (errorPassword == 0) {
        document.getElementById("badPassword").style.display = "none";
    }
    if (errorPasswordRepeat == 0) {
        document.getElementById("badRepeatPassword").style.display = "none";
    }
    if (errorEmail == 0) {
        document.getElementById("badEmail").style.display = "none";
    }
});

document.getElementById("emailInput").addEventListener("focusout", emailCheck);
document.getElementById("emailInput").addEventListener("focus", function() {
    if (errorLogin == 0) {
        document.getElementById("badLogin").style.display = "none";
    }
    if (errorPassword == 0) {
        document.getElementById("badPassword").style.display = "none";
    }
    if (errorPasswordRepeat == 0) {
        document.getElementById("badRepeatPassword").style.display = "none";
    }
    if (errorEmail == 0) {
        document.getElementById("badEmail").style.display = "none";
    }
});


// Sprawdzenie loginu
function loginCheck() {
    errorLogin = 0;
    let login = document.forms["registrationForm"]["login"].value;
    document.getElementById("badLogin").innerHTML = "";
    if (login == "") {
        document.getElementById("badLogin").style.display = "block";
        document.getElementById("badLogin").innerHTML += "- Podaj login <br>";
        errorLogin++;
    } else {
        if (login.length < 6) {
            document.getElementById("badLogin").style.display = "block";
            document.getElementById("badLogin").innerHTML += "- Co najmniej 6 znaków <br>";
            errorLogin++;
        }
        if (login.length > 25) {
            document.getElementById("badLogin").style.display = "block";
            document.getElementById("badLogin").innerHTML += "- Maksymalnie 25 znaków <br>";
            errorLogin++;
        }
        var char = login.slice(0, 1);
        if (!char.match(/[a-zA-Z]/i)) {
            document.getElementById("badLogin").style.display = "block";
            document.getElementById("badLogin").innerHTML += "- Zacznij od litery <br>";
            errorLogin++;
        }
    }
    if (errorLogin == 0) {
        document.getElementById("badLogin").style.display = "none";
    }
}

// Sprawdzenie hasła
function passwordCheck() {
    errorPassword = 0;
    let password = document.forms["registrationForm"]["psw"].value;
    document.getElementById("badPassword").innerHTML = "";
    if (password == "") {
        document.getElementById("badPassword").style.display = "block";
        document.getElementById("badPassword").innerHTML += "- Podaj hasło <br>";
        errorPassword++;
    } else {
        if (password.length < 8) {
            document.getElementById("badPassword").style.display = "block";
            document.getElementById("badPassword").innerHTML += "- Co najmniej 8 znaków <br>";
            errorPassword++;
        }
        if (password.length > 25) {
            document.getElementById("badPassword").style.display = "block";
            document.getElementById("badPassword").innerHTML += "- Maksymalnie 25 znaków <br>";
            errorPassword++;
        }
        if ((password.match(/[A-Z]/g)) == null) {
            document.getElementById("badPassword").style.display = "block";
            document.getElementById("badPassword").innerHTML += "- Mała litera, duża litera, liczba <br>";
            errorPassword++;
        } else if ((password.match(/[a-z]/g)) == null) {
            document.getElementById("badPassword").style.display = "block";
            document.getElementById("badPassword").innerHTML += "- Mała litera, duża litera, liczba <br>";
            errorPassword++;
        } else if ((password.match(/[0-9]/g)) == null) {
            document.getElementById("badPassword").style.display = "block";
            document.getElementById("badPassword").innerHTML += "- Mała litera, duża litera, liczba <br>";
            errorPassword++;
        }
        let passwordRepeat = document.forms["registrationForm"]["psw-repeat"].value;
        if (passwordRepeat != "") {
            passwordRepeatCheck();
        }
    }
    if (errorPassword == 0) {
        document.getElementById("badPassword").style.display = "none";
    }
}

// Sprawdzenie poprawności powtórzenia hasła
function passwordRepeatCheck() {
    errorPasswordRepeat = 0;
    let passwordRepeat = document.forms["registrationForm"]["psw-repeat"].value;
    document.getElementById("badRepeatPassword").innerHTML = "";
    if (passwordRepeat == "") {
        document.getElementById("badRepeatPassword").style.display = "block";
        document.getElementById("badRepeatPassword").innerHTML += "- Podaj hasło <br>";
        errorPasswordRepeat++;
    } else {
        let password = document.forms["registrationForm"]["psw"].value;
        if (password != passwordRepeat) {
            document.getElementById("badRepeatPassword").style.display = "block";
            document.getElementById("badRepeatPassword").innerHTML += "- Błędne hasło <br>";
            errorPasswordRepeat++;
        }
    }
    if (errorPasswordRepeat == 0) {
        document.getElementById("badRepeatPassword").style.display = "none";
    }
}

// Sprawdzenie poprawności emaila
function emailCheck() {
    errorEmail = 0;
    let email = document.forms["registrationForm"]["email"].value;
    document.getElementById("badEmail").innerHTML = "";
    if (email == "") {
        document.getElementById("badEmail").style.display = "block";
        document.getElementById("badEmail").innerHTML += "- Podaj email <br>";
        errorEmail++;
    } else {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!email.match(mailformat)) {
            document.getElementById("badEmail").style.display = "block";
            document.getElementById("badEmail").innerHTML += "- Błędny format maila <br>";
            errorEmail++;
        }
    }
    if (errorEmail == 0) {
        document.getElementById("badEmail").style.display = "none";
    }
}

// Funkcja pokazująca hasło
function myFunction() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    var x2 = document.getElementById("pass2");
    if (x2.type === "password") {
        x2.type = "text";
    } else {
        x2.type = "password";
    }
}

// Wyłączenie błędu nie wybrania płci
document.getElementById("wojownik").addEventListener("click", checkboxErrorDisable);
document.getElementById("wojowniczka").addEventListener("click", checkboxErrorDisable);
let checkboxError = 0;

function checkboxErrorDisable() {
    checkboxError = 0;
    document.getElementById("gender").style.display = "none";
}

document.querySelector(".registerbtn").addEventListener("click", checkAll);

function checkAll() {
    loginCheck();
    passwordCheck();
    passwordRepeatCheck();
    emailCheck();

    if (document.getElementById("wojownik").checked == false && document.getElementById("wojowniczka").checked == false) {
        document.getElementById("gender").style.display = "block";
        checkboxError++;
    }
    if (checkboxError == 0 && errorEmail == 0 && errorLogin == 0 && errorPassword == 0 && errorPasswordRepeat == 0) {
        document.querySelector(".registerbtn").disabled = false;
        /*$(document).ready(function() {
            $("#empty").load("../index.php");
        });*/
    }
}
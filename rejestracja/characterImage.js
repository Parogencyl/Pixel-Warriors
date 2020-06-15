//////////// WOJOWNIK ///////////////

document.getElementById("warrior").addEventListener("change", function() {
    var gender1 = document.getElementsByName("gender")[0];
    var gender2 = document.getElementsByName("gender")[1];
    var color1 = document.getElementsByName("hairColor")[0];
    var color2 = document.getElementsByName("hairColor")[1];
    var color3 = document.getElementsByName("hairColor")[2];

    if (document.getElementById("warrior").checked && gender1.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Brązowy.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Czarny.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    } else if (document.getElementById("warrior").checked && gender2.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Brązowa.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Czarna.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    }
});
// Wojonik płeć
document.getElementById("wojownik").addEventListener("change", function() {
    var gender1 = document.getElementsByName("gender")[0];
    var color1 = document.getElementsByName("hairColor")[0];
    var color2 = document.getElementsByName("hairColor")[1];
    var color3 = document.getElementsByName("hairColor")[2];

    if (document.getElementById("warrior").checked && gender1.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Brązowy.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Czarny.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    }
});

document.getElementById("wojowniczka").addEventListener("change", function() {
    var gender2 = document.getElementsByName("gender")[1];
    var color1 = document.getElementsByName("hairColor")[0];
    var color2 = document.getElementsByName("hairColor")[1];
    var color3 = document.getElementsByName("hairColor")[2];

    if (document.getElementById("warrior").checked && gender2.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Brązowa.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Czarna.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    }
});

document.getElementById("brown").addEventListener("change", function() {
    var gender1 = document.getElementsByName("gender")[0];
    var gender2 = document.getElementsByName("gender")[1];
    var color1 = document.getElementsByName("hairColor")[0];
    var color2 = document.getElementsByName("hairColor")[1];
    var color3 = document.getElementsByName("hairColor")[2];

    if (document.getElementById("warrior").checked && gender1.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Brązowy.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Czarny.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    }

    if (document.getElementById("warrior").checked && gender2.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Brązowa.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Czarna.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    }
});

document.getElementById("blond").addEventListener("change", function() {
    var gender1 = document.getElementsByName("gender")[0];
    var gender2 = document.getElementsByName("gender")[1];
    var color1 = document.getElementsByName("hairColor")[0];
    var color2 = document.getElementsByName("hairColor")[1];
    var color3 = document.getElementsByName("hairColor")[2];

    if (document.getElementById("warrior").checked && gender1.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Brązowy.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Czarny.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    }

    if (document.getElementById("warrior").checked && gender2.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Brązowa.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Czarna.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    }
});

document.getElementById("black").addEventListener("change", function() {
    var gender1 = document.getElementsByName("gender")[0];
    var gender2 = document.getElementsByName("gender")[1];
    var color1 = document.getElementsByName("hairColor")[0];
    var color2 = document.getElementsByName("hairColor")[1];
    var color3 = document.getElementsByName("hairColor")[2];

    if (document.getElementById("warrior").checked && gender1.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Brązowy.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Czarny.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    }

    if (document.getElementById("warrior").checked && gender2.checked) {
        if (color1.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Brązowa.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color2.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Blond.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        } else if (color3.checked) {
            document.getElementById("characterImage").style.display = "block";
            document.getElementById("characterImage").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Kobieta_Czarna.gif')";
            document.getElementById("characterImage").style.animationName = "image";
            setTimeout(() => {
                document.getElementById("characterImage").style.animationName = "";
            }, 1100);
        }
    }
});
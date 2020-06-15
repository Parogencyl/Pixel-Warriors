document.getElementById("dmgKnight").style.display = "none";
document.getElementById("dmgEnemy").style.display = "none";
document.getElementById("atackKnight").style.display = "none";
document.getElementById("atackEnemy").style.display = "none";
document.getElementById("win").style.display = "none";
document.getElementById("newFight").style.display = "none";
document.getElementById("prize").style.display = "none";
document.getElementById("healthKnight").style.width = "100%";
document.getElementById("healthEnemy").style.width = "100%";
document.getElementById("stamina").style.width = "100%";
document.getElementById("staminaBg").style.width = "100%";
document.getElementById("knight").style.backgroundImage = "url('../../projekt_grafika/Walka/Gracz/Rycerz_Brązowy.gif')";
document.getElementById("enemy").style.backgroundImage = "url('../../projekt_grafika/Piwnica/Poziom2/szkietel1.png')";
document.getElementById("center").style.backgroundImage = "url('../../../projekt_grafika/Walka/Walka1_Gif.gif')";
document.getElementById("knightBlock").style.backgroundImage = "url('../../../Przedmioty/Tarcza1_Pusty_Gif.gif')";
document.getElementById("knightBlock").style.display = "none";
document.getElementById("atackKnight").style.backgroundImage = "url('../../../Przedmioty/Miecz1_Pusty_Gif.gif')";
document.getElementById("atackEnemy").style.backgroundImage = "url('../../../projekt_grafika/Piwnica/Poziom2/szkietel1_bron.png')";


//Normalny atak
function normalAttack(i) {
    document.getElementsByTagName("button")[0].disabled = true; // zablokowanie przycisków
    document.getElementsByTagName("button")[1].disabled = true;
    document.getElementsByTagName("button")[2].disabled = true;
    document.getElementsByTagName("button")[3].disabled = true;
    staminaPlusNormal();
    // Atak postaci
    document.getElementById("atackKnight").style.display = "block";
    var attack = document.getElementById("atackKnight");
    attack.classList.add("knightAnimeAttack");

    setTimeout((function() { removeAnim("atackKnight") }), 1200); // animacja ataku

    var damage = Math.floor(Math.random() * 10) + 1;
    setTimeout((function() {
        dmgShow(damage, "dmgEnemy"); // pokazanie obrażeń
        makeDmg("healthEnemy", damage, "#right>"); // zmniejszenie zdrowia
    }), 1200);

    // Kontra

    setTimeout((function() { enemyAttack() }), 1400);

    setTimeout((function() {
        document.getElementsByTagName("button")[0].disabled = false; // odblokowanie przycisków
        document.getElementsByTagName("button")[1].disabled = false;
        document.getElementsByTagName("button")[2].disabled = false;
        var width = document.getElementById("stamina").style.width;
        width = width.substr(0, width.length - 1);
        if (width >= 30) {
            document.getElementsByTagName("button")[3].disabled = false;
        }
    }), 4000);
    // Zablokowanie przycisków po walce
    setTimeout((function() {
        var content = document.querySelector("#right>.levelOfHealth").innerHTML;
        var position = content.indexOf("%");
        var value = content.substr(0, position);
        if (value == 0) {
            document.getElementsByTagName("button")[0].disabled = true; // zablokowanie przycisków
            document.getElementsByTagName("button")[1].disabled = true;
            document.getElementsByTagName("button")[2].disabled = true;
            document.getElementsByTagName("button")[3].disabled = true;
        }
    }), 2500);
}

//Blok
function block(i) {
    document.getElementsByTagName("button")[0].disabled = true; // zablokowanie przycisków
    document.getElementsByTagName("button")[1].disabled = true;
    document.getElementsByTagName("button")[2].disabled = true;
    document.getElementsByTagName("button")[3].disabled = true;
    staminaPlus();

    // Atak przeciwnika
    document.getElementById("atackEnemy").style.display = "block";
    var attackEnemy = document.getElementById("atackEnemy");
    attackEnemy.classList.add("enemyAnimeAttack");

    setTimeout((function() { document.getElementById("knightBlock").style.display = "block" }), 1000);
    setTimeout((function() { document.getElementById("knightBlock").style.display = "none" }), 1400);

    setTimeout((function() { removeAnim("atackEnemy") }), 1200); // animacja ataku

    setTimeout((function() {
        document.getElementsByTagName("button")[0].disabled = false; // odblokowanie przycisków
        document.getElementsByTagName("button")[1].disabled = false;
        document.getElementsByTagName("button")[2].disabled = false;
        var width = document.getElementById("stamina").style.width;
        width = width.substr(0, width.length - 1);
        if (width >= 30) {
            document.getElementsByTagName("button")[3].disabled = false;
        }
    }), 1400);
}

//Silny atak
function powerfullAttack(i) {
    var content = document.getElementById("levelOfStamina").innerHTML;
    var position = content.indexOf("%");
    var value = content.substr(0, position);
    if (value >= 30) {
        document.getElementsByTagName("button")[0].disabled = true; // zablokowanie przycisków
        document.getElementsByTagName("button")[1].disabled = true;
        document.getElementsByTagName("button")[2].disabled = true;
        document.getElementsByTagName("button")[3].disabled = true;
        staminaMinus();

        // Atak postaci
        document.getElementById("atackKnight").style.display = "block";
        var attack = document.getElementById("atackKnight");
        attack.classList.add("knightAnimeAttack");

        setTimeout((function() { removeAnim("atackKnight") }), 1200); // animacja ataku

        var damage = Math.floor(Math.random() * 10) + 10;
        setTimeout((function() {
            dmgShow(damage, "dmgEnemy"); // pokazanie obrażeń
            makeDmg("healthEnemy", damage, "#right>"); // zmniejszenie zdrowia
        }), 1200);

        // Kontra
        setTimeout((function() { enemyAttack() }), 1400);

        setTimeout((function() {
            document.getElementsByTagName("button")[0].disabled = false; // odblokowanie przycisków
            document.getElementsByTagName("button")[1].disabled = false;
            document.getElementsByTagName("button")[2].disabled = false;
            var width = document.getElementById("stamina").style.width;
            width = width.substr(0, width.length - 1);
            if (width >= 30) {
                document.getElementsByTagName("button")[3].disabled = false;
            }
        }), 2500);
    }

    // Zablokowanie przycisków po walce
    setTimeout((function() {
        var content = document.querySelector("#right>.levelOfHealth").innerHTML;
        var position = content.indexOf("%");
        var value = content.substr(0, position);
        if (value == 0) {
            document.getElementsByTagName("button")[0].disabled = true; // zablokowanie przycisków
            document.getElementsByTagName("button")[1].disabled = true;
            document.getElementsByTagName("button")[2].disabled = true;
            document.getElementsByTagName("button")[3].disabled = true;
        }
    }), 2500);
}

// Usunięcie klasy ataku
function removeAnim(name) {
    var attack = document.getElementById(name);
    if (name == "atackKnight") {
        attack.classList.remove("knightAnimeAttack");
    } else {
        attack.classList.remove("enemyAnimeAttack");
    }
    document.getElementById(name).style.display = "none";
}

// Atack przeciwnika
function enemyAttack() {
    var content = document.querySelector("#right>.levelOfHealth").innerHTML;
    var position = content.indexOf("%");
    var value = content.substr(0, position);
    if (value > 0) {
        document.getElementById("atackEnemy").style.display = "block";
        var attackEnemy = document.getElementById("atackEnemy");
        attackEnemy.classList.add("enemyAnimeAttack");

        setTimeout((function() { removeAnim("atackEnemy") }), 1200); // animacja ataku

        var damage = Math.floor(Math.random() * 10) + 1;
        setTimeout((function() {
            dmgShow(damage, "dmgKnight"); // pokazanie obrażeń
            makeDmg("healthKnight", damage, "#left>"); // zmniejszenie zdrowia
        }), 1200);
    }
}

// Wyświetlenie obrażeń
function dmgShow(damage, idName) {
    var dmg = document.getElementById(idName);
    dmg.style.display = "block";
    dmg.innerHTML = damage;
    setTimeout((function() { dmg.style.display = "none" }), 1200);
}

// Pasek zdrowia
function makeDmg(name, damage, side) {
    var width = document.getElementById(name).style.width;
    width = width.substr(0, width.length - 1);
    width = width - damage;
    if (width <= 0) {
        width = 0;
    }
    document.getElementById(name).style.width = width + "%";
    var content = document.querySelector(side + ".levelOfHealth").innerHTML;
    var position = content.indexOf("%");
    var divObject = content.substr(position + 1, content.length);
    document.querySelector(side + ".levelOfHealth").innerHTML = width + "%" + divObject;

    // Wynik walki
    if (width <= 0) {
        document.getElementById("win").style.display = "block";
        if (side == "#right>") {
            document.getElementById("win").innerHTML = "Zwycięstwo";
            document.getElementById("enemy").style.opacity = "0.7";
            document.getElementById("newFight").style.display = "block";
            // Szansa na drop po walce
            let prize = Math.floor(Math.random() * 100) + 1;
            if (prize > 60) {
                // 40% do 5lv
                document.getElementById("prize").style.display = "block";
            } else if (prize > 80) {
                // 20% do 15lv
                document.getElementById("prize").style.display = "block";
            } else if (prize > 95) {
                // 5% do 40lv
                document.getElementById("prize").style.display = "block";
            }
        } else {
            document.getElementById("win").innerHTML = "Porażka";
            document.getElementById("win").style.backgroundColor = "red";
            document.getElementById("knight").style.opacity = "0.7";
            document.getElementById("newFight").style.display = "block";
        }
    }
}

// Zmniejszenie staminy 
function staminaMinus() {
    var width = document.getElementById("stamina").style.width;
    width = width.substr(0, width.length - 1);
    if (width >= 30) {
        width = width - 30;
        document.getElementById("stamina").style.width = width + "%";
        var content = document.getElementById("levelOfStamina").innerHTML;
        var position = content.indexOf("%");
        var divObject = content.substr(position + 1, content.length);
        document.getElementById("levelOfStamina").innerHTML = width + "%" + divObject;
    }
}

// Zwiększenie staminy o 10
function staminaPlus() {
    var width = document.getElementById("stamina").style.width;
    width = width.substr(0, width.length - 1);
    if (width < 100) {
        width = Number(width) + 10;
    }
    document.getElementById("stamina").style.width = width + "%";
    var content = document.getElementById("levelOfStamina").innerHTML;
    var position = content.indexOf("%");
    var divObject = content.substr(position + 1, content.length);
    document.getElementById("levelOfStamina").innerHTML = width + "%" + divObject;
}

// Zwiększenie staminy o 5
function staminaPlusNormal() {
    var width = document.getElementById("stamina").style.width;
    width = width.substr(0, width.length - 1);
    if (width < 100) {
        width = Number(width) + 5;
    }
    document.getElementById("stamina").style.width = width + "%";
    var content = document.getElementById("levelOfStamina").innerHTML;
    var position = content.indexOf("%");
    var divObject = content.substr(position + 1, content.length);
    document.getElementById("levelOfStamina").innerHTML = width + "%" + divObject;
}

// Poddanie się
function surrender() {
    document.getElementById("win").style.display = "block";
    document.getElementById("win").innerHTML = "Tchórz...";
    document.getElementById("win").style.backgroundColor = "red";
    document.getElementById("knight").style.opacity = "0.7";
    setTimeout((function() { location.href = '../tawerna.php' }), 1000);
}

// Szybka walka

function autoFight() {
    let level = document.getElementById("healthKnight").style.width;
    let hpKnight = level.substr(0, level.length - 1);
    level = document.getElementById("healthKnight").style.width;
    let hpEnemy = level.substr(0, level.length - 1);

    document.getElementById("button1").disabled = true;
    document.getElementById("button2").disabled = true;
    document.getElementById("button3").disabled = true;
    document.getElementById("surrender").disabled = true;
    document.getElementById("autoFight").disabled = true;

    var damage;

    while (hpKnight > 0 && hpEnemy > 0) {
        damage = Math.floor(Math.random() * 10) + 1;
        hpEnemy -= damage;
        if (hpEnemy > 0) {
            damage = Math.floor(Math.random() * 10) + 1;
            hpKnight -= damage;
        }
    }

    if (hpKnight <= 0) {
        hpKnight = 0;
    } else {
        hpEnemy = 0;
    }

    // Zdrowie postaci
    document.getElementById("healthKnight").style.width = hpKnight + "%";
    var content = document.querySelector("#left>" + ".levelOfHealth").innerHTML;
    var position = content.indexOf("%");
    var divObject = content.substr(position + 1, content.length);
    document.querySelector("#left>" + ".levelOfHealth").innerHTML = hpKnight + "%" + divObject;

    document.getElementById("healthEnemy").style.width = hpEnemy + "%";
    var content = document.querySelector("#right>" + ".levelOfHealth").innerHTML;
    var position = content.indexOf("%");
    var divObject = content.substr(position + 1, content.length);
    document.querySelector("#right>" + ".levelOfHealth").innerHTML = hpEnemy + "%" + divObject;

    // Wynik walki
    document.getElementById("win").style.display = "block";
    if (hpKnight > 0) {
        document.getElementById("win").innerHTML = "Zwycięstwo";
        document.getElementById("enemy").style.opacity = "0.7";
        document.getElementById("newFight").style.display = "block";
        // Szansa na drop po walce
        let prize = Math.floor(Math.random() * 100) + 1;
        if (prize > 60) {
            // 40% do 5lv
            document.getElementById("prize").style.display = "block";
        } else if (prize > 80) {
            // 20% do 15lv
            document.getElementById("prize").style.display = "block";
        } else if (prize > 95) {
            // 5% do 40lv
            document.getElementById("prize").style.display = "block";
        }
    } else {
        document.getElementById("win").innerHTML = "Porażka";
        document.getElementById("win").style.backgroundColor = "red";
        document.getElementById("knight").style.opacity = "0.7";
        document.getElementById("newFight").style.display = "block";
    }
}
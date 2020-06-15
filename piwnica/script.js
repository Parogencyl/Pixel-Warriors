document.getElementById("doorClose").addEventListener("click", function() { enemyClose() });

document.getElementById("door1").addEventListener("mouseover", function() { pictureDoor1() });
document.getElementById("door1").addEventListener("mouseout", function() { pictureDoor() });
document.getElementById("door1").addEventListener("click", function() { enemyOpen1() });

document.getElementById("door2").addEventListener("mouseover", function() { pictureDoor2() });
document.getElementById("door2").addEventListener("mouseout", function() { pictureDoor() });
document.getElementById("door2").addEventListener("click", function() { enemyOpen2() });

document.getElementById("door3").addEventListener("mouseover", function() { pictureDoor3() });
document.getElementById("door3").addEventListener("mouseout", function() { pictureDoor() });
document.getElementById("door3").addEventListener("click", function() { enemyOpen3() });

document.getElementById("monster").style.display = "none";
document.getElementById("doorClose").style.visibility = "hidden";

function pictureDoor() {
    document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/cellar.png')";
}

function pictureDoor1() {
    document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/cellar1door.png')";
}

function pictureDoor2() {
    document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/cellar2door.png')";
}

function pictureDoor3() {
    document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/cellar3door.png')";
}

function enemyOpen1() {
    document.getElementById("monster").style.display = "block";
    document.getElementById("doorClose").style.visibility = "visible";
    document.getElementById("monster").style.animationName = "monster1";
}

function enemyOpen2() {
    document.getElementById("monster").style.display = "block";
    document.getElementById("doorClose").style.visibility = "visible";
    document.getElementById("monster").style.animationName = "monster2";
}

function enemyOpen3() {
    document.getElementById("monster").style.display = "block";
    document.getElementById("doorClose").style.visibility = "visible";
    document.getElementById("monster").style.animationName = "monster3";
}

function enemyClose() {
    document.getElementById("monster").style.display = "none";
    document.getElementById("doorClose").style.visibility = "hidden";
}
// 
document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Normalna_Gif.gif')";

// Pokazanie misji
function missionOpen(check) {
    document.getElementById("mission1").style.display = "block";
    document.getElementById("mission2").style.display = "block";
    document.getElementById("mission3").style.display = "block";
    document.getElementById("openMission1").style.display = "block";
    document.getElementById("openMission2").style.display = "block";
    document.getElementById("openMission3").style.display = "block";
    document.getElementById("arrow1").style.display = "block";
    document.getElementById("arrow2").style.display = "block";
    document.getElementById("arrow3").style.display = "block";
    document.getElementById("buttonOpen").style.zIndex = "0";
    document.getElementById("buttonClose").style.zIndex = "1";
    document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Usta_Rozmowa_Gif.gif')";
}

// Zamknięcie misji
function missionClose(check) {
    document.getElementById("mission1").style.display = "none";
    document.getElementById("mission2").style.display = "none";
    document.getElementById("mission3").style.display = "none";
    document.getElementById("openMission1").style.display = "none";
    document.getElementById("openMission2").style.display = "none";
    document.getElementById("openMission3").style.display = "none";
    document.getElementById("arrow1").style.display = "none";
    document.getElementById("arrow2").style.display = "none";
    document.getElementById("arrow3").style.display = "none";
    document.getElementById("buttonOpen").style.zIndex = "1";
    document.getElementById("buttonClose").style.zIndex = "0";
    document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Normalna_Gif.gif')";
}

function pictureOpen() {
    document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Usta_Rozmowa_Gif.gif')";
    document.getElementById("buttonOpen").style.zIndex = "1";

}

function pictureClose() {
    let number = document.getElementById("buttonOpen").style.zIndex;
    if (number == 1) {
        document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Normalna_Gif.gif')";
    }
}


document.getElementById("buttonOpen").addEventListener("click", function() { missionOpen() });
document.getElementById("buttonClose").addEventListener("click", function() { missionClose() });
document.getElementById("buttonOpen").addEventListener("mouseover", function() { pictureOpen() });
document.getElementById("buttonOpen").addEventListener("mouseout", function() { pictureClose() });
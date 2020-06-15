<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../../style.css" rel="stylesheet">
    <link href="mission.css" rel="stylesheet">
    <link href="../../mediaStyle.css" rel="stylesheet">
    <link rel="icon" href="../../projekt_grafika/images/Icona_gif.gif" type="image/icon" sizes="16x16">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    <title> Pixel Warriors </title>
</head>

<body>

<?php 
         include('../../php/session.php');
    ?>

    <!-- plik cookie w celu uniemożliwienia refreshowania strony -->
    <script>
        function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
        return "";
        }
        var value = 0;
        if(getCookie("mission") == null){
            document.cookie = "mission=0";
        }
        value = getCookie("mission");
        value++;
        document.cookie = "mission="+value;

        window.addEventListener("beforeunload", reloadFunctionMission());
        function reloadFunctionMission() {
            if (value>1) {
                window.open("../tawerna.php", "_self");
                document.cookie = "mission=0";
            }
        }
        </script>

    <article>
        <div id="logo"> </div>

        <div id="menu">
            <div id="level"></div>
            <div id="rubin"> <img src="../../projekt_grafika/Inne/rubin.gif"> </div>
            <div id="monet"> <img src="../../projekt_grafika/Inne/money.png"> </div>
            <div id="buttons">
                <div class="button" id="top">
                    <div class="textPosition"> Statystyki </div>
                </div>

                <div class="button">
                    <div class="textPosition"> Ekwipunek </div>
                </div>

                <div class="button">
                    <div class="textPosition"> Tawerna </div>
                </div>

                <div class="button">
                    <div class="textPosition"> Targowisko </div>
                </div>

                <div class="button">
                    <div class="textPosition"> Spis graczy </div>
                </div>

                <div id="specialShop"> 
                    <div class="fas fa-shopping-cart"></div>
                </div>
                
            </div>
        </div>

        <!-- Budowa tawerny -->

        <div id="center">

<section id="left">
    <div id="knight"></div>
    <div id="dmgKnight"> </div>
    <div class="levelOfHealth" id="healthContent"> </div>
    <div id="healthBgKnight">
        <div id="healthKnight"> </div>
    </div>
    <div id="knightBlock">
    </div>
    <button id="autoFight" onclick="autoFight()"> Szybka walka </button>
</section>

<section id="middle">

    <div id="atackKnight"> </div>

    <button id="button1" onclick="normalAttack(0)"> Atak </button>
    <button id="button2" onclick="block(1)"> Blok </button>
    <button id="button3" onclick="powerfullAttack(2)"> Potężne uderzenie </button>

    <div id="levelOfStamina"> 100%
        <div id="staminaBg"> </div>
        <div id="stamina"> </div>
    </div>

    <div id="prizeBg"> </div>
    <div id="prize">
    </div>

    <div id="prizeItem"> </div>
    <div class="tooltipItem1">
        <div class="itemPowerStat"></div>
    </div>

    <div id="lose"> Porażka </div>

    <div id="newFight" onclick="setTimeout(function() {location.href='../tawerna.php'})">  </div>

    <div id="atackEnemy"> </div>

    <div id="helmetCharacter"></div>
    <div id="armorCharacter"></div>
    <div id="legsCharacter"></div>
    <div id="bootsCharacter"></div>
    <div id="swordCharacter"></div>
    <div id="shieldCharacter"></div>
    <div id="gloves1Character"></div>
    <div id="gloves2Character"></div>

</section>

<section id="right">
    <div id="enemy"></div>
    <div id="dmgEnemy"> </div>
    <div class="levelOfHealth" style="left:75%;" id="healthContentEnemy">200/200</div>
    <div id="healthBgEnemy">
        <div id="healthEnemy"> </div>
    </div>
    <button id="surrender" onclick="surrender()"> Poddaje się </button>
</section>

<div id="nothing"> </div>

    </div>

    <div id="footer">

            <div class="button" id="buttonLog">
                <div class="textPosition"> Wyloguj </div>
            </div>

        <div id="nick"> </div>

            <div class="button" id="buttonSet">
                <div class="textPosition"> Ustawienia </div>
            </div>

    </div>

</article>

    <?php
        $whichMission = 3;
        include '../../php/walka/script.php';
        include '../../php/walka/characters.php';  
    ?>

</body>

</html>
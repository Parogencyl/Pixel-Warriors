<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../style.css" rel="stylesheet">
    <link href="fight.css" rel="stylesheet">
    <link href="../mediaStyle.css" rel="stylesheet">
    <link rel="icon" href="../projekt_grafika/images/Icona_gif.gif" type="image/icon" sizes="16x16">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    <title> Pixel Warriors </title>
</head>

<body>

    <?php
         include('../php/session.php');
    ?>
    
    <article>
    <div id="logo"> </div>

<div id="menu">
    <div id="rubin"> </div>
    <div id="monet"> </div>
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

        <div id="prizeBg"> </div>
        <div id="prize">
        </div>

        <div id="lose"> </div>

        <div id="newFight" onclick="setTimeout(function() {location.href='ranking.php'})">  </div>

        <div id="atackEnemy"> </div>

        <div id="enemyBlock"></div>

        <div id="helmetCharacterPlayer"></div>
        <div id="armorCharacterPlayer"></div>
        <div id="legsCharacterPlayer"></div>
        <div id="bootsCharacterPlayer"></div>
        <div id="swordCharacterPlayer"></div>
        <div id="shieldCharacterPlayer"></div>
        <div id="gloves1CharacterPlayer"></div>
        <div id="gloves2CharacterPlayer"></div>

    </section>

    <section id="right">
        <div id="enemy"></div>
        <div id="dmgEnemy"> </div>
        <div class="levelOfHealth" style="left:75%;" id="healthContentEnemy"></div>
        <div id="healthBgEnemy">
            <div id="healthEnemy"> </div>
        </div>
        
        <div id="helmetCharacterEnemy"></div>
        <div id="armorCharacterEnemy"></div>
        <div id="legsCharacterEnemy"></div>
        <div id="bootsCharacterEnemy"></div>
        <div id="swordCharacterEnemy"></div>
        <div id="shieldCharacterEnemy"></div>
        <div id="gloves1CharacterEnemy"></div>
        <div id="gloves2CharacterEnemy"></div>

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

    <!-- Pobranie numery przeciwnika z plików cookie -->
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
        var number = getCookie("number");
        var reload = getCookie("reload");
        reload++;
        document.cookie = "reload="+reload;

        window.addEventListener("beforeunload", reloadFunction());

        function reloadFunction() {
            if (reload>1) {
                window.open("ranking.php", "_self");
                document.cookie = "reload= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
            }
        }

        $(document).ready(function(){
            $("#nothing").load("../php/ranking/fightScript.php", {numberEnemy: number});
        });
        $(document).ready(function(){
            $("#nothing").load("../php/ranking/enemyEq.php", {numberEnemy: number});
        });
        $(document).ready(function(){
            $("#nothing").load("../php/ranking/playerEq.php");
        });
        document.cookie = "number= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    </script>
   
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" charset="utf-8">
    <link href="../style.css" rel="stylesheet">
    <link href="tawerna.css" rel="stylesheet">
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
            <div id="level"></div>
            <div id="rubin"> <img src="../projekt_grafika/Inne/rubin.gif"> </div>
            <div id="monet"> <img src="../projekt_grafika/Inne/money.png"> </div>
            <div id="buttons">
                <a href="../statystyki/statystyki.php">
                    <div class="button" id="top" id="statButton">
                        <div class="textPosition"> Statystyki </div>
                    </div>
                </a>

                <a href="../ekwipunek/ekwipunek.php">
                    <div class="button">
                        <div class="textPosition"> Ekwipunek </div>
                    </div>
                </a>

                <a href="tawerna.php">
                    <div class="button">
                        <div class="textPosition" style="text-shadow: 1px 1px 1px #ac7339;"> Tawerna </div>
                    </div>
                </a>

                <a href="../sklep/market.php">
                    <div class="button">
                        <div class="textPosition"> Targowisko </div>
                    </div>
                </a>

                <a href="../ranking/ranking.php">
                    <div class="button">
                        <div class="textPosition"> Spis graczy </div>
                    </div>
                </a>

                <a href="../doladowanie/boost.php">
                    <div id="specialShop"> 
                        <div class="fas fa-shopping-cart"></div>
                    </div>
                </a>
                
            </div>
        </div>

        <!-- Budowa tawerny -->

        <div id="center">
            <div id="timeStamina"></div>

            <div id="stamina"></div>
            <div id="staminaValue"></div>
            <div id="staminaBg"></div>

            <div id="buttonOpen"> </div>
            <div id="buttonClose"> </div>

            <div id="arrow1"></div>
            <div id="arrow2"></div>
            <div id="arrow3"></div>

            <div id="mission1">
                <div class="opacityText1">
                    <div class="text" id="textMission1"> </div>
                </div>
            </div>
            <div id="openMission1">
                <div class="takeMission" id="takeMission1"> Nagroda: 30 exp, 10 RB <br>Koszt: 5 ST </div>
            </div>

            <div id="mission2">
                <div class="opacityText2">
                    <div class="text" id="textMission2"> </div>
                </div>
            </div>
            <div id="openMission2">
                <div class="takeMission" id="takeMission2"> Nagroda: 30 exp, 10 RB <br>Koszt: 5 ST </div>
            </div>

            <div id="mission3">
                <div class="opacityText3">
                    <div class="text" id="textMission3"> </div>
                </div>
            </div>
            <div id="openMission3">
                <div class="takeMission" id="takeMission3"> Nagroda: 30 exp, 10 RB <br>Koszt: 5 ST </div>
            </div>

        </div>

        <div id="arrowCellar" onclick="window.open('../piwnica/cellar.php', '_self')"></div>

        <div id="nothing"></div>

        <div id="footer">

            <a href="../php/logout.php">
                <div class="button" id="buttonLog">
                    <div class="textPosition"> Wyloguj </div>
                </div>
            </a>

            <div id="nick"></div>

            <a href="../settings/ustawienia.php">
                <div class="button" id="buttonSet">
                    <div class="textPosition"> Ustawienia </div>
                </div>
            </a>

        </div>

    </article>

    <?php
        include '../php/getCharacter.php'; // Pobieranie danych postaci
        include '../php/tawerna/stamina.php';
        include '../php/tawerna/script.php';
        include '../php/tawerna/missions.php';
    ?>

</body>

</html>
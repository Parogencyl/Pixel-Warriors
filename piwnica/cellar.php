<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" charset="utf-8">
    <link href="../style.css" rel="stylesheet">
    <link href="cellar.css" rel="stylesheet">
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

                <a href="../karczma/tawerna.php">
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

        <!-- Budowa Piwnicy -->

        <div id="center">
            <div id="door1"></div>
            <div id="door2"></div>
            <div id="door3"></div>

            <div id="monster1">
                <div id="numberOfMonsters1"> </div>
                <div id="picture1"></div>
                <div id="levelOfMonster1"> </div>
                <div id="timeFight1"></div>
                <div id="name1"> </div>
            </div>

            <div id="monster2">
                <div id="numberOfMonsters2"> </div>
                <div id="picture2"></div>
                <div id="levelOfMonster2"> </div>
                <div id="timeFight2"></div>
                <div id="name2"> </div>
            </div>

            <div id="monster3">
                <div id="numberOfMonsters3"> </div>
                <div id="picture3"></div>
                <div id="levelOfMonster3"> </div>
                <div id="timeFight3"></div>
                <div id="name3"> </div>
            </div>

            <div id="doorClose"> Zamknij </div>

            <div id="arrowTawerna" onclick="window.open('../karczma/tawerna.php', '_self')"></div>
        </div>

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
        include '../php/piwnica/script.php';    // Interakcja z użytkownikiem na stronie głównej
    ?>

</body>

</html>
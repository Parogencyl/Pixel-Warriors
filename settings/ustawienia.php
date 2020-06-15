<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../style.css" rel="stylesheet">
    <link href="ustawienia.css" rel="stylesheet">
    <link href="../mediaStyle.css" rel="stylesheet">
    <link rel="icon" href="../projekt_grafika/images/Icona_gif.gif" type="image/icon" sizes="16x16">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

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
                    <div class="button" id="top">
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
                        <div class="textPosition"> Tawerna </div>
                    </div>
                </a>

                <a href="../sklep/market.php">
                    <div class="button">
                        <div class="textPosition"> Targowisko </div>
                    </div>
                </a>

                <a href="../ranking/ranking.html">
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

        <div id="center">
            <div id="settings">
                <div id="sound"> Efekty dźwiękowe: </div>
                <div id="soundImg"></div>
                <div style="width: 100%; height: 10%; margin-top: 14%;">Email: </div>
                <div id="email"> </div>
                <div style="width: 100%; height: 10%; margin-top: 6%;">Nowy email: </div>
                <input type="email" id="newEmail">
                <button type="button" id="changeEmail">Zmień</button>
            </div>
        </div>

        <div id="footer">

            <a href="../php/logout.php">
                <div class="button" id="buttonLog">
                    <div class="textPosition"> Wyloguj </div>
                </div>
            </a>

            <div id="nick"></div>

            <a href="ustawienia.php">
                <div class="button" id="buttonSet">
                    <div class="textPosition" style="text-shadow: 1px 1px 1px red;"> Ustawienia </div>
                </div>
            </a>

        </div>

    </article>

<?php
    include '../php/getCharacter.php'; // Pobieranie danych postaci
    include 'script.php';
    include 'settingsQuery.php';
?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../style.css" rel="stylesheet">
    <link href="ranking.css" rel="stylesheet">
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

                <a href="ranking.php">
                    <div class="button">
                        <div class="textPosition" style="text-shadow: 1px 1px 1px #ac7339;"> Spis graczy </div>
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

        <!-- Tablica -->
        <div id='table'> 
            <div id='head'>
                <div>Gracz</div>
                <div>Profesja</div>
                <div>Poziom</div>
                <div>Punkty</div> 
                <div>Pozycja</div> 
            </div>

            <div id='body'>
            </div>

        </div>

        <div id="search">
            <input name="search" id="searchInput" spellcheck="false" placeholder="Nazwa gracza/Pozycja">
            <div id="searchButton"> </div>
        </div>

        <div id="right">

            <div id="stats"> </div>
            <h2> Statystyki </h2>
            <h3> </h3>

            <div id="statLeft">
                <p class="nameStat"> Siła </p>
                <p class="nameStat"> Inteligencja </p>
                <p class="nameStat"> Zręczność </p>
                <p class="nameStat"> Obrażenia broni </p>
                <p class="nameStat"> Zdrowie </p>
                <p class="nameStat"> Szczęście </p>
                <p class="nameStat"> Obrona fizyczna </p>
                <p class="nameStat"> Obrona magiczna </p>
            </div>

            <div id="statRight">
                <p class="valueStat">  </p>
                <p class="valueStat">  </p>
                <p class="valueStat">  </p>
                <p class="valueStat">  </p>
                <p class="valueStat">  </p>
                <p class="valueStat">  </p>
                <p class="valueStat">  </p>
                <p class="valueStat">  </p>
            </div>

            <div id="fight">
                <div id="numberFights"> </div>
            </div>
           

            </div>
        </div>

        <div id="nothing"> </div>

        <div id="footer">

            <a href="../php/logout.php">
                <div class="button" id="buttonLog">
                    <div class="textPosition"> Wyloguj </div>
                </div>
            </a>

            <div id="nick"> </div>

            <a href="../settings/ustawienia.php">
                <div class="button" id="buttonSet">
                    <div class="textPosition"> Ustawienia </div>
                </div>
            </a>

        </div>

    </article>

    <?php
         include '../php/getCharacter.php'; // Pobieranie danych postaci
         include '../php/ranking/rankTable.php';
         include '../php/ranking/searchPlayers.php';
    ?>


</body>

</html>
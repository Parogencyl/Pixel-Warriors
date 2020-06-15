<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../style.css" rel="stylesheet">
    <link href="statystyki.css" rel="stylesheet">
    <link href="statystykiRight.css" rel="stylesheet">
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
            <div id="level"> </div>
            <div id="rubin"> <img src="../projekt_grafika/Inne/rubin.gif"> </div>
            <div id="monet"> <img src="../projekt_grafika/Inne/money.png"> </div>
            <div id="buttons">
                <a href="statystyki.php">
                    <div class="button" id="top">
                        <div class="textPosition" style="text-shadow: 1px 1px 1px #ac7339;"> Statystyki </div>
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

        <div id="center">

            <div id="backgroundLeft"></div>

            <section id="left">
                <div id="leftItems">
                    <div class="one">
                        <img id="helmet" onmouseover="disableTooltip('.tooltipItem1', 'helmetSource')" onmouseout="enableTooltip('.tooltipItem1')">
                        <div class="tooltipItem1">
                            <div class="itemName">  </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="two">
                        <img id="armor" onmouseover="disableTooltip('.tooltipItem2', 'armorSource')" onmouseout="enableTooltip('.tooltipItem2')">
                        <div class="tooltipItem2">
                            <div class="itemName">  </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="three">
                        <img id="legs" onmouseover="disableTooltip('.tooltipItem3', 'legsSource')" onmouseout="enableTooltip('.tooltipItem3')">
                        <div class="tooltipItem3">
                            <div class="itemName"> </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="four">
                        <img id="boot" onmouseover="disableTooltip('.tooltipItem4', 'bootSource')" onmouseout="enableTooltip('.tooltipItem4')">
                        <div class="tooltipItem4">
                            <div class="itemName"></div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                </div>

                <div id="character">
                    <div id="helmetCharacter"> </div>
                    <div id="armorCharacter"> </div>
                    <div id="legsCharacter"> </div>
                    <div id="bootCharacter"> </div>
                    <div id="necklaceCharacter"> </div>
                    <div id="swordCharacter"> </div>
                    <div id="shieldCharacter"> </div>
                    <div id="glovesCharacter"> </div>
                </div>

                <div id="rightItems">
                    <div class="one">
                        <img id="necklace" onmouseover="disableTooltip('.tooltipItem5', 'necklaceSource')" onmouseout="enableTooltip('.tooltipItem5')">
                        <div class="tooltipItem5">
                            <div class="itemName"> </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="two">
                        <img id="sword" onmouseover="disableTooltip('.tooltipItem6', 'swordSource')" onmouseout="enableTooltip('.tooltipItem6')">
                        <div class="tooltipItem6">
                            <div class="itemName"> </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="three">
                        <img id="shield" onmouseover="disableTooltip('.tooltipItem7', 'shieldSource')" onmouseout="enableTooltip('.tooltipItem7')">
                        <div class="tooltipItem7">
                            <div class="itemName"></div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="four">
                        <img id="gloves" onmouseover="disableTooltip('.tooltipItem8', 'glovesSource')" onmouseout="enableTooltip('.tooltipItem8')">
                        <div class="tooltipItem8">
                            <div class="itemName"> aa </div>
                            <div class="itemPowerStat"> a </div>
                        </div>
                    </div>

                </div>

                <div id="experience">
                    <div id="backgroundExp"> </div>
                    <div id="levelOfExperience"> </div>
                    <div id="exp"></div>
                </div>

            </section>

            <div id="backgroundRight"></div>

            <section id="right">

                <div id="stat1" class="statSize">
                    <div class="tooltip"> Siła:
                        <span class="tooltiptext" style="width: 350%"> Zwiększa zadawane obrażenia wojownika. </span>
                    </div>
                    <div id="value1" class="valueSize"> 20 </div>
                </div>

                <div id="stat2" class="statSize">
                    <div class="tooltip"> Inteligencja:
                        <span class="tooltiptext"> Zwiększa zadawane obrażenia maga. </span>
                    </div>
                    <div id="value2" class="valueSize"> 5 </div>
                </div>

                <div id="stat3" class="statSize">
                    <div class="tooltip"> Zręczność:
                        <span class="tooltiptext"> Zwiększa zadawane obrażenia łowcy. </span>
                    </div>
                    <div id="value3" class="valueSize"> 12 </div>
                </div>

                <div id="stat7" class="statSize">
                    <div class="tooltip"> Zdrowie:
                        <span class="tooltiptext"> Ilość punktów zdrowia postaci. </span>
                    </div>
                    <div id="value7" class="valueSize"> 100 </div>
                </div>

                <div id="stat6" class="statSize">
                    <div class="tooltip"> Szczęście:
                        <span class="tooltiptext"> Szansa na zadanie 120% obrażeń. </span>
                    </div>
                    <div id="value4" class="valueSize"> 15% </div>
                </div>

                <div id="stat4" class="statSize">
                    <div class="tooltip"> Obrona fizyczna:
                        <span class="tooltiptext"> Zmniejsza otrzymywane obrażenia od ataków fizycznych. </span>
                    </div>
                    <div id="value5" class="valueSize"> 10% </div>
                </div>

                <div id="stat5" class="statSize">
                    <div class="tooltip"> Obrona magiczna:
                        <span class="tooltiptext"> Zmniejsza otrzymywane obrażenia od ataków magicznych. </span>
                    </div>
                    <div id="value6" class="valueSize"> 6% </div>
                </div>

                <div class="plus" id="powerPlusButton">
                    <div class="tooltip2">
                        <span class="tooltiptext2" id="powerPlus" > 200RB </span>
                    </div>
                </div>
                <div class="plus" style="top: 12.5%;" id="intelligencePlusButton">
                    <div class="tooltip2">
                        <span class="tooltiptext2" id="intelligencePlus"> 200RB </span>
                    </div>
                </div>
                <div class="plus" style="top: 28%;" id="skillPlusButton">
                    <div class="tooltip2">
                        <span class="tooltiptext2" id="skillPlus"> 200RB </span>
                    </div>
                </div>
                <div class="plus" style="top: 42.5%;" id="healthPlusButton">
                    <div class="tooltip2">
                        <span class="tooltiptext2" id="healthPlus"> 200RB </span>
                    </div>
                </div>
                <div class="plus" style="top: 57.5%;" id="luckPlusButton">
                    <div class="tooltip2">
                        <span class="tooltiptext2" id="luckPlus"> 200RB </span>
                    </div>
                </div>

            </section>

        </div>

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

<!-- pobieranie eq z bazy -->

    <?php 
         include '../php/getCharacter.php'; // Pobieranie danych postaci
         $setLevel = 1;
         include '../php/getEquipment.php';
         include '../php/statystyki/getStatistics.php';
        include '../php/getPlayerExperience.php';
        include '../php/statystyki/itemTooltips.php';
    ?>
    
    </article>

</body>

</html>




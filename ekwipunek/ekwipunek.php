<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../style.css" rel="stylesheet">
    <link href="../statystyki/statystyki.css" rel="stylesheet">
    <link href="ekwipunekRight.css" rel="stylesheet">
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
            <div id="rubin"> <img src="../projekt_grafika/Inne/rubin.gif"> </div>
            <div id="monet"> <img src="../projekt_grafika/Inne/money.png"> </div>
            <div id="buttons">
                <a href="../statystyki/statystyki.php">
                    <div class="button" id="top">
                        <div class="textPosition"> Statystyki </div>
                    </div>
                </a>

                <a href="ekwipunek.php">
                    <div class="button">
                        <div class="textPosition" style="text-shadow: 1px 1px 1px #ac7339;"> Ekwipunek </div>
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

            <div id="backgroundLeft" ></div>

            <section id="left">
                <div id="leftItems">
                    <div class="one">
                        <img id="helmet" ondblclick="dropItem('helmet', '.tooltipItem',)" onmouseover="disableTooltip('.tooltipItem1', 'helmetSource')" onmouseout="enableTooltip('.tooltipItem1')">
                        <div class="tooltipItem1">
                            <div class="itemName"> </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="two">
                        <img id="armor" ondblclick="dropItem('armor', '.tooltipItem')" onmouseover="disableTooltip('.tooltipItem2', 'armorSource')" onmouseout="enableTooltip('.tooltipItem2')">
                        <div class="tooltipItem2">
                            <div class="itemName">  </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="three">
                        <img id="legs" ondblclick="dropItem('legs', '.tooltipItem')" onmouseover="disableTooltip('.tooltipItem3', 'legsSource')" onmouseout="enableTooltip('.tooltipItem3')">
                        <div class="tooltipItem3">
                            <div class="itemName">  </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="four">
                        <img id="boot" ondblclick="dropItem('boot', '.tooltipItem')" onmouseover="disableTooltip('.tooltipItem4', 'bootSource')" onmouseout="enableTooltip('.tooltipItem4')">
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
                        <img id="necklace" ondblclick="dropItem('necklace', '.tooltipItem')" onmouseover="disableTooltip('.tooltipItem5', 'necklaceSource')" onmouseout="enableTooltip('.tooltipItem5')">
                        <div class="tooltipItem5">
                            <div class="itemName"> </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="two">
                        <img id="sword" ondblclick="dropItem('sword', '.tooltipItem')" onmouseover="disableTooltip('.tooltipItem6', 'swordSource')" onmouseout="enableTooltip('.tooltipItem6')">
                        <div class="tooltipItem6">
                            <div class="itemName"> </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="three">
                        <img id="shield" ondblclick="dropItem('shield', '.tooltipItem')" onmouseover="disableTooltip('.tooltipItem7', 'shieldSource')" onmouseout="enableTooltip('.tooltipItem7')">
                        <div class="tooltipItem7">
                            <div class="itemName">  </div>
                            <div class="itemPowerStat"></div>
                        </div>
                    </div>

                    <div class="four">
                        <img id="gloves" ondblclick="dropItem('gloves', '.tooltipItem')" onmouseover="disableTooltip('.tooltipItem8', 'glovesSource')" onmouseout="enableTooltip('.tooltipItem8')">
                        <div class="tooltipItem8">
                            <div class="itemName"> </div>
                            <div class="itemPowerStat"></div>
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

                    <div id="item1" ondblclick="putItem('1')" onclick="openMenu('1')" onmouseover="tooltipItem1()" onmouseout="enableTooltip('.tooltipItem1Eq')">
                        <img id="positionItem1" rel="item1">
                    </div>
                    <div class="tooltipItem1Eq">
                        <div class="itemPowerStat"></div>
                    </div>
                    <div id="tools1">
                        <div class="upgrade" onclick="upgradeItem('1')" id="upgrade1"> Ulepsz </div>
                        <hr>
                        <div class="sell" onclick="sell('1')" id="sell1"> Sprzedaj </div>
                        <hr>
                        <div class="compare" onclick="compare('1')"> Porównaj </div>
                    </div>

                    <div id="item2" ondblclick="putItem('2')" onclick="openMenu('2')" onmouseover="tooltipItem2()" onmouseout="enableTooltip('.tooltipItem2Eq')">
                        <img id="positionItem2" rel="item2">
                    </div>
                    <div class="tooltipItem2Eq">
                        <div class="itemPowerStat"></div>
                    </div>

                    <div id="tools2">
                        <div class="upgrade" onclick="upgradeItem('2')" id="upgrade2"> Ulepsz </div>
                        <hr>
                        <div class="sell" onclick="sell('2')" id="sell2"> Sprzedaj </div>
                        <hr>
                        <div class="compare" onclick="compare('2')"> Porównaj </div>
                    </div>

                    <div id="item3" ondblclick="putItem('3')" onclick="openMenu('3')" onmouseover="tooltipItem3()" onmouseout="enableTooltip('.tooltipItem3Eq')">
                        <img id="positionItem3" rel="item3">
                    </div>
                    <div class="tooltipItem3Eq">
                        <div class="itemPowerStat"></div>
                    </div>

                    <div id="tools3">
                        <div class="upgrade" onclick="upgradeItem('3')" id="upgrade3"> Ulepsz </div>
                        <hr>
                        <div class="sell" onclick="sell('3')" id="sell3"> Sprzedaj </div>
                        <hr>
                        <div class="compare" onclick="compare('3')"> Porównaj </div>
                    </div>

                <div id="item4" ondblclick="putItem('4')" onclick="openMenu('4')" onmouseover="tooltipItem4()" onmouseout="enableTooltip('.tooltipItem4Eq')">
                    <img id="positionItem4" rel="item4">
                </div>
                <div class="tooltipItem4Eq">
                    <div class="itemPowerStat"></div>
                </div>
                <div id="tools4">
                        <div class="upgrade" onclick="upgradeItem('4')" id="upgrade4"> Ulepsz </div>
                        <hr>
                        <div class="sell" onclick="sell('4')" id="sell4"> Sprzedaj </div>
                        <hr>
                        <div class="compare" onclick="compare('4')"> Porównaj </div>
                    </div>

                <div id="item5" ondblclick="putItem('5')" onclick="openMenu('5')" onmouseover="tooltipItem5()" onmouseout="enableTooltip('.tooltipItem5Eq')">
                    <img id="positionItem5" rel="item5">
                </div>
                <div class="tooltipItem5Eq">
                    <div class="itemPowerStat"></div>
                </div>
                <div id="tools5">
                        <div class="upgrade" onclick="upgradeItem('5')" id="upgrade5"> Ulepsz </div>
                        <hr>
                        <div class="sell" onclick="sell('5')" id="sell5"> Sprzedaj </div>
                        <hr>
                        <div class="compare" onclick="compare('5')"> Porównaj </div>
                    </div>

                <div id="item6" ondblclick="putItem('6')" onclick="openMenu('6')" onmouseover="tooltipItem6()" onmouseout="enableTooltip('.tooltipItem6Eq')">
                    <img id="positionItem6" rel="item6">
                </div>
                <div class="tooltipItem6Eq">
                    <div class="itemPowerStat"></div>
                </div>
                <div id="tools6">
                        <div class="upgrade" onclick="upgradeItem('6')" id="upgrade6"> Ulepsz </div>
                        <hr>
                        <div class="sell" onclick="sell('6')" id="sell6"> Sprzedaj </div>
                        <hr>
                        <div class="compare" onclick="compare('6')"> Porównaj </div>
                    </div>

                <div id="item7" ondblclick="putItem('7')" onclick="openMenu('7')" onmouseover="tooltipItem7()" onmouseout="enableTooltip('.tooltipItem7Eq')">
                    <img id="positionItem7" rel="item7">
                </div>
                <div class="tooltipItem7Eq">
                    <div class="itemPowerStat"></div>
                </div>
                <div id="tools7">
                        <div class="upgrade" onclick="upgradeItem('7')" id="upgrade7"> Ulepsz </div>
                        <hr>
                        <div class="sell" onclick="sell('7')" id="sell7"> Sprzedaj </div>
                        <hr>
                        <div class="compare" onclick="compare('7')"> Porównaj </div>
                    </div>

                <div id="item8" ondblclick="putItem('8')" onclick="openMenu('8')" onmouseover="tooltipItem8()" onmouseout="enableTooltip('.tooltipItem8Eq')">
                    <img id="positionItem8" rel="item8">
                </div>
                <div class="tooltipItem8Eq">
                    <div class="itemPowerStat"></div>
                </div>
                <div id="tools8">
                        <div class="upgrade" onclick="upgradeItem('8')" id="upgrade8"> Ulepsz </div>
                        <hr>
                        <div class="sell" onclick="sell('8')" id="sell8"> Sprzedaj </div>
                        <hr>
                        <div class="compare" onclick="compare('8')"> Porównaj </div>
                    </div>

                <div id="item9" ondblclick="putItem('9')" onclick="openMenu('9')" onmouseover="tooltipItem9()" onmouseout="enableTooltip('.tooltipItem9Eq')">
                    <img id="positionItem9" rel="item9">
                </div>
                <div class="tooltipItem9Eq">
                    <div class="itemPowerStat"></div>
                </div>
                <div id="itemName"> </div>
                <div id="tools9">
                    <div class="upgrade" onclick="upgradeItem('9')" id="upgrade9"> Ulepsz </div>
                    <hr>
                    <div class="sell" onclick="sell('9')" id="sell9"> Sprzedaj </div>
                    <hr>
                    <div class="compare" onclick="compare('9')"> Porównaj </div>
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
        include '../php/getEquipment.php'; // Pobranie eq i wyświetlenie statystyk
        include '../php/ekwipunek/getBackpack.php';    // Ekwipunek przedmioty i statystyki włączanie
        include '../php/ekwipunek/dropItem.php';       // Zdejmowanie przedmiotów
        include '../php/ekwipunek/putItem.php';        // Zakładanie przedmietów
        include '../php/getPlayerExperience.php';       // Poziom expa gracza
        include '../php/statystyki/itemTooltips.php';   // statytyki eq
        include '../php/ekwipunek/eqTooltips.php';      // statystyki przedmiotów w plecaku
        include '../php/ekwipunek/menuItem.php';        // menu przycisków
    ?>
 
    </article>

</body>

</html>

  <!-- 
<script>
$(document).ready(function(){
  $("#helmet").dblclick(function(){
    $("#helmet").load("../php/drop1.php");
  });
});
</script>
    -->

<!-- 
    Przeciąganie przedmiotów 
    
                <div id="item1 " ondrop="drop(event) " ondragover="allowDrop(event) ">
                    <img id="positionItem1 " draggable="true " ondragstart="drag(event) ">
                </div>

                <div id="item2 " ondrop="drop(event) " ondragover="allowDrop(event) ">
                    <img id="positionItem2 " draggable="true " ondragstart="drag(event) ">
                </div>

                <div id="item3 " ondrop="drop(event) " ondragover="allowDrop(event) ">
                    <img id="positionItem3 " draggable="true " ondragstart="drag(event) ">
                </div>

                <div id="item4 " ondrop="drop(event) " ondragover="allowDrop(event) ">
                    <img id="positionItem4 " draggable="true " ondragstart="drag(event) " rel="item ">
                </div>

                <div id="item5 " ondrop="drop(event) " ondragover="allowDrop(event) ">
                    <img id="positionItem5 " draggable="true " ondragstart="drag(event) ">
                </div>

                <div id="item6 " ondrop="drop(event) " ondragover="allowDrop(event) ">
                    <img id="positionItem6 " draggable="true " ondragstart="drag(event) ">
                </div>

                <div id="item7 " ondrop="drop(event) " ondragover="allowDrop(event) ">
                    <img id="positionItem7 " draggable="true " ondragstart="drag(event) ">
                </div>

                <div id="item8 " ondrop="drop(event) " ondragover="allowDrop(event) ">
                    <img id="positionItem8 " draggable="true " ondragstart="drag(event) ">
                </div>

                <div id="item9 " ondrop="drop(event) " ondragover="allowDrop(event) ">
                    <img id="positionItem9 " draggable="true " ondragstart="drag(event) ">
                </div>
-->
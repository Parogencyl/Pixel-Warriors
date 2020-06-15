<?php
  $serverName = "s75.linuxpl.com";
  $userName = "bohun";
  $userPassword = "Bohun2965029!";
  $dbName = "bohun_pixelWarriors";
  
  //Create connection
  $connection = new mysqli($serverName, $userName, $userPassword, $dbName);
  
  //Check connection
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
      exit();
  }
  mysqli_set_charset($connection, "utf8");
  
  session_start();
     
     $user_check = $_SESSION['login_user'];
     
     $sessionSql = "SELECT player.Login FROM player WHERE player.Login='$user_check'";
     $ses_sql = mysqli_query($connection, $sessionSql);
     if (mysqli_num_rows($ses_sql) > 0) {
         $row = mysqli_fetch_assoc($ses_sql);
         $login_session = $row['Login'];
     }
  
     
     if(!isset($_SESSION['login_user'])){
        header("location: ../index.php");
        die();
     }

     // Pobranie typów przedmiotów ze sklepu
    $selectItemType2 = "SELECT items.Type FROM shopStatistics INNER JOIN player ON player.Id=shopStatistics.Player 
    INNER JOIN items ON items.IdItem=shopStatistics.ItemId WHERE player.Login='$user_check'";
    $selectItemTypeQuery2 = mysqli_query($connection, $selectItemType2);
    if (mysqli_num_rows($selectItemTypeQuery2) > 0) {
        while($row = mysqli_fetch_assoc($selectItemTypeQuery2)){
            $typeItemsShop[] = $row['Type'];
        }
    }

    // Pobranie kwot przedmiotów ze skelpu
    $selectSlots3 = "SELECT Price FROM shopStatistics INNER JOIN player ON player.Id=shopStatistics.Player 
    WHERE player.Login='$user_check'";
    $getSlots3 = mysqli_query($connection, $selectSlots3);
    if(mysqli_num_rows($getSlots3) > 0){
        while ($row = mysqli_fetch_assoc($getSlots3)) {
            $priceShop[] = $row['Price'];
        }
    }else {
        echo "Empty backpackStatistics";
    }

    // Pobranie rubinów
    $selectRubins = "SELECT Rubins FROM player WHERE player.Login='$user_check'";
    $selectRubinsQuery = mysqli_query($connection, $selectRubins);
    if (mysqli_num_rows($selectRubinsQuery) > 0) {
        $row = mysqli_fetch_assoc($selectRubinsQuery);
            $rubins = $row['Rubins'];
    }

    // pobranie scieżek przedmiotów w plecaku
    $selectSlotsShop = "SELECT * FROM backpack INNER JOIN player ON player.Id=backpack.IdBackpack WHERE player.Login='$user_check'";
    $selectSlotsShopQuery = mysqli_query($connection, $selectSlotsShop);
    if(mysqli_num_rows($selectSlotsShopQuery) > 0){
        $row = mysqli_fetch_assoc($selectSlotsShopQuery);
        $slot1 = $row['Slot1'];
        $slot2 = $row['Slot2'];
        $slot3 = $row['Slot3'];
        $slot4 = $row['Slot4'];
        $slot5 = $row['Slot5'];
        $slot6 = $row['Slot6'];
        $slot7 = $row['Slot7'];
        $slot8 = $row['Slot8'];
        $slot9 = $row['Slot9'];
    }else {
        echo "Empty equipment";
    }

    // pobranie scieżek przedmiotów ze sklepu
    $selectSlotsShop = "SELECT * FROM shop INNER JOIN player ON player.Id=shop.IdShop WHERE player.Login='$user_check'";
    $selectSlotsShopQuery = mysqli_query($connection, $selectSlotsShop);
    if(mysqli_num_rows($selectSlotsShopQuery) > 0){
        $row = mysqli_fetch_assoc($selectSlotsShopQuery);
        $slot1Shop = $row['Slot1Shop'];
        $slot2Shop = $row['Slot2Shop'];
        $slot3Shop = $row['Slot3Shop'];
        $slot4Shop = $row['Slot4Shop'];
        $slot5Shop = $row['Slot5Shop'];
    }else {
        echo "Empty equipment";
    }
?>

<script>

    var slotsBp = ["<?php echo $slot1 ?>", "<?php echo $slot2 ?>", "<?php echo $slot3 ?>", "<?php echo $slot4 ?>", "<?php echo $slot5 ?>",
    "<?php echo $slot6 ?>", "<?php echo $slot7 ?>", "<?php echo $slot8 ?>", "<?php echo $slot9 ?>"];

    var typeItemsShop = ["<?php echo $typeItemsShop[0] ?>", "<?php echo $typeItemsShop[1] ?>", "<?php echo $typeItemsShop[2] ?>", 
    "<?php echo $typeItemsShop[3] ?>", "<?php echo $typeItemsShop[4] ?>"];
    var priceShop = ["<?php echo $priceShop[0] ?>", "<?php echo $priceShop[1] ?>", "<?php echo $priceShop[2] ?>", "<?php echo $priceShop[3] ?>",
    "<?php echo $priceShop[4] ?>"];
    var rubins = "<?php echo $rubins ?>";

    document.getElementById('toolsShop1').style.visibility = 'hidden';
    document.getElementById('toolsShop2').style.visibility = 'hidden';
    document.getElementById('toolsShop3').style.visibility = 'hidden';
    document.getElementById('toolsShop4').style.visibility = 'hidden';
    document.getElementById('toolsShop5').style.visibility = 'hidden';

    //////////      Otworzenie menu przedmiotu       /////////////

function openMenuShop(number) {
    var bgItem = document.getElementById('positionItem'+number+"Shop").src;

    if(bgItem != "http://www.pixelwarriors.pl/Przedmioty/Ramka_Gif.gif"){

        var price = priceShop[number-1];

        document.getElementById("buy"+number).innerHTML = "Kup <br><font color='red'>-"+price+"RB</font>";

        // Zamknięcie wszystkich okien
        for(let i=1; i<6; i++){
            if(i != number ){
                document.getElementById('toolsShop'+i).style.visibility = 'hidden';
            }
        }
        for(let i=1; i<9; i++){
            document.querySelector('.tooltipItem'+i).style.visibility = 'hidden';
        }
        for(let i=1; i<6; i++){
            document.querySelector('.tooltipItem'+i+'Shop').style.visibility = 'hidden';
        }
        
        // Otworzenie menu przedmiotu lub zamknięcie
        if(document.getElementById('toolsShop'+number).style.visibility == "hidden"){
            document.getElementById('toolsShop'+number).style.visibility = 'visible';
        } else if(document.getElementById('toolsShop'+number).style.visibility == "visible"){
            document.getElementById('toolsShop'+number).style.visibility = "hidden";
        }

        //Utrzymanie menu po najechaniu
        document.getElementById("toolsShop"+number).addEventListener("mouseover", function() { keepMenuShop(number); });
        //Zamkniecie menu po zjechaniu 
        document.getElementById("toolsShop"+number).addEventListener("mouseout", function() { closeMenuShop(number); });
        
    }
}

function keepMenuShop(number) {
    document.getElementById('toolsShop'+number).style.visibility = 'visible';
}

function closeMenuShop(number) {
    document.getElementById('toolsShop'+number).style.visibility = 'hidden'; 
}

    //////////     Porównanie przedmiotów      /////////////

function compareShop(number) {
    var itemNumber = 0;
    document.querySelector('#toolsShop' + number).style.visibility = 'hidden';
    document.querySelector('.tooltipItem' + number + 'Shop').style.visibility = 'visible';
    document.querySelector('.tooltipItem' + number + 'Eq').style.visibility = 'hidden';

    if(typeItemsShop[number-1] == "helmet"){
        document.querySelector('.tooltipItem1').style.visibility = 'visible';
        itemNumber = 1;
    }
    if(typeItemsShop[number-1] == "armor"){
        document.querySelector('.tooltipItem2').style.visibility = 'visible';
        itemNumber = 2;
    }
    if(typeItemsShop[number-1] == "legs"){
        document.querySelector('.tooltipItem3').style.visibility = 'visible';
        itemNumber = 3;
    }
    if(typeItemsShop[number-1] == "boots"){
        document.querySelector('.tooltipItem4').style.visibility = 'visible';
        itemNumber = 4;
    }
    if(typeItemsShop[number-1] == "necklace"){
        document.querySelector('.tooltipItem5').style.visibility = 'visible';
        itemNumber = 5;
    }
    if(typeItemsShop[number-1] == "sword"){
        document.querySelector('.tooltipItem6').style.visibility = 'visible';
        itemNumber = 6;
    }
    if(typeItemsShop[number-1] == "shield"){
        document.querySelector('.tooltipItem7').style.visibility = 'visible';
        itemNumber = 7;
    }
    if(typeItemsShop[number-1] == "gloves"){
        document.querySelector('.tooltipItem8').style.visibility = 'visible';
        itemNumber = 8;
    }

    $(document).ready(function(){
        $("#itemName").load("../php/sklep/compareItemsShop.php",{whichItem: number, eqItem: itemNumber});
    });

    //Zamkniecie menu po zjechaniu 
    document.querySelector('.tooltipItem' + number+ 'Shop').addEventListener("mouseover", function() { keepCompare(number, itemNumber); });
    //Zamkniecie menu po zjechaniu 
    document.querySelector('.tooltipItem' + number+ 'Shop').addEventListener("mouseout", function() { closeCompare(number, itemNumber); });
}

function keepCompare(number, itemNumber) {
    document.querySelector('.tooltipItem' + number+ 'Shop').style.visibility = 'visible';
    document.querySelector('.tooltipItem' + itemNumber).style.visibility = 'visible'; 
}

function closeCompare(number, itemNumber) {
    document.querySelector('.tooltipItem' + number+ 'Shop').style.visibility = 'hidden'; 
    document.querySelector('.tooltipItem' + itemNumber).style.visibility = 'hidden'; 
    // Przywrócenie poprzednich kolorów statystyk
    $(document).ready(function(){
        $("#itemName").load("../php/statystyki/itemTooltips.php");
    });
    $(document).ready(function(){
        $("#itemName").load("../php/sklep/shopTooltips.php");
    });
}

    //////////     Kupienie przedmiotów      /////////////

function buy(number) {
    document.querySelector('#toolsShop' + number).style.visibility = 'visible';
    // Sprawdzenie czy jest miejsce w plecaku na zakupienie przedmiotów
    let checkEmptySlots = 0;
    for(let i=0; i<9; i++){
        if(slotsBp[i] == "../Przedmioty/Ramka_Gif.gif"){
            checkEmptySlots += 1;
        }
    }

    if((Number(priceShop[number-1]) <= Number(rubins)) && checkEmptySlots >= 1){
        $(document).ready(function(){
            $("#itemName").load("../php/sklep/buyItem.php",{whichItem: number});
        });
    } else {
        document.querySelector('#toolsShop' + number).style.visibility = 'hidden';
    }
}

</script>

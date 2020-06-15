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

    $selectItemType = "SELECT items.Type FROM backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player 
    INNER JOIN items ON items.IdItem=backpackStatistics.ItemId WHERE player.Login='$user_check'";
    $selectItemTypeQuery = mysqli_query($connection, $selectItemType);
    if (mysqli_num_rows($selectItemTypeQuery) > 0) {
        while($row = mysqli_fetch_assoc($selectItemTypeQuery)){
            $typeItems[] = $row['Type'];
        }
    }
    $selectSlots3 = "SELECT Price, Improvment FROM backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player 
    INNER JOIN items ON items.IdItem=backpackStatistics.ItemId WHERE player.Login='$user_check'";
    $getSlots3 = mysqli_query($connection, $selectSlots3);
    if(mysqli_num_rows($getSlots3) > 0){
        while ($row = mysqli_fetch_assoc($getSlots3)) {
            $priceBp[] = $row['Price'];
            $improvment[] = $row['Improvment'];
        }
    }else {
        echo "Empty backpackStatistics";
    }

    mysqli_close($connection);
?>

<script>

    var typeItems = ["<?php echo $typeItems[0] ?>", "<?php echo $typeItems[1] ?>", "<?php echo $typeItems[2] ?>", "<?php echo $typeItems[3] ?>",
    "<?php echo $typeItems[4] ?>", "<?php echo $typeItems[5] ?>", "<?php echo $typeItems[6] ?>", "<?php echo $typeItems[7] ?>",
    "<?php echo $typeItems[8] ?>"];
    var priceBp = ["<?php echo $priceBp[0] ?>", "<?php echo $priceBp[1] ?>", "<?php echo $priceBp[2] ?>", "<?php echo $priceBp[3] ?>",
    "<?php echo $priceBp[4] ?>", "<?php echo $priceBp[5] ?>", "<?php echo $priceBp[6] ?>", "<?php echo $priceBp[7] ?>",
    "<?php echo $priceBp[8] ?>"];
    var improvment = ["<?php echo $improvment[0] ?>", "<?php echo $improvment[1] ?>", "<?php echo $improvment[2] ?>", "<?php echo $improvment[3] ?>",
    "<?php echo $improvment[4] ?>", "<?php echo $improvment[5] ?>", "<?php echo $improvment[6] ?>", "<?php echo $improvment[7] ?>",
    "<?php echo $improvment[8] ?>"];


    document.getElementById('tools1').style.visibility = 'hidden';
    document.getElementById('tools2').style.visibility = 'hidden';
    document.getElementById('tools3').style.visibility = 'hidden';
    document.getElementById('tools4').style.visibility = 'hidden';
    document.getElementById('tools5').style.visibility = 'hidden';
    document.getElementById('tools6').style.visibility = 'hidden';
    document.getElementById('tools7').style.visibility = 'hidden';
    document.getElementById('tools8').style.visibility = 'hidden';
    document.getElementById('tools9').style.visibility = 'hidden';


    //////////      Otworzenie menu przedmiotu       /////////////

function openMenu(number) {
    var bgItem = document.getElementById('positionItem'+number).src;
    if(bgItem != "http://www.pixelwarriors.pl/Przedmioty/Ramka_Gif.gif"){

        var price = priceBp[number-1];
        var improv = improvment[number-1];

        if(improv < 5){
            document.getElementById("upgrade"+number).innerHTML = "Ulepsz <br><font color='gold'>-"+((price*1.3).toFixed(0))+"RB</font>";
        }else if(improv == 5) {
            document.getElementById("upgrade"+number).innerHTML = "Ulepsz <br><font color='gold'>-1<img src='../projekt_grafika/Inne/money.png' width='11%'></font>";
        } else if(improv == 6) {
            document.getElementById("upgrade"+number).innerHTML = "Ulepsz <br><font color='gold'>-3<img src='../projekt_grafika/Inne/money.png' width='11%'></font>";
        }else {
            document.getElementById("upgrade"+number).innerHTML = "Ulepsz <br>";
        }
        document.getElementById("sell"+number).innerHTML = "Sprzedaj <br><font color='green'>+"+price+"RB</font>";

        
        // Zamknięcie wszystkich okien
        for(let i=1; i<10; i++){
            if(i != number ){
                document.getElementById('tools'+i).style.visibility = 'hidden';
            }
        }
        for(let i=1; i<9; i++){
            document.querySelector('.tooltipItem'+i).style.visibility = 'hidden';
        }
        for(let i=1; i<10; i++){
            document.querySelector('.tooltipItem'+i+'Eq').style.visibility = 'hidden';
        }
        
        // Otworzenie menu przedmiotu lub zamknięcie
        if(document.getElementById('tools'+number).style.visibility == "hidden"){
            document.querySelector('.tooltipItem'+number+'Eq').style.visibility = 'hidden';
            document.getElementById('tools'+number).style.visibility = 'visible';
        } else if(document.getElementById('tools'+number).style.visibility == "visible"){
            document.getElementById('tools'+number).style.visibility = "hidden";
        }

        //Utrzymanie menu po najechaniu
        document.getElementById("tools"+number).addEventListener("mouseover", function() { keepMenu(number); });
        //Zamkniecie menu po zjechaniu 
        document.getElementById("tools"+number).addEventListener("mouseout", function() { closeMenu(number); });
        
    }
}

function keepMenu(number) {
    document.getElementById('tools'+number).style.visibility = 'visible';
}

function closeMenu(number) {
    document.getElementById('tools'+number).style.visibility = 'hidden'; 
}


    //////////     Porównanie przedmiotów      /////////////

function compare(number) {
    var itemNumber = 0;
    document.querySelector('#tools' + number).style.visibility = 'hidden';
    document.querySelector('.tooltipItem' + number + 'Eq').style.visibility = 'visible';

    var urlAddress = "http://www.pixelwarriors.pl/sklep/market.php";
    if(urlAddress == window.location.href){
        document.querySelector('.tooltipItem' + number + 'Shop').style.visibility = 'hidden';
    }

    if(typeItems[number-1] == "helmet"){
        document.querySelector('.tooltipItem1').style.visibility = 'visible';
        itemNumber = 1;
    }
    if(typeItems[number-1] == "armor"){
        document.querySelector('.tooltipItem2').style.visibility = 'visible';
        itemNumber = 2;
    }
    if(typeItems[number-1] == "legs"){
        document.querySelector('.tooltipItem3').style.visibility = 'visible';
        itemNumber = 3;
    }
    if(typeItems[number-1] == "boots"){
        document.querySelector('.tooltipItem4').style.visibility = 'visible';
        itemNumber = 4;
    }
    if(typeItems[number-1] == "necklace"){
        document.querySelector('.tooltipItem5').style.visibility = 'visible';
        itemNumber = 5;
    }
    if(typeItems[number-1] == "sword"){
        document.querySelector('.tooltipItem6').style.visibility = 'visible';
        itemNumber = 6;
    }
    if(typeItems[number-1] == "shield"){
        document.querySelector('.tooltipItem7').style.visibility = 'visible';
        itemNumber = 7;
    }
    if(typeItems[number-1] == "gloves"){
        document.querySelector('.tooltipItem8').style.visibility = 'visible';
        itemNumber = 8;
    }

    $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/compareItems.php",{whichItem: number, eqItem: itemNumber});
    });

    //Zamkniecie menu po zjechaniu 
    document.querySelector('.tooltipItem' + number+ 'Eq').addEventListener("mouseover", function() { keepCompare(number, itemNumber); });
    //Zamkniecie menu po zjechaniu 
    document.querySelector('.tooltipItem' + number+ 'Eq').addEventListener("mouseout", function() { closeCompare(number, itemNumber); });
    
}

function keepCompare(number, itemNumber) {
    document.querySelector('.tooltipItem' + number+ 'Eq').style.visibility = 'visible';
    document.querySelector('.tooltipItem' + itemNumber).style.visibility = 'visible'; 
}

function closeCompare(number, itemNumber) {
    document.querySelector('.tooltipItem' + number+ 'Eq').style.visibility = 'hidden'; 
    document.querySelector('.tooltipItem' + itemNumber).style.visibility = 'hidden'; 

    // Przywrócenie poprzednich kolorów statystyk
    $(document).ready(function(){
        $("#itemName").load("../php/statystyki/itemTooltips.php");
    });
    $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/eqTooltips.php");
    });
}


    //////////     Sprzedanie przedmiotów      /////////////

function sell(number) {
    document.querySelector('#tools' + number).style.visibility = 'visible';

    $(document).ready(function(){
        $("#tools1").load("../php/ekwipunek/sellItem.php",{whichItem: number});
    });
}


    //////////     Ulepszenie przedmiotów      /////////////

function upgradeItem(number) {

    $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/upgradeItem.php",{whichItem: number});
    });

    document.getElementById('tools'+number).style.visibility = 'hidden'; 
    document.querySelector('.tooltipItem' + number+ 'Eq').style.visibility = 'visible';

    document.querySelector('.tooltipItem' + number+ 'Eq').addEventListener("mouseover", function() { keepCompare2(number); });
    function keepCompare2(number) {
        document.querySelector('.tooltipItem' + number+ 'Eq').style.visibility = 'visible';
    }

    document.querySelector('.tooltipItem' + number+ 'Eq').addEventListener("mouseout", function() { closeCompare2(number); });
    function closeCompare2(number) {
        document.querySelector('.tooltipItem' + number+ 'Eq').style.visibility = 'hidden';
    }

    $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/menuItem.php");
    });
}

</script>

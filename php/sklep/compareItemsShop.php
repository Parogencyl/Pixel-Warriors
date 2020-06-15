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

     $selectSlotsShop2 = "SELECT * FROM shopStatistics INNER JOIN player ON player.Id=shopStatistics.Player 
     INNER JOIN items ON items.IdItem=shopStatistics.ItemId WHERE player.Login='$user_check'";
     $selectSlotsShopQuery2 = mysqli_query($connection, $selectSlotsShop2);
     if(mysqli_num_rows($selectSlotsShopQuery2) > 0){
         while ($row = mysqli_fetch_assoc($selectSlotsShopQuery2)) {
             $slotShop[] = $row['Slot'];
             $attack2Shop[] = $row['Attack'];
             $health2Shop[] = $row['Health'];
             $power2Shop[] = $row['Power'];
             $intelligence2Shop[] = $row['Intelligence'];
             $skill2Shop[] = $row['Skill'];
             $pDefence2Shop[] = $row['PhysicDefence'];
             $mDefence2Shop[] = $row['MagicDefence'];
             $luck2Shop[] = $row['Luck'];
             $improvment2Shop[] = $row['Improvment'];
             $itemIdShop[] = $row['ItemId'];
             $nameShop[] = $row['Name'];
             $priceShop[] = $row['Price'];
             $profesionShop[] = $row['Profesion'];
         }
     }else {
         echo "Empty backpackStatistics";
     }

    $selectSlots = "SELECT * FROM equipmentStatistics INNER JOIN player ON player.Id=equipmentStatistics.Player 
    INNER JOIN items ON items.IdItem=equipmentStatistics.ItemId WHERE player.Login='$user_check'";
    $getSlots = mysqli_query($connection, $selectSlots);
    if(mysqli_num_rows($getSlots) > 0){
        while ($row = mysqli_fetch_assoc($getSlots)) {
                $slot[] = $row['Slot'];
                $attack2[] = $row['Attack'];
                $health2[] = $row['Health'];
                $power2[] = $row['Power'];
                $intelligence2[] = $row['Intelligence'];
                $skill2[] = $row['Skill'];
                $pDefence2[] = $row['PhysicDefence'];
                $mDefence2[] = $row['MagicDefence'];
                $luck2[] = $row['Luck'];
                $improvment2[] = $row['Improvment'];
                $itemId[] = $row['ItemId'];
                $name[] = $row['Name'];
                $price[] = $row['Price'];
        }
    }else {
        echo "Empty equipmentStatistics";
    }

    $shopItem = $_POST['whichItem'];
    $eqItem = $_POST['eqItem'];

    mysqli_close($connection);
?>

<script>

    var shopItem = "<?php echo $shopItem ?>";
    var eqItem = "<?php echo $eqItem ?>";

    var slot1Shop = "<?php echo $slot1Shop ?>";
    var slot2Shop = "<?php echo $slot2Shop ?>";
    var slot3Shop = "<?php echo $slot3Shop ?>";
    var slot4Shop = "<?php echo $slot4Shop ?>";
    var slot5Shop = "<?php echo $slot5Shop ?>";

    var slotArrayShop = [slot1Shop, slot2Shop, slot3Shop, slot4Shop, slot5Shop];

    var nameArrayShop = ["<?php echo $nameShop[0] ?>", "<?php echo $nameShop[1] ?>", "<?php echo $nameShop[2] ?>", "<?php echo $nameShop[3] ?>",
     "<?php echo $nameShop[4] ?>"];

    var attackArrayShop = ["<?php echo $attack2Shop[0] ?>", "<?php echo $attack2Shop[1] ?>", "<?php echo $attack2Shop[2] ?>",
     "<?php echo $attack2Shop[3] ?>", "<?php echo $attack2Shop[4] ?>"];

    var powerArrayShop = ["<?php echo $power2Shop[0] ?>", "<?php echo $power2Shop[1] ?>", "<?php echo $power2Shop[2] ?>",
     "<?php echo $power2Shop[3] ?>", "<?php echo $power2Shop[4] ?>"];

    var intelligenceArrayShop = ["<?php echo $intelligence2Shop[0] ?>", "<?php echo $intelligence2Shop[1] ?>", "<?php echo $intelligence2Shop[2] ?>",
     "<?php echo $intelligence2Shop[3] ?>", "<?php echo $intelligence2Shop[4] ?>"];

    var skillArrayShop = ["<?php echo $skill2Shop[0] ?>", "<?php echo $skill2Shop[1] ?>", "<?php echo $skill2Shop[2] ?>",
     "<?php echo $skill2Shop[3] ?>", "<?php echo $skill2Shop[4] ?>"];

    var healthArrayShop = ["<?php echo $health2Shop[0] ?>", "<?php echo $health2Shop[1] ?>", "<?php echo $health2Shop[2] ?>",
     "<?php echo $health2Shop[3] ?>", "<?php echo $health2Shop[4] ?>"];

    var luckArrayShop = ["<?php echo $luck2Shop[0] ?>", "<?php echo $luck2Shop[1] ?>", "<?php echo $luck2Shop[2] ?>", "<?php echo $luck2Shop[3] ?>",
    "<?php echo $luck2Shop[4] ?>"];

    var pDefenceArrayShop = ["<?php echo $pDefence2Shop[0] ?>", "<?php echo $pDefence2Shop[1] ?>", "<?php echo $pDefence2Shop[2] ?>",
     "<?php echo $pDefence2Shop[3] ?>", "<?php echo $pDefence2Shop[4] ?>"];

    var mDefenceArrayShop = ["<?php echo $mDefence2Shop[0] ?>", "<?php echo $mDefence2Shop[1] ?>", "<?php echo $mDefence2Shop[2] ?>",
     "<?php echo $mDefence2Shop[3] ?>", "<?php echo $mDefence2Shop[4] ?>"];

    var improvmentArrayShop = ["<?php echo $improvment2Shop[0] ?>", "<?php echo $improvment2Shop[1] ?>", "<?php echo $improvment2Shop[2] ?>",
     "<?php echo $improvment2Shop[3] ?>", "<?php echo $improvment2Shop[4] ?>"];

     var profesionShop = ["<?php echo $profesionShop[0] ?>", "<?php echo $profesionShop[1] ?>", "<?php echo $profesionShop[2] ?>", "<?php echo $profesionShop[3] ?>",
    "<?php echo $profesionShop[4] ?>"];

     var priceShop = ["<?php echo $priceShop[0] ?>", "<?php echo $priceShop[1] ?>", "<?php echo $priceShop[2] ?>", "<?php echo $priceShop[3] ?>",
    "<?php echo $priceShop[4] ?>"];


    // Eq
    var nameArray = ["<?php echo $name[0] ?>", "<?php echo $name[1] ?>", "<?php echo $name[2] ?>", "<?php echo $name[3] ?>",
     "<?php echo $name[4] ?>", "<?php echo $name[5] ?>", "<?php echo $name[6] ?>", "<?php echo $name[7] ?>"];

    var attackArray = ["<?php echo $attack2[0] ?>", "<?php echo $attack2[1] ?>", "<?php echo $attack2[2] ?>", "<?php echo $attack2[3] ?>",
    "<?php echo $attack2[4] ?>", "<?php echo $attack2[5] ?>", "<?php echo $attack2[6] ?>", "<?php echo $attack2[7] ?>"];

    var powerArray = ["<?php echo $power2[0] ?>", "<?php echo $power2[1] ?>", "<?php echo $power2[2] ?>", "<?php echo $power2[3] ?>",
    "<?php echo $power2[4] ?>", "<?php echo $power2[5] ?>", "<?php echo $power2[6] ?>", "<?php echo $power2[7] ?>"];

    var intelligenceArray = ["<?php echo $intelligence2[0] ?>", "<?php echo $intelligence2[1] ?>", "<?php echo $intelligence2[2] ?>", "<?php echo $intelligence2[3] ?>",
    "<?php echo $intelligence2[4] ?>", "<?php echo $intelligence2[5] ?>", "<?php echo $intelligence2[6] ?>", "<?php echo $intelligence2[7] ?>"];

    var skillArray = ["<?php echo $skill2[0] ?>", "<?php echo $skill2[1] ?>", "<?php echo $skill2[2] ?>", "<?php echo $skill2[3] ?>",
    "<?php echo $skill2[4] ?>", "<?php echo $skill2[5] ?>", "<?php echo $skill2[6] ?>", "<?php echo $skill2[7] ?>"];

    var healthArray = ["<?php echo $health2[0] ?>", "<?php echo $health2[1] ?>", "<?php echo $health2[2] ?>", "<?php echo $health2[3] ?>",
    "<?php echo $health2[4] ?>", "<?php echo $health2[5] ?>", "<?php echo $health2[6] ?>", "<?php echo $health2[7] ?>"];

    var luckArray = ["<?php echo $luck2[0] ?>", "<?php echo $luck2[1] ?>", "<?php echo $luck2[2] ?>", "<?php echo $luck2[3] ?>",
    "<?php echo $luck2[4] ?>", "<?php echo $luck2[5] ?>", "<?php echo $luck2[6] ?>", "<?php echo $luck2[7] ?>"];

    var pDefenceArray = ["<?php echo $pDefence2[0] ?>", "<?php echo $pDefence2[1] ?>", "<?php echo $pDefence2[2] ?>", "<?php echo $pDefence2[3] ?>",
    "<?php echo $pDefence2[4] ?>", "<?php echo $pDefence2[5] ?>", "<?php echo $pDefence2[6] ?>", "<?php echo $pDefence2[7] ?>"];

    var mDefenceArray = ["<?php echo $mDefence2[0] ?>", "<?php echo $mDefence2[1] ?>", "<?php echo $mDefence2[2] ?>", "<?php echo $mDefence2[3] ?>",
    "<?php echo $mDefence2[4] ?>", "<?php echo $mDefence2[5] ?>", "<?php echo $mDefence2[6] ?>", "<?php echo $mDefence2[7] ?>"];

    var improvmentArray = ["<?php echo $improvment2[0] ?>", "<?php echo $improvment2[1] ?>", "<?php echo $improvment2[2] ?>", "<?php echo $improvment2[3] ?>",
    "<?php echo $improvment2[4] ?>", "<?php echo $improvment2[5] ?>", "<?php echo $improvment2[6] ?>", "<?php echo $improvment2[7] ?>"];

    var price = ["<?php echo $price[0] ?>", "<?php echo $price[1] ?>", "<?php echo $price[2] ?>", "<?php echo $price[3] ?>",
    "<?php echo $price[4] ?>", "<?php echo $price[5] ?>", "<?php echo $price[6] ?>", "<?php echo $price[7] ?>"];


    //////////              EQ            ///////////////

    var stats = "";
    if(nameArray[eqItem-1] != "Pusty"){
        stats = "<center><font color='#b63b03'>"+nameArray[eqItem-1]+"</font></center><hr>";
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML = stats;
    }

    if(attackArray[eqItem-1] != 0){
        if(parseInt(attackArray[eqItem-1]) >= parseInt(attackArrayShop[shopItem-1])){
            stats = "Atak: <font color='green'>+"+attackArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Atak: <font color='red'>+"+attackArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }

    if(powerArray[eqItem-1] != 0){
        if(parseInt(powerArray[eqItem-1]) >= parseInt(powerArrayShop[shopItem-1])){
            stats = "Siła: <font color='green'>+"+powerArray[eqItem-1]+"</font><br>"; 
        } else {
            stats = "Siła: <font color='red'>+"+powerArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }
    if(intelligenceArray[eqItem-1] != 0){
        if(parseInt(intelligenceArray[eqItem-1]) >= parseInt(intelligenceArrayShop[shopItem-1])){
            stats = "Inteligencja: <font color='green'>+"+intelligenceArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Inteligencja: <font color='red'>+"+intelligenceArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;

    }
    if(skillArray[eqItem-1] != 0){
        if(parseInt(skillArray[eqItem-1]) >= parseInt(skillArrayShop[shopItem-1])){
            stats = "Zręczność: <font color='green'>+"+skillArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Zręczność: <font color='red'>+"+skillArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;

    }
    
    if(healthArray[eqItem-1] != 0){
        if(parseInt(healthArray[eqItem-1]) >= parseInt(healthArrayShop[shopItem-1])){
            stats = "Zdrowie: <font color='green'>+"+healthArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Zdrowie: <font color='red'>+"+healthArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }

    if(luckArray[eqItem-1] != 0){
        if(parseInt(luckArray[eqItem-1]) >= parseInt(luckArrayShop[shopItem-1])){
            stats = "Szczęście: <font color='green'>+"+luckArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Szczęście: <font color='red'>+"+luckArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }

    if(pDefenceArray[eqItem-1] != 0){
        if(parseInt(pDefenceArray[eqItem-1]) >= parseInt(pDefenceArrayShop[shopItem-1])){
            stats = "Obrona F: <font color='green'>+"+pDefenceArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Obrona F: <font color='red'>+"+pDefenceArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    } 

    if(mDefenceArray[eqItem-1] != 0){
        if(parseInt(mDefenceArray[eqItem-1]) >= parseInt(mDefenceArrayShop[shopItem-1])){
            stats = "Obrona M: <font color='green'>+"+mDefenceArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Obrona M: <font color='red'>+"+mDefenceArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }

    if(price[eqItem-1] != 0){
        stats = "<hr><center>Wartość: <font color='red'>"+price[eqItem-1]+"</font> <img src='../projekt_grafika/Inne/rubin.gif'></center> <br>";
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }

// Ustawienie wysokości tooltipów

    for(let i=1; i<6; i++){
        document.querySelector(".tooltipItem"+i+">.itemPowerStat").style.height = "auto";
        var heightElement = document.querySelector(".tooltipItem"+i+">.itemPowerStat").clientHeight;
        document.querySelector(".tooltipItem"+i+">.itemPowerStat").style.top = "5%";
        document.querySelector(".tooltipItem"+i).style.height = heightElement + "px";
        document.querySelector(".tooltipItem"+i).style.backgroundImage = "url(../projekt_grafika/Inne/Tooltip.gif)";    
    }


   //////////////////           Shop           ///////////////////////

   var statsShop = "";
    document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML = "";
    if(nameArrayShop[shopItem-1] != "Pusty"){
        statsShop = "<center><font color='#b63b03'>"+nameArrayShop[shopItem-1]+"</font></center><hr>";
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;
    }

    if(attackArrayShop[shopItem-1] != 0){
        if(parseInt(attackArrayShop[shopItem-1]) >= parseInt(attackArray[eqItem-1])){
            statsShop = "Atak: <font color='green'>+"+attackArrayShop[shopItem-1]+"</font><br>";
        } else {
            statsShop = "Atak: <font color='red'>+"+attackArrayShop[shopItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;
    }

    if(powerArrayShop[shopItem-1] != 0){
        if(parseInt(powerArrayShop[shopItem-1]) >= parseInt(powerArray[eqItem-1])){
            statsShop = "Siła: <font color='green'>+"+powerArrayShop[shopItem-1]+"</font><br>"; 
        } else {
            statsShop = "Siła: <font color='red'>+"+powerArrayShop[shopItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;
    }
    if(intelligenceArrayShop[shopItem-1] != 0){
        if(parseInt(intelligenceArrayShop[shopItem-1]) >= parseInt(intelligenceArray[eqItem-1])){
            statsShop = "Inteligencja: <font color='green'>+"+intelligenceArrayShop[shopItem-1]+"</font><br>";
        } else {
            statsShop = "Inteligencja: <font color='red'>+"+intelligenceArrayShop[shopItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;

    }
    if(skillArrayShop[shopItem-1] != 0){
        if(parseInt(skillArrayShop[shopItem-1]) >= parseInt(skillArray[eqItem-1])){
            statsShop = "Zręczność: <font color='green'>+"+skillArrayShop[shopItem-1]+"</font><br>";
        } else {
            statsShop = "Zręczność: <font color='red'>+"+skillArrayShop[shopItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;

    }
    
    if(healthArrayShop[shopItem-1] != 0){
        if(parseInt(healthArrayShop[shopItem-1]) >= parseInt(healthArray[eqItem-1])){
            statsShop = "Zdrowie: <font color='green'>+"+healthArrayShop[shopItem-1]+"</font><br>";
        } else {
            statsShop = "Zdrowie: <font color='red'>+"+healthArrayShop[shopItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;
    }

    if(luckArrayShop[shopItem-1] != 0){
        if(parseInt(luckArrayShop[shopItem-1]) >= parseInt(luckArray[eqItem-1])){
            statsShop = "Szczęście: <font color='green'>+"+luckArrayShop[shopItem-1]+"</font><br>";
        } else {
            statsShop = "Szczęście: <font color='red'>+"+luckArrayShop[shopItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;
    }

    if(pDefenceArrayShop[shopItem-1] != 0){
        if(parseInt(pDefenceArrayShop[shopItem-1]) >= parseInt(pDefenceArray[eqItem-1])){
            statsShop = "Obrona F: <font color='green'>+"+pDefenceArrayShop[shopItem-1]+"</font><br>";
        } else {
            statsShop = "Obrona F: <font color='red'>+"+pDefenceArrayShop[shopItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;
    } 

    if(mDefenceArrayShop[shopItem-1] != 0){
        if(parseInt(mDefenceArray[shopItem-1]) >= parseInt(mDefenceArray[eqItem-1])){
            statsShop = "Obrona M: <font color='green'>+"+mDefenceArrayShop[shopItem-1]+"</font><br>";
        } else {
            statsShop = "Obrona M: <font color='red'>+"+mDefenceArrayShop[shopItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;
    }

    if(priceShop[shopItem-1] != 0){
        statsShop = "<hr><center>Wartość: <font color='red'>"+priceShop[shopItem-1]+"</font> <img src='../projekt_grafika/Inne/rubin.gif'></center> <br>";
        document.querySelector(".tooltipItem"+shopItem+">.itemPowerStat").innerHTML += statsShop;
    }

// Ustawienie wysokości tooltipów

    for(let i=1; i<6; i++){
        document.querySelector(".tooltipItem"+i+"Shop>.itemPowerStat").style.height = "auto";
        let heightElementShop = document.querySelector(".tooltipItem"+i+"Shop>.itemPowerStat").clientHeight;
        document.querySelector(".tooltipItem"+i+"Shop>.itemPowerStat").style.top = "5%";
        document.querySelector(".tooltipItem"+i+"Shop").style.height = heightElementShop + "px";
        document.querySelector(".tooltipItem"+i+"Shop").style.backgroundImage = "url(../projekt_grafika/Inne/Tooltip2.png)";    

    }

</script>
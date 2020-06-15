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

    $selectSlots3 = "SELECT * FROM backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player 
    INNER JOIN items ON items.IdItem=backpackStatistics.ItemId WHERE player.Login='$user_check'";
    $getSlots3 = mysqli_query($connection, $selectSlots3);
    if(mysqli_num_rows($getSlots3) > 0){
        while ($rowBp = mysqli_fetch_assoc($getSlots3)) {
            $slotBp[] = $rowBp['Slot'];
            $attack2Bp[] = $rowBp['Attack'];
            $health2Bp[] = $rowBp['Health'];
            $power2Bp[] = $rowBp['Power'];
            $intelligence2Bp[] = $rowBp['Intelligence'];
            $skill2Bp[] = $rowBp['Skill'];
            $pDefence2Bp[] = $rowBp['PhysicDefence'];
            $mDefence2Bp[] = $rowBp['MagicDefence'];
            $luck2Bp[] = $rowBp['Luck'];
            $improvment2Bp[] = $rowBp['Improvment'];
            $itemIdBp[] = $rowBp['ItemId'];
            $nameBp[] = $rowBp['Name'];
            $priceBp[] = $rowBp['Price'];
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

    $bpItem = $_POST['whichItem'];
    $eqItem = $_POST['eqItem'];

    mysqli_close($connection);
?>

<script>

    var bpItem = "<?php echo $bpItem ?>";
    var eqItem = "<?php echo $eqItem ?>";

    //Bp
    var nameArrayBp = ["<?php echo $nameBp[0] ?>", "<?php echo $nameBp[1] ?>", "<?php echo $nameBp[2] ?>", "<?php echo $nameBp[3] ?>",
    "<?php echo $nameBp[4] ?>", "<?php echo $nameBp[5] ?>", "<?php echo $nameBp[6] ?>", "<?php echo $nameBp[7] ?>", "<?php echo $nameBp[8] ?>"];

    var attackArrayBp = ["<?php echo $attack2Bp[0] ?>", "<?php echo $attack2Bp[1] ?>", "<?php echo $attack2Bp[2] ?>", "<?php echo $attack2Bp[3] ?>",
    "<?php echo $attack2Bp[4] ?>", "<?php echo $attack2Bp[5] ?>", "<?php echo $attack2Bp[6] ?>", "<?php echo $attack2Bp[7] ?>", "<?php echo $attack2Bp[8] ?>"];

    var powerArrayBp = ["<?php echo $power2Bp[0] ?>", "<?php echo $power2Bp[1] ?>", "<?php echo $power2Bp[2] ?>", "<?php echo $power2Bp[3] ?>",
    "<?php echo $power2Bp[4] ?>", "<?php echo $power2Bp[5] ?>", "<?php echo $power2Bp[6] ?>", "<?php echo $power2Bp[7] ?>", "<?php echo $power2Bp[8] ?>"];

    var intelligenceArrayBp = ["<?php echo $intelligence2Bp[0] ?>", "<?php echo $intelligence2Bp[1] ?>", "<?php echo $intelligence2Bp[2] ?>", "<?php echo $intelligence2Bp[3] ?>",
    "<?php echo $intelligence2Bp[4] ?>", "<?php echo $intelligence2Bp[5] ?>", "<?php echo $intelligence2Bp[6] ?>", "<?php echo $intelligence2Bp[7] ?>", "<?php echo $intelligence2Bp[8] ?>"];

    var skillArrayBp = ["<?php echo $skill2Bp[0] ?>", "<?php echo $skill2Bp[1] ?>", "<?php echo $skill2Bp[2] ?>", "<?php echo $skill2Bp[3] ?>",
    "<?php echo $skill2Bp[4] ?>", "<?php echo $skill2Bp[5] ?>", "<?php echo $skill2Bp[6] ?>", "<?php echo $skill2Bp[7] ?>", "<?php echo $skill2Bp[8] ?>"];

    var healthArrayBp = ["<?php echo $health2Bp[0] ?>", "<?php echo $health2Bp[1] ?>", "<?php echo $health2Bp[2] ?>", "<?php echo $health2Bp[3] ?>",
    "<?php echo $health2Bp[4] ?>", "<?php echo $health2Bp[5] ?>", "<?php echo $health2Bp[6] ?>", "<?php echo $health2Bp[7] ?>", "<?php echo $health2Bp[8] ?>"];

    var luckArrayBp = ["<?php echo $luck2Bp[0] ?>", "<?php echo $luck2Bp[1] ?>", "<?php echo $luck2Bp[2] ?>", "<?php echo $luck2Bp[3] ?>",
    "<?php echo $luck2Bp[4] ?>", "<?php echo $luck2Bp[5] ?>", "<?php echo $luck2Bp[6] ?>", "<?php echo $luck2Bp[7] ?>", "<?php echo $luck2Bp[8] ?>"];

    var pDefenceArrayBp = ["<?php echo $pDefence2Bp[0] ?>", "<?php echo $pDefence2Bp[1] ?>", "<?php echo $pDefence2Bp[2] ?>", "<?php echo $pDefence2Bp[3] ?>",
    "<?php echo $pDefence2Bp[4] ?>", "<?php echo $pDefence2Bp[5] ?>", "<?php echo $pDefence2Bp[6] ?>", "<?php echo $pDefence2Bp[7] ?>", "<?php echo $pDefence2Bp[8] ?>"];

    var mDefenceArrayBp = ["<?php echo $mDefence2Bp[0] ?>", "<?php echo $mDefence2Bp[1] ?>", "<?php echo $mDefence2Bp[2] ?>", "<?php echo $mDefence2Bp[3] ?>",
    "<?php echo $mDefence2Bp[4] ?>", "<?php echo $mDefence2Bp[5] ?>", "<?php echo $mDefence2Bp[6] ?>", "<?php echo $mDefence2Bp[7] ?>", "<?php echo $mDefence2Bp[8] ?>"];

    var improvmentArrayBp = ["<?php echo $improvment2Bp[0] ?>", "<?php echo $improvment2Bp[1] ?>", "<?php echo $improvment2Bp[2] ?>", "<?php echo $improvment2Bp[3] ?>",
    "<?php echo $improvment2Bp[4] ?>", "<?php echo $improvment2Bp[5] ?>", "<?php echo $improvment2Bp[6] ?>", "<?php echo $improvment2Bp[7] ?>", "<?php echo $improvment2Bp[8] ?>"];

    var priceBp = ["<?php echo $priceBp[0] ?>", "<?php echo $priceBp[1] ?>", "<?php echo $priceBp[2] ?>", "<?php echo $priceBp[3] ?>",
    "<?php echo $priceBp[4] ?>", "<?php echo $priceBp[5] ?>", "<?php echo $priceBp[6] ?>", "<?php echo $priceBp[7] ?>", "<?php echo $priceBp[8] ?>"];


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
    document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML = "";
    if(nameArray[eqItem-1] != "Pusty"){
        if(improvmentArray[i] != 0){
        stats = "<center><font color='#b63b03'>"+nameArray[i]+"</font><font color='green'> +"+improvmentArray[i]+
        "</font></center><hr>";
        } else {
            stats = "<center><font color='#b63b03'>"+nameArray[i]+"</font></center><hr>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;  
    }

    if(attackArray[eqItem-1] != 0){
        if(parseInt(attackArray[eqItem-1]) >= parseInt(attackArrayBp[bpItem-1])){
            stats = "Atak: <font color='green'>+"+attackArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Atak: <font color='red'>+"+attackArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }

    if(powerArray[eqItem-1] != 0){
        if(parseInt(powerArray[eqItem-1]) >= parseInt(powerArrayBp[bpItem-1])){
            stats = "Siła: <font color='green'>+"+powerArray[eqItem-1]+"</font><br>"; 
        } else {
            stats = "Siła: <font color='red'>+"+powerArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }
    if(intelligenceArray[eqItem-1] != 0){
        if(parseInt(intelligenceArray[eqItem-1]) >= parseInt(intelligenceArrayBp[bpItem-1])){
            stats = "Inteligencja: <font color='green'>+"+intelligenceArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Inteligencja: <font color='red'>+"+intelligenceArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;

    }
    if(skillArray[eqItem-1] != 0){
        if(parseInt(skillArray[eqItem-1]) >= parseInt(skillArrayBp[bpItem-1])){
            stats = "Zręczność: <font color='green'>+"+skillArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Zręczność: <font color='red'>+"+skillArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;

    }
    
    if(healthArray[eqItem-1] != 0){
        if(parseInt(healthArray[eqItem-1]) >= parseInt(healthArrayBp[bpItem-1])){
            stats = "Zdrowie: <font color='green'>+"+healthArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Zdrowie: <font color='red'>+"+healthArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }

    if(luckArray[eqItem-1] != 0){
        if(parseInt(luckArray[eqItem-1]) >= parseInt(luckArrayBp[bpItem-1])){
            stats = "Szczęście: <font color='green'>+"+luckArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Szczęście: <font color='red'>+"+luckArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    }

    if(pDefenceArray[eqItem-1] != 0){
        if(parseInt(pDefenceArray[eqItem-1]) >= parseInt(pDefenceArrayBp[bpItem-1])){
            stats = "Obrona F: <font color='green'>+"+pDefenceArray[eqItem-1]+"</font><br>";
        } else {
            stats = "Obrona F: <font color='red'>+"+pDefenceArray[eqItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+eqItem+">.itemPowerStat").innerHTML += stats;
    } 

    if(mDefenceArray[eqItem-1] != 0){
        if(parseInt(mDefenceArray[eqItem-1]) >= parseInt(mDefenceArrayBp[bpItem-1])){
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

    for(let i=1; i<9; i++){
        document.querySelector(".tooltipItem"+i+">.itemPowerStat").style.height = "auto";
        var heightElement = document.querySelector(".tooltipItem"+i+">.itemPowerStat").clientHeight;
        document.querySelector(".tooltipItem"+i+">.itemPowerStat").style.top = "5%";
        document.querySelector(".tooltipItem"+i).style.height = heightElement + "px";
        document.querySelector(".tooltipItem"+i).style.backgroundImage = "url(../projekt_grafika/Inne/Tooltip.gif)";    
    }


    //////////////////           BP           ///////////////////////

    var statsBp = "";
    document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML = "";
    if(nameArrayBp[bpItem-1] != "Pusty"){
        if(improvmentArrayBp[i] != 0){
            statsBp = "<center><font color='#b63b03'>"+nameArrayBp[i]+"</font><font color='green'> +"+improvmentArrayBp[i]+
            "</font></center><hr>";
            } else {
                statsBp = "<center><font color='#b63b03'>"+nameArrayBp[i]+"</font></center><hr>";
            }
            document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;
        }
    }

    if(attackArrayBp[bpItem-1] != 0){
        if(parseInt(attackArrayBp[bpItem-1]) > parseInt(attackArray[eqItem-1])){
            statsBp = "Atak: <font color='green'>+"+attackArrayBp[bpItem-1]+"</font><br>";
        } else {
            statsBp = "Atak: <font color='red'>+"+attackArrayBp[bpItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;
    }

    if(powerArrayBp[bpItem-1] != 0){
        if(parseInt(powerArrayBp[bpItem-1]) > parseInt(powerArray[eqItem-1])){
            statsBp = "Siła: <font color='green'>+"+powerArrayBp[bpItem-1]+"</font><br>";
        } else {
            statsBp = "Siła: <font color='red'>+"+powerArrayBp[bpItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;
    }

    if(intelligenceArrayBp[bpItem-1] != 0){
        if(parseInt(intelligenceArrayBp[bpItem-1]) > parseInt(intelligenceArray[eqItem-1])){
            statsBp = "Inteligencja: <font color='green'>+"+intelligenceArrayBp[bpItem-1]+"</font><br>";
        } else {
            statsBp = "Inteligencja: <font color='red'>+"+intelligenceArrayBp[bpItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;

    } 

    if(skillArrayBp[bpItem-1] != 0){
        if(parseInt(skillArrayBp[bpItem-1]) > parseInt(skillArray[eqItem-1])){
            statsBp = "Zręczność: <font color='green'>+"+skillArrayBp[bpItem-1]+"</font><br>";
        } else {
            statsBp = "Zręczność: <font color='red'>+"+skillArrayBp[bpItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;

    }

    if(healthArrayBp[bpItem-1] != 0){
        if(parseInt(healthArrayBp[bpItem-1]) > parseInt(healthArray[eqItem-1])){
            statsBp = "Zdrowie: <font color='green'>+"+healthArrayBp[bpItem-1]+"</font><br>";
        } else {
            statsBp = "Zdrowie: <font color='red'>+"+healthArrayBp[bpItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;
    } 

    if(luckArrayBp[bpItem-1] != 0){
        if(parseInt(luckArrayBp[bpItem-1]) > parseInt(luckArray[eqItem-1])){
            statsBp = "Szczęście: <font color='green'>+"+luckArrayBp[bpItem-1]+"</font><br>";
        } else {
            statsBp = "Szczęście: <font color='red'>+"+luckArrayBp[bpItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;
    }

    if(pDefenceArrayBp[bpItem-1] != 0){
        if(parseInt(pDefenceArrayBp[bpItem-1]) > parseInt(pDefenceArray[eqItem-1])){
            statsBp = "Obrona F: <font color='green'>+"+pDefenceArrayBp[bpItem-1]+"</font><br>";
        } else {
            statsBp = "Obrona F: <font color='red'>+"+pDefenceArrayBp[bpItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;
    }

    if(mDefenceArrayBp[bpItem-1] != 0){
        if(parseInt(mDefenceArrayBp[bpItem-1]) > parseInt(mDefenceArray[eqItem-1])){
            statsBp = "Obrona M: <font color='green'>+"+mDefenceArrayBp[bpItem-1]+"</font><br>";
        } else {
            statsBp = "Obrona M: <font color='red'>+"+mDefenceArrayBp[bpItem-1]+"</font><br>";
        }
        document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;
    }

    if(priceBp[bpItem-1] != 0){
        statsBp = "<hr><center>Wartość: <font color='red'>"+priceBp[bpItem-1]+"</font> <img src='../projekt_grafika/Inne/rubin.gif'></center> <br>";
        document.querySelector(".tooltipItem"+bpItem+"Eq>.itemPowerStat").innerHTML += statsBp;
    }

// Ustawienie wysokości tooltipów

    for(let i=1; i<10; i++){
        document.querySelector(".tooltipItem"+i+"Eq>.itemPowerStat").style.height = "auto";
        let heightElementBp = document.querySelector(".tooltipItem"+i+"Eq>.itemPowerStat").clientHeight;
        document.querySelector(".tooltipItem"+i+"Eq>.itemPowerStat").style.top = "5%";
        document.querySelector(".tooltipItem"+i+"Eq").style.height = heightElementBp + "px";
        document.querySelector(".tooltipItem"+i+"Eq").style.backgroundImage = "url(../projekt_grafika/Inne/Tooltip.gif)";    
    }
</script>
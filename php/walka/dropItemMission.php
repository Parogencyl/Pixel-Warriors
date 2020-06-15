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
      header("location: ../../index.php");
      die();
   }


   $getPlayerValue = "SELECT player.Level FROM player WHERE player.Login='$user_check'";
   $getPlayerValueQuery = mysqli_query($connection, $getPlayerValue);
   if(mysqli_num_rows($getPlayerValueQuery) > 0){
       $row = mysqli_fetch_assoc($getPlayerValueQuery);
       $level = $row['Level'];
   }

   $getExperience = "SELECT RequiredExp FROM experience 
   INNER JOIN player ON player.Level=experience.Level WHERE player.Login='$user_check'";
   $getExperienceQuery = mysqli_query($connection, $getExperience);
   if(mysqli_num_rows($getExperienceQuery) > 0){
       $row = mysqli_fetch_assoc($getExperienceQuery);
       $requiredExp = $row['RequiredExp'];
   }

    $getPlayerProfesion = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
    WHERE player.Login='$user_check'"; 
    $getPlayerProfesionQuery = mysqli_query($connection, $getPlayerProfesion);
    if(mysqli_num_rows($getPlayerProfesionQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerProfesionQuery);
            $profesion = $row['Profesion'];
    }

    $typeItem2 = $_POST['typeItem2'];
    $itemId2 = $_POST['itemId2'];
    $numberSlot2 = $_POST['numberSlot2'];

    $selectName = "SELECT Name FROM items WHERE IdItem='$itemId2'";
    $selectNameQuery = mysqli_query($connection, $selectName);
    if (mysqli_num_rows($selectNameQuery) > 0) {
        $row = mysqli_fetch_assoc($selectNameQuery);
        $name = $row['Name'];
    }

        $attackItem = 0;
        $powerItem = 0;
        $intelligenceItem = 0;
        $skillItem =0;
        $healthitem = 0;
        $luckItem =0;
        $pDefenceItem =0;
        $mDefenceItem =0;
        $itemIdOfItem = $itemId2;
        $slotItem =1;
        $sum = 0;
        if ($profesion == "warrior") {
            if ($typeItem2 == "armor") {
                $pDefenceItem = $requiredExp/rand((1.3*$level), (2*$level));
                $pDefenceItem = (int)$pDefenceItem;
                $mDefenceItem = $requiredExp/rand((3.3*$level), (4*$level));
                $mDefenceItem = (int)$mDefenceItem;
                $powerItem = $requiredExp/rand((0.8*$level), (1.2*$level));
                $powerItem = (int)$powerItem;
                $healthItem = $requiredExp/rand((0.3*$level), (0.5*$level));
                $healthItem = (int)$healthItem;
                $luckItem = $requiredExp/rand((1.2*$level), (2.2*$level));
                $luckItem = (int)$luckItem;
                $slotItem = 2;
                $lotery = rand(1,100);
                if($lotery>70){
                    $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $intelligenceItem = (int)$intelligenceItem;
                }
                $lotery = rand(1,100);
                if($lotery>70){
                    $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $skillItem = (int)$skillItem;
                }
                $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                $sum *= 2.2;
                $sum = (int)$sum;
            }
            if ($typeItem2 == "legs") {
                $pDefenceItem = $requiredExp/rand((1.4*$level), (2.3*$level));
                $pDefenceItem = (int)$pDefenceItem;
                $mDefenceItem = $requiredExp/rand((3.3*$level), (4*$level));
                $mDefenceItem = (int)$mDefenceItem;
                $powerItem = $requiredExp/rand((0.9*$level), (1.4*$level));
                $powerItem = (int)$powerItem;
                $healthItem = $requiredExp/rand((0.3*$level), (0.6*$level));
                $healthItem = (int)$healthItem;
                $luckItem = $requiredExp/rand((1.4*$level), (2.4*$level));
                $luckItem = (int)$luckItem;
                $slotItem = 3;
                $lotery = rand(1,100);
                if($lotery>70){
                    $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $intelligenceItem = (int)$intelligenceItem;
                }
                $lotery = rand(1,100);
                if($lotery>70){
                    $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $skillItem = (int)$skillItem;
                }
                $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                $sum *= 2.2;
                $sum = (int)$sum;
            }
            if ($typeItem2 == "helmet") {
                $pDefenceItem = $requiredExp/rand((2.3*$level), (3*$level));
                $pDefenceItem = (int)$pDefenceItem;
                $mDefenceItem = $requiredExp/rand((4.5*$level), (6.5*$level));
                $mDefenceItem = (int)$mDefenceItem;
                $powerItem = $requiredExp/rand((1.1*$level), (1.5*$level));
                $powerItem = (int)$powerItem;
                $healthItem = $requiredExp/rand((0.7*$level), (1.1*$level));
                $healthItem = (int)$healthItem;
                $luckItem = $requiredExp/rand((1.8*$level), (2.9*$level));
                $luckItem = (int)$luckItem;
                $slotItem = 1;
                $lotery = rand(1,100);
                if($lotery>70){
                    $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $intelligenceItem = (int)$intelligenceItem;
                }
                $lotery = rand(1,100);
                if($lotery>70){
                    $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $skillItem = (int)$skillItem;
                }
                $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                $sum *= 2.5;
                $sum = (int)$sum;
            }
            if ($typeItem2 == "boots") {
                $pDefenceItem = $requiredExp/rand((2.3*$level), (3*$level));
                $pDefenceItem = (int)$pDefenceItem;
                $mDefenceItem = $requiredExp/rand((4.5*$level), (6.5*$level));
                $mDefenceItem = (int)$mDefenceItem;
                $powerItem = $requiredExp/rand((1.1*$level), (1.5*$level));
                $powerItem = (int)$powerItem;
                $healthItem = $requiredExp/rand((0.8*$level), (1.2*$level));
                $healthItem = (int)$healthItem;
                $luckItem = $requiredExp/rand((1.8*$level), (3*$level));
                $luckItem = (int)$luckItem;
                $slotItem = 4;
                $lotery = rand(1,100);
                if($lotery>70){
                    $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $intelligenceItem = (int)$intelligenceItem;
                }
                $lotery = rand(1,100);
                if($lotery>70){
                    $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $skillItem = (int)$skillItem;
                }
                $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                $sum *= 2.5;
                $sum = (int)$sum;
            }
            if ($typeItem2 == "necklace") {
                $mDefenceItem = $requiredExp/rand((3*$level), (4*$level));
                $mDefenceItem = (int)$mDefenceItem;
                $powerItem = $requiredExp/rand((2.8*$level), (3.5*$level));
                $powerItem = (int)$powerItem;
                $healthItem = $requiredExp/rand((1.4*$level), (2.4*$level));
                $healthItem = (int)$healthItem;
                $luckItem = $requiredExp/rand((2*$level), (3*$level));
                $luckItem = (int)$luckItem;
                $slotItem = 5;
                $lotery = rand(1, 100);
                if ($lotery>70) {
                    $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $intelligenceItem = (int)$intelligenceItem;
                }
                $lotery = rand(1, 100);
                if ($lotery>70) {
                    $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $skillItem = (int)$skillItem;
                }
                $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                $sum *= 2.7;
                $sum = (int)$sum;
            }
            if ($typeItem2 == "gloves") {
                $pDefenceItem = $requiredExp/rand((2.7*$level), (3.8*$level));
                $pDefenceItem = (int)$pDefenceItem;
                $powerItem = $requiredExp/rand((2.3*$level), (3.1*$level));
                $powerItem = (int)$powerItem;
                $healthItem = $requiredExp/rand((1.4*$level), (2*$level));
                $healthItem = (int)$healthItem;
                $luckItem = $requiredExp/rand((2.9*$level), (3.6*$level));
                $luckItem = (int)$luckItem;
                $slotItem = 8;
                $lotery = rand(1, 100);
                if ($lotery>70) {
                    $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $intelligenceItem = (int)$intelligenceItem;
                }
                $lotery = rand(1, 100);
                if ($lotery>70) {
                    $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $skillItem = (int)$skillItem;
                }
                $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                $sum *= 2.7;
                $sum = (int)$sum;
            }
            if ($typeItem2 == "sword") {
                $attackItem = $requiredExp/rand((0.7*$level), (1.3*$level));
                $attackItem = (int)$attackItem;
                $powerItem = $requiredExp/rand((1.4*$level), (2.2*$level));
                $powerItem = (int)$powerItem;
                $luckItem = $requiredExp/rand((2.4*$level), (3.7*$level));
                $luckItem = (int)$luckItem;
                $healthItem = $requiredExp/rand((1.6*$level), (2.4*$level));
                $healthItem = (int)$healthItem;
                $slotItem = 6;
                $lotery = rand(1, 100);
                if ($lotery>70) {
                    $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $intelligenceItem = (int)$intelligenceItem;
                }
                $lotery = rand(1, 100);
                if ($lotery>70) {
                    $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $skillItem = (int)$skillItem;
                }
                $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem + $$attackItem;
                $sum *= 2.7;
                $sum = (int)$sum;
            }
            if ($typeItem2 == "shield") {
                $pDefenceItem = $requiredExp/rand((1.7*$level), (2.7*$level));
                $pDefenceItem = (int)$pDefenceItem;
                $mDefenceItem = $requiredExp/rand((3.5*$level), (4.5*$level));
                $mDefenceItem = (int)$mDefenceItem;
                $healthItem = $requiredExp/rand((0.7*$level), (1.4*$level));
                $healthItem = (int)$healthItem;
                $luckItem = $requiredExp/rand((2.8*$level), (4*$level));
                $luckItem = (int)$luckItem;
                $slotItem = 7;
                $lotery = rand(1,100);
                if ($lotery>50) {
                    $powerItem = $requiredExp/rand((1.6*$level), (2.2*$level));
                    $powerItem = (int)$powerItem;
                }
                $lotery = rand(1,100);
                if($lotery>70){
                    $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $intelligenceItem = (int)$intelligenceItem;
                }
                $lotery = rand(1,100);
                if($lotery>70){
                    $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                    $skillItem = (int)$skillItem;
                }
                $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                $sum *= 2.5;
                $sum = (int)$sum;
            }

        }

        $setItemStat = "UPDATE backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player 
        SET Attack='$attackItem', Power='$powerItem', Skill='$skillItem', Intelligence='$intelligenceItem', Health='$healthItem', 
        Luck='$luckItem', PhysicDefence='$pDefenceItem', MagicDefence='$mDefenceItem', ItemId='$itemIdOfItem', Price='$sum'
        WHERE player.Login='$user_check' AND Slot='$numberSlot2'";
        $setItemStatQuery = mysqli_query($connection, $setItemStat);

    mysqli_close($connection);
?>

<script>
    document.getElementById("prizeItem").addEventListener("mouseover", disableTooltip);
    document.getElementById("prizeItem").addEventListener("mouseout", enableTooltip);

    document.querySelector(".tooltipItem1").style.visibility = 'hidden';

    // Tooltip
    function disableTooltip() {
        document.querySelector(".tooltipItem1").style.visibility = 'visible';
    }

    function enableTooltip() {
        document.querySelector(".tooltipItem1").style.visibility = 'hidden';
    }

    var nameArray = "<?php echo $name ?>";
    var attackArray = "<?php echo $attackItem ?>";
    var powerArray = "<?php echo $powerItem ?>";
    var skillArray = "<?php echo $skillItem ?>";
    var intelligenceArray = "<?php echo $intelligenceItem ?>";
    var healthArray = "<?php echo $healthItem ?>";
    var luckArray = "<?php echo $luckItem ?>";
    var pDefenceArray = "<?php echo $pDefenceItem ?>";
    var mDefenceArray = "<?php echo $mDefenceItem ?>";
    var price = "<?php echo $sum ?>";
    var profesion2 = "<?php echo $profesion ?>";

    var number = 1;
    var stats = "";
    document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML = "";
    if(nameArray != "Pusty"){
        stats = "<center><font color='#b63b03'>"+nameArray+"</font></center><hr>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    }
    if(attackArray != 0){
        stats = "Atak: <font color='gold'>+"+attackArray+"</font><br>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    }
    if(powerArray != 0){
        stats = "Siła: <font color='gold'>+"+powerArray+"</font><br>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    }
    if(intelligenceArray != 0){
        stats = "Inteligencja: <font color='gold'>+"+intelligenceArray+"</font><br>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;

    } 
    if(skillArray != 0){
        stats = "Zręczność: <font color='gold'>+"+skillArray+"</font><br>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    } 
    if(healthArray != 0){
        stats = "Zdrowie: <font color='gold'>+"+healthArray+"</font><br>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    } 
    if(luckArray != 0){
        stats = "Szczęście: <font color='gold'>+"+luckArray+"</font><br>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    } 
    if(pDefenceArray != 0){
        stats = "Obrona F: <font color='gold'>+"+pDefenceArray+"</font><br>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    } 
    if(mDefenceArray != 0){
        stats = "Obrona M: <font color='gold'>+"+mDefenceArray+"</font><br>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    } 
    if(profesion == "warrior"){
        stats = "<hr><center>Wojownik</center>";
    } else if(profesion == "mag"){
        stats = "<hr><center>Mag</center>";
    } else if(profesion == "hunter"){
        stats = "<hr><center>Łowca</center>";
    } else if(profesion == "all"){
        stats = "<hr>";
    }
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    if(price != 0){
        stats = "<center>Wartość: <font color='red'>"+price+"</font> <img src='../../projekt_grafika/Inne/rubin.gif'></center> <br>";
        document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
    } 


// Ustawienie wysokości tooltipów

        document.querySelector(".tooltipItem1 >.itemPowerStat").style.height = "auto";
        var heightElement = document.querySelector(".tooltipItem1 >.itemPowerStat").clientHeight;
        document.querySelector(".tooltipItem1 >.itemPowerStat").style.top = "5%";
        document.querySelector(".tooltipItem1").style.height = heightElement + "px";
        document.querySelector(".tooltipItem1").style.backgroundImage = "url(../../projekt_grafika/Inne/Tooltip2.png)";    

</script>
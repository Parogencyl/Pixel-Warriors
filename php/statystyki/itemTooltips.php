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

    $selectSlots = "SELECT * FROM equipment INNER JOIN player ON player.Id=equipment.IdEquipment WHERE player.Login='$user_check'";
    $getSlots = mysqli_query($connection, $selectSlots);
    if(mysqli_num_rows($getSlots) > 0){
        $row = mysqli_fetch_assoc($getSlots);
        $slot1 = $row['Slot1'];
        $slot1Stat = $row['Slot1Stat'];
        $slot2 = $row['Slot2'];
        $slot2Stat = $row['Slot2Stat'];
        $slot3 = $row['Slot3'];
        $slot3Stat = $row['Slot3Stat'];
        $slot4 = $row['Slot4'];
        $slot4Stat = $row['Slot4Stat'];
        $slot5 = $row['Slot5'];
        $slot5Stat = $row['Slot5Stat'];
        $slot6 = $row['Slot6'];
        $slot6Stat = $row['Slot6Stat'];
        $slot7 = $row['Slot7'];
        $slot7Stat = $row['Slot7Stat'];
        $slot8 = $row['Slot8'];
        $slot8Stat = $row['Slot8Stat'];
    }else {
        echo "Empty equipment";
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
                $profesion[] = $row['Profesion'];
                $price[] = $row['Price'];
        }
    }else {
        echo "Empty equipmentStatistics";
    }

?>

<script>

    var slot1 = "<?php echo $slot1 ?>";
    var slot2 = "<?php echo $slot2 ?>";
    var slot3 = "<?php echo $slot3 ?>";
    var slot4 = "<?php echo $slot4 ?>";
    var slot5 = "<?php echo $slot5 ?>";
    var slot6 = "<?php echo $slot6 ?>";
    var slot7 = "<?php echo $slot7 ?>";
    var slot8 = "<?php echo $slot8 ?>";

    var slotArray = [slot1, slot2, slot3, slot4, slot5, slot6, slot7, slot8];

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

    var profesion = ["<?php echo $profesion[0] ?>", "<?php echo $profesion[1] ?>", "<?php echo $profesion[2] ?>", "<?php echo $profesion[3] ?>",
    "<?php echo $profesion[4] ?>", "<?php echo $profesion[5] ?>", "<?php echo $profesion[6] ?>", "<?php echo $profesion[7] ?>"];

    var number = 0;
    var licznik = 0;
    var licznikArray = [0, 1];
    
    for(let i=0; i<8; i++){
        if(slotArray[i] != "../Przedmioty/Ramka_Gif.gif"){
            var stats = "";
            number = i+1;
            document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML = "";
            if(nameArray[i] != "Pusty"){
                number = i+1;
                if(improvmentArray[i] != 0){
                    stats = "<center><font color='#b63b03'>"+nameArray[i]+"</font><font color='green'> +"+improvmentArray[i]+
                    "</font></center><hr>";
                } else {
                    stats = "<center><font color='#b63b03'>"+nameArray[i]+"</font></center><hr>";
                }
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
            }

            if(attackArray[i] != 0){
             number = i+1;
                stats = "Atak: <font color='gold'>+"+attackArray[i]+"</font><br>";
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
            }else {
                licznik++;
            }
            if(powerArray[i] != 0){
             number = i+1;
                stats = "Siła: <font color='gold'>+"+powerArray[i]+"</font><br>";
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
            }else {
                licznik++;
            }
            if(intelligenceArray[i] != 0){
             number = i+1;
                stats = "Inteligencja: <font color='gold'>+"+intelligenceArray[i]+"</font><br>";
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;

            } else {
                licznik++;
            }
            if(skillArray[i] != 0){
             number = i+1;
                stats = "Zręczność: <font color='gold'>+"+skillArray[i]+"</font><br>";
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;

            } else {
                licznik++;
            }
            if(healthArray[i] != 0){
             number = i+1;
                stats = "Zdrowie: <font color='gold'>+"+healthArray[i]+"</font><br>";
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
            } else {
                licznik++;
            }
            if(luckArray[i] != 0){
             number = i+1;
                stats = "Szczęście: <font color='gold'>+"+luckArray[i]+"</font><br>";
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
            } else {
                licznik++;
            }
            if(pDefenceArray[i] != 0){
             number = i+1;
                stats = "Obrona F: <font color='gold'>+"+pDefenceArray[i]+"</font><br>";
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
            } else {
                licznik++;
            }
            if(mDefenceArray[i] != 0){
             number = i+1;
                stats = "Obrona M: <font color='gold'>+"+mDefenceArray[i]+"</font><br>";
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
            } else {
                licznik++;
            }
            if(profesion[i] == "warrior"){
             number = i+1;
             stats = "<hr><center>Wojownik</center>";
            } else if(profesion[i] == "mag"){
                number = i+1;
                stats = "<hr><center>Mag</center>";
            } else if(profesion[i] == "hunter"){
                number = i+1;
                stats = "<hr><center>Łowca</center>";
            } else if(profesion[i] == "all"){
                number = i+1;
                stats = "<hr>";
            }
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
                licznik++;
            if(price[i] != 0){
             number = i+1;
             stats = "<center>Wartość: <font color='red'>"+price[i]+"</font> <img src='../projekt_grafika/Inne/rubin.gif'></center> <br>";
                document.querySelector(".tooltipItem"+number+">.itemPowerStat").innerHTML += stats;
            } else {
                licznik++;
            }
        licznikArray[i] = licznik;
        licznik = 0;
        }
    }

// Ustawienie wysokości tooltipów

    for(let i=1; i<9; i++){
        document.querySelector(".tooltipItem"+i+">.itemPowerStat").style.height = "auto";
        var heightElement = document.querySelector(".tooltipItem"+i+">.itemPowerStat").clientHeight;
        document.querySelector(".tooltipItem"+i+">.itemPowerStat").style.top = "5%";
        document.querySelector(".tooltipItem"+i).style.height = heightElement + "px";
        document.querySelector(".tooltipItem"+i).style.backgroundImage = "url(../projekt_grafika/Inne/Tooltip2.png)";    
    }

</script>
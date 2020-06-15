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

    $selectSlots2 = "SELECT * FROM backpack INNER JOIN player ON player.Id=backpack.IdBackpack WHERE player.Login='$user_check'";
    $getSlots2 = mysqli_query($connection, $selectSlots2);
    if(mysqli_num_rows($getSlots2) > 0){
        $row = mysqli_fetch_assoc($getSlots2);
        $slot1Bp = $row['slot1'];
        $slot1StatBp = $row['slot1Stat'];
        $slot2Bp = $row['slot2'];
        $slot2StatBp = $row['slot2Stat'];
        $slot3Bp = $row['slot3'];
        $slot3StatBp = $row['slot3Stat'];
        $slot4Bp = $row['slot4'];
        $slot4StatBp = $row['slot4Stat'];
        $slot5Bp = $row['slot5'];
        $slot5StatBp = $row['slot5Stat'];
        $slot6Bp = $row['slot6'];
        $slot6StatBp = $row['slot6Stat'];
        $slot7Bp = $row['slot7'];
        $slot7StatBp = $row['slot7Stat'];
        $slot8Bp = $row['slot8'];
        $slot8StatBp = $row['slot8Stat'];
        $slot9Bp = $row['slot9'];
        $slot9StatBp = $row['slot9Stat'];
    }else {
        echo "Empty equipment";
    }

    //Statystyki Bp
    $selectSlots3 = "SELECT * FROM backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player 
    INNER JOIN items ON items.IdItem=backpackStatistics.ItemId WHERE player.Login='$user_check'";
    $getSlots3 = mysqli_query($connection, $selectSlots3);
    if(mysqli_num_rows($getSlots3) > 0){
        while ($row = mysqli_fetch_assoc($getSlots3)) {
            $slotBp[] = $row['Slot'];
            $attack2Bp[] = $row['Attack'];
            $health2Bp[] = $row['Health'];
            $power2Bp[] = $row['Power'];
            $intelligence2Bp[] = $row['Intelligence'];
            $skill2Bp[] = $row['Skill'];
            $pDefence2Bp[] = $row['PhysicDefence'];
            $mDefence2Bp[] = $row['MagicDefence'];
            $luck2Bp[] = $row['Luck'];
            $improvment2Bp[] = $row['Improvment'];
            $itemIdBp[] = $row['ItemId'];
            $nameBp[] = $row['Name'];
            $profesionBp[] = $row['Profesion'];
            $priceBp[] = $row['Price'];
        }
    }else {
        echo "Empty backpackStatistics";
    }

    //Statystyki Eq
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

    //Profesja gracza
    $selectProf = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
    WHERE player.Login='$user_check'";
    $selectProfQuery = mysqli_query($connection, $selectProf);
    if (mysqli_num_rows($selectProfQuery) > 0) {
        $row = mysqli_fetch_assoc($selectProfQuery);
        $profesionPlayer = $row['Profesion'];
    }

    /*for($i = 0; $i<sizeof($slot); $i++){
        echo "<script> console.log('".$slot[$i]."')</script>";
    }*/
    mysqli_close($connection);
?>

<script>

    var slot1Bp = "<?php echo $slot1Bp ?>";
    var slot2Bp = "<?php echo $slot2Bp ?>";
    var slot3Bp = "<?php echo $slot3Bp ?>";
    var slot4Bp = "<?php echo $slot4Bp ?>";
    var slot5Bp = "<?php echo $slot5Bp ?>";
    var slot6Bp = "<?php echo $slot6Bp ?>";
    var slot7Bp = "<?php echo $slot7Bp ?>";
    var slot8Bp = "<?php echo $slot8Bp ?>";
    var slot9Bp = "<?php echo $slot9Bp ?>";

    var slotArrayBp = [slot1Bp, slot2Bp, slot3Bp, slot4Bp, slot5Bp, slot6Bp, slot7Bp, slot8Bp, slot9Bp];

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

    var profesionBp = ["<?php echo $profesionBp[0] ?>", "<?php echo $profesionBp[1] ?>", "<?php echo $profesionBp[2] ?>", "<?php echo $profesionBp[3] ?>",
    "<?php echo $profesionBp[4] ?>", "<?php echo $profesionBp[5] ?>", "<?php echo $profesionBp[6] ?>", "<?php echo $profesionBp[7] ?>", "<?php echo $profesionBp[8] ?>"];

    var price = ["<?php echo $priceBp[0] ?>", "<?php echo $priceBp[1] ?>", "<?php echo $priceBp[2] ?>", "<?php echo $priceBp[3] ?>",
    "<?php echo $priceBp[4] ?>", "<?php echo $priceBp[5] ?>", "<?php echo $priceBp[6] ?>", "<?php echo $priceBp[7] ?>", "<?php echo $priceBp[8] ?>"];

    var profesionPlayer = "<?php echo $profesionPlayer ?>";

    var numberBp = 0;
    var licznikBp = 0;
    var licznikArrayBp = [0, 1];

    for(let i=0; i<9; i++){
        if(slotArrayBp[i] != "../Przedmioty/Ramka_Gif.gif"){
            var statsBp = "";
            numberBp = i+1;
            document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML = "";
            if(nameArrayBp[i] != "Pusty"){
                numberBp = i+1;
                if(improvmentArrayBp[i] != 0){
                statsBp = "<center><font color='#b63b03'>"+nameArrayBp[i]+"</font><font color='green'> +"+improvmentArrayBp[i]+
                "</font></center><hr>";
                } else {
                    statsBp = "<center><font color='#b63b03'>"+nameArrayBp[i]+"</font></center><hr>";
                }
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;
            }

            if(attackArrayBp[i] != 0){
             numberBp = i+1;
             statsBp = "Atak: <font color='gold'>+"+attackArrayBp[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;
            }else {
                licznikBp++;
            }
            if(powerArrayBp[i] != 0){
             numberBp = i+1;
             statsBp = "Siła: <font color='gold'>+"+powerArrayBp[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;
            }else {
                licznikBp++;
            }
            if(intelligenceArrayBp[i] != 0){
             numberBp = i+1;
             statsBp = "Inteligencja: <font color='gold'>+"+intelligenceArrayBp[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;

            } else {
                licznikBp++;
            }
            if(skillArrayBp[i] != 0){
            numberBp = i+1;
             statsBp = "Zręczność: <font color='gold'>+"+skillArrayBp[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;

            } else {
                licznikBp++;
            }
            if(healthArrayBp[i] != 0){
            numberBp = i+1;
             statsBp = "Zdrowie: <font color='gold'>+"+healthArrayBp[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;
            } else {
                licznikBp++;
            }
            if(luckArrayBp[i] != 0){
             numberBp = i+1;
             statsBp = "Szczęście: <font color='gold'>+"+luckArrayBp[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;
            } else {
                licznikBp++;
            }
            if(pDefenceArrayBp[i] != 0){
             numberBp = i+1;
             statsBp = "Obrona F: <font color='gold'>+"+pDefenceArrayBp[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;
            } else {
                licznikBp++;
            }
            if(mDefenceArrayBp[i] != 0){
             numberBp = i+1;
             statsBp = "Obrona M: <font color='gold'>+"+mDefenceArrayBp[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;
            } else {
                licznikBp++;
            }
            if(profesionBp[i] == "warrior"){
                numberBp = i+1;
                if(profesionPlayer == profesionBp[i]){
                    statsBp = "<hr><center>Wojownik</center>";
                }else {
                    statsBp = "<hr><center><font color='red'> Wojownik </font></center>"
                }
            } else if(profesionBp[i] == "mag"){
                numberBp = i+1;
                if(profesionPlayer == profesionBp[i]){
                    statsBp = "<hr><center> Mag </center>";
                }else {
                    statsBp = "<hr><center><font color='red'> Mag </font></center>"
                }
            } else if(profesionBp[i] == "hunter"){
                numberBp = i+1;
                if(profesionPlayer == profesionBp[i]){
                    statsBp = "<hr><center> Łowca </center>";
                }else {
                    statsBp = "<hr><center><font color='red'> Łowca </font></center>"
                }
            } else if(profesionBp[i] == "all"){
                numberBp = i+1;
                statsBp = "<hr>";
            }
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;
                licznikBp++;
            if(price[i] != 0){
             numberBp = i+1;
             statsBp = "<center>Wartość: <font color='red'>"+price[i]+"</font> <img src='../projekt_grafika/Inne/rubin.gif'></center> <br>";
                document.querySelector(".tooltipItem"+numberBp+"Eq>.itemPowerStat").innerHTML += statsBp;
            } else {
                licznikBp++;
            }
        licznikArrayBp[i] = licznikBp;
        licznikBp = 0;
        }
    }

// Ustawienie wysokości tooltipów

    for(let i=1; i<10; i++){
        document.querySelector(".tooltipItem"+i+"Eq>.itemPowerStat").style.height = "auto";
        let heightElementBp = document.querySelector(".tooltipItem"+i+"Eq>.itemPowerStat").clientHeight;
        document.querySelector(".tooltipItem"+i+"Eq>.itemPowerStat").style.top = "5%";
        document.querySelector(".tooltipItem"+i+"Eq").style.height = heightElementBp + "px";
        document.querySelector(".tooltipItem"+i+"Eq").style.backgroundImage = "url(../projekt_grafika/Inne/Tooltip2.png)";    

    }


</script>
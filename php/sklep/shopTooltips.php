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

    //Profesja gracza
    $selectProf = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
    WHERE player.Login='$user_check'";
    $selectProfQuery = mysqli_query($connection, $selectProf);
    if (mysqli_num_rows($selectProfQuery) > 0) {
        $row = mysqli_fetch_assoc($selectProfQuery);
        $profesionPlayer = $row['Profesion'];
    }
?>

<script>

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

    var profesionPlayer = "<?php echo $profesionPlayer ?>";

    var numberShop = 0;
    var licznikShop = 0;
    var licznikArrayShop = [0, 1];

    for(let i=0; i<5; i++){
        if(slotArrayShop[i] != "../Przedmioty/Ramka_Gif.gif"){
            var statsShop = "";
            numberShop = i+1;
            document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML = "";
            if(nameArrayShop[i] != "Pusty"){
                numberShop = i+1;
                statsShop = "<center><font color='#b63b03'>"+nameArrayShop[i]+"</font></center><hr>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;
            }

            if(attackArrayShop[i] != 0){
             numberShop = i+1;
             statsShop = "Atak: <font color='gold'>+"+attackArrayShop[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;
            }else {
                licznikShop++;
            }
            if(powerArrayShop[i] != 0){
             numberShop = i+1;
             statsShop = "Siła: <font color='gold'>+"+powerArrayShop[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;
            }else {
                licznikShop++;
            }
            if(intelligenceArrayShop[i] != 0){
             numberShop = i+1;
             statsShop = "Inteligencja: <font color='gold'>+"+intelligenceArrayShop[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;

            } else {
                licznikShop++;
            }
            if(skillArrayShop[i] != 0){
             numberShop = i+1;
             statsShop = "Zręczność: <font color='gold'>+"+skillArrayShop[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;

            } else {
                licznikShop++;
            }
            if(healthArrayShop[i] != 0){
             numberShop = i+1;
             statsShop = "Zdrowie: <font color='gold'>+"+healthArrayShop[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;
            } else {
                licznikShop++;
            }
            if(luckArrayShop[i] != 0){
             numberShop = i+1;
             statsShop = "Szczęście: <font color='gold'>+"+luckArrayShop[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;
            } else {
                licznikShop++;
            }
            if(pDefenceArrayShop[i] != 0){
             numberShop = i+1;
             statsShop = "Obrona F: <font color='gold'>+"+pDefenceArrayShop[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;
            } else {
                licznikShop++;
            }
            if(mDefenceArrayShop[i] != 0){
             numberShop = i+1;
             statsShop = "Obrona M: <font color='gold'>+"+mDefenceArrayShop[i]+"</font><br>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;
            } else {
                licznikShop++;
            }

            if(profesionShop[i] == "warrior"){
                numberShop = i+1;
                if(profesionPlayer == profesionShop[i]){
                    statsShop = "<hr><center>Wojownik</center>";
                }else {
                    statsShop = "<hr><center><font color='red'> Wojownik </font></center>"
                }
            } else if(profesionShop[i] == "mag"){
                numberShop = i+1;
                if(profesionPlayer == profesionShop[i]){
                    statsShop = "<hr><center> Mag </center>";
                }else {
                    statsShop = "<hr><center><font color='red'> Mag </font></center>"
                }
            } else if(profesionShop[i] == "hunter"){
                numberShop = i+1;
                if(profesionPlayer == profesionShop[i]){
                    statsShop = "<hr><center> Łowca </center>";
                }else {
                    statsShop = "<hr><center><font color='red'> Łowca </font></center>"
                }
            } else if(profesionShop[i] == "all"){
                numberShop = i+1;
                statsShop = "<hr>";
            }
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;
                licznikShop++;
            if(priceShop[i] != 0){
                numberShop = i+1;
                statsShop = "<center>Wartość: <font color='red'>"+priceShop[i]+"</font> <img src='../projekt_grafika/Inne/rubin.gif'></center> <br>";
                document.querySelector(".tooltipItem"+numberShop+"Shop>.itemPowerStat").innerHTML += statsShop;
            } else {
                licznikShop++;
            }
        licznikArrayShop[i] = licznikShop;
        licznikShop = 0;
        }
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
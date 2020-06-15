<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
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

    $getPlayerValue = "SELECT player.Level, Experience, Rubins, player.Rank, player.Monets FROM player WHERE player.Login='$user_check'";
    $getPlayerValueQuery = mysqli_query($connection, $getPlayerValue);
    if(mysqli_num_rows($getPlayerValueQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerValueQuery);
        $level = $row['Level'];
        $experience = $row['Experience'];
        $rubins = $row['Rubins'];
        $rank = $row['Rank'];
        $monets = $row['Monets'];
    }

    $getExperience = "SELECT experience.Level, RequiredExp FROM experience 
    INNER JOIN player ON player.Level=experience.Level WHERE player.Login='$user_check'";
    $getExperienceQuery = mysqli_query($connection, $getExperience);
    if(mysqli_num_rows($getExperienceQuery) > 0){
        $row = mysqli_fetch_assoc($getExperienceQuery);
        $requiredExp = $row['RequiredExp'];
    }

    $getExperience = "SELECT Power, Intelligence, Skill, Health, Luck FROM statistics 
    INNER JOIN player ON player.Id=statistics.Id WHERE player.Login='$user_check'";
    $getExperienceQuery = mysqli_query($connection, $getExperience);
    if(mysqli_num_rows($getExperienceQuery) > 0){
        $row = mysqli_fetch_assoc($getExperienceQuery);
        $power = $row['Power'];
        $intelligence = $row['Intelligence'];
        $skill = $row['Skill'];
        $health = $row['Health'];
        $luck = $row['Luck'];
    }

    $getPlayerProfesion = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
    WHERE player.Login='$user_check'"; 
    $getPlayerProfesionQuery = mysqli_query($connection, $getPlayerProfesion);
    if(mysqli_num_rows($getPlayerProfesionQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerProfesionQuery);
            $profesion = $row['Profesion'];
    }

    $exp;
    $rub;
    $lvUp = 0;
    $whichMission = $_POST['which'];
    if($whichMission == 1){
        $experience1 = $_POST['experience1'];
        $rubin1 = $_POST['rubin1'];
    } else if($whichMission == 2){
        $experience1 = $_POST['experience2'];
        $rubin1 = $_POST['rubin2'];
    } else if($whichMission == 3){
        $experience1 = $_POST['experience3'];
        $rubin1 = $_POST['rubin3'];
    }

    // Dodanie expa, rubinów i zwiększenie lv oraz statystyk

        $currentExp = $experience + $experience1;
        $exp = $experience1;
        $currentRubins = $rubins + $rubin1;
        $rub = $rubin1;
        $rank += 10;
        if ($currentExp >= $requiredExp) {
            $level += 1;
            $currentExp -= $requiredExp;
            $rank += 50;
            $monets += 1;
            $lvUp = 1;
            if($profesion == "warrior"){
                $health += 40;
                $power += 10;
                $intelligence += 1;
                $skill += 1;
                $luck += 2;
            }
            if($profesion == "mag"){
                $health += 20;
                $power += 1;
                $intelligence += 10;
                $skill += 1;
                $luck += 2;
            }
            if($profesion == "hunter"){
                $health += 30;
                $power += 1;
                $intelligence += 1;
                $skill += 10;
                $luck += 2;
            } 
        }

    $setPlayer = "UPDATE player SET player.Level='$level', player.Experience='$currentExp', Rubins='$currentRubins', Rank='$rank',
    Monets='$monets' WHERE player.Login='$user_check'";
    $setPlayerQuery = mysqli_query($connection, $setPlayer);

    $setStatistics = "UPDATE statistics INNER JOIN player ON player.Id=statistics.Id SET Power='$power',
    Health='$health', Skill='$skill', Intelligence='$intelligence', Luck='$luck' WHERE player.Login='$user_check'";
    $setStatisticsQuery = mysqli_query($connection, $setStatistics);

    
    // pobranie losowego przedmiotu według poziomu
    if($level < 18){
        $getItem = "SELECT * FROM items WHERE MinLevel<'18' AND IdItem>'1' AND (Profesion='$profesion' OR Profesion='all') ORDER BY RAND() LIMIT 1";
        $getItemQuery = mysqli_query($connection, $getItem);
        if(mysqli_num_rows($getItemQuery) > 0){
            $row = mysqli_fetch_assoc($getItemQuery);
            $itemSource = $row['Source'];
            $itemName = $row['Name'];
            $typeItem = $row['Type'];
            $itemId = $row['IdItem'];
        } else {
            echo "<script> console.log('Nie dropi itemka')</script>";
        }
    } else if($level < 36 && $level >= 18){
        $getItem = "SELECT * FROM items WHERE MinLevel<'36' AND MinLevel>='10' AND IdItem>'1' AND (Profesion='$profesion' OR Profesion='all') ORDER BY RAND() LIMIT 1";
        $getItemQuery = mysqli_query($connection, $getItem);
        if(mysqli_num_rows($getItemQuery) > 0){
            $row = mysqli_fetch_assoc($getItemQuery);
            $itemSource = $row['Source'];
            $itemName = $row['Name'];
            $typeItem = $row['Type'];
            $itemId = $row['IdItem'];
        } else {
            echo "<script> console.log('Nie dropi itemka')</script>";
        }
    }else if($level >= 36){
        $getItem = "SELECT * FROM items WHERE MinLevel<='62' AND MinLevel>='24' AND (Profesion='$profesion' OR Profesion='all') ORDER BY RAND() LIMIT 1";
        $getItemQuery = mysqli_query($connection, $getItem);
        if(mysqli_num_rows($getItemQuery) > 0){
            $row = mysqli_fetch_assoc($getItemQuery);
            $itemSource = $row['Source'];
            $itemName = $row['Name'];
            $typeItem = $row['Type'];
            $itemId = $row['IdItem'];
        } else {
            echo "<script> console.log('Nie dropi itemka')</script>";
        }
    }

    $getSlots = "SELECT * FROM backpack INNER JOIN player ON player.Id=backpack.IdBackpack WHERE player.Login='$user_check'";
    $getSlotsQuery = mysqli_query($connection, $getSlots);
        if(mysqli_num_rows($getSlotsQuery) > 0){
            $row = mysqli_fetch_assoc($getSlotsQuery);
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
            echo "<script> console.log('Nie działa bp (win file)')</script>";
        }

    for($i=9; $i>=1; $i--){
        if($row['Slot'.$i] == "../Przedmioty/Ramka_Gif.gif"){
            $numberSlot = $i;
        }
    }


    /// Ustawienie zdobotych przedmiotów w pleckau
    $rand = rand(1,100);

    if($level < 5 && $rand > 60){
        $setItem = "UPDATE backpack INNER JOIN player ON player.Id=backpack.Idbackpack 
        SET backpack.Slot$numberSlot='$itemSource' WHERE player.Login='$user_check'";
        $setItemQuery = mysqli_query($connection, $setItem);
    } else if ($level < 15 && $rand > 80){
        $setItem = "UPDATE backpack INNER JOIN player ON player.Id=backpack.Idbackpack 
        SET backpack.Slot$numberSlot='$itemSource' WHERE player.Login='$user_check'";
        $setItemQuery = mysqli_query($connection, $setItem);
    } else if ($level < 35 && $rand > 90){
        $setItem = "UPDATE backpack INNER JOIN player ON player.Id=backpack.Idbackpack 
        SET backpack.Slot$numberSlot='$itemSource' WHERE player.Login='$user_check'";
        $setItemQuery = mysqli_query($connection, $setItem);
    } else if ($level >= 35 && $rand > 95){
        $setItem = "UPDATE backpack INNER JOIN player ON player.Id=backpack.Idbackpack 
        SET backpack.Slot$numberSlot='$itemSource' WHERE player.Login='$user_check'";
        $setItemQuery = mysqli_query($connection, $setItem);
    }

    mysqli_close($connection);
?>

<script>

    document.getElementById("prize").style.display = "block";
    document.getElementById("prizeBg").style.display = "block";
    document.getElementById("prizeItem").style.display = "block";
    document.getElementById("enemy").style.opacity = "0.7";
    document.getElementById("newFight").style.display = "block";

    var levelPlayer = "<?php echo $level ?>";
    let rand = "<?php echo $rand ?>";
    let itemName = "<?php echo $itemName ?>";
    let typeItem = "<?php echo $typeItem ?>";
    let itemId = "<?php echo $itemId ?>";
    let numberSlot = "<?php echo $numberSlot ?>";
    let itemSource = "<?php echo $itemSource ?>";
    var exp = "<?php echo $exp ?>";
    var rub = "<?php echo $rub ?>";
    var lvUp = "<?php echo $lvUp ?>";


    document.getElementById("prize").innerHTML = "Rubiny: <font color='gold'>"+rub+"</font> <img src='../../projekt_grafika/Inne/rubin.gif'> <br>"+
    "Doświadczenie: <font color='gold'>"+exp+"</font><br>";
    
    if(lvUp == 1){
        document.getElementById("prize").innerHTML = "Monety: <font color='gold'>1</font> <img src='../../projekt_grafika/Inne/money.png' width='7%'> <br>" + 
        "Rubiny: <font color='gold'>"+rub+"</font> <img src='../../projekt_grafika/Inne/rubin.gif'> <br>"+"Doświadczenie: <font color='gold'>"+exp+"</font><br>";
    }  

    if(levelPlayer < 5 && rand > 60){
        document.getElementById("prizeItem").style.backgroundImage = "url(../"+itemSource+")";   
        $(document).ready(function(){
            $("#surrender").load("../../php/walka/dropItemMission.php", {typeItem2:typeItem, itemId2:itemId, numberSlot2:numberSlot});
        }); 
    } else if (levelPlayer < 15 && rand > 80){
        document.getElementById("prizeItem").style.backgroundImage = "url(../"+itemSource+")";   
        $(document).ready(function(){
            $("#surrender").load("../../php/walka/dropItemMission.php", {typeItem2:typeItem, itemId2:itemId, numberSlot2:numberSlot});
        });  
    } else if (levelPlayer < 35 && rand > 90){
        document.getElementById("prizeItem").style.backgroundImage = "url(../"+itemSource+")";   
        $(document).ready(function(){
            $("#surrender").load("../../php/walka/dropItemMission.php", {typeItem2:typeItem, itemId2:itemId, numberSlot2:numberSlot});
        }); 
    } else if (levelPlayer >= 35 && rand > 95){
        document.getElementById("prizeItem").style.backgroundImage = "url(../"+itemSource+")";    
        $(document).ready(function(){
            $("#surrender").load("../../php/walka/dropItemMission.php", {typeItem2:typeItem, itemId2:itemId, numberSlot2:numberSlot});
        }); 
    }

</script>
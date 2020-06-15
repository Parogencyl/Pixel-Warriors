<!-- Pobranie i wyświetlenie statystyk wybranego gracza -->

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

    $playerIndex = $_POST['loadIndex'];


    $getStats = "SELECT * FROM statistics INNER JOIN player ON player.Id=statistics.Id WHERE player.Id='$playerIndex'";
    $getStatsQuery = mysqli_query($connection, $getStats);
    if(mysqli_num_rows($getStatsQuery) > 0){
        $row = mysqli_fetch_assoc($getStatsQuery);
        $power = $row['Power'];
        $intelligence = $row['Intelligence'];
        $skill = $row['Skill'];
        $health = $row['Health'];
        $luck = $row['Luck'];
        $physicDefence = $row['PhysicDefence'];
        $magicDefence = $row['MagicDefence'];
    }

    $getStatsWeapon = "SELECT Attack FROM equipmentStatistics INNER JOIN player ON player.Id=equipmentStatistics.Player 
    WHERE player.Id='$playerIndex' AND Slot='6'";
    $getStatsWeaponQuery = mysqli_query($connection, $getStatsWeapon);
    if(mysqli_num_rows($getStatsWeaponQuery) > 0){
        $row = mysqli_fetch_assoc($getStatsWeaponQuery);
        $attack = $row['Attack'];
    }

    $getPlayer = "SELECT player.Level, player.Login FROM player WHERE player.Id='$playerIndex'";
    $getPlayerQuery = mysqli_query($connection, $getPlayer);
    if(mysqli_num_rows($getPlayerQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerQuery);
        $level = $row['Level'];
        $nick = $row['Login'];
    }

    mysqli_close($connection);
?>

<script>

    var level = "<?php echo $level ?>";
    var attack = "<?php echo $attack ?>";
    var power = "<?php echo $power ?>";
    var intelligence = "<?php echo $intelligence ?>";
    var skill = "<?php echo $skill ?>";
    var health = "<?php echo $health ?>";
    var luckPoints = "<?php echo $luck ?>";
    var pDefencePoints = "<?php echo $physicDefence ?>";
    var mDefencePoints = "<?php echo $magicDefence ?>";
    var nick = "<?php echo $nick ?>";

    var luck = (luckPoints / (level/0.8));
    var physicDefence = (pDefencePoints / (level*0.7));
    var magicDefence = (mDefencePoints / (level*0.7));

    document.querySelector("h3").innerHTML = nick;
    document.querySelector(".valueStat:nth-child(1)").innerHTML = power;
    document.querySelector(".valueStat:nth-child(2)").innerHTML = intelligence;
    document.querySelector(".valueStat:nth-child(3)").innerHTML = skill;
    document.querySelector(".valueStat:nth-child(4)").innerHTML = attack;
    document.querySelector(".valueStat:nth-child(5)").innerHTML = health;
    if(luck > 50){
        document.querySelector(".valueStat:nth-child(6)").innerHTML = "50%";
    }else {
        document.querySelector(".valueStat:nth-child(6)").innerHTML = luck.toFixed(2)+"%";
    }
    if(physicDefence > 50){
        document.querySelector(".valueStat:nth-child(7)").innerHTML = "50%";
    }else{
        document.querySelector(".valueStat:nth-child(7)").innerHTML = physicDefence.toFixed(2)+"%";
    }
    if(magicDefence > 50){
        document.querySelector(".valueStat:nth-child(8)").innerHTML = "50%";
    }else{
        document.querySelector(".valueStat:nth-child(8)").innerHTML = magicDefence.toFixed(2)+"%";        
    }

</script>
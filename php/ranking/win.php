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

    $widthHealth = $_POST['prize'];
    // Exp na odstawie poziomu
    if ($level < 4) {
        $Exp1 = rand(0.1*$requiredExp, 0.3*$requiredExp);
        $Exp1 = (int)$Exp1;
    } else if($level < 10 && $level >= 4) {
        $Exp1 = rand(0.08*$requiredExp, 0.15*$requiredExp);
        $Exp1 = (int)$Exp1;
    }else if($level < 30 && $level >= 10){
        $Exp1 = rand(0.05*$requiredExp, 0.08*$requiredExp);
        $Exp1 = (int)$Exp1;
    }else if($level < 60 && $level >= 30){
        $Exp1 = rand(0.03*$requiredExp, 0.06*$requiredExp);
        $Exp1 = (int)$Exp1;
    }else {
        $Exp1 = rand(0.02*$requiredExp, 0.04*$requiredExp);
        $Exp1 = (int)$Exp1;
    }
    // Rubiny na podstawie poziomu
    if ($level < 5) {
        $rubin1 = rand(0.13*$requiredExp, 0.22*$requiredExp);
        $rubin1 = (int)$rubin1;
    } else if ($level < 15 && $level >=5) {
        $rubin1 = rand(0.1*$requiredExp, 0.17*$requiredExp);
        $rubin1 = (int)$rubin1;
    } else if ($level < 30 && $level >=15) {
        $rubin1 = rand(0.08*$requiredExp, 0.12*$requiredExp);
        $rubin1 = (int)$rubin1;
    } else {
        $rubin1 = rand(0.06*$requiredExp, 0.1*$requiredExp);
        $rubin1 = (int)$rubin1;
    }

    // Ustawienie nagród za walkę
    if($widthHealth > 95){
        $experiencewin = 0;
        $rubinWin = $rubin1 * 0.1;
        $rankWin = 0;
    } else if($widthHealth <= 95 && $widthHealth > 80){
        $experiencewin = $Exp1 * 0.4;
        $rubinWin = $rubin1 * 0.3;
        $rankWin = (100-$widthHealth)*1.5;
    } else if($widthHealth <= 80 && $widthHealth > 50){
        $experiencewin = $Exp1 * 0.6;
        $rubinWin = $rubin1 * 0.5;
        $rankWin = (100-$widthHealth)*1.2;
    }else if($widthHealth <= 50 && $widthHealth > 20){
        $experiencewin = $Exp1 * 0.9;
        $rubinWin = $rubin1 * 0.8;
        $rankWin = (100-$widthHealth)*1.3;
    }else if($widthHealth <= 20 && $widthHealth > 5){
        $experiencewin = $Exp1 * 1.1;
        $rubinWin = $rubin1 * 1;
        $rankWin = (100-$widthHealth)*1.4;
    } else {
        $experiencewin = $Exp1 * 1.5;
        $rubinWin = $rubin1 * 1.4;
        $rankWin = (100-$widthHealth)*1.5;
    }

    $experiencewin = (int)$experiencewin;
    $rubinWin = (int)$rubinWin;
    $rankWin = (int)$rankWin;

    $currentExp = $experience + $experiencewin;
    $currentRubins = $rubins + $rubinWin;
    $rank += $rankWin;
    $lvUp = 0;
    // Ustawienie nagród za wbicie poziomu
    if ($currentExp >= $requiredExp) {
        $level += 1;
        $currentExp -= $requiredExp;
        $rank += 50;
        $monets += 1;
        $lvUp = 1;
        if ($profesion == "warrior") {
            $health += 40;
            $power += 10;
            $intelligence += 1;
            $skill += 1;
            $luck += 2;
        }
        if ($profesion == "mag") {
            $health += 20;
            $power += 1;
            $intelligence += 10;
            $skill += 1;
            $luck += 2;
        }
        if ($profesion == "hunter") {
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
    

    mysqli_close($connection);
?>

<script>
    var exp1 = "<?php echo $Exp1 ?>";
    var rubin1 = "<?php echo $rubin ?>";
    var exp = "<?php echo $experiencewin ?>";
    var rub = "<?php echo $rubinWin ?>";
    var rank = "<?php echo $rankWin ?>";
    var lvUp = "<?php echo $lvUp ?>";

    document.getElementById("prize").innerHTML = "Rubiny: <font color='gold'>"+rub+"</font> <img src='../projekt_grafika/Inne/rubin.gif'> <br>"+
    "Doświadczenie: <font color='gold'>"+exp+"</font><br>" + "Punkty rankingowe: <font color='gold'>"+rank+"</font><br>";
    
    if(lvUp == 1){
        document.getElementById("prize").innerHTML = "Monety: <font color='gold'>1</font> <img src='../projekt_grafika/Inne/money.png' width='7%'> <br>" + 
        "Rubiny: <font color='gold'>"+rub+"</font> <img src='../projekt_grafika/Inne/rubin.gif'> <br>"+"Doświadczenie: <font color='gold'>"+exp+
        "</font><br>" + "Punkty rankingowe: <font color='gold'>"+rank+"</font><br>";
    }  
</script>
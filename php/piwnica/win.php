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

    $numberMonster = $_POST['numberMonster'];
    $numberCellar = $_POST['numberCellar'];

    $getMonster = "SELECT Luck, Power FROM cellarMonsters WHERE NumberOfCellar='$numberCellar' AND NumberOfMonster='$numberMonster' ";
    $getMonsterQuery = mysqli_query($connection, $getMonster);
    if(mysqli_num_rows($getMonsterQuery) > 0){
        $row = mysqli_fetch_assoc($getMonsterQuery);
        $luckEnemy = $row['Luck'];
        $powerEnemy = $row['Power'];
    }

    $experiencewin = rand($luckEnemy*1.2, $luckEnemy*1.4);
    $rubinWin = rand($powerEnemy*1.2, $powerEnemy*1.4);

    $experiencewin = (int)$experiencewin;
    $rubinWin = (int)$rubinWin;

    $currentExp = $experience + $experiencewin;
    $currentRubins = $rubins + $rubinWin;
    $rank += 80;
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

    if ($lvUp == 1) {
        $setStatistics = "UPDATE statistics INNER JOIN player ON player.Id=statistics.Id SET Power='$power',
    Health='$health', Skill='$skill', Intelligence='$intelligence', Luck='$luck' WHERE player.Login='$user_check'";
        $setStatisticsQuery = mysqli_query($connection, $setStatistics);
    }

    if($numberMonster <= 10){
        $numberMonster++;
        $setMonster = "UPDATE cellarPlayer INNER JOIN player ON player.Id=cellarPlayer.Id SET LevelCellar$numberCellar='$numberMonster' 
        WHERE player.Login='$user_check'";
        $setMonsterQuery = mysqli_query($connection, $setMonster);
    }

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
    "Doświadczenie: <font color='gold'>"+exp+"</font><br>";
    
    if(lvUp == 1){
        document.getElementById("prize").innerHTML = "Monety: <font color='gold'>1</font> <img src='../projekt_grafika/Inne/money.png' width='7%'> <br>" + 
        "Rubiny: <font color='gold'>"+rub+"</font> <img src='../projekt_grafika/Inne/rubin.gif'> <br>"+"Doświadczenie: <font color='gold'>"+exp+
        "</font><br>";
    }  
</script>
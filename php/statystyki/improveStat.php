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

   $getPlayerProfesion = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
    WHERE player.Login='$user_check'"; 
    $getPlayerProfesionQuery = mysqli_query($connection, $getPlayerProfesion);
    if(mysqli_num_rows($getPlayerProfesionQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerProfesionQuery);
            $profesion = $row['Profesion'];
    }

   $getPlayer = "SELECT Rubins, Level FROM player WHERE player.Login='$user_check'";
    $getPlayerQuery = mysqli_query($connection, $getPlayer);
    if(mysqli_num_rows($getPlayerQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerQuery);
        $rubins = $row['Rubins'];
        $level = $row['Level'];
    }

    $getStats = "SELECT * FROM statistics INNER JOIN player ON player.Id=statistics.Id WHERE player.Login='$user_check'";
    $getStatsQuery = mysqli_query($connection, $getStats);
    if(mysqli_num_rows($getStatsQuery) > 0){
        $row = mysqli_fetch_assoc($getStatsQuery);
        $power2 = $row['Power'];
        $improvePower2 = $row['improvePower'];
        $intelligence2 = $row['Intelligence'];
        $improveIntelligence2 = $row['improveIntelligence'];
        $skill2 = $row['Skill'];
        $improveSkill2 = $row['improveSkill'];
        $health2 = $row['Health'];
        $improveHealth2 = $row['improveHealth'];
        $luck2 = $row['Luck'];
        $improveLuck2 = $row['improveLuck'];
        $physicDefence2 = $row['PhysicDefence'];
        $magicDefence2 = $row['MagicDefence'];
    }

    $whichStat = $_POST['whichStat'];
    
    if($whichStat == 1){
        if ($rubins >= ($improvePower2*5)) {
            $rubins -= ($improvePower2*5);
            $improvePower2 += 1;
            $power2 += 1;
            $setPlayer = "UPDATE player SET Rubins='$rubins' WHERE player.Login='$user_check'";
            $setPlayerQuery = mysqli_query($connection, $setPlayer);
            $setStatistics = "UPDATE statistics INNER JOIN player ON player.Id=statistics.Id SET Power='$power2', improvePower='$improvePower2'
            WHERE player.Login='$user_check'";
            $setStatisticsQuery = mysqli_query($connection, $setStatistics);
        }

    } else if($whichStat == 2){
        if ($rubins >= ($improveIntelligence2*5)) {
            $rubins -= ($improveIntelligence2*5);
            $improveIntelligence2 += 1;
            $intelligence2 += 1;
            $setPlayer = "UPDATE player SET Rubins='$rubins' WHERE player.Login='$user_check'";
            $setPlayerQuery = mysqli_query($connection, $setPlayer);
            $setStatistics = "UPDATE statistics INNER JOIN player ON player.Id=statistics.Id SET Intelligence='$intelligence2', 
            improveIntelligence='$improveIntelligence2' WHERE player.Login='$user_check'";
            $setStatisticsQuery = mysqli_query($connection, $setStatistics);
        }

    } else if($whichStat == 3){
        if ($rubins >= ($improveSkill2*5)) {
            $rubins -= ($improveSkill2*5);
            $improveSkill2 += 1;
            $skill2 += 1;
            $setPlayer = "UPDATE player SET Rubins='$rubins' WHERE player.Login='$user_check'";
            $setPlayerQuery = mysqli_query($connection, $setPlayer);
            $setStatistics = "UPDATE statistics INNER JOIN player ON player.Id=statistics.Id SET Skill='$skill2', improveSkill='$improveSkill2'
            WHERE player.Login='$user_check'";
            $setStatisticsQuery = mysqli_query($connection, $setStatistics);
        }

    } else if($whichStat == 4){
        if ($rubins >= ($improveHealth2*5)) {
            $rubins -= ($improveHealth2*5);
            $improveHealth2 += 1;
            if ($profesion == "warrior") {
                $health2 += 15;
            } elseif ($profesion == "mag") {
                $health2 += 5;
            } elseif ($profesion == "hunter") {
                $health2 += 10;
            }
            $setPlayer = "UPDATE player SET Rubins='$rubins' WHERE player.Login='$user_check'";
            $setPlayerQuery = mysqli_query($connection, $setPlayer);
            $setStatistics = "UPDATE statistics INNER JOIN player ON player.Id=statistics.Id SET Health='$health2', improveHealth='$improveHealth2'
            WHERE player.Login='$user_check'";
            $setStatisticsQuery = mysqli_query($connection, $setStatistics);
        }
        
    } else if($whichStat == 5){
        if ($rubins >= ($improveLuck2*5)) {
            $rubins -= ($improveLuck2*5);
            $improveLuck2 += 1;
            $luck2 += 1;
            $setPlayer = "UPDATE player SET Rubins='$rubins' WHERE player.Login='$user_check'";
            $setPlayerQuery = mysqli_query($connection, $setPlayer);
            $setStatistics = "UPDATE statistics INNER JOIN player ON player.Id=statistics.Id SET Luck='$luck2', improveLuck='$improveLuck2'
            WHERE player.Login='$user_check'";
            $setStatisticsQuery = mysqli_query($connection, $setStatistics);
        }
    }


    mysqli_close($connection);
?>

<script>
    var luckPoints = "<?php echo $luck2; ?>";
    var level = "<?php echo $level; ?>";
    var luck = luckPoints / (level/0.8);
    document.getElementById("value1").innerHTML = "<?php echo $power2; ?>";
    document.getElementById("value2").innerHTML = "<?php echo $intelligence2; ?>";
    document.getElementById("value3").innerHTML = "<?php echo $skill2; ?>";
    document.getElementById("value7").innerHTML = "<?php echo $health2; ?>";
    document.getElementById("value4").innerHTML = luck.toFixed(2)+"%";
    document.getElementById("value5").innerHTML = "<?php echo $physicDefence2; ?>"+"%";
    document.getElementById("value6").innerHTML = "<?php echo $magicDefence2; ?>"+"%";

    var improvePower2 = "<?php echo $improvePower2; ?>";
    var improveIntelligence2 = "<?php echo $improveIntelligence2; ?>";
    var improveSkill2 = "<?php echo $improveSkill2; ?>";
    var improveHealth2 = "<?php echo $improveHealth2; ?>";
    var improveLuck2 = "<?php echo $improveLuck2; ?>";

    document.getElementById("rubin").innerHTML = "<img src='../projekt_grafika/Inne/rubin.gif'> "+"<?php echo $rubins; ?>";
    document.getElementById("powerPlus").innerHTML = (improvePower2*5)+"RB"; 
    document.getElementById("intelligencePlus").innerHTML = (improveIntelligence2*5)+"RB"; 
    document.getElementById("skillPlus").innerHTML = (improveSkill2*5)+"RB"; 
    document.getElementById("healthPlus").innerHTML = (improveHealth2*5)+"RB"; 
    document.getElementById("luckPlus").innerHTML = (improveLuck2*5)+"RB"; 
</script>
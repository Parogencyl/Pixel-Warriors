
<!-- USTAWIANIE WSZYSTKIEGO DO KOLEJNYCH MISJI: USTAWIENIE NAGRÓD I KOSZTÓW MISJI, ODEJMOWANIE STAMINY I ZMIANA CZASU (GDY CZAS BYŁ NA 0000...) -->
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

$maxValue = "SELECT MAX(IdMission) AS Max FROM `missions`";
$maxValueQuery = mysqli_query($connection, $maxValue);
if (mysqli_num_rows($maxValueQuery) > 0) {
    $row = mysqli_fetch_assoc($maxValueQuery);
    $max = $row['Max'];
}
$one = $two = $three = 0;
$one = rand(1,$max);
$two = rand(1,$max);
while($one == $two) {
    $two = rand(1,$max);
}
$three = rand(1,$max);
while($one == $three || $two == $three) {
    $three = rand(1,$max);
}

//Ustawienie numerów misji dla gracza
$setMission = "UPDATE playerMission INNER JOIN player ON player.Id=playerMission.IdPlayerMission 
SET Mission1='$one', Mission2='$two', Mission3='$three' WHERE player.Login='$user_check'";
$setMissionQuery = mysqli_query($connection, $setMission);


// Ustawienie czasu na obecny, gdy stamina jest pełna (bo czas jest 0000-00-00 00:00:00);
$firstMission = "SELECT stamina.FirstMission FROM stamina INNER JOIN player ON player.Id=stamina.IdStamina WHERE player.Login='$user_check'";
$firstMissionQuery = mysqli_query($connection, $firstMission);
if (mysqli_num_rows($firstMissionQuery) > 0) {
    $row = mysqli_fetch_assoc($firstMissionQuery);
    $date = $row['FirstMission'];
}

$current = date("Y-m-d H:i:s");
if ($date == "0000-00-00 00:00:00" || $date == "1970-01-01 01:00:00") {
    $setNewDate = "UPDATE stamina INNER JOIN player ON player.Id=stamina.IdStamina SET stamina.FirstMission='$current' WHERE player.Login='$user_check'";
    $setNewDateQuery = mysqli_query($connection, $setNewDate);
}

/////////////////////////////
                             //Ustawienie kosztu i nagród kolejnych misji
/////////////////////////////

// Ustawienie nowych kosztów misji
$getLvExp = "SELECT player.Level, player.Experience FROM player WHERE player.Login='$user_check'";
$getLvExpQuery = mysqli_query($connection, $getLvExp);
if(mysqli_num_rows($getLvExpQuery) > 0){
    $row = mysqli_fetch_assoc($getLvExpQuery);
    $currentLevel = $row['Level'];
}

$staminaCost = array();
for($i = 0; $i < 3; $i++){
    if($currentLevel <5){
        $staminaCost[$i] = rand(2,5);
    }else if($currentLevel <15 && $currentLevel >= 5){
        $staminaCost[$i] = rand(3,7);
    } else if($currentLevel <40 && $currentLevel >= 15){
        $staminaCost[$i] = rand(4,9);
    }else {
        $staminaCost[$i] = rand(6,10);
    }
}
$setNewCost = "UPDATE playerMission INNER JOIN player ON player.Id=playerMission.IdPlayerMission SET Stamina1='$staminaCost[0]', 
Stamina2='$staminaCost[1]', Stamina3='$staminaCost[2]' WHERE player.Login='$user_check'";
$setNewCostQuery = mysqli_query($connection, $setNewCost);



    //////////////////// Ustawienie expa za misje
$getRequiredExp = "SELECT experience.RequiredExp FROM experience WHERE experience.Level='$currentLevel'";
$getRequiredExpQuery = mysqli_query($connection, $getRequiredExp);
if(mysqli_num_rows($getRequiredExpQuery) > 0){
    $row = mysqli_fetch_assoc($getRequiredExpQuery);
    $requiredExp = $row['RequiredExp'];
}

if ($currentLevel < 4) {
    $Exp1 = rand(0.15*$requiredExp, 0.3*$requiredExp);
    $Exp1 = (int)$Exp1;
    $Exp2 = rand(0.15*$requiredExp, 0.3*$requiredExp);
    $Exp2 = (int)$Exp2;
    $Exp3 = rand(0.15*$requiredExp, 0.3*$requiredExp);
    $Exp3 = (int)$Exp3;
} else if($currentLevel < 10 && $currentLevel >= 4) {
    $Exp1 = rand(0.085*$requiredExp, 0.15*$requiredExp);
    $Exp1 = (int)$Exp1;
    $Exp2 = rand(0.085*$requiredExp, 0.15*$requiredExp);
    $Exp2 = (int)$Exp2;
    $Exp3 = rand(0.085*$requiredExp, 0.15*$requiredExp);
    $Exp3 = (int)$Exp3;
}else if($currentLevel < 30 && $currentLevel >= 10){
    $Exp1 = rand(0.045*$requiredExp, 0.075*$requiredExp);
    $Exp1 = (int)$Exp1;
    $Exp2 = rand(0.045*$requiredExp, 0.075*$requiredExp);
    $Exp2 = (int)$Exp2;
    $Exp3 = rand(0.045*$requiredExp, 0.075*$requiredExp);
    $Exp3 = (int)$Exp3;
}else if($currentLevel < 60 && $currentLevel >= 30){
    $Exp1 = rand(0.025*$requiredExp, 0.045*$requiredExp);
    $Exp1 = (int)$Exp1;
    $Exp2 = rand(0.025*$requiredExp, 0.045*$requiredExp);
    $Exp2 = (int)$Exp2;
    $Exp3 = rand(0.025*$requiredExp, 0.045*$requiredExp);
    $Exp3 = (int)$Exp3;
}else if($currentLevel < 100 && $currentLevel >= 60){
    $Exp1 = rand(0.015*$requiredExp, 0.025*$requiredExp);
    $Exp1 = (int)$Exp1;
    $Exp2 = rand(0.015*$requiredExp, 0.025*$requiredExp);
    $Exp2 = (int)$Exp2;
    $Exp3 = rand(0.015*$requiredExp, 0.025*$requiredExp);
    $Exp3 = (int)$Exp3;
}else {
    $Exp1 = rand(0.008*$requiredExp, 0.015*$requiredExp);
    $Exp1 = (int)$Exp1;
    $Exp2 = rand(0.008*$requiredExp, 0.015*$requiredExp);
    $Exp2 = (int)$Exp2;
    $Exp3 = rand(0.008*$requiredExp, 0.015*$requiredExp);
    $Exp3 = (int)$Exp3;
}

$setNewExp = "UPDATE playerMission INNER JOIN player ON player.Id=playerMission.IdPlayerMission SET Experience1='$Exp1', 
Experience2='$Exp2', Experience3='$Exp3' WHERE player.Login='$user_check'";
$setNewExpQuery = mysqli_query($connection, $setNewExp);


    /////////////// Ustawienie rubinów za misje
    if ($currentLevel < 5) {
        $rubin1 = rand(0.13*$requiredExp, 0.22*$requiredExp);
        $rubin1 = (int)$rubin1;
        $rubin2 = rand(0.13*$requiredExp, 0.22*$requiredExp);
        $rubin2 = (int)$rubin2;
        $rubin3 = rand(0.13*$requiredExp, 0.22*$requiredExp);
        $rubin3 = (int)$rubin3;
    } else if ($currentLevel < 15 && $currentLevel >=5) {
        $rubin1 = rand(0.1*$requiredExp, 0.17*$requiredExp);
        $rubin1 = (int)$rubin1;
        $rubin2 = rand(0.1*$requiredExp, 0.17*$requiredExp);
        $rubin2 = (int)$rubin2;
        $rubin3 = rand(0.1*$requiredExp, 0.17*$requiredExp);
        $rubin3 = (int)$rubin3;
    } else if ($currentLevel < 30 && $currentLevel >=15) {
        $rubin1 = rand(0.07*$requiredExp, 0.11*$requiredExp);
        $rubin1 = (int)$rubin1;
        $rubin2 = rand(0.07*$requiredExp, 0.11*$requiredExp);
        $rubin2 = (int)$rubin2;
        $rubin3 = rand(0.07*$requiredExp, 0.11*$requiredExp);
        $rubin3 = (int)$rubin3;
    } else if ($currentLevel < 65 && $currentLevel >=30) {
        $rubin1 = rand(0.05*$requiredExp, 0.08*$requiredExp);
        $rubin1 = (int)$rubin1;
        $rubin2 = rand(0.05*$requiredExp, 0.08*$requiredExp);
        $rubin2 = (int)$rubin2;
        $rubin3 = rand(0.05*$requiredExp, 0.08*$requiredExp);
        $rubin3 = (int)$rubin3;
    }else {
        $rubin1 = rand(0.03*$requiredExp, 0.05*$requiredExp);
        $rubin1 = (int)$rubin1;
        $rubin2 = rand(0.03*$requiredExp, 0.05*$requiredExp);
        $rubin2 = (int)$rubin2;
        $rubin3 = rand(0.03*$requiredExp, 0.05*$requiredExp);
        $rubin3 = (int)$rubin3;
    }
$setNewRubins = "UPDATE playerMission INNER JOIN player ON player.Id=playerMission.IdPlayerMission SET Rubin1='$rubin1', 
Rubin2='$rubin2', Rubin3='$rubin3' WHERE player.Login='$user_check'";
$setNewRubinsQuery = mysqli_query($connection, $setNewRubins);

    mysqli_close($connection);
?>

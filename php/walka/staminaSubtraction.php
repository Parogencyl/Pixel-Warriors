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

           //////////// Zmniejszenie staminy o koszt misji i ustawienie nowej
// Pobranie kosztów misji
$whichCost = $_POST['whichMission'];
$getWhichCost = "SELECT Stamina1, Stamina2, Stamina3 FROM playerMission INNER JOIN player ON player.Id=playerMission.IdPlayerMission WHERE player.Login='$user_check'";
$getWhichCostQuery = mysqli_query($connection, $getWhichCost);
if(mysqli_num_rows($getWhichCostQuery) > 0){
    $row = mysqli_fetch_assoc($getWhichCostQuery);
    $cost1 = $row['Stamina1'];
    $cost2 = $row['Stamina2'];
    $cost3 = $row['Stamina3'];
}
if($whichCost == 1){
    $cost = $cost1;
}else if($whichCost == 2){
    $cost = $cost2;
}else if($whichCost == 3){
    $cost = $cost3;
}

// Pobranie staminy
$getStaminaValue = "SELECT stamina.Value FROM stamina INNER JOIN player ON player.Id=stamina.IdStamina WHERE player.Login='$user_check'";
$getStaminaValueQuery = mysqli_query($connection, $getStaminaValue);
if(mysqli_num_rows($getStaminaValueQuery) > 0){
    $row = mysqli_fetch_assoc($getStaminaValueQuery);
    $staminaValue = $row['Value'];
}

// Ustawienie nowej staminy
$subraction = $staminaValue - $cost;
if($staminaValue < $cost){
    header("location: ../tawerna.php");
    $subraction = 0;
}
$setSubtraction = "UPDATE stamina INNER JOIN player ON player.Id=stamina.IdStamina SET stamina.Value='$subraction' WHERE player.Login='$user_check'";
$setSubtractionQuery = mysqli_query($connection, $setSubtraction);

mysqli_close($connection);
?>
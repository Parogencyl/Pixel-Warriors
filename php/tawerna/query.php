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

  // czas na 0000-00-00
$i = $_POST['timeZero'];
if($i == 0){
    $dateZero = "UPDATE stamina INNER JOIN player ON player.Id=stamina.IdStamina SET stamina.FirstMission='0000-00-00 00:00:00' WHERE player.Login='$user_check'";
    $dateZeroQuery = mysqli_query($connection, $dateZero);
}

 // ustawienie czasu misji ostatniej misji 

$timeMission = $_POST['add'];
$time = date('Y-m-d H:i:s', $timeMission);
$i = $_POST['number'];

if ($i == 1) {
    $lastDate = "UPDATE stamina INNER JOIN player ON player.Id=stamina.IdStamina SET stamina.FirstMission='$time' WHERE player.Login='$user_check'";
    $lastDateQuery = mysqli_query($connection, $lastDate);
}

// ustawienie staminy od ostaniej misji
$stam = $_POST['stam'];
$i = $_POST['number2'];

if ($i == 2) {
    $setStamina = "UPDATE stamina INNER JOIN player ON player.Id=stamina.IdStamina SET stamina.Value='$stam' WHERE player.Login='$user_check'";
    $staminaQuery = mysqli_query($connection, $setStamina);

}

mysqli_close($connection);
?>
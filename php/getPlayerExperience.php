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

   // Pobranie potrzebnego expa na level
    $getRequiredExp = "SELECT RequiredExp FROM experience INNER JOIN player ON player.Level=experience.Level WHERE player.Login='$user_check'";
    $getRequiredExpQuery = mysqli_query($connection, $getRequiredExp);
    if(mysqli_num_rows($getRequiredExpQuery) > 0){
        $row = mysqli_fetch_assoc($getRequiredExpQuery);
        $requiredExp = $row['RequiredExp'];
    }

    // Pobranie potrzebnego expa gracza
    $getPlayerExp = "SELECT Experience, player.Level FROM player WHERE player.Login='$user_check'";
    $getPlayerExpQuery = mysqli_query($connection, $getPlayerExp);
    if(mysqli_num_rows($getPlayerExpQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerExpQuery);
        $playerExp = $row['Experience'];
        $level = $row['Level'];
    }

    $widthExp = $playerExp/$requiredExp*100;

    $levelSet = 0;
    $levelSet = $setLevel;

    mysqli_close($connection);
?>

<script>

    var levelSet = "<?php echo $levelSet ?>";

    document.getElementById("exp").innerHTML = "<?php echo $playerExp.'/'.$requiredExp ?>";
    document.getElementById("levelOfExperience").style.width = "<?php echo $widthExp ?>"+"%";
    if(levelSet == 1){
        document.getElementById("level").innerHTML = "Poziom: " + "<?php echo $level ?>";
    }

</script>
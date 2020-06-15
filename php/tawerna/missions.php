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

// Pobranie numerów misji
$getMissions = "SELECT IdPlayerMission, playerMission.Mission1, playerMission.Mission2, playerMission.Mission3 FROM playerMission 
INNER JOIN player ON player.Id=playerMission.IdPlayerMission WHERE player.Login='$user_check'";
$getMissionsQuery = mysqli_query($connection, $getMissions);
if (mysqli_num_rows($getMissionsQuery) > 0) {
    $row = mysqli_fetch_assoc($getMissionsQuery);
    $number1 = $row['Mission1'];
    $number2 = $row['Mission2'];
    $number3 = $row['Mission3'];
}

//Pobranie opisu misji (dla każdej osobno)
$getMission1 = "SELECT IdMission, Description FROM missions WHERE IdMission='$number1'";
$getMission1Query1 = mysqli_query($connection, $getMission1);
if (mysqli_num_rows($getMission1Query1) > 0) {
    $row = mysqli_fetch_assoc($getMission1Query1);
    $description1 = $row['Description'];
}

$getMission2 = "SELECT IdMission, Description FROM missions WHERE IdMission='$number2'";
$getMission1Query2 = mysqli_query($connection, $getMission2);
if (mysqli_num_rows($getMission1Query2) > 0) {
    $row = mysqli_fetch_assoc($getMission1Query2);
    $description2 = $row['Description'];
}

$getMission3 = "SELECT IdMission, Description FROM missions WHERE IdMission='$number3'";
$getMission1Quer3 = mysqli_query($connection, $getMission3);
if (mysqli_num_rows($getMission1Quer3) > 0) {
    $row = mysqli_fetch_assoc($getMission1Quer3);
    $description3 = $row['Description'];
}

$getMissionoptions = "SELECT Experience1, Experience2, Experience3, Rubin1, Rubin2, Rubin3, Stamina1, Stamina2, Stamina3 FROM playerMission
INNER JOIN player ON player.Id=playerMission.IdPlayerMission WHERE player.Login='$user_check'";
$getMissionOptionsQuery = mysqli_query($connection, $getMissionoptions);
if(mysqli_num_rows($getMissionOptionsQuery) > 0){
    $row = mysqli_fetch_assoc($getMissionOptionsQuery);
    $Experience1 = $row['Experience1'];
    $Experience2 = $row['Experience2'];
    $Experience3 = $row['Experience3'];
    $Rubin1 = $row['Rubin1'];
    $Rubin2 = $row['Rubin2'];
    $Rubin3 = $row['Rubin3'];
    $Stamina1 = $row['Stamina1'];
    $Stamina2 = $row['Stamina2'];
    $Stamina3 = $row['Stamina3'];
}

mysqli_close($connection);
?>

<script>
    document.getElementById("textMission1").innerHTML = "<?php echo $description1 ?>";
    document.getElementById("textMission2").innerHTML = "<?php echo $description2 ?>";
    document.getElementById("textMission3").innerHTML = "<?php echo $description3 ?>";

    document.getElementById("takeMission1").innerHTML = "Nagroda: "+"<?php echo $Experience1 ?>"+" exp, "+"<?php echo $Rubin1 ?>"+" RB"+
    "<br>Koszt: "+"<?php echo $Stamina1 ?>";
    document.getElementById("takeMission2").innerHTML = "Nagroda: "+"<?php echo $Experience2 ?>"+" exp, "+"<?php echo $Rubin2 ?>"+" RB"+
    "<br>Koszt: "+"<?php echo $Stamina2 ?>";
    document.getElementById("takeMission3").innerHTML = "Nagroda: "+"<?php echo $Experience3 ?>"+" exp, "+"<?php echo $Rubin3 ?>"+" RB"+
    "<br>Koszt: "+"<?php echo $Stamina3 ?>";

</script>

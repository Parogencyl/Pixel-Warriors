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

    $getSound = "SELECT player.Sound, player.Email FROM player WHERE player.Login='$user_check'";
    $getSoundQuery = mysqli_query($connection, $getSound);
    if(mysqli_num_rows($getSoundQuery) > 0){
        $row = mysqli_fetch_assoc($getSoundQuery);
        $sound = $row['Sound'];
        $email = $row['Email'];
    }

    $value = $_POST['onOff'];
    if($value == 1){
        $setSound = "UPDATE player SET player.Sound='false' WHERE player.Login='$user_check'";
        $setSoundQuery = mysqli_query($connection, $setSound);  
    }else if($value == 2){
        $setSound = "UPDATE player SET player.Sound='true' WHERE player.Login='$user_check'";
        $setSoundQuery = mysqli_query($connection, $setSound);  
    }
?>

<script>

    let sound = "<?php echo $sound ?>";
    if( sound == "true"){
        document.getElementById("soundImg").style.backgroundImage = "url(../projekt_grafika/Inne/music_on.gif)";
    } else if( sound == "false"){
        document.getElementById("soundImg").style.backgroundImage = "url(../projekt_grafika/Inne/music_off.gif)";
    }

    let email = "<?php echo $email ?>";
    document.getElementById("email").innerHTML = email;

</script>
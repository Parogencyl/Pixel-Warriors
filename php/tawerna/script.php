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

   $getStamina = "SELECT stamina.Value FROM stamina INNER JOIN player ON player.Id=stamina.IdStamina WHERE player.Login='$user_check'";
   $getStaminaQuery = mysqli_query($connection, $getStamina);
   if(mysqli_num_rows($getStaminaQuery) > 0){
       $row = mysqli_fetch_assoc($getStaminaQuery);
       $staminaValue = $row['Value'];
   }

   $getMissionCost = "SELECT Stamina1, Stamina2, Stamina3 FROM playerMission INNER JOIN player ON player.Id=playerMission.IdPlayerMission
    WHERE player.Login='$user_check'";
   $getMissionCostQuery = mysqli_query($connection, $getMissionCost);
   if(mysqli_num_rows($getMissionCostQuery) > 0){
       $row = mysqli_fetch_assoc($getMissionCostQuery);
       $stamina1 = $row['Stamina1'];
       $stamina2 = $row['Stamina2'];
       $stamina3 = $row['Stamina3'];
   }

   $difference1 = $staminaValue - $stamina1;
   $difference2 = $staminaValue - $stamina2;
   $difference3 = $staminaValue - $stamina3;

   mysqli_close($connection);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script>
// 
document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Normalna_Gif.gif')";
document.getElementById("timeStamina").style.display = "none";

// Pokazanie misji
function missionOpen(check) {
    document.getElementById("mission1").style.display = "block";
    document.getElementById("mission2").style.display = "block";
    document.getElementById("mission3").style.display = "block";
    document.getElementById("openMission1").style.display = "block";
    document.getElementById("openMission2").style.display = "block";
    document.getElementById("openMission3").style.display = "block";
    document.getElementById("arrow1").style.display = "block";
    document.getElementById("arrow2").style.display = "block";
    document.getElementById("arrow3").style.display = "block";
    document.getElementById("buttonOpen").style.zIndex = "0";
    document.getElementById("buttonClose").style.zIndex = "1";
    document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Usta_Rozmowa_Gif.gif')";
}

// Zamknięcie misji
function missionClose(check) {
    document.getElementById("mission1").style.display = "none";
    document.getElementById("mission2").style.display = "none";
    document.getElementById("mission3").style.display = "none";
    document.getElementById("openMission1").style.display = "none";
    document.getElementById("openMission2").style.display = "none";
    document.getElementById("openMission3").style.display = "none";
    document.getElementById("arrow1").style.display = "none";
    document.getElementById("arrow2").style.display = "none";
    document.getElementById("arrow3").style.display = "none";
    document.getElementById("buttonOpen").style.zIndex = "1";
    document.getElementById("buttonClose").style.zIndex = "0";
    document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Normalna_Gif.gif')";
}

function pictureOpen() {
    document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Usta_Rozmowa_Gif.gif')";
    document.getElementById("buttonOpen").style.zIndex = "1";

}

function pictureClose() {
    let number = document.getElementById("buttonOpen").style.zIndex;
    if (number == 1) {
        document.getElementById("center").style.backgroundImage = "url('graphics/Tawerna_Normalna_Gif.gif')";
    }
}

function newMission1(){
    let difference1 = "<?php echo $difference1 ?>";
    if (difference1 >= 0) {
        $(document).ready(function(){
            $("#nothing").load("../php/walka/staminaSubtraction.php",{whichMission:1});
        });
        window.open("walka/mission1.php", "_self");
    } else {
        document.getElementById("staminaBg").style.boxShadow = "0px 0px 9px 8px red";
    }
}
function newMission2(){
    let difference2 = "<?php echo $difference2 ?>";
    if (difference2 >= 0) {
        $(document).ready(function(){
            $("#nothing").load("../php/walka/staminaSubtraction.php",{whichMission:2});
        });
        window.open("walka/mission2.php", "_self");
    }else {
        document.getElementById("staminaBg").style.boxShadow = "0px 0px 9px 8px red";
    }
}
function newMission3(){
    let difference3 = "<?php echo $difference3 ?>";
    if (difference3 >= 0) {
        $(document).ready(function(){
            $("#nothing").load("../php/walka/staminaSubtraction.php",{whichMission:3});
        });
        window.open("walka/mission3.php", "_self");
    }else {
        document.getElementById("staminaBg").style.boxShadow = "0px 0px 9px 8px red";
    }
}


document.getElementById("buttonOpen").addEventListener("click", function() { missionOpen() });
document.getElementById("buttonClose").addEventListener("click", function() { missionClose() });
document.getElementById("buttonOpen").addEventListener("mouseover", function() { pictureOpen() });
document.getElementById("buttonOpen").addEventListener("mouseout", function() { pictureClose() });

document.getElementById("openMission1").addEventListener("click", function() { newMission1() });
document.getElementById("openMission2").addEventListener("click", function() { newMission2() });
document.getElementById("openMission3").addEventListener("click", function() { newMission3() });

</script>
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

   $getPlayer = "SELECT player.Level FROM player WHERE player.Login='$user_check'";
    $getPlayerQuery = mysqli_query($connection, $getPlayer);
    if(mysqli_num_rows($getPlayerQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerQuery);
        $level = $row['Level'];
    }

   $getStats = "SELECT * FROM statistics INNER JOIN player ON player.Id=statistics.Id WHERE player.Login='$user_check'";
   $getStatsQuery = mysqli_query($connection, $getStats);
   if(mysqli_num_rows($getStatsQuery) > 0){
       $row = mysqli_fetch_assoc($getStatsQuery);
       $power = $row['Power'];
       $improvePower = $row['improvePower'];
       $intelligence = $row['Intelligence'];
       $improveIntelligence = $row['improveIntelligence'];
       $skill = $row['Skill'];
       $improveSkill = $row['improveSkill'];
       $health = $row['Health'];
       $improveHealth = $row['improveHealth'];
       $luck = $row['Luck'];
       $improveLuck = $row['improveLuck'];
       $physicDefence = $row['PhysicDefence'];
       $magicDefence = $row['MagicDefence'];
   }

   mysqli_close($connection);

?>

<script>
    var luckPoints = "<?php echo $luck; ?>";
    var pDefencePoints = "<?php echo $physicDefence; ?>";
    var mDefencePoints = "<?php echo $magicDefence; ?>";

    var level = "<?php echo $level; ?>";
    var luck = (luckPoints / (level/0.8));
    var physicDefence = (pDefencePoints / (level*0.7));
    var magicDefence = (mDefencePoints / (level*0.7));

    document.getElementById("value1").innerHTML = "<?php echo $power; ?>";
    document.getElementById("value2").innerHTML = "<?php echo $intelligence; ?>";
    document.getElementById("value3").innerHTML = "<?php echo $skill; ?>";
    document.getElementById("value7").innerHTML = "<?php echo $health; ?>";
    if(luck > 50){
        document.getElementById("value4").innerHTML = "50%";
    }else {
        document.getElementById("value4").innerHTML = luck.toFixed(2)+"%";
    }
    if(physicDefence > 50){
        document.getElementById("value5").innerHTML = "50%";
    }else{
        document.getElementById("value5").innerHTML = physicDefence.toFixed(2)+"%";
    }
    if(magicDefence > 50){
        document.getElementById("value6").innerHTML = "50%";
    }else{
        document.getElementById("value6").innerHTML = magicDefence.toFixed(2)+"%";        
    }

    var improvePower = "<?php echo $improvePower; ?>";
    var improveIntelligence = "<?php echo $improveIntelligence; ?>";
    var improveSkill = "<?php echo $improveSkill; ?>";
    var improveHealth = "<?php echo $improveHealth; ?>";
    var improveLuck = "<?php echo $improveLuck; ?>";

    document.getElementById("rubin").innerHTML = "<img src='../projekt_grafika/Inne/rubin.gif'> "+"<?php echo $rubins; ?>";
    document.getElementById("powerPlus").innerHTML = (improvePower*5)+"RB"; 
    document.getElementById("intelligencePlus").innerHTML = (improveIntelligence*5)+"RB"; 
    document.getElementById("skillPlus").innerHTML = (improveSkill*5)+"RB"; 
    document.getElementById("healthPlus").innerHTML = (improveHealth*5)+"RB"; 
    document.getElementById("luckPlus").innerHTML = (improveLuck*5)+"RB";  

    document.getElementById("powerPlusButton").addEventListener("click", function(){ open(1); });
    document.getElementById("intelligencePlusButton").addEventListener("click", function(){ open(2); }); 
    document.getElementById("skillPlusButton").addEventListener("click", function(){ open(3); }); 
    document.getElementById("healthPlusButton").addEventListener("click", function(){ open(4); }); 
    document.getElementById("luckPlusButton").addEventListener("click", function(){ open(5); }); 

    function open(i){
        $(document).ready(function(){
            $("#powerPlus").load("../php/statystyki/improveStat.php", {whichStat:i});
        });
    }

</script>
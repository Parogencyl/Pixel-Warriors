<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

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

    $selectStamina = "SELECT stamina.Value, stamina.FirstMission FROM player INNER JOIN stamina ON player.Id=stamina.IdStamina WHERE player.Login='$user_check'";
    $staminaQuery = mysqli_query($connection, $selectStamina);
    if (mysqli_num_rows($staminaQuery) > 0) {
        $row = mysqli_fetch_assoc($staminaQuery);
        $stamina = $row['Value'];
        $time = $row['FirstMission'];
    }
    
    $firstMission = "0000-00-00 00:00:00";
    $firstMissionSeconds = 0;
    $current = date("Y-m-d H:i:s");
    $currentDate = strtotime($current);
    
    if ($time != "0000-00-00 00:00:00" && $time != "1970-01-01 01:00:00") {
        $firstMission = strtotime($time);
        // Konsola w PHP -   echo "<script> console.log('time: ".$time."')</script>"; 

        $different = $currentDate-$firstMission;
        $rest = $different%300;
        $whole = (int)($different/300); // ile staminy dodało od ostatniej misji

        $firstMission += ($whole*300); // 300, bo każde 5 min (60*5) to jeden punkt staminy
        $stamina += $whole;

        $firstMissionSeconds = $firstMission;
        $firstMission = date('Y-m-d H:i:s', $firstMissionSeconds);
    }

    mysqli_close($connection);
?>

<script>
    let stamina = <?php echo $stamina ?>;
     // ustawienie staminy od ostaniej misji

    if(stamina>100){
        stamina=100;
    }
    document.getElementById("staminaValue").style.width = (stamina/2)+"%";   
    document.getElementById("stamina").innerHTML = "Stamina: "+stamina;
    if(stamina==100){
        let timeMission = "<?php echo $firstMission ?>";
        // czas na 0000-00-00 gdy stamina jest pełna
        var i = 0;
        if(timeMission!="0000-00-00 00:00:00"){
            $(document).ready(function(){
                $("#stamina").load("../php/tawerna/query.php", {timeZero:i});
            });  
            var j=2;
                    $(document).ready(function(){
                        $("#stamina").load("../php/tawerna/query.php", {stam:stamina, number2:j});
                    }); 
        }
        document.getElementById("staminaValue").style.width = (stamina/2)+"%";   
        document.getElementById("stamina").innerHTML = "Stamina: "+stamina;
        document.getElementById("timeStamina").style.display = "none";

    }else if(stamina<100 && stamina>=0){
        //Aktualizacja staminy w bazie
        var j=2;
        $(document).ready(function(){
            $("#staminaValue").load("../php/tawerna/query.php", {stam:stamina, number2:j});
        });

        let timeMission = "<?php echo $firstMission ?>";
        let timeMissionSeconds = "<?php echo $firstMissionSeconds ?>";
        if(timeMission != "0000-00-00 00:00:00"){
            let counter = 300-"<?php echo $rest ?>";
    
            let sec = counter%60;
            let min = parseInt(counter/60);
        
            // zegar
            function time(){
                let zero = "";
                if(sec<10){
                    zero ="0";
                }
                document.getElementById("timeStamina").style.display = "block";
                document.getElementById("timeStamina").innerHTML = "0"+min+":"+zero+sec;
                if(sec > 0){
                    sec--;
                }if(min == 0 && sec == 0){
                    sec = 59;
                    min = 4;
                    /*
                    timeMissionSeconds += 300;
                    stamina += 1;

                    // modyfikacja staminy od ostaniej misji
                    var j=2;
                    $(document).ready(function(){
                        $("#stamina").load("../php/tawerna/query.php", {stam:stamina, number2:j});
                    }); 

                    // modyfikacja czasu ostatniej misji 
                    var k=1;
                    $(document).ready(function(){
                        $("#timeStamina").load("../php/tawerna/query.php", {add:timeMissionSeconds, number:k});
                    });
                    */

                    document.location.reload(true);
                    
                }if(sec == 0){
                    min--; 
                    sec=59;
                }
                
                setTimeout("time();", 990);
            }
            
            time();

            // modyfikacja czasu ostatniej misji  
            var i=1;
            $(document).ready(function(){
                $("#timeStamina").load("../php/tawerna/query.php", {add:timeMissionSeconds, number:i});
            });
        } else if(timeMission == "0000-00-00 00:00:00"){
            var currentDate = "<?php echo $currentDate ?>";
            var i=1;
            $(document).ready(function(){
                $("#timeStamina").load("../php/tawerna/query.php", {add:currentDate, number:i});
            });
            sec = 59;
            min = 4;
            function time(){
                let zero = "";
                if(sec<10){
                    zero ="0";
                }
                document.getElementById("timeStamina").style.display = "block";
                document.getElementById("timeStamina").innerHTML = "0"+min+":"+zero+sec;
                if(sec > 0){
                    sec--;
                }if(min == 0 && sec == 0){
                    sec = 59;
                    min = 4;
                    document.location.reload(true);
                }if(sec == 0){
                    min--;
                    sec=59;
                }
                
                setTimeout("time();", 1000);
            }

            time();
            
        }
        
    }
    
</script>

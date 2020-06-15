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
      header("location: ../../index.php");
      die();
   }

   $getPlayer = "SELECT player.Level FROM player WHERE player.Login='$user_check'"; 
   $getPlayerQuery = mysqli_query($connection, $getPlayer);
   if(mysqli_num_rows($getPlayerQuery) > 0){
       $row = mysqli_fetch_assoc($getPlayerQuery);
       $level = $row['Level'];
   }

   $getPlayerStat = "SELECT * FROM statistics INNER JOIN player ON player.Id=statistics.Id WHERE player.Login='$user_check'"; 
   $getPlayerStatQuery = mysqli_query($connection, $getPlayerStat);
   if(mysqli_num_rows($getPlayerStatQuery) > 0){
       $row = mysqli_fetch_assoc($getPlayerStatQuery);
       $power = $row['Power'];
       $intelligence = $row['Intelligence'];
       $skill = $row['Skill'];
       $health = $row['Health'];
       $luck = $row['Luck'];
       $pDefence = $row['PhysicDefence'];
       $mDefence = $row['MagicDefence'];
       $monets = $row['Monets'];
       $rubins = $row['Rubins'];
       $name = $row['Login'];
   }
   $getPlayerAttack = "SELECT Attack FROM equipmentStatistics INNER JOIN player ON player.Id=equipmentStatistics.Player WHERE player.Login='$user_check' AND Slot='6'"; 
   $getPlayerAttackQuery = mysqli_query($connection, $getPlayerAttack);
   if(mysqli_num_rows($getPlayerAttackQuery) > 0){
       $row = mysqli_fetch_assoc($getPlayerAttackQuery);
       $attack = $row['Attack'];
   }

   $getPlayerProfesion = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
   WHERE player.Login='$user_check'"; 
   $getPlayerProfesionQuery = mysqli_query($connection, $getPlayerProfesion);
   if(mysqli_num_rows($getPlayerProfesionQuery) > 0){
       $row = mysqli_fetch_assoc($getPlayerProfesionQuery);
        $profesion = $row['Profesion'];
   }

   $whichPrize = $whichMission;

   $getMissionSettings = "SELECT * FROM playerMission INNER JOIN player ON player.Id=playerMission.IdPlayerMission 
   WHERE player.Login='$user_check'"; 
   $getMissionSettingsQuery = mysqli_query($connection, $getMissionSettings);
   if(mysqli_num_rows($getMissionSettingsQuery) > 0){
       $row = mysqli_fetch_assoc($getMissionSettingsQuery);
        $mission1 = $row['Mission1'];
        $mission2 = $row['Mission2'];
        $mission3 = $row['Mission3'];
   }

   if($whichMission == 1){
        $getMissionSettings2 = "SELECT * FROM missions WHERE IdMission='$mission1'"; 
        $getMissionSettingsQuery2 = mysqli_query($connection, $getMissionSettings2);
        if(mysqli_num_rows($getMissionSettingsQuery2) > 0){
            $row = mysqli_fetch_assoc($getMissionSettingsQuery2);
            $mapSource = $row['Map'];
            $enemySource = $row['Enemy'];
            $weaponSource = $row['Weapon'];
        }
    } else if($whichMission == 2){
        $getMissionSettings2 = "SELECT * FROM missions WHERE IdMission='$mission2'"; 
        $getMissionSettingsQuery2 = mysqli_query($connection, $getMissionSettings2);
        if(mysqli_num_rows($getMissionSettingsQuery2) > 0){
            $row = mysqli_fetch_assoc($getMissionSettingsQuery2);
            $mapSource = $row['Map'];
            $enemySource = $row['Enemy'];
            $weaponSource = $row['Weapon'];
        }
    } else if($whichMission == 3){
        $getMissionSettings2 = "SELECT * FROM missions WHERE IdMission='$mission3'"; 
        $getMissionSettingsQuery2 = mysqli_query($connection, $getMissionSettings2);
        if(mysqli_num_rows($getMissionSettingsQuery2) > 0){
            $row = mysqli_fetch_assoc($getMissionSettingsQuery2);
            $mapSource = $row['Map'];
            $enemySource = $row['Enemy'];
            $weaponSource = $row['Weapon'];
        }
    }

    $getMissionPrize = "SELECT Experience1, Experience2, Experience3, Rubin1, Rubin2, Rubin3 FROM playerMission
    INNER JOIN player ON player.Id=playerMission.IdPlayerMission WHERE player.Login='$user_check'";
    $getMissionPrizeQuery = mysqli_query($connection, $getMissionPrize);
    if(mysqli_num_rows($getMissionPrizeQuery) > 0){
        $row = mysqli_fetch_assoc($getMissionPrizeQuery);
        $experience1 = $row['Experience1'];
        $experience2 = $row['Experience2'];
        $experience3 = $row['Experience3'];
        $rubin1 = $row['Rubin1'];
        $rubin2 = $row['Rubin2'];
        $rubin3 = $row['Rubin3'];
    }

    mysqli_close($connection);
?>


<script>

    $(document).ready(function(){
        $("#nothing").load("../../php/tawerna/newMissions.php");
    });

    // Ustawienie danych gracza w stopce
    document.querySelector("#rubin").innerHTML = "<img src='../../projekt_grafika/Inne/rubin.gif'> " + "<?php echo $rubins ?>";
    document.querySelector("#monet").innerHTML = "<img src='../../projekt_grafika/Inne/money.png'> " + "<?php echo $monets ?>";
    document.querySelector("#nick").innerHTML = "<?php echo $name ?>";

    var mapSource = "<?php echo $mapSource ?>";
    var enemySource = "<?php echo $enemySource ?>";
    var weaponSource = "<?php echo $weaponSource ?>";

    document.getElementById("dmgKnight").style.display = "none";
    document.getElementById("dmgEnemy").style.display = "none";
    document.getElementById("atackKnight").style.display = "none";
    document.getElementById("atackEnemy").style.display = "none";
    document.getElementById("lose").style.display = "none";
    document.getElementById("newFight").style.display = "none";
    document.getElementById("prizeBg").style.display = "none";
    document.getElementById("prize").style.display = "none";
    document.getElementById("prizeItem").style.display = "none";
    document.getElementById("healthKnight").style.width = "100%";
    document.getElementById("healthEnemy").style.width = "100%";
    document.getElementById("stamina").style.width = "100%";
    document.getElementById("staminaBg").style.width = "100%";
    document.getElementById("enemy").style.backgroundImage = "url('"+enemySource+"')";
    document.getElementById("center").style.backgroundImage = "url('"+mapSource+"')";
    document.getElementById("knightBlock").style.display = "none";
    document.getElementById("atackEnemy").style.backgroundImage = "url('"+weaponSource+"')";

   let whichPrize = "<?php echo $whichPrize ?>";

   let level = "<?php echo $level ?>";
   let profesionCharacter = "<?php echo $profesion ?>";
   let attackDmg = "<?php echo $attack ?>";
   let power = "<?php echo $power ?>";
   let intelligence = "<?php echo $intelligence ?>";
   let skill = "<?php echo $skill ?>";
   let luck = "<?php echo $luck ?>";
   let pDefence = "<?php echo $pDefence ?>";
   pDefence = (parseInt(pDefence) / (level*0.7));
   if(pDefence > 50){
       pDefence = 50;
   }
   let mDefence = "<?php echo $mDefence ?>";
   mDefence = (parseInt(mDefence) / (level*0.7));
   if(mDefence > 50){
       mDefence = 50;
   }

if( level < 5){
    document.getElementsByTagName("button")[2].disabled = true;
} 
if (level < 15 ){
    document.getElementsByTagName("button")[3].disabled = true;
}

    let healthKnight = "<?php echo $health ?>";    
    document.getElementById("healthContent").innerHTML = healthKnight+"/"+healthKnight;
    let currentHealthKnight = healthKnight;

    if(level == 1){
        var healthEnemy = parseInt(healthKnight)+(Math.floor(Math.random() * 30) - 80);
    } else if(level < 6){
        var healthEnemy = parseInt(healthKnight)+(Math.floor(Math.random() * 50) - 100);
    } else if(level < 15){
        var healthEnemy = parseInt(healthKnight)+(Math.floor(Math.random() * 100) - 50);
    }else {
        var healthEnemy = parseInt(healthKnight)+(Math.floor(Math.random() * 100) + 1)-7*parseInt(level);
    }
    healthEnemy = parseInt(healthEnemy);
    document.getElementById("healthContentEnemy").innerHTML = healthEnemy+"/"+healthEnemy;
    let currentHealthEnemy = healthEnemy;

//Normalny atak
function normalAttack(i) {
    blockValue = 0;

    document.getElementById("dmgEnemy").style.color = "black";
    document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw red";

    document.getElementById("button1").disabled = true;  // zablokowanie przycisków
    document.getElementById("button2").disabled = true;
    document.getElementById("button3").disabled = true;
    document.getElementById("surrender").disabled = true;
    document.getElementById("autoFight").disabled = true;
    staminaPlusNormal();

    // Atak postaci
    document.getElementById("atackKnight").style.display = "block";
    var attack = document.getElementById("atackKnight");
    attack.classList.add("knightAnimeAttack");

    setTimeout((function() { removeAnim("atackKnight") }), 1200); // animacja ataku

///////////////////// Zadawane obrażenia   //////////////////////

        var luckAttack = Math.floor(Math.random() * 100) + 1;
        var luckPoints = "<?php echo $luck; ?>";
        var luck = luckPoints / (level/0.8);
        if(profesionCharacter == "warrior"){
            var one = parseInt(attackDmg)*5 + parseInt(power)/1.6 + parseInt(level)*2;
            var two = parseInt(attackDmg)*7 + parseInt(power)/1.2 + parseInt(level)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
        damage = parseInt(damage);

        } else if(profesionCharacter == "mag"){
            var one = parseInt(attackDmg)*5 + parseInt(intelligence)/1.6 + parseInt(level)*4;
            var two = parseInt(attackDmg)*7 + parseInt(intelligence)/1.2 + parseInt(level)*10;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damage = parseInt(damage);

        } else if(profesionCharacter == "hunter"){
            var one = parseInt(attackDmg)*5 + parseInt(skill)/1.6 + parseInt(level);
            var two = parseInt(attackDmg)*7 + parseInt(skill)/1.2 + parseInt(level)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damage = parseInt(damage);
        }
    setTimeout((function() {
        dmgShow(damage, "dmgEnemy"); // pokazanie obrażeń
        makeDmgEnemy("healthEnemy", damage); // zmniejszenie zdrowia
    }), 1200);

    // Kontra

    setTimeout((function() { enemyAttack() }), 1400);

    setTimeout((function() {
        if (currentHealthEnemy > 0) {
            document.getElementById("autoFight").disabled = false;  // odblokowanie przycisków
            document.getElementById("button1").disabled = false;
            if( level >= 5){
            document.getElementById("button2").disabled = false;
            } 
            var width = document.getElementById("stamina").style.width;
            width = width.substr(0, width.length - 1);
            if (width >= 30 && level >= 15) {
                document.getElementById("button3").disabled = false;  // odblokowanie przycisków
            }
            document.getElementById("surrender").disabled = false;            
        } 
    }), 2800);
}

let blockValue = 0;

//Blok
function block(i) {
    if(blockValue == 0){
    blockValue = 1;
    document.getElementById("button1").disabled = true;  // zablokowanie przycisków
    document.getElementById("button2").disabled = true;
    document.getElementById("button3").disabled = true;
    document.getElementById("surrender").disabled = true;
    document.getElementById("autoFight").disabled = true;
    staminaPlus();

    // Atak przeciwnika
    document.getElementById("atackEnemy").style.display = "block";
    var attackEnemy = document.getElementById("atackEnemy");
    attackEnemy.classList.add("enemyAnimeAttack");

    setTimeout((function() { document.getElementById("knightBlock").style.display = "block" }), 1000);
    setTimeout((function() { document.getElementById("knightBlock").style.display = "none" }), 1400);

    setTimeout((function() { removeAnim("atackEnemy") }), 1200); // animacja ataku

    setTimeout((function() {
        document.getElementById("autoFight").disabled = false;  // odblokowanie przycisków
        document.getElementById("button1").disabled = false;
        document.getElementById("button2").disabled = false;
        var width = document.getElementById("stamina").style.width;
        width = width.substr(0, width.length - 1);
        if (width >= 30 && level >= 15) {
            document.getElementById("button3").disabled = false;
        }
        document.getElementById("surrender").disabled = false;               
    }), 1400);
}
}


//Silny atak
function powerfullAttack(i) {
    blockValue = 0;

    var content = document.getElementById("levelOfStamina").innerHTML;
    var position = content.indexOf("%");
    var value = content.substr(0, position);
    if (value >= 30) {
        document.getElementById("button1").disabled = true;  // zablokowanie przycisków
        document.getElementById("button2").disabled = true;
        document.getElementById("button3").disabled = true;
        document.getElementById("surrender").disabled = true;
        document.getElementById("autoFight").disabled = true;
        staminaMinus();

        // Atak postaci
        document.getElementById("atackKnight").style.display = "block";
        var attack = document.getElementById("atackKnight");
        attack.classList.add("knightAnimeAttack");

        setTimeout((function() { removeAnim("atackKnight") }), 1200); // animacja ataku

        document.getElementById("dmgEnemy").style.color = "red";
        document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";

        if(profesionCharacter == "warrior"){
            var one = parseInt(attackDmg)*7 + parseInt(power)/1.6 + parseInt(level);
            var two = parseInt(attackDmg)*8 + parseInt(power)/1.2 + parseInt(level)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 4;
            damage = parseInt(damage);

        } else if(profesionCharacter == "mag"){
            var one = parseInt(attackDmg)*7 + parseInt(intelligence)/1.6 + parseInt(level)*3;
            var two = parseInt(attackDmg)*8 + parseInt(intelligence)/1.2 + parseInt(level)*8;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 4;
            damage = parseInt(damage);

        } else if(profesionCharacter == "hunter"){
            var one = parseInt(attackDmg)*7 + parseInt(skill)/1.6 + parseInt(level);
            var two = parseInt(attackDmg)*8 + parseInt(skill)/1.2 + parseInt(level)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 4;
            damage = parseInt(damage);
        }
    
        setTimeout((function() {
            dmgShow(damage, "dmgEnemy"); // pokazanie obrażeń
            makeDmgEnemy("healthEnemy", damage); // zmniejszenie zdrowia
        }), 1200);

        // Kontra
        setTimeout((function() { enemyAttack() }), 1400);

        setTimeout((function() {
            if (currentHealthEnemy > 0) {
                document.getElementById("button1").disabled = false;  // odblokowanie przycisków
                document.getElementById("button2").disabled = false;
                var width = document.getElementById("stamina").style.width;
                width = width.substr(0, width.length - 1);
                if (width >= 30 && level >= 15) {
                    document.getElementById("button3").disabled = false;
                }
                document.getElementById("autoFight").disabled = false;
                document.getElementById("surrender").disabled = false;            
            } 
        }), 2800);
    }
}

// Usunięcie klasy ataku
function removeAnim(name) {
    var attack = document.getElementById(name);
    if (name == "atackKnight") {
        attack.classList.remove("knightAnimeAttack");
    } else {
        attack.classList.remove("enemyAnimeAttack");
    }
    document.getElementById(name).style.display = "none";
}

// Atack przeciwnika
function enemyAttack() {
    /*var content = document.querySelector("#right>.levelOfHealth").innerHTML;
    var position = content.indexOf("%");
    var value = content.substr(0, position);*/
    document.getElementById("dmgKnight").style.color = "black";
    document.getElementById("dmgKnight").style.textShadow = "0.15vw 0.15vw 0.1vw red";
    var widthEnemy = document.getElementById("healthEnemy").style.width;
    var position = widthEnemy.indexOf("%");
    var value = widthEnemy.substr(0, position);
    if (value > 0) {
        document.getElementById("atackEnemy").style.display = "block";
        var attackEnemy = document.getElementById("atackEnemy");
        attackEnemy.classList.add("enemyAnimeAttack");

        setTimeout((function() { removeAnim("atackEnemy") }), 1200); // usunięcie animacji ataku

        let luckAttack = Math.floor(Math.random() * 100) + 1;
        var value100 = 100;
        var defenceP = 100-pDefence;
        defenceP = parseInt(defenceP)/100;
        var defenceM = 100-mDefence;
        defenceM = parseInt(defenceM)/100;

        var basicPower = 15 + parseInt(level)*10;
        var basicIntelligence = 15 + parseInt(level);
        var basicSkill = 15 + parseInt(level);
        var basicLuck = parseInt(level)*2;
        var basicStats = basicPower+basicIntelligence+basicSkill+basicLuck;
        
        if(level < 15){  
            var damage = (Math.floor(Math.random()*parseInt(basicStats*0.15)) + basicStats*0.1);
            
        } else if(level < 25){
            var damage = (Math.floor(Math.random()*parseInt(basicStats*0.25)) + basicStats*0.3);
            if(luckAttack > 65){
                damage *= 1.4;
                document.getElementById("dmgKnight").style.color = "red";
                document.getElementById("dmgKnight").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
        } else {
            var damage = (Math.floor(Math.random()*parseInt(basicStats*0.25)) + basicStats*0.4);
            if(luckAttack > 65){
                damage *= 1.4;
                document.getElementById("dmgKnight").style.color = "red";
                document.getElementById("dmgKnight").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
        }

        if(profesionCharacter == "warrior"){
            damage *= defenceP;
        } else if(profesionCharacter == "mag"){
            damage *= defenceM;
        } else if(profesionCharacter == "hunter"){
            damage *= defenceP;
        }

        damage = parseInt(damage);
        let damageEnemy = parseInt(damage);

        setTimeout((function() {
            dmgShow(damageEnemy, "dmgKnight"); // pokazanie obrażeń
            makeDmgKnight("healthKnight", damageEnemy); // zmniejszenie zdrowia
        }), 1200);
    }

}

// Wyświetlenie obrażeń
function dmgShow(damage, idName) {
    var dmg = document.getElementById(idName);
    dmg.style.display = "block";
    dmg.innerHTML = damage;
    setTimeout((function() { dmg.style.display = "none" }), 1200);
}

// Pasek zdrowia gracza
function makeDmgKnight(name, damage) {
    currentHealthKnight -= damage;
    width = (currentHealthKnight/healthKnight)*100;
    if (width <= 0) {
        width = 0;
    }
    document.getElementById(name).style.width = width + "%";
    document.querySelector("#left>.levelOfHealth").innerHTML = currentHealthKnight+"/"+healthKnight;

    // Wynik walki ( przegrana )
    if (width <= 0) {
        document.getElementById("button1").style.display = "none";
        document.getElementById("button2").style.display = "none";
        document.getElementById("button3").style.display = "none";
        document.getElementById("surrender").style.display = "none";
        document.getElementById("autoFight").style.display = "none";

        document.getElementById("lose").style.display = "block";
        document.getElementById("knight").style.opacity = "0.7";
        document.getElementById("newFight").style.display = "block";
        }
    }

// Pasek zdrowia przeciwnika
function makeDmgEnemy(name, damage) {
    currentHealthEnemy -= damage;
    width = (currentHealthEnemy/healthEnemy)*100;
    if (width <= 0) {
        width = 0;
    }
    document.getElementById(name).style.width = width + "%";
    document.querySelector("#right>.levelOfHealth").innerHTML = currentHealthEnemy+"/"+healthEnemy;

    // Wynik walki (wygrana)
    if (width <= 0) {
        document.getElementById("button1").style.display = "none";
        document.getElementById("button2").style.display = "none";
        document.getElementById("button3").style.display = "none";
        document.getElementById("surrender").style.display = "none";
        document.getElementById("autoFight").style.display = "none";

        document.getElementById("prize").style.display = "block";
        document.getElementById("prizeBg").style.display = "block";
        document.getElementById("prizeItem").style.display = "block";
        document.getElementById("enemy").style.opacity = "0.7";
        document.getElementById("newFight").style.display = "block";

        var whichMission = "<?php echo $whichMission ?>";
        if(whichMission  == 1){
            var exp = "<?php echo $experience1 ?>";
            var rub = "<?php echo $rubin1 ?>";
            $(document).ready(function(){
                $("#nothing").load("../../php/walka/win.php", {experience1:exp, rubin1:rub, which:whichMission});
            });
        } else if(whichMission  == 2){
            var exp = "<?php echo $experience2 ?>";
            var rub = "<?php echo $rubin2 ?>";
            $(document).ready(function(){
                $("#nothing").load("../../php/walka/win.php", {experience2:exp, rubin2:rub, which:whichMission});
            });
        } else if(whichMission  == 3){
            var exp = "<?php echo $experience3 ?>";
            var rub = "<?php echo $rubin3 ?>";
            $(document).ready(function(){
                $("#nothing").load("../../php/walka/win.php", {experience3:exp, rubin3:rub, which:whichMission});
            });
        }  
    }
}

// Zmniejszenie staminy 
function staminaMinus() {
    var width = document.getElementById("stamina").style.width;
    width = width.substr(0, width.length - 1);
    if (width >= 30) {
        width = width - 30;
        document.getElementById("stamina").style.width = width + "%";
        var content = document.getElementById("levelOfStamina").innerHTML;
        var position = content.indexOf("%");
        var divObject = content.substr(position + 1, content.length);
        document.getElementById("levelOfStamina").innerHTML = width + "%" + divObject;
    }
}

// Zwiększenie staminy o 10
function staminaPlus() {
    var width = document.getElementById("stamina").style.width;
    width = width.substr(0, width.length - 1);
    if (width < 100) {
        width = Number(width) + 10;
    }
    document.getElementById("stamina").style.width = width + "%";
    var content = document.getElementById("levelOfStamina").innerHTML;
    var position = content.indexOf("%");
    var divObject = content.substr(position + 1, content.length);
    document.getElementById("levelOfStamina").innerHTML = width + "%" + divObject;
}

// Zwiększenie staminy o 5
function staminaPlusNormal() {
    var width = document.getElementById("stamina").style.width;
    width = width.substr(0, width.length - 1);
    if (width < 100) {
        width = Number(width) + 5;
    }
    document.getElementById("stamina").style.width = width + "%";
    var content = document.getElementById("levelOfStamina").innerHTML;
    var position = content.indexOf("%");
    var divObject = content.substr(position + 1, content.length);
    document.getElementById("levelOfStamina").innerHTML = width + "%" + divObject;
}

// Poddanie się
function surrender() {
    document.getElementById("button1").style.display = "none";
    document.getElementById("button2").style.display = "none";
    document.getElementById("button3").style.display = "none";
    document.getElementById("surrender").style.display = "none";
    document.getElementById("autoFight").style.display = "none";

    document.getElementById("lose").style.display = "block";
    document.getElementById("knight").style.opacity = "0.7";

    setTimeout((function() { location.href = '../tawerna.php' }), 500);
}

// Szybka walka

function autoFight() {
    document.getElementById("healthContent").innerHTML = healthKnight+"/"+healthKnight;
    document.getElementById("healthContentEnemy").innerHTML = healthEnemy+"/"+healthEnemy;

    document.getElementById("button1").style.display = "none";
    document.getElementById("button2").style.display = "none";
    document.getElementById("button3").style.display = "none";
    document.getElementById("surrender").style.display = "none";
    document.getElementById("autoFight").style.display = "none";

    var basicPower = 15 + parseInt(level)*10;
    var basicIntelligence = 15 + parseInt(level);
    var basicSkill = 15 + parseInt(level);
    var basicLuck = parseInt(level)*2;
    var basicStats = basicPower+basicIntelligence+basicSkill+basicLuck;
    var defenceP = 100-pDefence;
    defenceP = parseInt(defenceP)/100;
    var defenceM = 100-mDefence;
    defenceM = parseInt(defenceM)/100;

    while (currentHealthKnight > 0 && currentHealthEnemy > 0) {
        var luckAttack = Math.floor(Math.random() * 100) + 1;
        var luckPoints = "<?php echo $luck; ?>";
        var luck = luckPoints / (level/0.8);
        if(profesionCharacter == "warrior"){
            var one = parseInt(attackDmg)*5 + parseInt(power)/1.6 + parseInt(level)*2;
            var two = parseInt(attackDmg)*7 + parseInt(power)/1.2 + parseInt(level)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
            }
        damage = parseInt(damage);

        } else if(profesionCharacter == "mag"){
            var one = parseInt(attackDmg)*5 + parseInt(intelligence)/1.6 + parseInt(level)*4;
            var two = parseInt(attackDmg)*7 + parseInt(intelligence)/1.2 + parseInt(level)*10;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
            }
            damage = parseInt(damage);

        } else if(profesionCharacter == "hunter"){
            var one = parseInt(attackDmg)*5 + parseInt(skill)/1.6 + parseInt(level);
            var two = parseInt(attackDmg)*7 + parseInt(skill)/1.2 + parseInt(level)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
            }
            damage = parseInt(damage);
        }

        let damageKnight = parseInt(damage);
        currentHealthEnemy -= damageKnight;

        if (currentHealthEnemy > 0) {
            let luckAttack = Math.floor(Math.random() * 100) + 1;
            
            if(level < 15){ 
                var damage = (Math.floor(Math.random()*parseInt(basicStats*0.15)) + basicStats*0.1);  
            } else if(level < 25){
                var damage = (Math.floor(Math.random()*parseInt(basicStats*0.2)) + basicStats*0.3);
                if(luckAttack > 65){
                    damage *= 1.4;
                }
            } else {
                var damage = (Math.floor(Math.random()*parseInt(basicStats*0.25)) + basicStats*0.4);
                if(luckAttack > 65){
                    damage *= 1.4;
                }
            }

            if(profesionCharacter == "warrior"){
                damage *= defenceP;
            } else if(profesionCharacter == "mag"){
                damage *= defenceM;
            } else if(profesionCharacter == "hunter"){
                damage *= defenceP;
            }

            damage = parseInt(damage); 
            let damageEnemy = parseInt(damage);
            currentHealthKnight -= damageEnemy;
        }
    }

    // Zdrowie postaci
    if (currentHealthKnight <= 0) {
        currentHealthKnight = 0;
    } else {
        currentHealthEnemy = 0;
    }

    widthKnight = (currentHealthKnight/healthKnight)*100;
    document.getElementById("healthKnight").style.width = widthKnight + "%";
    document.querySelector("#left>.levelOfHealth").innerHTML = currentHealthKnight+"/"+healthKnight;

    widthEnemy = (currentHealthEnemy/healthEnemy)*100;
    document.getElementById("healthEnemy").style.width = widthEnemy + "%";
    document.querySelector("#right>.levelOfHealth").innerHTML = currentHealthEnemy+"/"+healthEnemy;

    // Wynik walki
    if (currentHealthKnight > 0) {
        document.getElementById("prize").style.display = "block";
        document.getElementById("prizeBg").style.display = "block";
        document.getElementById("prizeItem").style.display = "block";
        document.getElementById("enemy").style.opacity = "0.7";
        document.getElementById("newFight").style.display = "block";
        
        var whichMission = "<?php echo $whichMission ?>";
        if(whichMission == 1){
            var exp = "<?php echo $experience1 ?>";
            var rub = "<?php echo $rubin1 ?>";
            $(document).ready(function(){
                $("#nothing").load("../../php/walka/win.php", {experience1:exp, rubin1:rub, which:whichMission});
            });
        } else if(whichMission == 2){
            var exp = "<?php echo $experience2 ?>";
            var rub = "<?php echo $rubin2 ?>";
            $(document).ready(function(){
                $("#nothing").load("../../php/walka/win.php", {experience2:exp, rubin2:rub, which:whichMission});
            });
        } else if(whichMission == 3){
            var exp = "<?php echo $experience3 ?>";
            var rub = "<?php echo $rubin3 ?>";
            $(document).ready(function(){
                $("#nothing").load("../../php/walka/win.php", {experience3:exp, rubin3:rub, which:whichMission});
            });
        }  
    } else {
        document.getElementById("lose").style.display = "block";
        document.getElementById("knight").style.opacity = "0.7";
        document.getElementById("newFight").style.display = "block";
    }

}

document.getElementById("newFight").addEventListener("click", function() {document.cookie = "mission=0"});
</script>
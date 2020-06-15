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
    $numberEnemy = $_POST['numberEnemy'];

    // Zmniejszenie ilości walk
    $getFightNumber = "SELECT rankingFight.Value FROM rankingFight INNER JOIN player ON player.Id=rankingFight.IdRankingFight 
    WHERE player.Login='$user_check'"; 
    $getFightNumberQuery = mysqli_query($connection, $getFightNumber);
    if(mysqli_num_rows($getFightNumberQuery) > 0){
        $row = mysqli_fetch_assoc($getFightNumberQuery);
        $valueFight = $row['Value'];
    }

    $valueFight--;
    $setFightNumber = "UPDATE rankingFight INNER JOIN player ON player.Id=rankingFight.IdRankingFight 
    SET Value='$valueFight' WHERE player.Login='$user_check'";
    $setFightNumberQuery = mysqli_query($connection, $setFightNumber);

    // Statystyki gracza
    $getPlayer = "SELECT player.Level, Experience, Rank, Login, Rubins, Monets FROM player WHERE player.Login='$user_check'"; 
    $getPlayerQuery = mysqli_query($connection, $getPlayer);
    if(mysqli_num_rows($getPlayerQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerQuery);
        $level = $row['Level'];
        $rubins = $row['Rubins'];
        $exp = $row['Experience'];
        $rank = $row['Rank'];
        $nick = $row['Login'];
        $monets = $row['Monets'];
    }

    $getPlayer = "SELECT * FROM statistics INNER JOIN player ON player.Id=statistics.Id WHERE player.Login='$user_check'";
    $getPlayerQuery = mysqli_query($connection, $getPlayer);
    if(mysqli_num_rows($getPlayerQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerQuery);
        $powerPlayer = $row['Power'];
        $intelligencePlayer = $row['Intelligence'];
        $skillPlayer = $row['Skill'];
        $healthPlayer = $row['Health'];
        $luckPlayer = $row['Luck'];
        $pDefencePlayer = $row['PhysicDefence'];
        $mDefencePlayer = $row['MagicDefence'];
    }

    $getPlayerAttack = "SELECT Attack FROM equipmentStatistics INNER JOIN player ON player.Id=equipmentStatistics.Player WHERE player.Login='$user_check' AND Slot='6'"; 
    $getPlayerAttackQuery = mysqli_query($connection, $getPlayerAttack);
    if(mysqli_num_rows($getPlayerAttackQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerAttackQuery);
        $attackPlayer = $row['Attack'];
    }
 
    $getPlayerProfesion = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
    WHERE player.Login='$user_check'"; 
    $getPlayerProfesionQuery = mysqli_query($connection, $getPlayerProfesion);
    if(mysqli_num_rows($getPlayerProfesionQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerProfesionQuery);
         $profesionPlayer = $row['Profesion'];
    }

    // Statystyki przeciwnika
    $getPlayer = "SELECT player.Level FROM player WHERE player.Id='$numberEnemy'"; 
    $getPlayerQuery = mysqli_query($connection, $getPlayer);
    if(mysqli_num_rows($getPlayerQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerQuery);
        $levelEnemy = $row['Level'];
    }

    $getPlayer = "SELECT * FROM statistics INNER JOIN player ON player.Id=statistics.Id WHERE player.Id='$numberEnemy'";
    $getPlayerQuery = mysqli_query($connection, $getPlayer);
    if(mysqli_num_rows($getPlayerQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerQuery);
        $powerEnemy = $row['Power'];
        $intelligenceEnemy = $row['Intelligence'];
        $skillEnemy = $row['Skill'];
        $healthEnemy = $row['Health'];
        $luckEnemy = $row['Luck'];
        $pDefenceEnemy = $row['PhysicDefence'];
        $mDefenceEnemy = $row['MagicDefence'];
    }

    $getPlayerAttack = "SELECT Attack FROM equipmentStatistics INNER JOIN player ON player.Id=equipmentStatistics.Player WHERE player.Id='$numberEnemy' AND Slot='6'"; 
    $getPlayerAttackQuery = mysqli_query($connection, $getPlayerAttack);
    if(mysqli_num_rows($getPlayerAttackQuery) > 0){
        $row = mysqli_fetch_assoc($getPlayerAttackQuery);
        $attackEnemy = $row['Attack'];
    }
 
    $getPlayerProfesion = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
    WHERE player.Id='$numberEnemy'"; 
    $getPlayerProfesionQuery = mysqli_query($connection, $getPlayerProfesion);
    if (mysqli_num_rows($getPlayerProfesionQuery) > 0) {
        $row = mysqli_fetch_assoc($getPlayerProfesionQuery);
        $profesionEnemy = $row['Profesion'];
    }

    $numberMission = rand(1,9);
    $getMissionSettings = "SELECT Map FROM missions WHERE IdMission='$numberMission'"; 
    $getMissionSettingsQuery = mysqli_query($connection, $getMissionSettings);
    if(mysqli_num_rows($getMissionSettingsQuery) > 0){
        $row = mysqli_fetch_assoc($getMissionSettingsQuery);
        $mapSource = $row['Map'];
    }

    mysqli_close($connection);
?>

<script>
    
    let rubin = "<?php echo $rubins ?>";
    let monet = "<?php echo $monets ?>";
    let nick = "<?php echo $nick ?>";
    let map = "<?php echo $mapSource ?>";

    // Player statystyki
    let powerPlayer = "<?php echo $powerPlayer ?>";
    let intelligencePlayer = "<?php echo $intelligencePlayer ?>";
    let skillPlayer = "<?php echo $skillPlayer ?>";
    let healthPlayer = "<?php echo $healthPlayer ?>";
    let luckPlayer = "<?php echo $luckPlayer ?>";
    let pDefencePlayer = "<?php echo $pDefencePlayer ?>";
    let mDefencePlayer = "<?php echo $mDefencePlayer ?>";
    let attackPlayer = "<?php echo $attackPlayer ?>";
    let profesionPlayer = "<?php echo $profesionPlayer ?>";
    let levelPlayer = "<?php echo $level ?>";

    pDefencePlayer = (parseInt(pDefencePlayer) / (levelPlayer*0.7));
    if(pDefencePlayer > 50){
        pDefencePlayer = 50;
    }
    mDefencePlayer = (parseInt(mDefencePlayer) / (levelPlayer*0.7));
    if(mDefencePlayer > 50){
        mDefencePlayer = 50;
    }

    // Enemy statystyki
    let powerEnemy = "<?php echo $powerEnemy ?>";
    let intelligenceEnemy = "<?php echo $intelligenceEnemy ?>";
    let skillEnemy = "<?php echo $skillEnemy ?>";
    let healthEnemy = "<?php echo $healthEnemy ?>";
    let luckEnemy = "<?php echo $luckEnemy ?>";
    let pDefenceEnemy = "<?php echo $pDefenceEnemy ?>";
    let mDefenceEnemy = "<?php echo $mDefenceEnemy ?>";
    let attackEnemy = "<?php echo $attackEnemy ?>";
    let profesionEnemy = "<?php echo $profesionEnemy ?>";
    let levelEnemy = "<?php echo $levelEnemy ?>";

    pDefenceEnemy = (parseInt(pDefenceEnemy) / (levelEnemy*0.7));
    if(pDefenceEnemy > 50){
        pDefenceEnemy = 50;
    }
    mDefenceEnemy = (parseInt(mDefenceEnemy) / (levelEnemy*0.7));
    if(mDefenceEnemy > 50){
        mDefenceEnemy = 50;
    }

    // Ustawienie danych gracza w stopce
    document.getElementById("rubin").innerHTML = "<img src='../projekt_grafika/Inne/rubin.gif'> " + rubin;
    document.getElementById("monet").innerHTML = "<img src='../projekt_grafika/Inne/money.png'> " + monet;
    document.getElementById("nick").innerHTML = nick;

    document.getElementById("dmgKnight").style.display = "none";
    document.getElementById("dmgEnemy").style.display = "none";
    document.getElementById("atackKnight").style.display = "none";
    document.getElementById("atackEnemy").style.display = "none";
    document.getElementById("lose").style.display = "none";
    document.getElementById("newFight").style.display = "none";
    document.getElementById("prizeBg").style.display = "none";
    document.getElementById("prize").style.display = "none";
    document.getElementById("healthKnight").style.width = "100%";
    document.getElementById("healthEnemy").style.width = "100%";
    document.getElementById("center").style.backgroundImage = "url('"+map+"')";
    document.getElementById("knightBlock").style.display = "none";
    document.getElementById("enemyBlock").style.display = "none";
  
    // Ustawienie zdrowia graczy
    document.getElementById("healthContent").innerHTML = healthPlayer+"/"+healthPlayer;
    let currentHealthKnight = healthPlayer;
    document.getElementById("healthContentEnemy").innerHTML = healthEnemy+"/"+healthEnemy;
    let currentHealthEnemy = healthEnemy;

//Normalny atak
function normalAttack(i) {
    document.getElementById("dmgEnemy").style.color = "black";
    document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw red";

    document.getElementById("button1").disabled = true;  // zablokowanie przycisków
    document.getElementById("surrender").disabled = true;
    document.getElementById("autoFight").disabled = true;

    // Atak postaci
    document.getElementById("atackKnight").style.display = "block";
    var attack = document.getElementById("atackKnight");
    attack.classList.add("knightAnimeAttack");

    setTimeout((function() { removeAnim("atackKnight") }), 1200); // animacja ataku

///////////////////// Zadawane obrażenia   //////////////////////
        var luckAttack = Math.floor(Math.random() * 100) + 1;
        var luckPoints = luckPlayer;
        var luck = luckPoints / (levelPlayer/0.8);
        if(profesionPlayer == "warrior"){
            var one = parseInt(attackPlayer)*5 + parseInt(powerPlayer)/1.6 + parseInt(levelPlayer)*2;
            var two = parseInt(attackPlayer)*7 + parseInt(powerPlayer)/1.2 + parseInt(levelPlayer)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damage = damage * ((100-pDefenceEnemy)/100);

        } else if(profesionPlayer == "mag"){
            var one = parseInt(attackPlayer)*5 + parseInt(intelligencePlayer)/1.6 + parseInt(levelPlayer)*4;
            var two = parseInt(attackPlayer)*7 + parseInt(intelligencePlayer)/1.2 + parseInt(levelPlayer)*10;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damage = damage * ((100-mDefenceEnemy)/100);

        } else if(profesionPlayer == "hunter"){
            var one = parseInt(attackPlayer)*5 + parseInt(skillPlayer)/1.6 + parseInt(levelPlayer);
            var two = parseInt(attackPlayer)*7 + parseInt(skillPlayer)/1.2 + parseInt(levelPlayer)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damage = damage * ((100-pDefenceEnemy)/100);
        }

        damage = parseInt(damage);

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
            document.getElementById("surrender").disabled = false;            
        } 
    }), 2800);
}



//Blok
function block(i) {
    document.getElementById("button1").disabled = true;  // zablokowanie przycisków
    document.getElementById("surrender").disabled = true;
    document.getElementById("autoFight").disabled = true;

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
        document.getElementById("surrender").disabled = false;               
    }), 1400);
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
    document.getElementById("dmgKnight").style.color = "black";
    document.getElementById("dmgKnight").style.textShadow = "0.15vw 0.15vw 0.1vw red";
    var widthEnemy = document.getElementById("healthEnemy").style.width;
    var position = widthEnemy.indexOf("%");
    var value = widthEnemy.substr(0, position);
    if (value > 0) {
        document.getElementById("atackEnemy").style.display = "block";
        var attackEn = document.getElementById("atackEnemy");
        attackEn.classList.add("enemyAnimeAttack");

        setTimeout((function() { removeAnim("atackEnemy") }), 1200); // usunięcie animacji ataku
        var luckAttack = Math.floor(Math.random() * 100) + 1;
        var luckPoints = luckEnemy;
        var luck = luckPoints / (levelEnemy/0.8);
        if(profesionEnemy == "warrior"){
            var one = parseInt(attackEnemy)*5 + parseInt(powerEnemy)/1.6 + parseInt(levelEnemy)*2;
            var two = parseInt(attackEnemy)*7 + parseInt(powerEnemy)/1.2 + parseInt(levelEnemy)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damage = damage * ((100-pDefencePlayer)/100);

        } else if(profesionEnemy == "mag"){
            var one = parseInt(attackEnemy)*5 + parseInt(intelligenceEnemy)/1.6 + parseInt(levelEnemy)*4;
            var two = parseInt(attackEnemy)*7 + parseInt(intelligenceEnemy)/1.2 + parseInt(levelEnemy)*10;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damage = damage * ((100-mDefencePlayer)/100);

        } else if(profesionEnemy == "hunter"){
            var one = parseInt(attackEnemy)*5 + parseInt(skillEnemy)/1.6 + parseInt(levelEnemy);
            var two = parseInt(attackEnemy)*7 + parseInt(skillEnemy)/1.2 + parseInt(levelEnemy)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damage *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damage = damage * ((100-pDefencePlayer)/100);
        }

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
     var width = (currentHealthKnight/healthPlayer)*100;
    if (width <= 0) {
        width = 0;
    }
    document.getElementById(name).style.width = width + "%";
    document.querySelector("#left>.levelOfHealth").innerHTML = currentHealthKnight+"/"+healthPlayer;

    // Wynik walki ( przegrana )
    if (width <= 0) {
        document.getElementById("button1").style.display = "none";
        document.getElementById("surrender").style.display = "none";
        document.getElementById("autoFight").style.display = "none";

        document.getElementById("lose").style.display = "block";
        document.getElementById("lose").innerHTML = "Porażka";
        document.getElementById("knight").style.opacity = "0.7";
        document.getElementById("newFight").style.display = "block";
        document.getElementById("helmetCharacterPlayer").style.opacity = "0.95";
        document.getElementById("armorCharacterPlayer").style.opacity = "0.95";
        document.getElementById("legsCharacterPlayer").style.opacity = "0.95";
        document.getElementById("bootsCharacterPlayer").style.opacity = "0.95";
        document.getElementById("swordCharacterPlayer").style.opacity = "0.95";
        document.getElementById("shieldCharacterPlayer").style.opacity = "0.95";
        document.getElementById("gloves1CharacterPlayer").style.opacity = "0.95";
        document.getElementById("gloves2CharacterPlayer").style.opacity = "0.95";
        }
    }

// Pasek zdrowia przeciwnika
function makeDmgEnemy(name, damage) {
    currentHealthEnemy -= damage;
    var width = (currentHealthEnemy/healthEnemy)*100;
    if (width <= 0) {
        width = 0;
    }
    document.getElementById(name).style.width = width + "%";
    document.querySelector("#right>.levelOfHealth").innerHTML = currentHealthEnemy+"/"+healthEnemy;

    // Wynik walki (wygrana)
    if (width <= 0) {
        document.getElementById("button1").style.display = "none";
        document.getElementById("surrender").style.display = "none";
        document.getElementById("autoFight").style.display = "none";

        document.getElementById("prize").style.display = "block";
        document.getElementById("prizeBg").style.display = "block";
        document.getElementById("enemy").style.opacity = "0.7";
        document.getElementById("newFight").style.display = "block";
        document.getElementById("helmetCharacterEnemy").style.opacity = "0.95";
        document.getElementById("armorCharacterEnemy").style.opacity = "0.95";
        document.getElementById("legsCharacterEnemy").style.opacity = "0.95";
        document.getElementById("bootsCharacterEnemy").style.opacity = "0.95";
        document.getElementById("swordCharacterEnemy").style.opacity = "0.95";
        document.getElementById("shieldCharacterEnemy").style.opacity = "0.95";
        document.getElementById("gloves1CharacterEnemy").style.opacity = "0.95";
        document.getElementById("gloves2CharacterEnemy").style.opacity = "0.95";

        var widthPlayer = (currentHealthKnight/healthPlayer)*100;

        $(document).ready(function(){
            $("#nothing").load("../php/ranking/win.php", {prize:widthPlayer});
        });

        
    }
}

// Poddanie się
function surrender() {
    document.getElementById("button1").style.display = "none";
    document.getElementById("surrender").style.display = "none";
    document.getElementById("autoFight").style.display = "none";

    document.getElementById("lose").style.display = "block";
    document.getElementById("knight").style.opacity = "0.7";
    document.getElementById("lose").innerHTML = "Porażka";

    setTimeout((function() { location.href = 'ranking.php' }), 1200);
}

// Szybka walka

function autoFight() {
    document.getElementById("healthContent").innerHTML = healthPlayer+"/"+healthPlayer;
    document.getElementById("healthContentEnemy").innerHTML = healthEnemy+"/"+healthEnemy;

    document.getElementById("button1").style.display = "none";
    document.getElementById("surrender").style.display = "none";
    document.getElementById("autoFight").style.display = "none";

    while (currentHealthKnight > 0 && currentHealthEnemy > 0) {
        ///////////////////// Zadawane obrażenia Gracza //////////////////////
        var luckAttack = Math.floor(Math.random() * 100) + 1;
        var luckPoints = luckPlayer;
        var luck = luckPoints / (levelPlayer/0.8);
        if(profesionPlayer == "warrior"){
            var one = parseInt(attackPlayer)*5 + parseInt(powerPlayer)/1.6 + parseInt(levelPlayer)*2;
            var two = parseInt(attackPlayer)*7 + parseInt(powerPlayer)/1.2 + parseInt(levelPlayer)*6;
            var damagePlayer = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damagePlayer *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damagePlayer = damagePlayer * ((100-pDefenceEnemy)/100);

        } else if(profesionPlayer == "mag"){
            var one = parseInt(attackPlayer)*5 + parseInt(intelligencePlayer)/1.6 + parseInt(levelPlayer)*4;
            var two = parseInt(attackPlayer)*7 + parseInt(intelligencePlayer)/1.2 + parseInt(levelPlayer)*10;
            var damagePlayer = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damagePlayer *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damagePlayer = damagePlayer * ((100-mDefenceEnemy)/100);

        } else if(profesionPlayer == "hunter"){
            var one = parseInt(attackPlayer)*5 + parseInt(skillPlayer)/1.6 + parseInt(levelPlayer);
            var two = parseInt(attackPlayer)*7 + parseInt(skillPlayer)/1.2 + parseInt(levelPlayer)*6;
            var damagePlayer = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
            if(luckAttack >= (101-luck.toFixed(0))){
                damagePlayer *= 1.4;
                document.getElementById("dmgEnemy").style.color = "red";
                document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
            }
            damagePlayer = damagePlayer * ((100-pDefenceEnemy)/100);
        }

        let damageKnight = parseInt(damagePlayer);
        currentHealthEnemy -= damageKnight;

        if (currentHealthEnemy > 0) {
            var luckAttack = Math.floor(Math.random() * 100) + 1;
            var luckPoints = luckEnemy;
            var luck = luckPoints / (levelEnemy/0.8);
            if(profesionEnemy == "warrior"){
                var one = parseInt(attackEnemy)*5 + parseInt(powerEnemy)/1.6 + parseInt(levelEnemy)*2;
                var two = parseInt(attackEnemy)*7 + parseInt(powerEnemy)/1.2 + parseInt(levelEnemy)*6;
                var damageEnemy = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
                if(luckAttack >= (101-luck.toFixed(0))){
                    damageEnemy *= 1.4;
                    document.getElementById("dmgEnemy").style.color = "red";
                    document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
                }
                damageEnemy = damageEnemy * ((100-pDefencePlayer)/100);
            } else if(profesionEnemy == "mag"){
                var one = parseInt(attackEnemy)*5 + parseInt(intelligenceEnemy)/1.6 + parseInt(levelEnemy)*4;
                var two = parseInt(attackEnemy)*7 + parseInt(intelligenceEnemy)/1.2 + parseInt(levelEnemy)*10;
                var damageEnemy = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
                if(luckAttack >= (101-luck.toFixed(0))){
                    damageEnemy *= 1.4;
                    document.getElementById("dmgEnemy").style.color = "red";
                    document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
                }
                damageEnemy = damageEnemy * ((100-mDefencePlayer)/100);

            } else if(profesionEnemy == "hunter"){
                var one = parseInt(attackEnemy)*5 + parseInt(skillEnemy)/1.6 + parseInt(levelEnemy);
                var two = parseInt(attackEnemy)*7 + parseInt(skillEnemy)/1.2 + parseInt(levelEnemy)*6;
                var damageEnemy = (Math.floor(Math.random()*parseInt(two-one)) + one) / 6;
                if(luckAttack >= (101-luck.toFixed(0))){
                    damageEnemy *= 1.4;
                    document.getElementById("dmgEnemy").style.color = "red";
                    document.getElementById("dmgEnemy").style.textShadow = "0.15vw 0.15vw 0.1vw black";
                }
                damageEnemy = damageEnemy * ((100-pDefencePlayer)/100);
            }
            damageEnemy = parseInt(damageEnemy);
            currentHealthKnight -= damageEnemy;
        }
    }

    // Zdrowie postaci
    if (currentHealthKnight <= 0) {
        currentHealthKnight = 0;
    } else {
        currentHealthEnemy = 0;
    }

    widthKnight = (currentHealthKnight/healthPlayer)*100;
    document.getElementById("healthKnight").style.width = widthKnight + "%";
    document.querySelector("#left>.levelOfHealth").innerHTML = currentHealthKnight+"/"+healthPlayer;

    widthEnemy = (currentHealthEnemy/healthEnemy)*100;
    document.getElementById("healthEnemy").style.width = widthEnemy + "%";
    document.querySelector("#right>.levelOfHealth").innerHTML = currentHealthEnemy+"/"+healthEnemy;

    // Wynik walki
    if (currentHealthKnight > 0) {
        document.getElementById("prize").style.display = "block";
        document.getElementById("prizeBg").style.display = "block";
        document.getElementById("enemy").style.opacity = "0.7";
        document.getElementById("helmetCharacterEnemy").style.opacity = "0.95";
        document.getElementById("armorCharacterEnemy").style.opacity = "0.95";
        document.getElementById("legsCharacterEnemy").style.opacity = "0.95";
        document.getElementById("bootsCharacterEnemy").style.opacity = "0.95";
        document.getElementById("swordCharacterEnemy").style.opacity = "0.95";
        document.getElementById("shieldCharacterEnemy").style.opacity = "0.95";
        document.getElementById("gloves1CharacterEnemy").style.opacity = "0.95";
        document.getElementById("gloves2CharacterEnemy").style.opacity = "0.95";

        document.getElementById("newFight").style.display = "block";  
        
        var widthPlayer = (currentHealthKnight/healthPlayer)*100;

        $(document).ready(function(){
            $("#nothing").load("../php/ranking/win.php", {prize:widthPlayer});
        });
    } else {
        document.getElementById("lose").style.display = "block";
        document.getElementById("knight").style.opacity = "0.7";
        document.getElementById("lose").innerHTML = "Porażka";
        document.getElementById("newFight").style.display = "block";
        document.getElementById("helmetCharacterPlayer").style.opacity = "0.95";
        document.getElementById("armorCharacterPlayer").style.opacity = "0.95";
        document.getElementById("legsCharacterPlayer").style.opacity = "0.95";
        document.getElementById("bootsCharacterPlayer").style.opacity = "0.95";
        document.getElementById("swordCharacterPlayer").style.opacity = "0.95";
        document.getElementById("shieldCharacterPlayer").style.opacity = "0.95";
        document.getElementById("gloves1CharacterPlayer").style.opacity = "0.95";
        document.getElementById("gloves2CharacterPlayer").style.opacity = "0.95";
    }
}

</script>
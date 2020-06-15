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

    $cellarNumber = $_POST['cellarNumber'];
    $monsterNumber = $_POST['monsterNumber'];

    // Statystyki przeciwnika
    $getMonster = "SELECT * FROM cellarMonsters WHERE NumberOfCellar='$cellarNumber' AND NumberOfMonster='$monsterNumber' ";
    $getMonsterQuery = mysqli_query($connection, $getMonster);
    if(mysqli_num_rows($getMonsterQuery) > 0){
        $row = mysqli_fetch_assoc($getMonsterQuery);
        $attackEnemy = $row['Attack'];
        $powerEnemy = $row['Power'];
        $intelligenceEnemy = $row['Intelligence'];
        $skillEnemy = $row['Skill'];
        $healthEnemy = $row['Health'];
        $luckEnemy = $row['Luck'];
        $nameMonster = $row['Name'];
        $levelMonster = $row['Level'];
        $profesionMonster = $row['Profesion'];
        $imageMonster = $row['ImageMonster'];
        $imageWeapon = $row['ImageWeapon'];
    }

    // ustawienie nowego czasu 
    $date = date("Y-m-d H:i:s");

    $setTime = "UPDATE cellarPlayer INNER JOIN player ON player.Id=cellarPlayer.Id SET DateCellar$cellarNumber='$date' 
    WHERE player.Login='$user_check' ";
    $setTimeQuery = mysqli_query($connection, $setTime);

    mysqli_close($connection);
?>

<script>
    
    let rubin = "<?php echo $rubins ?>";
    let monet = "<?php echo $monets ?>";
    let nick = "<?php echo $nick ?>";

    var monsterNumber = "<?php echo $monsterNumber ?>";
    var cellarNumber = "<?php echo $cellarNumber ?>";

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
    var powerEnemy = "<?php echo $powerEnemy ?>";
    var intelligenceEnemy = "<?php echo $intelligenceEnemy ?>";
    var skillEnemy = "<?php echo $skillEnemy ?>";
    var healthEnemy = "<?php echo $healthEnemy ?>";
    var luckEnemy = "<?php echo $luckEnemy ?>";
    var pDefenceEnemy = "<?php echo $pDefenceEnemy ?>";
    var mDefenceEnemy = "<?php echo $mDefenceEnemy ?>";
    var attackEnemy = "<?php echo $attackEnemy ?>";
    var levelEnemy = "<?php echo $levelMonster ?>";
    var profesionEnemy = "<?php echo $profesionMonster ?>";
    var imageMonster = "<?php echo $imageMonster ?>";
    var imageWeapon = "<?php echo $imageWeapon ?>";
    var nameMonster = "<?php echo $nameMonster ?>";
    var pDefenceEnemy = 30;
    var mDefenceEnemy = 30;

    // Ustawienie danych gracza w stopce
    document.getElementById("rubin").innerHTML = "<img src='../projekt_grafika/Inne/rubin.gif'> " + rubin;
    document.getElementById("monet").innerHTML = "<img src='../projekt_grafika/Inne/money.png'> " + monet;
    document.getElementById("nick").innerHTML = nick;

    document.getElementById("left").style.visibility = "visible";
    document.getElementById("right").style.visibility = "visible";
    document.getElementById("middle").style.visibility = "visible";
    document.getElementById("dmgKnight").style.display = "none";
    document.getElementById("dmgEnemy").style.display = "none";
    document.getElementById("atackKnight").style.display = "none";
    document.getElementById("atackEnemy").style.display = "none";
    document.getElementById("lose").style.display = "none";
    document.getElementById("newFight").style.display = "none";
    document.getElementById("prizeBg").style.display = "none";
    document.getElementById("prize").style.display = "none";
    document.getElementById("stamina").style.width = "100%";
    document.getElementById("staminaBg").style.width = "100%";
    document.getElementById("healthKnight").style.width = "100%";
    document.getElementById("healthEnemy").style.width = "100%";
    if(cellarNumber == 1){
        document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/piwnica_walka.png')";
    } else if(cellarNumber == 2){
        document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/piwnica_walka2.png')";
    }
    else if(cellarNumber == 3){
        document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/piwnica_walka3.png')";
    }
    document.getElementById("knightBlock").style.display = "none";
    document.getElementById("enemyBlock").style.display = "none";
    document.getElementById("atackEnemy").style.backgroundImage = "url('"+imageWeapon+"')";
    document.getElementById("enemy").style.backgroundImage = "url('"+imageMonster+"')";
    document.getElementById("nameEnemy").innerHTML = nameMonster+" ("+levelEnemy+")";
  
    // Ustawienie zdrowia graczy
    document.getElementById("healthContent").innerHTML = healthPlayer+"/"+healthPlayer;
    let currentHealthKnight = healthPlayer;
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
            damage = damage * ((100-pDefenceEnemy)/100);

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
            if( levelPlayer >= 5){
            document.getElementById("button2").disabled = false;
            } 
            var width = document.getElementById("stamina").style.width;
            width = width.substr(0, width.length - 1);
            if (width >= 30 && levelPlayer >= 15) {
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
        if (width >= 30 && levelPlayer >= 15) {
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

        if(profesionPlayer == "warrior"){
            var one = parseInt(attackPlayer)*7 + parseInt(powerPlayer)/1.6 + parseInt(levelPlayer);
            var two = parseInt(attackPlayer)*8 + parseInt(powerPlayer)/1.2 + parseInt(levelPlayer)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 4;
            damage = parseInt(damage);
            damage = damage * ((100-pDefenceEnemy)/100);

        } else if(profesionPlayer == "mag"){
            var one = parseInt(attackPlayer)*7 + parseInt(intelligencePlayer)/1.6 + parseInt(levelPlayer)*3;
            var two = parseInt(attackPlayer)*8 + parseInt(intelligencePlayer)/1.2 + parseInt(levelPlayer)*8;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 4;
            damage = parseInt(damage);
            damage = damage * ((100-pDefenceEnemy)/100);

        } else if(profesionPlayer == "hunter"){
            var one = parseInt(attackPlayer)*7 + parseInt(skillPlayer)/1.6 + parseInt(levelPlayer);
            var two = parseInt(attackPlayer)*8 + parseInt(skillPlayer)/1.2 + parseInt(levelPlayer)*6;
            var damage = (Math.floor(Math.random()*parseInt(two-one)) + one) / 4;
            damage = parseInt(damage);
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
                document.getElementById("button1").disabled = false;  // odblokowanie przycisków
                document.getElementById("button2").disabled = false;
                var width = document.getElementById("stamina").style.width;
                width = width.substr(0, width.length - 1);
                if (width >= 30 && levelPlayer >= 15) {
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
    width = (currentHealthKnight/healthPlayer)*100;
    if (width <= 0) {
        width = 0;
    }
    document.getElementById(name).style.width = width + "%";
    document.querySelector("#left>.levelOfHealth").innerHTML = currentHealthKnight+"/"+healthPlayer;

    // Wynik walki ( przegrana )
    if (width <= 0) {
        document.getElementById("button1").style.display = "none";
        document.getElementById("button2").style.display = "none";
        document.getElementById("button3").style.display = "none";
        document.getElementById("surrender").style.display = "none";
        document.getElementById("autoFight").style.display = "none";

        document.getElementById("lose").style.display = "block";
        document.getElementById("lose").innerHTML = "Porażka";
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
        document.getElementById("enemy").style.opacity = "0.7";
        document.getElementById("newFight").style.display = "block";

        $(document).ready(function(){
            $("#nothing").load("../php/piwnica/win.php", {numberMonster:monsterNumber, numberCellar:cellarNumber});
        });

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
    document.getElementById("lose").innerHTML = "Porażka";

    setTimeout((function() { location.href = 'ranking.php' }), 1200);
}

// Szybka walka

function autoFight() {
    document.getElementById("healthContent").innerHTML = healthPlayer+"/"+healthPlayer;
    document.getElementById("healthContentEnemy").innerHTML = healthEnemy+"/"+healthEnemy;

    document.getElementById("button1").style.display = "none";
    document.getElementById("button2").style.display = "none";
    document.getElementById("button3").style.display = "none";
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
        document.getElementById("newFight").style.display = "block";  

        $(document).ready(function(){
            $("#nothing").load("../php/piwnica/win.php", {numberMonster:monsterNumber, numberCellar:cellarNumber});
        });
    } else {
        document.getElementById("lose").style.display = "block";
        document.getElementById("knight").style.opacity = "0.7";
        document.getElementById("lose").innerHTML = "Porażka";
        document.getElementById("newFight").style.display = "block";
    }
}

</script>
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
        exit();
    }
    mysqli_set_charset($connection, "utf8");

    session_start();
   
    $user_check = $_SESSION['login_user'];

    // pobranie numeru przeciwnika
    $getLevelCellar1 = "SELECT LevelCellar1, LevelCellar2, LevelCellar3 FROM cellarPlayer INNER JOIN player ON player.Id=cellarPlayer.Id 
    WHERE player.Login='$user_check'";
    $queryLevelCellar1 = mysqli_query($connection, $getLevelCellar1);
    if(mysqli_num_rows($queryLevelCellar1) > 0){
        $row = mysqli_fetch_assoc($queryLevelCellar1);
        $levelCellar1 = $row['LevelCellar1'];
        $levelCellar2 = $row['LevelCellar2'];
        $levelCellar3 = $row['LevelCellar3'];
    }

    // Piwnica drzwi 1
    if ($levelCellar1 < 11) {
        $getMonster1 = "SELECT NumberOfMonster, ImageMonster, cellarMonsters.Level, DateCellar1, cellarMonsters.Name FROM cellarMonsters 
        INNER JOIN cellarPlayer ON cellarPlayer.LevelCellar1=cellarMonsters.NumberOfMonster
        INNER JOIN player ON player.Id=cellarPlayer.Id WHERE player.Login='$user_check' AND NumberOfCellar='1'";
        $getMonsterQuery1 = mysqli_query($connection, $getMonster1);
        if (mysqli_num_rows($getMonsterQuery1) > 0) {
            $row = mysqli_fetch_assoc($getMonsterQuery1);
            $imageMonster1 = $row['ImageMonster'];
            $levelMonster1 = $row['Level'];
            $nameMonster1 = $row['Name'];
            $numberOfMonster1 = $row['NumberOfMonster'];
            $dateCellar1 = $row['DateCellar1'];
        }
    } else {
        $getMonster1 = "SELECT ImageMonster, cellarMonsters.Level, cellarMonsters.Name FROM cellarMonsters 
        WHERE NumberOfCellar='1' AND NumberOfMonster='10'";
        $getMonsterQuery1 = mysqli_query($connection, $getMonster1);
        if (mysqli_num_rows($getMonsterQuery1) > 0) {
            $row = mysqli_fetch_assoc($getMonsterQuery1);
            $imageMonster1 = $row['ImageMonster'];
            $levelMonster1 = $row['Level'];
            $nameMonster1 = $row['Name'];
            $numberOfMonster1 = 11;
            $dateCellar1 = $row['DateCellar1'];
        }
    }

    // Piwnica drzwi 2
    if ($levelCellar2 < 11) {
        $getMonster2 = "SELECT NumberOfMonster, ImageMonster, cellarMonsters.Level, DateCellar2, cellarMonsters.Name FROM cellarMonsters 
        INNER JOIN cellarPlayer ON cellarPlayer.LevelCellar2=cellarMonsters.NumberOfMonster
        INNER JOIN player ON player.Id=cellarPlayer.Id WHERE player.Login='$user_check' AND NumberOfCellar='2'";
        $getMonsterQuery2 = mysqli_query($connection, $getMonster2);
        if(mysqli_num_rows($getMonsterQuery2) > 0){
            $row = mysqli_fetch_assoc($getMonsterQuery2);
            $imageMonster2 = $row['ImageMonster'];
            $levelMonster2 = $row['Level'];
            $nameMonster2 = $row['Name'];
            $numberOfMonster2 = $row['NumberOfMonster'];
            $dateCellar2 = $row['DateCellar2'];
        }
    } else {
        $getMonster2 = "SELECT ImageMonster, cellarMonsters.Level, cellarMonsters.Name FROM cellarMonsters 
        WHERE NumberOfCellar='2' AND NumberOfMonster='10'";
        $getMonsterQuery2 = mysqli_query($connection, $getMonster2);
        if (mysqli_num_rows($getMonsterQuery2) > 0) {
            $row = mysqli_fetch_assoc($getMonsterQuery2);
            $imageMonster2 = $row['ImageMonster'];
            $levelMonster2 = $row['Level'];
            $nameMonster2 = $row['Name'];
            $numberOfMonster2 = 11;
            $dateCellar2 = $row['DateCellar2'];
        }
    }

    // Piwnica drzwi 3
    if ($levelCellar3 < 11) {
        $getMonster3 = "SELECT NumberOfMonster, ImageMonster, cellarMonsters.Level, DateCellar3, cellarMonsters.Name FROM cellarMonsters 
        INNER JOIN cellarPlayer ON cellarPlayer.LevelCellar3=cellarMonsters.NumberOfMonster
        INNER JOIN player ON player.Id=cellarPlayer.Id WHERE player.Login='$user_check' AND NumberOfCellar='3'";
        $getMonsterQuery3 = mysqli_query($connection, $getMonster3);
        if(mysqli_num_rows($getMonsterQuery3) > 0){
            $row = mysqli_fetch_assoc($getMonsterQuery3);
            $imageMonster3 = $row['ImageMonster'];
            $levelMonster3 = $row['Level'];
            $nameMonster3 = $row['Name'];
            $numberOfMonster3 = $row['NumberOfMonster'];
            $dateCellar3 = $row['DateCellar3'];
        }
    } else {
        $getMonster3 = "SELECT ImageMonster, cellarMonsters.Level, cellarMonsters.Name FROM cellarMonsters 
        WHERE NumberOfCellar='3' AND NumberOfMonster='10'";
        $getMonsterQuery3 = mysqli_query($connection, $getMonster3);
        if (mysqli_num_rows($getMonsterQuery3) > 0) {
            $row = mysqli_fetch_assoc($getMonsterQuery3);
            $imageMonster3 = $row['ImageMonster'];
            $levelMonster3 = $row['Level'];
            $nameMonster3 = $row['Name'];
            $numberOfMonster3 = 11;
            $dateCellar3 = $row['DateCellar3'];
        }
    }

    $dateFromDatabase1 = strtotime($dateCellar1);
    $dateFromDatabase2 = strtotime($dateCellar2);
    $dateFromDatabase3 = strtotime($dateCellar3);


    mysqli_close($connection);
?>

<script>

    var imageMonster1 = "<?php echo $imageMonster1 ?>";
    var levelMonster1 = "<?php echo $levelMonster1 ?>";
    var nameMonster1 = "<?php echo $nameMonster1 ?>";
    var numberOfMonster1 = "<?php echo $numberOfMonster1 ?>";
    var dateCellar2 = "<?php echo $dateCellar1 ?>";
    var imageMonster2 = "<?php echo $imageMonster2 ?>";
    var levelMonster2 = "<?php echo $levelMonster2 ?>";
    var nameMonster2 = "<?php echo $nameMonster2 ?>";
    var numberOfMonster2 = "<?php echo $numberOfMonster2 ?>";
    var dateCellar2 = "<?php echo $dateCellar2 ?>";
    var imageMonster3 = "<?php echo $imageMonster3 ?>";
    var levelMonster3 = "<?php echo $levelMonster3 ?>";
    var nameMonster3 = "<?php echo $nameMonster3 ?>";
    var numberOfMonster3 = "<?php echo $numberOfMonster3 ?>";
    var dateCellar3 = "<?php echo $dateCellar3 ?>";

    document.getElementById("doorClose").addEventListener("click", function() { enemyClose() });

    document.getElementById("door1").addEventListener("mouseover", function() { pictureDoor1() });
    document.getElementById("door1").addEventListener("mouseout", function() { pictureDoor() });
    document.getElementById("door1").addEventListener("click", function() { enemyOpen1() });

    document.getElementById("door2").addEventListener("mouseover", function() { pictureDoor2() });
    document.getElementById("door2").addEventListener("mouseout", function() { pictureDoor() });
    document.getElementById("door2").addEventListener("click", function() { enemyOpen2() });

    document.getElementById("door3").addEventListener("mouseover", function() { pictureDoor3() });
    document.getElementById("door3").addEventListener("mouseout", function() { pictureDoor() });
    document.getElementById("door3").addEventListener("click", function() { enemyOpen3() });

    document.getElementById("monster1").style.display = "none";
    document.getElementById("monster2").style.display = "none";
    document.getElementById("monster3").style.display = "none";
    document.getElementById("doorClose").style.visibility = "hidden";
    document.getElementById("timeFight1").style.display = "none";
    document.getElementById("timeFight2").style.display = "none";
    document.getElementById("timeFight3").style.display = "none";

    function pictureDoor() {
        document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/cellar.png')";
    }

    function pictureDoor1() {
        document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/cellar1door.png')";
    }

    function pictureDoor2() {
        document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/cellar2door.png')";
    }

    function pictureDoor3() {
        document.getElementById("center").style.backgroundImage = "url('../projekt_grafika/images/piwnica/cellar3door.png')";
    }

    var time1 = "<?php echo $dateFromDatabase1 ?>";
    var time2 = "<?php echo $dateFromDatabase2 ?>";
    var time3 = "<?php echo $dateFromDatabase3 ?>";

    var minute1 = 0;
    var second1 = 0;
    var minute2 = 0;
    var second2 = 0;
    var minute3 = 0;
    var second3 = 0;
    var secZero = 0;
    var open1 = 0;
    var open2 = 0;
    var open3 = 0;

    function enemyOpen1() {
        enemyClose();
        open1++;
        var currentDate = new Date();
        var seconds = currentDate.getTime() / 1000;
        var check = seconds.toFixed(0) - time1;
        document.getElementById("monster1").style.display = "block";
        document.getElementById("doorClose").style.visibility = "visible";
        document.getElementById("monster1").style.animationName = "monster1";
        document.getElementById("timeFight1").style.display = "none";
        document.getElementById("picture1").style.backgroundImage = "url('"+imageMonster1+"')";
        document.getElementById("levelOfMonster1").innerHTML = "Poziom: "+levelMonster1;
        document.getElementById("name1").innerHTML = nameMonster1;
        document.getElementById("numberOfMonsters1").innerHTML = numberOfMonster1 + "/10";
        if(numberOfMonster1==11){
            document.getElementById("numberOfMonsters1").innerHTML = "10/10";
            document.getElementById("monster1").style.backgroundColor = "rgba(89, 211, 33, 0.7)";
            document.getElementById("picture1").style.opacity = "0.5";
            document.getElementById("timeFight1").style.display = "none";
        } else if(check < 3600){
            time = 3600 - check;
            document.getElementById("timeFight1").style.display = "block";
            let min1 = (time/60).toFixed(0);
            let sec1 = time%60;
            timeDisplay1(min1, sec1);
        } else {
            document.getElementById("monster1").addEventListener("click", function() { fight1() });
        }
    }

    function enemyOpen2() {
        enemyClose();
        open2++;
        var currentDate = new Date();
        var seconds = currentDate.getTime() / 1000;
        var check = seconds.toFixed(0) - time2;
        document.getElementById("monster2").style.display = "block";
        document.getElementById("doorClose").style.visibility = "visible";
        document.getElementById("monster2").style.animationName = "monster2";
        document.getElementById("timeFight2").style.display = "none";
        document.getElementById("picture2").style.backgroundImage = "url('"+imageMonster2+"')";
        document.getElementById("levelOfMonster2").innerHTML = "Poziom: "+levelMonster2;
        document.getElementById("name2").innerHTML = nameMonster2;
        document.getElementById("numberOfMonsters2").innerHTML = numberOfMonster2 + "/10";
        if(numberOfMonster2==11){
            document.getElementById("numberOfMonsters2").innerHTML = "10/10";
            document.getElementById("monster2").style.backgroundColor = "rgba(89, 211, 33, 0.7)";
            document.getElementById("picture2").style.opacity = "0.5";
            document.getElementById("timeFight2").style.display = "none";
        } else if(check < 3600){
            time = 3600 - check;
            document.getElementById("timeFight2").style.display = "block";
            let min2 = (time/60).toFixed(0);
            let sec2 = time%60;
            timeDisplay2(min2, sec2);
        } else {
            document.getElementById("monster2").addEventListener("click", function() { fight2() });
        }
    }

    function enemyOpen3() {
        enemyClose();
        open3++;
        var currentDate = new Date();
        var seconds = currentDate.getTime() / 1000;
        var check = seconds.toFixed(0) - time3;
        document.getElementById("monster3").style.display = "block";
        document.getElementById("doorClose").style.visibility = "visible";
        document.getElementById("monster3").style.animationName = "monster3";
        document.getElementById("timeFight3").style.display = "none";
        document.getElementById("picture3").style.backgroundImage = "url('"+imageMonster3+"')";
        document.getElementById("levelOfMonster3").innerHTML = "Poziom: "+levelMonster3;
        document.getElementById("name3").innerHTML = nameMonster3;
        document.getElementById("numberOfMonsters3").innerHTML = numberOfMonster3 + "/10";
        if(numberOfMonster3==11){
            document.getElementById("numberOfMonsters3").innerHTML = "10/10";
            document.getElementById("monster3").style.backgroundColor = "rgba(89, 211, 33, 0.7)";
            document.getElementById("picture3").style.opacity = "0.5";
            document.getElementById("timeFight3").style.display = "none";
        } else if(check < 3600){
            time = 3600 - check;
            document.getElementById("timeFight3").style.display = "block";
            let min3 = (time/60).toFixed(0);
            let sec3 = time%60;
            timeDisplay3(min3, sec3);
        } else {
            document.getElementById("monster3").addEventListener("click", function() { fight3() });
        }
    }

    function enemyClose() {
        document.getElementById("monster1").style.display = "none";
        document.getElementById("monster2").style.display = "none";
        document.getElementById("monster3").style.display = "none";
        document.getElementById("doorClose").style.visibility = "hidden";
    }

    // Otworzenie walki z parametrami
    function fight1(){
        window.open("fight.php", "_self");
        document.cookie = "cellarNumber=1" ;
        document.cookie = "reload=0";
        document.cookie = "monsterNumber=" + numberOfMonster1;
    }

    function fight2(){
        window.open("fight.php", "_self");
        document.cookie = "cellarNumber=2" ;
        document.cookie = "reload=0";
        document.cookie = "monsterNumber=" + numberOfMonster2;
    }

    function fight3(){
        window.open("fight.php", "_self");
        document.cookie = "cellarNumber=3" ;
        document.cookie = "reload=0";
        document.cookie = "monsterNumber=" + numberOfMonster3;
    }


        // zegar
    function timeDisplay1(min, sec){
        document.getElementById("door3").addEventListener("mouseover", function() { return 0; });
        document.getElementById("door2").addEventListener("mouseover", function() { return 0; });
        if(open1 == 2){
            open1 = 1;
            return 0;
        }
        let zero = "";
        let zeroMin = "";
        if(sec<10){
            zero ="0";
        }
        if(min<10){
            zeroMin ="0";
        }
        document.getElementById("timeFight1").innerHTML = zeroMin+min+":"+zero+sec;
        if(sec > 0){
            sec--;
        }if(min == 0 && sec == 0){
            document.getElementById("timeFight1").style.display = "none"; 
            document.getElementById("monster1").addEventListener("click", function() { fight1() });
        }if(sec == 0 && secZero == 1){
            min--; 
            sec=59;
            secZero = 0;
        }else if(sec == 0 && secZero == 0){
            secZero = 1;
        }  
        minute1 = min;
        second1 = sec;
        setTimeout("timeDisplay1(minute1, second1);", 990);
    }

    function timeDisplay2(min, sec){
        document.getElementById("door3").addEventListener("mouseover", function() { return 0; });
        document.getElementById("door1").addEventListener("mouseover", function() { return 0; });
        if(open2 == 2){
            open2 = 1;
            return 0;
        }
        let zero = "";
        let zeroMin = "";
        if(sec<10){
            zero ="0";
        }
        if(min<10){
            zeroMin ="0";
        }
        document.getElementById("timeFight2").innerHTML = zeroMin+min+":"+zero+sec;
        if(sec > 0){
            sec--;
        }if(min == 0 && sec == 0){
            document.getElementById("timeFight2").style.display = "none"; 
            document.getElementById("monster2").addEventListener("click", function() { fight2() });
        }if(sec == 0 && secZero == 1){
            min--; 
            sec=59;
            secZero = 0;
        }else if(sec == 0 && secZero == 0){
            secZero = 1;
        }  
        minute2 = min;
        second2 = sec;
        setTimeout("timeDisplay2(minute2, second2);", 990);
    }

    function timeDisplay3(min, sec){
        document.getElementById("door1").addEventListener("mouseover", function() { return 0; });
        document.getElementById("door2").addEventListener("mouseover", function() { return 0; });
        if(open3 == 2){
            open3 = 1;
            return 0;
        }
        let zero = "";
        let zeroMin = "";
        if(sec<10){
            zero ="0";
        }
        if(min<10){
            zeroMin ="0";
        }
        document.getElementById("timeFight3").innerHTML = zeroMin+min+":"+zero+sec;
        if(sec > 0){
            sec--;
        }if(min == 0 && sec == 0){
            document.getElementById("timeFight3").style.display = "none"; 
            document.getElementById("monster3").addEventListener("click", function() { fight3() });
        }if(sec == 0 && secZero == 1){
            min--; 
            sec=59;
            secZero = 0;
        }else if(sec == 0 && secZero == 0){
            secZero = 1;
        }  
        minute3 = min;
        second3 = sec;
        setTimeout("timeDisplay3(minute3, second3);", 990);
    }

</script>
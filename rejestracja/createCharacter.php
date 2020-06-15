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

    $getLogins2 = "SELECT player.Login FROM player";
    $getLoginsQuery2 = mysqli_query($connection, $getLogins2);
    if(mysqli_num_rows($getLoginsQuery2)>0){
        while($row = mysqli_fetch_assoc($getLoginsQuery2)){
            $loginPlayers[] = $row['Login'];
        }
    }

// odebranie informacji o koncie
/*
$login = $_POST['loginPlayer'];
$password = $_POST['passwordPlayer'];
$email = $_POST['emailPlayer'];
$profesion = $_POST['profesionPlayer'];
$gender = $_POST['genderPlayer'];
$color = $_POST['colorPlayer'];
*/
$login = $_POST['login'];
$password = $_POST['psw'];
$email = $_POST['email'];
$profesion = $_POST['profesion'];
$gender = $_POST['gender'];
$color = $_POST['hairColor'];

$error=0;

function loginCheck(){
    $firstLetter = substr($login, 0, 1);
    if($login != ""){
        if(strlen($login) < 6){
            $error++;
        }else if(strlen($login) > 25){
            $error++;
        }else if(!preg_match("/^[a-zA-Z]*$/",$firstLetter)){
            $error++;
        }
        for($i=0; $i < count($loginPlayers); $i++){
            if($loginPlayers[$i] == $login){
                $error++;
            }
        }
    } else {
        $error++;
    }  
}

function passwordCheck(){
    if($password != ""){
        if(strlen($password) < 8){
            $error++;
        }else if(strlen($password) > 25){
            $error++;
        }else if(!preg_match("/^[a-zA-Z0-9]*$/",$password)){
            $error++;
        }
    } else {
        $error++;
    }  
}

function emailCheck(){
    if($email != ""){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error++;
        }
    } else {
        $error++;
    }  
}

function checkboxesCheck(){
    if($profession == ""){
        $error++;
    }
    if($gender == ""){
        $error++;
    }
    if($color == ""){
        $error++;
    }
}

// Sprzawdzenie błędów, jak nie ma to tworzyć postać, jak są to powrót do formularza

    loginCheck();
    passwordCheck();
    emailCheck();
    checkboxesCheck();

    if($error == 0){
        // Pobranie ilości graczy
        $numbersOfPlayers = "SELECT COUNT(*) AS Value FROM player";
        $numbersOfPlayersQuery = mysqli_query($connection,$numbersOfPlayers);
        if(mysqli_num_rows($numbersOfPlayersQuery)>0){
            $row = mysqli_fetch_assoc($numbersOfPlayersQuery);
            $quantity = $row['Value'];
        }
        $idNewPlayer = $quantity+1;

        $currentDate = date("Y-m-d H:i:s");
        // Player
        $playerCreate = "INSERT INTO player (`Login`, `Password`, `FirstPassword`, `Email`, `FirstEmail`, `Date`, `Level`, `Experience`, 
        `Rubins`, `Monets`, `Sound`, `Rank`) VALUES ('$login', '$password', '$password', '$email', '$email', '$currentDate', '1', '0', '0', '0', 
        'true', '1')";
        $playerCreateQuery = mysqli_query($connection, $playerCreate);
        // PlayerCharacter
        $playerCharacterCreate = "INSERT INTO playerCharacter (`Gender`, `Profesion`, `HairColor`) VALUES ('$gender', '$profesion', '$color')";
        $playerCharacterCreateQuery = mysqli_query($connection, $playerCharacterCreate);
        // PlayerMission
        $playerMissionCreate = "INSERT INTO playerMission (`Mission1`, `Mission2`, `Mission3`, `Experience1`, `Experience2`, `Experience3`,
        `Rubin1`, `Rubin2`, `Rubin3`, `Stamina1`, `Stamina2`, `Stamina3`) VALUES ('2', '3', '1', '3', '2', '4','1', '3', '2', '3', '5', '4')";
        $playerMissionCreateQuery = mysqli_query($connection, $playerMissionCreate);
        // RankingFight
        $Date = date("Y-m-d");
        $rankingFightCreate = "INSERT INTO rankingFight (`Date`, `Value`) VALUES ('$Date', '10')";
        $rankingFightCreateQuery = mysqli_query($connection, $rankingFightCreate);
        // Shop
        $date = date("Y-m-d", $currentDate-86400);
        $shopCreate = "INSERT INTO shop (`Date`) VALUES ('$date')";
        $shopCreateQuery = mysqli_query($connection, $shopCreate);
        // ShopStatistics
        for ($i=1; $i<6; $i++) {
            $shopStatisticsCreate = "INSERT INTO shopStatistics (`Player`,`Slot`) VALUES ('$idNewPlayer', '$i')";
            $shopCreateQuery = mysqli_query($connection, $shopStatisticsCreate);
        }
        // Stamina
        $staminaCreate = "INSERT INTO stamina (`FirstMission`, `Value`) VALUES ('$currentDate', '100')";
        $staminaCreateQuery = mysqli_query($connection, $staminaCreate);
        // Statistics
        $statisticsCreate = "INSERT INTO statistics (`Power`) VALUES ('50')";
        $statisticsCreateQuery = mysqli_query($connection, $statisticsCreate);
        // Backpack
        $backpackCreate = "INSERT INTO backpack (`Slot1Stat`) VALUES ('1')";
        $backpackCreateQuery = mysqli_query($connection, $backpackCreate);
        // BackpackStatistics
        for($i=1; $i<10; $i++){
            $backpacStatisticskCreate = "INSERT INTO backpackStatistics (`Player`,`Slot`) VALUES ('$idNewPlayer', '$i')";
            $backpacStatisticskCreateQuery = mysqli_query($connection, $backpacStatisticskCreate);
        }
        //CellarPlayer
        $cellarPlayerCreate = "INSERT INTO cellarPlayer (`LevelCellar1`) VALUES ('1')";
        $cellarPlayerCreateQuery = mysqli_query($connection, $cellarPlayerCreate);
        // Equipment
        $equipmentCreate = "INSERT INTO equipment (`Slot1Stat`) VALUES ('1')";
        $equipmentCreateQuery = mysqli_query($connection, $equipmentCreate);
        // EquipmentStatistics
        for($i=1; $i<9; $i++){
            $equipmentStatisticsCreate = "INSERT INTO equipmentStatistics (`Player`,`Slot`) VALUES ('$idNewPlayer', '$i')";
            $equipmentStatisticsCreateQuery = mysqli_query($connection, $equipmentStatisticsCreate);
        }

        mysqli_close($connection);

        Header("Location: ../index.php");
        exit;
    }else {
        echo "<script> console.log('coś nie tak');</script>";
        mysqli_close($connection);

        Header("Location: registration.php");
        exit;
    }

?>
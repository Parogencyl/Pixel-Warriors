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

    // pobranie daty ostatniej zmiany przedmiotów
    $selectDateShop = "SELECT shop.Date FROM shop INNER JOIN player ON player.Id=shop.IdShop WHERE player.Login='$user_check'";
    $selectDateShopQuery = mysqli_query($connection, $selectDateShop);
    if (mysqli_num_rows($selectDateShopQuery) > 0) {
        $row = mysqli_fetch_assoc($selectDateShopQuery);
        $date = $row['Date'];
    }

    $changeItems = 0;
    $changeItems = $_POST['change'];

    // Pobranie monet gracza
    $selectMonetsPlayer = "SELECT Monets FROM player WHERE player.Login='$user_check'";
    $selectMonetsPlayerQuery = mysqli_query($connection, $selectMonetsPlayer);
    if (mysqli_num_rows($selectMonetsPlayerQuery) > 0) {
        $row = mysqli_fetch_assoc($selectMonetsPlayerQuery);
        $monets = $row['Monets'];
    }
    
    //sprawdzenei daty 
    $current = date("Y-m-d");
    $currentDate = strtotime($current);
    $dateFromDatabase = strtotime($date);
    $different = $currentDate-$dateFromDatabase;

    if($different != 0 || ($changeItems == 1 && $monets >=1)){

        ///// Pobranie informacji potrzebnych do pobrania przedmiotów oraz pobranie przedmiotów

         // Profesja gracza
        $getPlayerProfesion = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
        WHERE player.Login='$user_check'"; 
        $getPlayerProfesionQuery = mysqli_query($connection, $getPlayerProfesion);
        if(mysqli_num_rows($getPlayerProfesionQuery) > 0){
            $row = mysqli_fetch_assoc($getPlayerProfesionQuery);
            $profesion = $row['Profesion'];
        }
        // Poziom gracza
        $getPlayerValue = "SELECT player.Level FROM player WHERE player.Login='$user_check'";
        $getPlayerValueQuery = mysqli_query($connection, $getPlayerValue);
        if(mysqli_num_rows($getPlayerValueQuery) > 0){
            $row = mysqli_fetch_assoc($getPlayerValueQuery);
            $level = $row['Level'];
        }

        // Wymagany exp na level
        $getExperience = "SELECT RequiredExp FROM experience 
        INNER JOIN player ON player.Level=experience.Level WHERE player.Login='$user_check'";
        $getExperienceQuery = mysqli_query($connection, $getExperience);
        if(mysqli_num_rows($getExperienceQuery) > 0){
            $row = mysqli_fetch_assoc($getExperienceQuery);
            $requiredExp = $row['RequiredExp'];
        }

        // pobranie losowych przedmiotów według poziomu
        if($level < 18){
            $getItem = "SELECT * FROM items WHERE MinLevel<'18' AND IdItem>'1' AND (Profesion='$profesion' OR Profesion='all') ORDER BY RAND() LIMIT 5";
            $getItemQuery = mysqli_query($connection, $getItem);
            if(mysqli_num_rows($getItemQuery) > 0){
                while ($row = mysqli_fetch_assoc($getItemQuery)) {
                    $itemSource[] = $row['Source'];
                    $itemName[] = $row['Name'];
                    $typeItem[] = $row['Type'];
                    $itemId[] = $row['IdItem'];
                }
            } else {
                echo "<script> console.log('Nie dropi itemka')</script>";
            }
        } else if($level < 36 && $level >= 18){
            $getItem = "SELECT * FROM items WHERE MinLevel<'36' AND MinLevel>='10' AND IdItem>'1' AND (Profesion='$profesion' OR Profesion='all') ORDER BY RAND() LIMIT 5";
            $getItemQuery = mysqli_query($connection, $getItem);
            if(mysqli_num_rows($getItemQuery) > 0){
                while ($row = mysqli_fetch_assoc($getItemQuery)) {
                    $itemSource[] = $row['Source'];
                    $itemName[]= $row['Name'];
                    $typeItem[] = $row['Type'];
                    $itemId[] = $row['IdItem'];
                }
            } else {
                echo "<script> console.log('Nie dropi itemka')</script>";
            }
        }else if($level >= 36){
            $getItem = "SELECT * FROM items WHERE MinLevel<='62' AND MinLevel>='24' AND (Profesion='$profesion' OR Profesion='all') ORDER BY RAND() LIMIT 5";
            $getItemQuery = mysqli_query($connection, $getItem);
            if(mysqli_num_rows($getItemQuery) > 0){
                while ($row = mysqli_fetch_assoc($getItemQuery)) {
                    $itemSource[] = $row['Source'];
                    $itemName[] = $row['Name'];
                    $typeItem[] = $row['Type'];
                    $itemId[] = $row['IdItem'];
                }
            } else {
                echo "<script> console.log('Nie dropi itemka')</script>";
            }
        }

        $source1 = $itemSource[0];
        $source2 = $itemSource[1];
        $source3 = $itemSource[2];
        $source4 = $itemSource[3];
        $source5 = $itemSource[4];

        // Pobranie ponownie Id przedmiotów, ponieważ po losowaniu przedmiotów kolejnego dnia ustawiało złe id przemiotów
        if ($different != 0) {
            $getItem = "SELECT IdItem FROM items WHERE Source='$source1'";
            $getItemQuery = mysqli_query($connection, $getItem);
            if(mysqli_num_rows($getItemQuery) > 0){
                $row = mysqli_fetch_assoc($getItemQuery);
                    $itemId1 = $row['IdItem'];
            }
            $getItem = "SELECT IdItem FROM items WHERE Source='$source2'";
            $getItemQuery = mysqli_query($connection, $getItem);
            if(mysqli_num_rows($getItemQuery) > 0){
                $row = mysqli_fetch_assoc($getItemQuery);
                    $itemId2 = $row['IdItem'];
            }
            $getItem = "SELECT IdItem FROM items WHERE Source='$source3'";
            $getItemQuery = mysqli_query($connection, $getItem);
            if(mysqli_num_rows($getItemQuery) > 0){
                $row = mysqli_fetch_assoc($getItemQuery);
                    $itemId3 = $row['IdItem'];
            }
            $getItem = "SELECT IdItem FROM items WHERE Source='$source4'";
            $getItemQuery = mysqli_query($connection, $getItem);
            if(mysqli_num_rows($getItemQuery) > 0){
                $row = mysqli_fetch_assoc($getItemQuery);
                    $itemId4 = $row['IdItem'];
            }
            $getItem = "SELECT IdItem FROM items WHERE Source='$source5'";
            $getItemQuery = mysqli_query($connection, $getItem);
            if(mysqli_num_rows($getItemQuery) > 0){
                $row = mysqli_fetch_assoc($getItemQuery);
                    $itemId5 = $row['IdItem'];
            }
            $itemId[0] = $itemId1;
            $itemId[1] = $itemId2;
            $itemId[2] = $itemId3;
            $itemId[3] = $itemId4;
            $itemId[4] = $itemId5;
        }

        if ($changeItems == 1 && $monets >=1) {
            $monets -= 1;
            // ustawienie nowej ilości monet
            $setMonetsPlayer= "UPDATE player SET Monets='$monets' WHERE player.Login='$user_check'";
            $setMonetsPlayerQuery = mysqli_query($connection, $setMonetsPlayer);
        }
        // Ustawienie nowych przedmiotów w bazie
        $setNewItems = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot1Shop='$source1', Slot2Shop='$source2',
        Slot3Shop='$source3', Slot4Shop='$source4', Slot5Shop='$source5', shop.Date='$current' WHERE player.Login='$user_check'";
        $setNewItemsQuery = mysqli_query($connection, $setNewItems);

        ///// nowe statystyki dla przedmiotów
        for ($i=1; $i<6; $i++) {
            $idOfItem = $itemId[$i-1];
            $typeItem2 = $typeItem[$i-1];
            $attackItem = 0;
            $powerItem = 0;
            $intelligenceItem = 0;
            $skillItem =0;
            $healthitem = 0;
            $luckItem =0;
            $pDefenceItem =0;
            $mDefenceItem =0;
            $slotItem =1;
            $sum = 0;
            if ($profesion == "warrior") {
                if ($typeItem2 == "armor") {
                    $pDefenceItem = $requiredExp/rand((1.3*$level), (2*$level));
                    $pDefenceItem = (int)$pDefenceItem;
                    $mDefenceItem = $requiredExp/rand((3.3*$level), (4*$level));
                    $mDefenceItem = (int)$mDefenceItem;
                    $powerItem = $requiredExp/rand((0.8*$level), (1.2*$level));
                    $powerItem = (int)$powerItem;
                    $healthItem = $requiredExp/rand((0.3*$level), (0.5*$level));
                    $healthItem = (int)$healthItem;
                    $luckItem = $requiredExp/rand((1.2*$level), (2.2*$level));
                    $luckItem = (int)$luckItem;
                    $slotItem = 2;
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $intelligenceItem = (int)$intelligenceItem;
                    }
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $skillItem = (int)$skillItem;
                    }
                    $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                    $sum *= 2.6;
                    $sum = (int)$sum;
                }
                if ($typeItem2 == "legs") {
                    $pDefenceItem = $requiredExp/rand((1.4*$level), (2.3*$level));
                    $pDefenceItem = (int)$pDefenceItem;
                    $mDefenceItem = $requiredExp/rand((3.3*$level), (4*$level));
                    $mDefenceItem = (int)$mDefenceItem;
                    $powerItem = $requiredExp/rand((0.9*$level), (1.4*$level));
                    $powerItem = (int)$powerItem;
                    $healthItem = $requiredExp/rand((0.3*$level), (0.6*$level));
                    $healthItem = (int)$healthItem;
                    $luckItem = $requiredExp/rand((1.4*$level), (2.4*$level));
                    $luckItem = (int)$luckItem;
                    $slotItem = 3;
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $intelligenceItem = (int)$intelligenceItem;
                    }
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $skillItem = (int)$skillItem;
                    }
                    $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                    $sum *= 2.6;
                    $sum = (int)$sum;
                }
                if ($typeItem2 == "helmet") {
                    $pDefenceItem = $requiredExp/rand((2.3*$level), (3*$level));
                    $pDefenceItem = (int)$pDefenceItem;
                    $mDefenceItem = $requiredExp/rand((4.5*$level), (6.5*$level));
                    $mDefenceItem = (int)$mDefenceItem;
                    $powerItem = $requiredExp/rand((1.1*$level), (1.5*$level));
                    $powerItem = (int)$powerItem;
                    $healthItem = $requiredExp/rand((0.7*$level), (1.1*$level));
                    $healthItem = (int)$healthItem;
                    $luckItem = $requiredExp/rand((1.8*$level), (2.9*$level));
                    $luckItem = (int)$luckItem;
                    $slotItem = 1;
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $intelligenceItem = (int)$intelligenceItem;
                    }
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $skillItem = (int)$skillItem;
                    }
                    $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                    $sum *= 3;
                    $sum = (int)$sum;
                }
                if ($typeItem2 == "boots") {
                    $pDefenceItem = $requiredExp/rand((2.3*$level), (3*$level));
                    $pDefenceItem = (int)$pDefenceItem;
                    $mDefenceItem = $requiredExp/rand((4.5*$level), (6.5*$level));
                    $mDefenceItem = (int)$mDefenceItem;
                    $powerItem = $requiredExp/rand((1.1*$level), (1.5*$level));
                    $powerItem = (int)$powerItem;
                    $healthItem = $requiredExp/rand((0.8*$level), (1.2*$level));
                    $healthItem = (int)$healthItem;
                    $luckItem = $requiredExp/rand((1.8*$level), (3*$level));
                    $luckItem = (int)$luckItem;
                    $slotItem = 4;
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $intelligenceItem = (int)$intelligenceItem;
                    }
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $skillItem = (int)$skillItem;
                    }
                    $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                    $sum *= 2.9;
                    $sum = (int)$sum;
                }
                if ($typeItem2 == "necklace") {
                    $mDefenceItem = $requiredExp/rand((3*$level), (4*$level));
                    $mDefenceItem = (int)$mDefenceItem;
                    $powerItem = $requiredExp/rand((2.8*$level), (3.5*$level));
                    $powerItem = (int)$powerItem;
                    $healthItem = $requiredExp/rand((1.4*$level), (2.4*$level));
                    $healthItem = (int)$healthItem;
                    $luckItem = $requiredExp/rand((2*$level), (3*$level));
                    $luckItem = (int)$luckItem;
                    $slotItem = 5;
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $intelligenceItem = (int)$intelligenceItem;
                    }
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $skillItem = (int)$skillItem;
                    }
                    $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                    $sum *= 2.9;
                    $sum = (int)$sum;
                }
                if ($typeItem2 == "gloves") {
                    $pDefenceItem = $requiredExp/rand((2.7*$level), (3.8*$level));
                    $pDefenceItem = (int)$pDefenceItem;
                    $powerItem = $requiredExp/rand((2.3*$level), (3.1*$level));
                    $powerItem = (int)$powerItem;
                    $healthItem = $requiredExp/rand((1.4*$level), (2*$level));
                    $healthItem = (int)$healthItem;
                    $luckItem = $requiredExp/rand((2.9*$level), (3.6*$level));
                    $luckItem = (int)$luckItem;
                    $slotItem = 8;
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $intelligenceItem = (int)$intelligenceItem;
                    }
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $skillItem = (int)$skillItem;
                    }
                    $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                    $sum *= 2.9;
                    $sum = (int)$sum;
                }
                if ($typeItem2 == "sword") {
                    $attackItem = $requiredExp/rand((0.7*$level), (1.3*$level));
                    $attackItem = (int)$attackItem;
                    $powerItem = $requiredExp/rand((1.4*$level), (2.2*$level));
                    $powerItem = (int)$powerItem;
                    $luckItem = $requiredExp/rand((2.4*$level), (3.7*$level));
                    $luckItem = (int)$luckItem;
                    $healthItem = $requiredExp/rand((1.6*$level), (2.4*$level));
                    $healthItem = (int)$healthItem;
                    $slotItem = 6;
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $intelligenceItem = (int)$intelligenceItem;
                    }
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $skillItem = (int)$skillItem;
                    }
                    $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem + $$attackItem;
                    $sum *= 3;
                    $sum = (int)$sum;
                }
                if ($typeItem2 == "shield") {
                    $pDefenceItem = $requiredExp/rand((1.7*$level), (2.7*$level));
                    $pDefenceItem = (int)$pDefenceItem;
                    $mDefenceItem = $requiredExp/rand((3.5*$level), (4.5*$level));
                    $mDefenceItem = (int)$mDefenceItem;
                    $healthItem = $requiredExp/rand((0.7*$level), (1.4*$level));
                    $healthItem = (int)$healthItem;
                    $powerItem = $requiredExp/rand((1.7*$level), (2.1*$level));
                    $powerItem = (int)$powerItem;
                    $luckItem = $requiredExp/rand((2.8*$level), (4*$level));
                    $luckItem = (int)$luckItem;
                    $slotItem = 7;
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $intelligenceItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $intelligenceItem = (int)$intelligenceItem;
                    }
                    $lotery = rand(1, 100);
                    if ($lotery>70) {
                        $skillItem = $requiredExp/rand((3.5*$level), (5*$level));
                        $skillItem = (int)$skillItem;
                    }
                    $sum = $pDefenceItem + $mDefenceItem + $powerItem + $healthItem + $luckItem + $intelligenceItem + $skillItem;
                    $sum *= 2.9;
                    $sum = (int)$sum;
                }
            }
            // Ustawienie nowych statystyk
            $setNewItemsStats = "UPDATE shopStatistics INNER JOIN player ON player.Id=shopStatistics.Player SET Attack='$attackItem', 
            Power='$powerItem', Intelligence='$intelligenceItem', Skill='$skillItem', Health='$healthItem', Luck='$luckItem', 
            PhysicDefence='$pDefenceItem', MagicDefence='$mDefenceItem', Price='$sum', ItemId='$idOfItem' WHERE player.Login='$user_check' 
            AND Slot='$i'";
            $setNewItemsStatsQuery = mysqli_query($connection, $setNewItemsStats);
        }
    
    }else {
        $monets = -1;
    }


?>

<script>
    var changeItems = "<?php echo $changeItems ?>";
    var monets = "<?php echo $monets ?>";
    var different = "<?php echo $different ?>";

    if(different != 0 || (changeItems == 1 && monets >=0)){
        $(document).ready(function(){
            $("#itemName").load("../php/sklep/shopTooltips.php");
        });
        $(document).ready(function(){
            $("#itemName").load("../php/sklep/getShopItems.php");
        });
        $(document).ready(function(){
            $("#itemName").load("../php/sklep/menuItemShop.php");
        });
        $(document).ready(function(){
            $("#itemName").load("../php/sklep/compareItemsShop.php");
        });
        if (changeItems == 1 && monets >=0) {
            document.getElementById("monet").innerHTML = "<img src='../projekt_grafika/Inne/money.png'> "+ monets;
        }
    } else if(changeItems == 1 && monets == -1){
        document.getElementById("newItemsButton").style.color = "red";
        function change(){
            document.getElementById("newItemsButton").style.color = "#b63b03";
        }
        setTimeout("change();", 1000);
    }

</script>
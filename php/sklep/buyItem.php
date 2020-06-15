
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

    $number = $_POST['whichItem'];

    // Pobranie statystyk przedmiotu
    $selectSlotsShop2 = "SELECT * FROM shopStatistics INNER JOIN player ON player.Id=shopStatistics.Player 
    INNER JOIN items ON items.IdItem=shopStatistics.ItemId WHERE player.Login='$user_check' AND shopStatistics.Slot='$number'";
    $selectSlotsShopQuery2 = mysqli_query($connection, $selectSlotsShop2);
    if(mysqli_num_rows($selectSlotsShopQuery2) > 0){
        $row = mysqli_fetch_assoc($selectSlotsShopQuery2);
        $slotShop = $row['Slot'];
        $attack2Shop = $row['Attack'];
        $health2Shop = $row['Health'];
        $power2Shop = $row['Power'];
        $intelligence2Shop = $row['Intelligence'];
        $skill2Shop = $row['Skill'];
        $pDefence2Shop = $row['PhysicDefence'];
        $mDefence2Shop = $row['MagicDefence'];
        $luck2Shop = $row['Luck'];
        $itemIdShop = $row['ItemId'];
        $priceShop = $row['Price'];
        $sourceShop = $row['Source'];
    }else {
        echo "Empty backpackStatistics";
    }

    // Pobranie kasy gracza i ustawienie nowej kasy
    $selectRubins = "SELECT Rubins FROM player WHERE player.Login='$user_check'";
    $selectRubinsQuery = mysqli_query($connection, $selectRubins);
    if (mysqli_num_rows($selectRubinsQuery) > 0) {
        $row = mysqli_fetch_assoc($selectRubinsQuery);
            $rubins = $row['Rubins'];
    }

    $rubins -= $priceShop;

    $updateRubin = "UPDATE player SET Rubins='$rubins' WHERE player.Login='$user_check'";
    $updateRubin = mysqli_query($connection, $updateRubin);

    $selectSlotsShop = "SELECT * FROM backpack INNER JOIN player ON player.Id=backpack.IdBackpack WHERE player.Login='$user_check'";
    $selectSlotsShopQuery = mysqli_query($connection, $selectSlotsShop);
    if(mysqli_num_rows($selectSlotsShopQuery) > 0){
        $row = mysqli_fetch_assoc($selectSlotsShopQuery);
        $slot1 = $row['Slot1'];
        $slot2 = $row['Slot2'];
        $slot3 = $row['Slot3'];
        $slot4 = $row['Slot4'];
        $slot5 = $row['Slot5'];
        $slot6 = $row['Slot6'];
        $slot7 = $row['Slot7'];
        $slot8 = $row['Slot8'];
        $slot9 = $row['Slot9'];
    }else {
        echo "Empty equipment";
    }

    for($i=1; $i<10; $i++){
        if($row['Slot'.$i] == "../Przedmioty/Ramka_Gif.gif"){
            break;
        }
    }
    
    $priceShop *= 0.8;

    $setStatBp = "UPDATE backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player SET Health='$health2Shop',
    Attack='$attack2Shop', Power='$power2Shop', Intelligence='$intelligence2Shop', Skill='$skill2Shop', Luck='$luck2Shop', 
    PhysicDefence='$pDefence2Shop', MagicDefence='$mDefence2Shop', ItemId='$itemIdShop', Price='$priceShop' 
    WHERE player.Login='$user_check' AND Slot='$i'";
    $setStatEqQuery = mysqli_query($connection, $setStatBp);

    $setImageBp = "UPDATE backpack INNER JOIN player ON player.Id=backpack.IdBackpack SET Slot$i='$sourceShop'
    WHERE player.Login='$user_check'";
    $setImageBpQuery = mysqli_query($connection, $setImageBp);
    

    // Wyczyszczenie statystyk w slocie, po kupieniu przedmiotu
    if($number == 1){
        $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot1Shop='../Przedmioty/Ramka_Gif.gif' 
        WHERE player.Login='$user_check'";
        $setImageShopQuery = mysqli_query($connection, $setImageShop);
    } else if($number == 2){
        $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot2Shop='../Przedmioty/Ramka_Gif.gif' 
        WHERE player.Login='$user_check'";
        $setImageShopQuery = mysqli_query($connection, $setImageShop);
    } else if($number == 3){
        $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot3Shop='../Przedmioty/Ramka_Gif.gif' 
        WHERE player.Login='$user_check'";
        $setImageShopQuery = mysqli_query($connection, $setImageShop);
    } else if($number == 4){
        $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot4Shop='../Przedmioty/Ramka_Gif.gif' 
        WHERE player.Login='$user_check'";
        $setImageShopQuery = mysqli_query($connection, $setImageShop);
    } else if($number == 5){
        $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot5Shop='../Przedmioty/Ramka_Gif.gif' 
        WHERE player.Login='$user_check'";
        $setImageShopQuery = mysqli_query($connection, $setImageShop);
    }

    $setStatShop = "UPDATE shopStatistics INNER JOIN player ON player.Id=shopStatistics.Player SET Health='0',
    Attack='0', Power='0', Intelligence='0', Skill='0', Luck='0', PhysicDefence='0', MagicDefence='0', ItemId='1', Price='0' 
    WHERE player.Login='$user_check' AND Slot='$slotShop'";
    $setStatEqQuery = mysqli_query($connection, $setStatShop);

/*
    ////////////// Ustawienie nowego przemiotu ////////////

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
        $getItem = "SELECT * FROM items WHERE MinLevel<'18' AND IdItem>'1' AND (Profesion='$profesion' OR Profesion='all') ORDER BY RAND() LIMIT 1";
        $getItemQuery = mysqli_query($connection, $getItem);
        if(mysqli_num_rows($getItemQuery) > 0){
            $row = mysqli_fetch_assoc($getItemQuery);
            $itemSource = $row['Source'];
            $itemName = $row['Name'];
            $typeItem = $row['Type'];
            $itemId = $row['IdItem'];
        } else {
            echo "<script> console.log('Nie dropi itemka')</script>";
        }
    } else if($level < 36 && $level >= 18){
        $getItem = "SELECT * FROM items WHERE MinLevel<'36' AND MinLevel>='10' AND IdItem>'1' AND (Profesion='$profesion' OR Profesion='all') ORDER BY RAND() LIMIT 1";
        $getItemQuery = mysqli_query($connection, $getItem);
        if(mysqli_num_rows($getItemQuery) > 0){
            $row = mysqli_fetch_assoc($getItemQuery);
            $itemSource = $row['Source'];
            $itemName = $row['Name'];
            $typeItem = $row['Type'];
            $itemId = $row['IdItem'];
        } else {
            echo "<script> console.log('Nie dropi itemka')</script>";
        }
    }else if($level >= 36){
        $getItem = "SELECT * FROM items WHERE MinLevel<='62' AND MinLevel>='24' AND (Profesion='$profesion' OR Profesion='all') ORDER BY RAND() LIMIT 1";
        $getItemQuery = mysqli_query($connection, $getItem);
        if(mysqli_num_rows($getItemQuery) > 0){
            $row = mysqli_fetch_assoc($getItemQuery);
            $itemSource = $row['Source'];
            $itemName = $row['Name'];
            $typeItem = $row['Type'];
            $itemId = $row['IdItem'];
        } else {
            echo "<script> console.log('Nie dropi itemka')</script>";
        }
    }
    
    // nowe statystyki dla przedmiotu
        $idOfItem = $itemId;
        $typeItem2 = $typeItem;
        //echo "<script> console.log('Id: ".$idOfItem."')</script>";
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
                $sum *= 2.2;
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
                $sum *= 2.2;
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
                $sum *= 2.7;
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
                $sum *= 2.7;
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
                $sum *= 2.7;
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
                $sum *= 2.7;
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
                $sum *= 2.7;
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
                $sum *= 2.7;
                $sum = (int)$sum;
            }
        
        // Ustawienie nowych statystyk
        $setNewItemsStats = "UPDATE shopStatistics INNER JOIN player ON player.Id=shopStatistics.Player SET Attack='$attackItem', 
        Power='$powerItem', Intelligence='$intelligenceItem', Skill='$skillItem', Health='$healthItem', Luck='$luckItem', 
        PhysicDefence='$pDefenceItem', MagicDefence='$mDefenceItem', Price='$sum', ItemId='$idOfItem' WHERE player.Login='$user_check' 
        AND Slot='$number'";
        $setNewItemsStatsQuery = mysqli_query($connection, $setNewItemsStats);

        // Ustawienie nowego przedmiotu w bazie
        if($number == 1){
            $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot1Shop='$itemSource' WHERE player.Login='$user_check'";
            $setImageShopQuery = mysqli_query($connection, $setImageShop);
        } else if($number == 2){
            $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot2Shop='$itemSource' WHERE player.Login='$user_check'";
            $setImageShopQuery = mysqli_query($connection, $setImageShop);
        } else if($number == 3){
            $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot3Shop='$itemSource' WHERE player.Login='$user_check'";
            $setImageShopQuery = mysqli_query($connection, $setImageShop);
        } else if($number == 4){
            $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot4Shop='$itemSource' WHERE player.Login='$user_check'";
            $setImageShopQuery = mysqli_query($connection, $setImageShop);
        } else if($number == 5){
            $setImageShop = "UPDATE shop INNER JOIN player ON player.Id=shop.IdShop SET Slot5Shop='$itemSource' WHERE player.Login='$user_check'";
            $setImageShopQuery = mysqli_query($connection, $setImageShop);
        }
        
    }

    */
    
?>

<script>

    var number = "<?php echo $number ?>";
    var rubins = "<?php echo $rubins ?>";


    $(document).ready(function(){
        $("#itemName").load("../php/sklep/shopTooltips.php");
    });

    $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/eqTooltips.php");
    });

    $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/getBackpack.php");
    });

    $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/menuItem.php");
    });

    $(document).ready(function(){
        $("#itemName").load("../php/sklep/getShopItems.php");
    });

    $(document).ready(function(){
        $("#itemName").load("../php/sklep/menuItemShop.php");
    });

    document.querySelector('#toolsShop' + number).style.visibility = 'hidden';
    document.querySelector('#rubin').innerHTML = "<img src='../projekt_grafika/Inne/rubin.gif'>" + rubins;


</script>
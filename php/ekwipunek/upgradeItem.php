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

     //Statystyki Bp
    $selectSlots3 = "SELECT * FROM backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player 
    INNER JOIN items ON items.IdItem=backpackStatistics.ItemId WHERE player.Login='$user_check' AND backpackStatistics.Slot='$number'";
    $getSlots3 = mysqli_query($connection, $selectSlots3);
    if(mysqli_num_rows($getSlots3) > 0){
        $row = mysqli_fetch_assoc($getSlots3);
            $slotBp = $row['Slot'];
            $attackBp = $row['Attack'];
            $healthBp = $row['Health'];
            $power2Bp = $row['Power'];
            $intelligenceBp = $row['Intelligence'];
            $skillBp = $row['Skill'];
            $pDefenceBp = $row['PhysicDefence'];
            $mDefenceBp = $row['MagicDefence'];
            $luckBp = $row['Luck'];
            $improvmentBp = $row['Improvment'];
            $itemIdBp = $row['ItemId'];
            $nameBp = $row['Name'];
            $priceBp = $row['Price'];
    }else {
        echo "Empty backpackStatistics";
    }

    $selectRubins = "SELECT Rubins, Monets FROM player WHERE player.Login='$user_check'";
    $selectRubinsQuery = mysqli_query($connection, $selectRubins);
    if (mysqli_num_rows($selectRubinsQuery) > 0) {
        $row = mysqli_fetch_assoc($selectRubinsQuery);
            $rubins = $row['Rubins'];
            $monets = $row['Monets'];
    }

    // statystyki gracza
    $getStats = "SELECT * FROM statistics INNER JOIN player ON player.Id=statistics.Id WHERE player.Login='$user_check'";
   $getStatsQuery = mysqli_query($connection, $getStats);
   if(mysqli_num_rows($getStatsQuery) > 0){
       $row = mysqli_fetch_assoc($getStatsQuery);
       $power = $row['Power'];
       $intelligence = $row['Intelligence'];
       $skill = $row['Skill'];
       $health = $row['Health'];
       $luck = $row['Luck'];
       $physicDefence = $row['PhysicDefence'];
       $magicDefence = $row['MagicDefence'];
   }

   if(($improvmentBp < 5 && $rubins >= $priceBp) || ($improvmentBp == 6 && $monets >= 3) || ($improvmentBp == 5 && $monets >= 1)){   
       
        // zwiększenie statystyk gracza
        $power += ($power2Bp*1.1 - $power2Bp);
        $intelligence += ($intelligenceBp*1.1 - $intelligenceBp);
        $skill += ($skillBp*1.1 - $skillBp);
        $health += ($healthBp*1.1 - $healthBp);
        $luck += ($luckBp*1.1 - $luckBp);
        $physicDefence += ($pDefenceBp*1.1 - $pDefenceBp);
        $magicDefence += ($mDefenceBp*1.1 - $mDefenceBp);

        $setItemsStats = "UPDATE statistics INNER JOIN player ON player.Id=statistics.Id  SET  Health='$health', Power='$power', 
        Intelligence='$intelligence', Skill='$skill', Luck='$luck', PhysicDefence='$physicDefence', MagicDefence='$magicDefence'
        WHERE player.Login='$user_check'";
        $setItemsQuery = mysqli_query($connection, $setItemsStats);

        // zwiększenie statystk przedmiotu    
        $attackBp *= 1.1;
        $healthBp *= 1.1;
        $power2Bp *= 1.1;
        $intelligenceBp *= 1.1;
        $skillBp *= 1.1;
        $pDefenceBp *= 1.1;
        $mDefenceBp *= 1.1;
        $luckBp *= 1.1;
        $improvmentBp +=1;
        $priceBp *= 1.1;

        $setItemsStats = "UPDATE backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player  SET Attack='$attackBp', 
        Health='$healthBp', Power='$power2Bp', Intelligence='$intelligenceBp', Skill='$skillBp', Luck='$luckBp', PhysicDefence='$pDefenceBp',
        MagicDefence='$mDefenceBp', Improvment='$improvmentBp', Price='$priceBp' WHERE player.Login='$user_check' 
        AND backpackStatistics.Slot='$number'";
        $setItemsQuery = mysqli_query($connection, $setItemsStats);


        // zmniejszenie ilości rubinów oraz monet
        if($improvmentBp <5){
            $priceBp *= 1.3;
            $rubins -= (int)$priceBp;
            $setItemsStats = "UPDATE player SET Rubins='$rubins' WHERE player.Login='$user_check'";
            $setItemsQuery = mysqli_query($connection, $setItemsStats);
        } if($improvmentBp == 6) {
            $monets -= 1;
            $setItemsStats = "UPDATE player SET Monets='$monets' WHERE player.Login='$user_check'";
            $setItemsQuery = mysqli_query($connection, $setItemsStats);
        } if($improvmentBp == 7) {
            $monets -= 3;
            $setItemsStats = "UPDATE player SET Monets='$monets' WHERE player.Login='$user_check'";
            $setItemsQuery = mysqli_query($connection, $setItemsStats);
        }
        

   }
   mysqli_close($connection);
?>

<script>

    improvment = "<?php echo $improvmentBp ?>";
    price = "<?php echo $priceBp ?>";
    rubins = "<?php echo $rubins ?>";
    monets = "<?php echo $monets ?>";
    number = "<?php echo $number ?>";
    priceMonets = "<?php echo $priceMonets ?>";

    document.getElementById("rubin").innerHTML = "<img src='../projekt_grafika/Inne/rubin.gif'> "+rubins;
    document.getElementById("monet").innerHTML = "<img src='../projekt_grafika/Inne/money.png'> "+monets;

    $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/eqTooltips.php");
    });
    $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/menuItem.php");
    });

    if(price > rubins || improvment == 7){
        document.querySelector('.tooltipItem' + number+ 'Eq').style.visibility = 'hidden';
        document.getElementById('tools'+number).style.visibility = 'hidden'; 
    }

</script>
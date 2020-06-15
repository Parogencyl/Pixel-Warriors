<?php
 include '../../session.php';

// EQ
$selectSlots = "SELECT equipment.slot1, equipment.slot2, equipment.slot3, equipment.slot4, equipment.slot5, equipment.slot6,
equipment.slot7, equipment.slot8 FROM equipment INNER JOIN player ON player.Id=equipment.IdEquipment WHERE player.Login='$user_check'";
$getSlots = mysqli_query($connection, $selectSlots);
if (mysqli_num_rows($getSlots) > 0) {
    $row = mysqli_fetch_assoc($getSlots);
    $slot1 = $row['slot1'];
    $slot2 = $row['slot2'];
    $slot3 = $row['slot3'];
    $slot4 = $row['slot4'];
    $slot5 = $row['slot5'];
    $slot6 = $row['slot6'];
    $slot7 = $row['slot7'];
    $slot8 = $row['slot8'];
} else {
    echo "Empty database";
}

// BP

$selectSlotsBp = "SELECT backpack.slot1, backpack.slot2, backpack.slot3, backpack.slot4, backpack.slot5, backpack.slot6,
     backpack.slot7, backpack.slot8, backpack.slot9 FROM backpack INNER JOIN player ON player.Id=backpack.IdBackpack WHERE player.Login='$user_check'";
    $getSlotsBp = mysqli_query($connection, $selectSlotsBp);
    if (mysqli_num_rows($getSlotsBp) > 0) {
        $rowBp = mysqli_fetch_assoc($getSlotsBp);
        $slotBp1 = $rowBp['slot1'];
        $slotBp2 = $rowBp['slot2'];
        $slotBp3 = $rowBp['slot3'];
        $slotBp4 = $rowBp['slot4'];
        $slotBp5 = $rowBp['slot5'];
        $slotBp6 = $rowBp['slot6'];
        $slotBp7 = $rowBp['slot7'];
        $slotBp8 = $rowBp['slot8'];
        $slotBp9 = $rowBp['slot9'];
    } else {
        echo "Empty database";
    }

    // Pobranie statystyk przedmiotu w Bp
    $selectSlots = "SELECT * FROM backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player WHERE player.Login='$user_check'";
    $getSlots = mysqli_query($connection, $selectSlots);
    if(mysqli_num_rows($getSlots) > 0){
        while ($rowStat = mysqli_fetch_assoc($getSlots)) {
            $slot[] = $rowStat['Slot'];
            $attack[] = $rowStat['Attack'];
            $health[] = $rowStat['Health'];
            $power[] = $rowStat['Power'];
            $intelligence[] = $rowStat['Intelligence'];
            $skill[] = $rowStat['Skill'];
            $pDefence[] = $rowStat['PhysicDefence'];
            $mDefence[] = $rowStat['MagicDefence'];
            $luck[] = $rowStat['Luck'];
            $improvment[] = $rowStat['Improvment'];
            $itemId[] = $rowStat['ItemId'];
            $price[] = $rowStat['Price'];
        }
    }else {
        echo "Empty backpackStatistics Put";
    }

    $number = $_POST['number'];

    // Aktualizacja eq po zdjęciu
    if ($row['slot5'] == "../Przedmioty/Ramka_Gif.gif") {
        $itemSlot = $rowBp['slot'.$number];
        $updateEq = "UPDATE equipment INNER JOIN player ON player.Id=equipment.IdEquipment SET equipment.Slot5='$itemSlot' WHERE player.Login='$user_check'";
        $getSlotsEq = mysqli_query($connection, $updateEq);

        $slotNumber = $number;
            $attack = $attack[$number-1];
            $power = $power[$number-1];
            $intelligence = $intelligence[$number-1];
            $skill = $skill[$number-1];
            $health = $health[$number-1];
            $luck = $luck[$number-1];
            $pDefence = $pDefence[$number-1];
            $mDefence = $mDefence[$number-1];            
            $improvment = $improvment[$number-1];  
            $itemId = $itemId[$number-1];   
            $price = $price[$number-1];

            $setStatEq = "UPDATE equipmentStatistics INNER JOIN player ON player.Id=equipmentStatistics.Player SET Health='$health',
            Attack='$attack', Power='$power', Intelligence='$intelligence', Skill='$skill', Luck='$luck', PhysicDefence='$pDefence',
            MagicDefence='$mDefence', Improvment='$improvment', ItemId='$itemId', Price='$price' WHERE player.Login='$user_check' AND Slot='5'";
            $setStatBpQuery = mysqli_query($connection, $setStatEq);
    }

    // Aktualizacja plecaka po zdjęciu
    
    if ($rowBp['slot'.$number] != "../Przedmioty/Ramka_Gif.gif") {
        $dropItem = "UPDATE backpack INNER JOIN player ON player.Id=backpack.IdBackpack SET backpack.Slot$number='../Przedmioty/Ramka_Gif.gif' WHERE player.Login='$user_check'";
       $getSlotsBp = mysqli_query($connection, $dropItem);

       $setStatBp = "UPDATE backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player SET Health='0',
        Attack='0', Power='0', Intelligence='0', Skill='0', Luck='0', PhysicDefence='0',
        MagicDefence='0', Improvment='0', ItemId='1', Price='0'  WHERE player.Login='$user_check' AND Slot='$number'";
        $setStatEqQuery = mysqli_query($connection, $setStatBp);
   }

   /////////////////////  Aktualizacja statystyk gracza  ////////////////////////

   // Pobranie statystyk gracza
   $selectStatPlayer = "SELECT * FROM statistics INNER JOIN player ON player.Id=statistics.Id WHERE player.Login='$user_check'";
   $selectStatPlayerQuery = mysqli_query($connection, $selectStatPlayer);
   if(mysqli_num_rows($selectStatPlayerQuery) > 0){
        $row = mysqli_fetch_assoc($selectStatPlayerQuery);
           $powerPlayer = $row['Power'];
           $intelligencePlayer = $row['Intelligence'];
           $skillPlayer = $row['Skill'];
           $healthPlayer = $row['Health'];
           $luckPlayer = $row['Luck'];
           $pDefencePlayer = $row['PhysicDefence'];
           $mDefencev = $row['MagicDefence'];
   }else {
       echo "Empty Statistics";
   }

   //Ustawienie nowych statystyk gracza

    $powerPlayer += $power;
    $intelligencePlayer += $intelligence;
    $skillPlayer += $skill;
    $healthPlayer += $health;
    $luckPlayer += $luck;
    $pDefencePlayer += $pDefence;
    $mDefencev += $mDefence;

    $setStatPlayer = "UPDATE statistics INNER JOIN player ON player.Id=statistics.Id SET Health='$healthPlayer', Power='$powerPlayer', 
    Intelligence='$intelligencePlayer', Skill='$skillPlayer', Luck='$luckPlayer', PhysicDefence='$pDefencePlayer',
    MagicDefence='$mDefencev' WHERE player.Login='$user_check'";
    $setStatPlayerQuery = mysqli_query($connection, $setStatPlayer);

mysqli_close($connection);
?>

<script>

    $(document).ready(function(){
        if($("#itemName").load("../php/ekwipunek/eqTooltips.php")){
        }
    });

    $(document).ready(function(){
        $("#itemName").load("../php/statystyki/itemTooltips.php");
    });

</script>
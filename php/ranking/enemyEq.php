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

    $numberEnemy = $_POST['numberEnemy'];

   // Pobranie profesji, płci, koloru włosów
   $getPlayerCharacter = "SELECT Gender, Profesion, HairColor FROM playerCharacter 
   INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter WHERE player.Id='$numberEnemy'";
   $getPlayerCharacterQuery = mysqli_query($connection, $getPlayerCharacter);
   if(mysqli_num_rows($getPlayerCharacterQuery) > 0){
       $row = mysqli_fetch_assoc($getPlayerCharacterQuery);
       $genderEnemy = $row['Gender'];
       $profesionEnemy = $row['Profesion'];
       $hairColorEnemy = $row['HairColor'];
   }
   // Pobranie przedmiotów gracza
   $getPlayerEquipment2 = "SELECT equipment.Slot1, equipment.Slot2, equipment.Slot3, equipment.Slot4, equipment.Slot6, 
   equipment.Slot7, equipment.Slot8 FROM equipment INNER JOIN player ON player.Id=equipment.IdEquipment WHERE player.Id='$numberEnemy'";
   $getPlayerEquipmentQuery2 = mysqli_query($connection, $getPlayerEquipment2);
   if(mysqli_num_rows($getPlayerEquipmentQuery2) > 0){
       $row = mysqli_fetch_assoc($getPlayerEquipmentQuery2);
       $helmetEnemy = $row['Slot1'];
       $armorEnemy = $row['Slot2'];
       $legsEnemy = $row['Slot3'];
       $bootsEnemy = $row['Slot4'];
       $swordEnemy = $row['Slot6'];
       $shieldEnemy = $row['Slot7'];
       $glovesEnemy = $row['Slot8'];
   }else {
        echo "<script> console.log('Mission-character-eq')</script>";
   }

    mysqli_close($connection);
?>

<script>

   var genderEnemy2 = "<?php echo $genderEnemy ?>";
   var profesionEnemy2 = "<?php echo $profesionEnemy ?>";
   var hairColorEnemy2 = "<?php echo $hairColorEnemy ?>";

   var helmetEnemy = "<?php echo $helmetEnemy ?>";
   var armorEnemy = "<?php echo $armorEnemy ?>";
   var legsEnemy = "<?php echo $legsEnemy ?>";
   var bootsEnemy = "<?php echo $bootsEnemy ?>";
   var swordEnemy = "<?php echo $swordEnemy ?>";
   var shieldEnemy = "<?php echo $shieldEnemy ?>";
   var glovesEnemy = "<?php echo $glovesEnemy ?>";

   // ustawienie obrazka gracza
   if(profesionEnemy2 == "warrior"){
       if(genderEnemy2 == "male"){
           if(hairColorEnemy2 == "brown"){
                document.getElementById("enemy").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Brązowy.gif')";
           } else if(hairColorEnemy2 == "black"){
                document.getElementById("enemy").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Czarny.gif')";
           } else if(hairColorEnemy2 == "blond"){
                document.getElementById("enemy").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Blond.gif')";
           }
       } else if(genderEnemy2 == "female"){
            if(hairColorEnemy2 == "brown"){
                    document.getElementById("enemy").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_kobieta_Brązowy.gif')";
            } else if(hairColorEnemy2 == "black"){
                    document.getElementById("enemy").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_kobieta_Czarny.gif')";
            } else if(hairColorEnemy2 == "blond"){
                    document.getElementById("enemy").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_kobieta_Blond.gif')";
            }
       }
   }

   if(helmetEnemy != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("helmetCharacterEnemy").style.backgroundImage = "url('"+helmetEnemy+"')";
   }
   if(armorEnemy != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("armorCharacterEnemy").style.backgroundImage = "url('"+armorEnemy+"')";
   }
   if(legsEnemy != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("legsCharacterEnemy").style.backgroundImage = "url('"+legsEnemy+"')";
   }
   if(bootsEnemy != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("bootsCharacterEnemy").style.backgroundImage = "url('"+bootsEnemy+"')";
   }
   if(swordEnemy != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("atackEnemy").style.backgroundImage = "url('"+swordEnemy+"')";
    document.getElementById("swordCharacterEnemy").style.backgroundImage = "url('"+swordEnemy+"')";
   } else {
        document.getElementById("atackEnemy").style.backgroundImage = "url('../Przedmioty/PalceNatural.gif')";
        document.getElementById("atackEnemy").style.width = "8%";
        document.getElementById("atackEnemy").style.height = "13%";
   }
   if(shieldEnemy != "../Przedmioty/Ramka_Gif.gif"){
    switch (shieldEnemy){
        case "../Przedmioty/Tarcza1_Pusty_Gif.gif":
            document.getElementById("enemyBlock").style.backgroundImage = "url('"+shieldEnemy+"')";
            document.getElementById("shieldCharacterEnemy").style.backgroundImage = 'url("../Przedmioty/Tarcza1_Postać_Pusty_Gif.gif")';
            break;
        case "../Przedmioty/Tarcza2_Pusty_Gif.gif":
            document.getElementById("enemyBlock").style.backgroundImage = "url('"+shieldEnemy+"')";
            document.getElementById("shieldCharacterEnemy").style.backgroundImage = 'url("../Przedmioty/Tarcza2_Postać_Pusty_Gif.gif")';
            break;
        case "../Przedmioty/Tarcza3_Pusty_Gif.gif":
            document.getElementById("enemyBlock").style.backgroundImage = "url('"+shieldEnemy+"')"; 
            document.getElementById("shieldCharacterEnemy").style.backgroundImage = 'url("../Przedmioty/Tarcza3_Postać_Pusty_Gif.gif")';
            break;
        default:
            document.getElementById("enemyBlock").style.backgroundImage = '';
            document.getElementById("shieldCharacterEnemy").style.backgroundImage = '';
    }
   }
        if (glovesEnemy == "../Przedmioty/Rekawice1_Pusty_Gif.gif") {
            document.getElementById("gloves1CharacterEnemy").style.backgroundImage = "url('../Przedmioty/PalceBraz.gif')";
            document.getElementById("gloves2CharacterEnemy").style.backgroundImage = "url('../Przedmioty/PalceBraz.gif')";
        } else if (glovesEnemy == "../Przedmioty/Rekawice2_Pusty_Gif.gif") {
            document.getElementById("gloves1CharacterEnemy").style.backgroundImage = "url('../Przedmioty/PalceZelazo.gif')";
            document.getElementById("gloves2CharacterEnemy").style.backgroundImage = "url('../Przedmioty/PalceZelazo.gif')";
        } else if (glovesEnemy == "../Przedmioty/Rekawice3_Pusty_Gif.gif") {
            document.getElementById("gloves1CharacterEnemy").style.backgroundImage = "url('../Przedmioty/PalceGold.gif')";
            document.getElementById("gloves2CharacterEnemy").style.backgroundImage = "url('../Przedmioty/PalceGold.gif')";
        } else {
            document.getElementById("gloves1CharacterEnemy").style.backgroundImage = "url('../Przedmioty/PalceNatural.gif')";
            document.getElementById("gloves2CharacterEnemy").style.backgroundImage = "url('../Przedmioty/PalceNatural.gif')";
        }
   
</script>
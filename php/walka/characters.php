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

   // Pobranie profesji, płci, koloru włosów
   $getPlayerCharacter = "SELECT Gender, Profesion, HairColor FROM playerCharacter 
   INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter WHERE player.Login='$user_check'";
   $getPlayerCharacterQuery = mysqli_query($connection, $getPlayerCharacter);
   if(mysqli_num_rows($getPlayerCharacterQuery) > 0){
       $row = mysqli_fetch_assoc($getPlayerCharacterQuery);
       $gender = $row['Gender'];
       $profesion = $row['Profesion'];
       $hairColor = $row['HairColor'];
   }
   // Pobranie przedmiotów gracza
   $getPlayerEquipment = "SELECT equipment.Slot1, equipment.Slot2, equipment.Slot3, equipment.Slot4, equipment.Slot6, 
   equipment.Slot7, equipment.Slot8 FROM equipment INNER JOIN player ON player.Id=equipment.IdEquipment WHERE player.Login='$user_check'";
   $getPlayerEquipmentQuery = mysqli_query($connection, $getPlayerEquipment);
   if(mysqli_num_rows($getPlayerEquipmentQuery) > 0){
       $row = mysqli_fetch_assoc($getPlayerEquipmentQuery);
       $helmet = $row['Slot1'];
       $armor = $row['Slot2'];
       $legs = $row['Slot3'];
       $boots = $row['Slot4'];
       $sword = $row['Slot6'];
       $shield = $row['Slot7'];
       $gloves = $row['Slot8'];
   }else {
        echo "<script> console.log('Mission-character-eq')</script>";
   }

    mysqli_close($connection);
?>

<script>

   let gender = "<?php echo $gender ?>";
   let profesion = "<?php echo $profesion ?>";
   let hairColor = "<?php echo $hairColor ?>";

   let helmet = "<?php echo $helmet ?>";
   let armor = "<?php echo $armor ?>";
   let legs = "<?php echo $legs ?>";
   let boots = "<?php echo $boots ?>";
   let sword = "<?php echo $sword ?>";
   let shield = "<?php echo $shield ?>";
   let gloves = "<?php echo $gloves ?>";

   // ustawienie obrazka gracza
   if(profesion == "warrior"){
       if(gender == "male"){
           if(hairColor == "brown"){
                document.getElementById("knight").style.backgroundImage = "url('../../projekt_grafika/Walka/Gracz/Rycerz_Brązowy.gif')";
           } else if(hairColor == "black"){
                document.getElementById("knight").style.backgroundImage = "url('../../projekt_grafika/Walka/Gracz/Rycerz_Czarny.gif')";
           } else if(hairColor == "blond"){
                document.getElementById("knight").style.backgroundImage = "url('../../projekt_grafika/Walka/Gracz/Rycerz_Blond.gif')";
           }
       } else if(gender == "female"){
            if(hairColor == "brown"){
                    document.getElementById("knight").style.backgroundImage = "url('../../projekt_grafika/Walka/Gracz/Rycerz_kobieta_Brązowy.gif')";
            } else if(hairColor == "black"){
                    document.getElementById("knight").style.backgroundImage = "url('../../projekt_grafika/Walka/Gracz/Rycerz_kobieta_Czarny.gif')";
            } else if(hairColor == "blond"){
                    document.getElementById("knight").style.backgroundImage = "url('../../projekt_grafika/Walka/Gracz/Rycerz_kobieta_Blond.gif')";
            }
       }
   }

   if(helmet != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("helmetCharacter").style.backgroundImage = "url('../"+helmet+"')";
   }
   if(armor != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("armorCharacter").style.backgroundImage = "url('../"+armor+"')";
   }
   if(legs != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("legsCharacter").style.backgroundImage = "url('../"+legs+"')";
   }
   if(boots != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("bootsCharacter").style.backgroundImage = "url('../"+boots+"')";
   }
   if(sword != "../Przedmioty/Ramka_Gif.gif"){
    document.getElementById("atackKnight").style.backgroundImage = "url('../"+sword+"')";
    document.getElementById("swordCharacter").style.backgroundImage = "url('../"+sword+"')";
   } else {
        document.getElementById("atackKnight").style.backgroundImage = "url('../../Przedmioty/PalceNatural.gif')";
        document.getElementById("atackKnight").style.width = "8%";
        document.getElementById("atackKnight").style.height = "13%";
   }
   if(shield != "../Przedmioty/Ramka_Gif.gif"){
    switch (shield){
        case "../Przedmioty/Tarcza1_Pusty_Gif.gif":
            document.getElementById("knightBlock").style.backgroundImage = "url('../"+shield+"')";
            document.getElementById("shieldCharacter").style.backgroundImage = 'url("../../Przedmioty/Tarcza1_Postać_Pusty_Gif.gif")';
            break;
        case "../Przedmioty/Tarcza2_Pusty_Gif.gif":
            document.getElementById("knightBlock").style.backgroundImage = "url('../"+shield+"')";
            document.getElementById("shieldCharacter").style.backgroundImage = 'url("../../Przedmioty/Tarcza2_Postać_Pusty_Gif.gif")';
            break;
        case "../Przedmioty/Tarcza3_Pusty_Gif.gif":
            document.getElementById("knightBlock").style.backgroundImage = "url('../"+shield+"')"; 
            document.getElementById("shieldCharacter").style.backgroundImage = 'url("../../Przedmioty/Tarcza3_Postać_Pusty_Gif.gif")';
            break;
        default:
            document.getElementById("knightBlock").style.backgroundImage = '';
            document.getElementById("shieldCharacter").style.backgroundImage = '';
    }
   }
        if (gloves == "../Przedmioty/Rekawice1_Pusty_Gif.gif") {
            document.getElementById("gloves1Character").style.backgroundImage = "url('../../Przedmioty/PalceBraz.gif')";
            document.getElementById("gloves2Character").style.backgroundImage = "url('../../Przedmioty/PalceBraz.gif')";
        } else if (gloves == "../Przedmioty/Rekawice2_Pusty_Gif.gif") {
            document.getElementById("gloves1Character").style.backgroundImage = "url('../../Przedmioty/PalceZelazo.gif')";
            document.getElementById("gloves2Character").style.backgroundImage = "url('../../Przedmioty/PalceZelazo.gif')";
        } else if (gloves == "../Przedmioty/Rekawice3_Pusty_Gif.gif") {
            document.getElementById("gloves1Character").style.backgroundImage = "url('../../Przedmioty/PalceGold.gif')";
            document.getElementById("gloves2Character").style.backgroundImage = "url('../../Przedmioty/PalceGold.gif')";
        } else {
            document.getElementById("gloves1Character").style.backgroundImage = "url('../../Przedmioty/PalceNatural.gif')";
            document.getElementById("gloves2Character").style.backgroundImage = "url('../../Przedmioty/PalceNatural.gif')";
        }
   
</script>
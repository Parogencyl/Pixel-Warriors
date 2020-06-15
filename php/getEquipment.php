<!-- pobieranie eq z bazy -->

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

    $selectSlots = "SELECT equipment.Slot1, equipment.Slot2, equipment.Slot3, equipment.Slot4, equipment.Slot5, equipment.Slot6,
     equipment.Slot7, equipment.Slot8 FROM equipment INNER JOIN player ON player.Id=equipment.IdEquipment WHERE player.Login='$user_check'";
    $getSlots = mysqli_query($connection, $selectSlots);
    if(mysqli_num_rows($getSlots) > 0){
        $row = mysqli_fetch_assoc($getSlots);
        $slot1 = $row['Slot1'];
        $slot2 = $row['Slot2'];
        $slot3 = $row['Slot3'];
        $slot4 = $row['Slot4'];
        $slot5 = $row['Slot5'];
        $slot6 = $row['Slot6'];
        $slot7 = $row['Slot7'];
        $slot8 = $row['Slot8'];
    }else {
        echo "Empty database";
    }

   // Pobranie profesji, płci, koloru włosów
   $getPlayerCharacter = "SELECT Gender, Profesion, HairColor FROM playerCharacter 
   INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter WHERE player.Login='$user_check'";
   $getPlayerCharacterQuery = mysqli_query($connection, $getPlayerCharacter);
   if(mysqli_num_rows($getPlayerCharacterQuery) > 0){
       $row = mysqli_fetch_assoc($getPlayerCharacterQuery);
       $genderPlayer = $row['Gender'];
       $profesionPlayer = $row['Profesion'];
       $hairColorPlayer = $row['HairColor'];
   }
   
    mysqli_close($connection);
?>

<!-- wstawianie eq -->
<script>

    var gender = "<?php echo $genderPlayer ?>";
    var profesion = "<?php echo $profesionPlayer ?>";
    var hairColor = "<?php echo $hairColorPlayer ?>";
    
   // ustawienie obrazka gracza
   if(profesion == "warrior"){
       if(gender == "male"){
           if(hairColor == "brown"){
                document.getElementById("character").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Brązowy.gif')";
           } else if(hairColor == "black"){
                document.getElementById("character").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Czarny.gif')";
           } else if(hairColor == "blond"){
                document.getElementById("character").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_Blond.gif')";
           }
       } else if(gender == "female"){
            if(hairColor == "brown"){
                    document.getElementById("character").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_kobieta_Brązowy.gif')";
            } else if(hairColor == "black"){
                    document.getElementById("character").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_kobieta_Czarny.gif')";
            } else if(hairColor == "blond"){
                    document.getElementById("character").style.backgroundImage = "url('../projekt_grafika/Walka/Gracz/Rycerz_kobieta_Blond.gif')";
            }
       }
   }

let helmetSource = "<?php echo $slot1 ?>";
let helmet = document.querySelector('#helmet');
helmet.src = helmetSource;
let helmetCharacter = document.querySelector('#helmetCharacter');
if(helmetSource != "../Przedmioty/Ramka_Gif.gif"){
    helmetCharacter.style.backgroundImage = 'url("<?php echo $slot1 ?>")';
}else{
    helmetCharacter.style.backgroundImage = "";
}

let armorSource = "<?php echo $slot2 ?>";
let armor = document.querySelector('#armor');
armor.src = armorSource;
let armorCharacter = document.querySelector('#armorCharacter');
if(armorSource != "../Przedmioty/Ramka_Gif.gif"){
    armorCharacter.style.backgroundImage = 'url("<?php echo $slot2 ?>")';
}else{
    armorCharacter.style.backgroundImage = "";
}

let legsSource = "<?php echo $slot3 ?>";
let legs = document.querySelector('#legs');
legs.src = legsSource;
let legsCharacter = document.querySelector('#legsCharacter');
if(legsSource != "../Przedmioty/Ramka_Gif.gif"){
    legsCharacter.style.backgroundImage = 'url("<?php echo $slot3 ?>")';
}else{
    legsCharacter.style.backgroundImage = "";
}

let bootSource = "<?php echo $slot4 ?>";
let boot = document.querySelector('#boot');
boot.src = bootSource;
let bootCharacter = document.querySelector('#bootCharacter');
if(bootSource != "../Przedmioty/Ramka_Gif.gif"){
    bootCharacter.style.backgroundImage = 'url("<?php echo $slot4 ?>")';
}else{
    bootCharacter.style.backgroundImage = "";
}

let necklaceSource = "<?php echo $slot5 ?>";
let necklace = document.querySelector('#necklace');
necklace.src = necklaceSource;

let swordSource = "<?php echo $slot6 ?>";
let sword = document.querySelector('#sword');
sword.src = swordSource;
let swordCharacter = document.querySelector('#swordCharacter');
switch (swordSource){
    case "../Przedmioty/Miecz1_Pusty_Gif.gif":
        swordCharacter.style.backgroundImage = 'url("../Przedmioty/Miecz1_Postać_Pusty_Gif.gif")';
        break;
    case "../Przedmioty/Miecz2_Pusty_Gif.gif":
        swordCharacter.style.backgroundImage = 'url("../Przedmioty/Miecz2_Postać_Pusty_Gif.gif")';
        break;
    case "../Przedmioty/Miecz3_Pusty_Gif.gif":
        swordCharacter.style.backgroundImage = 'url("../Przedmioty/Miecz3_Postać_Pusty_Gif.gif")';
        break;
    default:
        swordCharacter.style.backgroundImage = '';
}

let shieldSource = "<?php echo $slot7 ?>";
let shield = document.querySelector('#shield');
shield.src = shieldSource;
let shieldCharacter = document.querySelector('#shieldCharacter');
switch (shieldSource){
    case "../Przedmioty/Tarcza1_Pusty_Gif.gif":
        shieldCharacter.style.backgroundImage = 'url("../Przedmioty/Tarcza1_Postać_Pusty_Gif.gif")';
        break;
    case "../Przedmioty/Tarcza2_Pusty_Gif.gif":
        shieldCharacter.style.backgroundImage = 'url("../Przedmioty/Tarcza2_Postać_Pusty_Gif.gif")';
        break;
    case "../Przedmioty/Tarcza3_Pusty_Gif.gif":
        shieldCharacter.style.backgroundImage = 'url("../Przedmioty/Tarcza3_Postać_Pusty_Gif.gif")';
        break;
    default:
    shieldCharacter.style.backgroundImage = '';
}

let glovesSource = "<?php echo $slot8 ?>";
let gloves = document.querySelector('#gloves');
gloves.src = glovesSource;
let glovesSourceCharacter;
if (glovesSource == "../Przedmioty/Rekawice1_Pusty_Gif.gif") {
    glovesSourceCharacter = 'url(../Przedmioty/PalceBraz.gif)';
} else if (glovesSource == "../Przedmioty/Rekawice2_Pusty_Gif.gif") {
    glovesSourceCharacter = 'url(../Przedmioty/PalceZelazo.gif)';
} else if (glovesSource == "../Przedmioty/Rekawice3_Pusty_Gif.gif") {
    glovesSourceCharacter = 'url(../Przedmioty/PalceGold.gif)';
} else {
    glovesSourceCharacter = 'url(../Przedmioty/PalceNatural.gif)';
}
let glovesCharacter = document.querySelector('#glovesCharacter');
glovesCharacter.style.backgroundImage = glovesSourceCharacter;

document.querySelector('.tooltipItem1').style.visibility = 'hidden';
document.querySelector('.tooltipItem2').style.visibility = 'hidden';
document.querySelector('.tooltipItem3').style.visibility = 'hidden';
document.querySelector('.tooltipItem4').style.visibility = 'hidden';
document.querySelector('.tooltipItem5').style.visibility = 'hidden';
document.querySelector('.tooltipItem6').style.visibility = 'hidden';
document.querySelector('.tooltipItem7').style.visibility = 'hidden';
document.querySelector('.tooltipItem8').style.visibility = 'hidden';


// Tooltip
function disableTooltip(name, type) {
    document.querySelector(name).style.visibility = 'visible';

    switch(type){
        case 'helmetSource':
            if (helmetSource == "../Przedmioty/Ramka_Gif.gif") {
                document.querySelector(name).style.visibility = 'hidden';
            }
            break;

        case 'armorSource':
            if (armorSource == "../Przedmioty/Ramka_Gif.gif") {
                document.querySelector(name).style.visibility = 'hidden';
            }
            break;

        case 'legsSource':
            if (legsSource == "../Przedmioty/Ramka_Gif.gif") {
                document.querySelector(name).style.visibility = 'hidden';
            }
            break;

        case 'bootSource':
            if (bootSource == "../Przedmioty/Ramka_Gif.gif") {
                document.querySelector(name).style.visibility = 'hidden';
            }
            break;
        case 'necklaceSource':
            if (necklaceSource == "../Przedmioty/Ramka_Gif.gif") {
                document.querySelector(name).style.visibility = 'hidden';
            }
            break;

        case 'swordSource':
            if (swordSource == "../Przedmioty/Ramka_Gif.gif") {
                document.querySelector(name).style.visibility = 'hidden';
            }
            break;

        case 'shieldSource':
            if (shieldSource == "../Przedmioty/Ramka_Gif.gif") {
                document.querySelector(name).style.visibility = 'hidden';
            }
            break;

        case 'glovesSource':
            if (glovesSource == "../Przedmioty/Ramka_Gif.gif") {
                document.querySelector(name).style.visibility = 'hidden';
            }
            break;
    }   
}
function enableTooltip(name) {
    document.querySelector(name).style.visibility = 'hidden';

}

</script>
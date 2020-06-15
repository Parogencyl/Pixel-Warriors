<!-- pobieranie plecaka z bazy -->

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

    $selectSlotsBp = "SELECT backpack.Slot1, backpack.Slot2, backpack.Slot3, backpack.Slot4, backpack.Slot5, backpack.Slot6,
     backpack.Slot7, backpack.Slot8, backpack.Slot9 FROM backpack INNER JOIN player ON player.Id=backpack.IdBackpack WHERE player.Login='$user_check'";
    $getSlotsBp = mysqli_query($connection, $selectSlotsBp);
    if (mysqli_num_rows($getSlotsBp) > 0) {
        $rowBp = mysqli_fetch_assoc($getSlotsBp);
        $slotBp1 = $rowBp['Slot1'];
        $slotBp2 = $rowBp['Slot2'];
        $slotBp3 = $rowBp['Slot3'];
        $slotBp4 = $rowBp['Slot4'];
        $slotBp5 = $rowBp['Slot5'];
        $slotBp6 = $rowBp['Slot6'];
        $slotBp7 = $rowBp['Slot7'];
        $slotBp8 = $rowBp['Slot8'];
        $slotBp9 = $rowBp['Slot9'];
    } else {
        echo "Empty database";
    }

    mysqli_close($connection);
?>

<script>
var itemSource1 = "<?php echo $slotBp1 ?>";
var itemSource2 = "<?php echo $slotBp2 ?>";
var itemSource3 = "<?php echo $slotBp3 ?>";
var itemSource4 = "<?php echo $slotBp4 ?>";
var itemSource5 = "<?php echo $slotBp5 ?>";
var itemSource6 = "<?php echo $slotBp6 ?>";
var itemSource7 = "<?php echo $slotBp7 ?>";
var itemSource8 = "<?php echo $slotBp8 ?>";
var itemSource9 = "<?php echo $slotBp9 ?>";

var itemSourceTable = [itemSource1, itemSource2, itemSource3, itemSource4, itemSource5, itemSource6, itemSource7, itemSource8, itemSource9];

var item1 = document.getElementById("positionItem1");
item1.src = itemSource1;
var item2 = document.getElementById("positionItem2");
item2.src = itemSource2;
var item3 = document.getElementById("positionItem3");
item3.src = itemSource3;
var item4 = document.getElementById("positionItem4");
item4.src = itemSource4;
var item5 = document.getElementById("positionItem5");
item5.src = itemSource5;
var item6 = document.getElementById("positionItem6");
item6.src = itemSource6;
var item7 = document.getElementById("positionItem7");
item7.src = itemSource7;
var item8 = document.getElementById("positionItem8");
item8.src = itemSource8;
var item9 = document.getElementById("positionItem9");
item9.src = itemSource9;

var id;
var number1, number2;

document.querySelector('.tooltipItem1Eq').style.visibility = 'hidden';
document.querySelector('.tooltipItem2Eq').style.visibility = 'hidden';
document.querySelector('.tooltipItem3Eq').style.visibility = 'hidden';
document.querySelector('.tooltipItem4Eq').style.visibility = 'hidden';
document.querySelector('.tooltipItem5Eq').style.visibility = 'hidden';
document.querySelector('.tooltipItem6Eq').style.visibility = 'hidden';
document.querySelector('.tooltipItem7Eq').style.visibility = 'hidden';
document.querySelector('.tooltipItem8Eq').style.visibility = 'hidden';
document.querySelector('.tooltipItem9Eq').style.visibility = 'hidden';


function tooltipItem1() {
    if (itemSource1 != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem1Eq').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem1Eq').style.visibility = 'hidden';
    }
}

function tooltipItem2() {
    if (itemSource2 != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem2Eq').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem2Eq').style.visibility = 'hidden';
    }
}

function tooltipItem3() {
    if (itemSource3 != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem3Eq').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem3Eq').style.visibility = 'hidden';
    }
}

function tooltipItem4() {
    if (itemSource4 != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem4Eq').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem4Eq').style.visibility = 'hidden';
    }
}

function tooltipItem5() {
    if (itemSource5 != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem5Eq').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem5Eq').style.visibility = 'hidden';
    }
}

function tooltipItem6() {
    if (itemSource6 != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem6Eq').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem6Eq').style.visibility = 'hidden';
    }
}

function tooltipItem7() {
    if (itemSource7 != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem7Eq').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem7Eq').style.visibility = 'hidden';
    }
}

function tooltipItem8() {
    if (itemSource8 != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem8Eq').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem8Eq').style.visibility = 'hidden';
    }
}

function tooltipItem9() {
    if (itemSource9 != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem9Eq').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem9Eq').style.visibility = 'hidden';
    }
}

</script>

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

    $selectSlotsShop = "SELECT * FROM shop INNER JOIN player ON player.Id=shop.IdShop WHERE player.Login='$user_check'";
    $selectSlotsShopQuery = mysqli_query($connection, $selectSlotsShop);
    if (mysqli_num_rows($selectSlotsShopQuery) > 0) {
        $row = mysqli_fetch_assoc($selectSlotsShopQuery);
        $slotShop1 = $row['Slot1Shop'];
        $slotShop2 = $row['Slot2Shop'];
        $slotShop3 = $row['Slot3Shop'];
        $slotShop4 = $row['Slot4Shop'];
        $slotShop5 = $row['Slot5Shop'];
    } else {
        echo "Empty database";
    }
?>

<script>
var itemSource1Shop = "<?php echo $slotShop1 ?>";
var itemSource2Shop = "<?php echo $slotShop2 ?>";
var itemSource3Shop = "<?php echo $slotShop3 ?>";
var itemSource4Shop = "<?php echo $slotShop4 ?>";
var itemSource5Shop = "<?php echo $slotShop5 ?>";

var item1Shop = document.getElementById("positionItem1Shop");
item1Shop.src = itemSource1Shop;
var item2Shop = document.getElementById("positionItem2Shop");
item2Shop.src = itemSource2Shop;
var item3Shop = document.getElementById("positionItem3Shop");
item3Shop.src = itemSource3Shop;
var item4Shop = document.getElementById("positionItem4Shop");
item4Shop.src = itemSource4Shop;
var item5Shop = document.getElementById("positionItem5Shop");
item5Shop.src = itemSource5Shop;

document.querySelector('.tooltipItem1Shop').style.visibility = 'hidden';
document.querySelector('.tooltipItem2Shop').style.visibility = 'hidden';
document.querySelector('.tooltipItem3Shop').style.visibility = 'hidden';
document.querySelector('.tooltipItem4Shop').style.visibility = 'hidden';
document.querySelector('.tooltipItem5Shop').style.visibility = 'hidden';


function tooltipItem1Shop() {
    if (itemSource1Shop != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem1Shop').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem1Shop').style.visibility = 'hidden';
    }
}

function tooltipItem2Shop() {
    if (itemSource2Shop != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem2Shop').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem2Shop').style.visibility = 'hidden';
    }
}

function tooltipItem3Shop() {
    if (itemSource3Shop != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem3Shop').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem3Shop').style.visibility = 'hidden';
    }
}

function tooltipItem4Shop() {
    if (itemSource4Shop != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem4Shop').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem4Shop').style.visibility = 'hidden';
    }
}

function tooltipItem5Shop() {
    if (itemSource5Shop != "../Przedmioty/Ramka_Gif.gif") {
        document.querySelector('.tooltipItem5Shop').style.visibility = 'visible';
    } else {
        document.querySelector('.tooltipItem5Shop').style.visibility = 'hidden';
    }
}


</script>
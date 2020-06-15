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

    $selectItemPrice = "SELECT Price FROM backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player 
    INNER JOIN items ON items.IdItem=backpackStatistics.ItemId WHERE player.Login='$user_check' AND backpackStatistics.Slot='$number'";
    $selectItemPriceQuery = mysqli_query($connection, $selectItemPrice);
    if (mysqli_num_rows($selectItemPriceQuery) > 0) {
        $row = mysqli_fetch_assoc($selectItemPriceQuery);
            $price = $row['Price'];
    }

    $selectRubins = "SELECT Rubins FROM player WHERE player.Login='$user_check'";
    $selectRubinsQuery = mysqli_query($connection, $selectRubins);
    if (mysqli_num_rows($selectRubinsQuery) > 0) {
        $row = mysqli_fetch_assoc($selectRubinsQuery);
            $rubins = $row['Rubins'];
    }
    $rubins += $price;

    $updateRubin = "UPDATE player SET Rubins='$rubins' WHERE player.Login='$user_check'";
    $updateRubin = mysqli_query($connection, $updateRubin);

    $setStatBp = "UPDATE backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player SET Health='0',
    Attack='0', Power='0', Intelligence='0', Skill='0', Luck='0', PhysicDefence='0',
    MagicDefence='0', Improvment='0', ItemId='1', Price='0' WHERE player.Login='$user_check' AND Slot='$number'";
    $setStatEqQuery = mysqli_query($connection, $setStatBp);

    $setImageBp = "UPDATE backpack INNER JOIN player ON player.Id=backpack.IdBackpack SET Slot$number='../Przedmioty/Ramka_Gif.gif'
    WHERE player.Login='$user_check'";
    $setImageBpQuery = mysqli_query($connection, $setImageBp);

    mysqli_close($connection);
?>

<script>

    var numberSell = "<?php echo $number ?>";
    var rubins = "<?php echo $rubins ?>";

    document.getElementById("positionItem"+numberSell).src = "../Przedmioty/Ramka_Gif.gif";
    document.getElementById("rubin").innerHTML = "<img src='../projekt_grafika/Inne/rubin.gif'> "+rubins;
    document.getElementById('tools'+numberSell).style.visibility = 'hidden';

    document.querySelector(".tooltipItem"+numberSell+"Eq>.itemPowerStat").innerHTML = "";
    document.querySelector('.tooltipItem'+numberSell+'Eq').style.visibility = 'hidden';

   $(document).ready(function(){
        $("#itemName").load("../php/ekwipunek/getBackpack.php");
    });

    var file = window.location.href;
    if(file.search("ekwipunek.php") < 1 ){
        $(document).ready(function(){
            $("#itemName").load("../php/sklep/menuItemShop.php");
        });
    }else {
        $(document).ready(function(){
            $("#itemName").load("../php/ekwipunek/menuItem.php");
        }); 
        $(document).ready(function(){
            $("#itemName").load("../php/ekwipunek/eqTooltips.php");
        }); 
        // Wstawienie ponownie zawartości HTML, ponieważ po sprzedaniu wrzuca jakiś skrypt i w tak jest to nadpisywane
        document.getElementById("tools1").innerHTML = "<div class='upgrade' onclick='upgradeItem('1')' id='upgrade1'> Ulepsz </div>"+
                        "<hr>"+
                        "<div class='sell' onclick='sell('1')' id='sell1'> Sprzedaj </div>"+
                        "<hr>"+
                        "<div class='compare' onclick='compare('1')'> Porównaj </div>";
    }

</script>
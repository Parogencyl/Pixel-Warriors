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

    //Profesja gracza
    $selectProf = "SELECT Profesion FROM playerCharacter INNER JOIN player ON player.Id=playerCharacter.IdPlayerCharacter 
    WHERE player.Login='$user_check'";
    $selectProfQuery = mysqli_query($connection, $selectProf);
    if (mysqli_num_rows($selectProfQuery) > 0) {
        $row = mysqli_fetch_assoc($selectProfQuery);
        $profesionPlayer = $row['Profesion'];
    }
    //Statystyki Bp
    $selectSlots3 = "SELECT items.Profesion FROM backpackStatistics INNER JOIN player ON player.Id=backpackStatistics.Player 
    INNER JOIN items ON items.IdItem=backpackStatistics.ItemId WHERE player.Login='$user_check'";
    $getSlots3 = mysqli_query($connection, $selectSlots3);
    if(mysqli_num_rows($getSlots3) > 0){
        while ($row = mysqli_fetch_assoc($getSlots3)) {
            $profesionBp[] = $row['Profesion'];
        }
    }else {
        echo "Empty backpackStatistics";
    }

    mysqli_close($connection);
?>

<script>
function putItem(i) {

    // Zamkniecie wszystkich menu przedmiotów 
    for(let i=1; i<10; i++){
        document.getElementById('tools'+i).style.visibility = 'hidden';
    }

    var profesionBp = ["<?php echo $profesionBp[0] ?>", "<?php echo $profesionBp[1] ?>", "<?php echo $profesionBp[2] ?>", "<?php echo $profesionBp[3] ?>",
    "<?php echo $profesionBp[4] ?>", "<?php echo $profesionBp[5] ?>", "<?php echo $profesionBp[6] ?>", "<?php echo $profesionBp[7] ?>", "<?php echo $profesionBp[8] ?>"];

    var profesionPlayer = "<?php echo $profesionPlayer ?>";

    let something = itemSourceTable[i - 1];
    let content = itemSourceTable[i - 1];
    let howMuch = content.indexOf("_")
    id = content.slice(14, howMuch - 1);
    if (id == "Helm") {
        if(profesionPlayer == profesionBp[i-1] || "all" == profesionBp[i-1]){
            if (helmetSource == "../Przedmioty/Ramka_Gif.gif") {
                helmetSource = itemSourceTable[i - 1];
                helmet.src = itemSourceTable[i - 1];
                itemSourceTable[i - 1] = "../Przedmioty/Ramka_Gif.gif";
                helmetCharacter.style.backgroundImage = "url(" + helmet.src + ")";

                $(document).ready(function(){
                    $("#helmet").load("../php/ekwipunek/put_items/put1.php", {number:i});
                });
            }
        }
    }
    if (id == "Zbroja") {
        if(profesionPlayer == profesionBp[i-1] || "all" == profesionBp[i-1]){
            if (armorSource == "../Przedmioty/Ramka_Gif.gif") {
                armorSource = itemSourceTable[i - 1];
                armor.src = itemSourceTable[i - 1];
                itemSourceTable[i - 1] = "../Przedmioty/Ramka_Gif.gif"
                armorCharacter.style.backgroundImage = "url(" + armor.src + ")";

                $(document).ready(function(){
                    $("#armor").load("../php/ekwipunek/put_items/put2.php", {number:i});
                });
            }
        }
    }
    if (id == "Spodnie") {
        if(profesionPlayer == profesionBp[i-1] || "all" == profesionBp[i-1]){
            if (legsSource == "../Przedmioty/Ramka_Gif.gif") {
                legsSource = itemSourceTable[i - 1];
                legs.src = itemSourceTable[i - 1];
                itemSourceTable[i - 1] = "../Przedmioty/Ramka_Gif.gif"
                legsCharacter.style.backgroundImage = "url(" + legs.src + ")";

                $(document).ready(function(){
                    $("#legs").load("../php/ekwipunek/put_items/put3.php", {number:i});
                });
            }
        }
    }
    if (id == "Buty") {
        if(profesionPlayer == profesionBp[i-1] || "all" == profesionBp[i-1]){
            if (bootSource == "../Przedmioty/Ramka_Gif.gif") {
                bootSource = itemSourceTable[i - 1];
                boot.src = itemSourceTable[i - 1];
                itemSourceTable[i - 1] = "../Przedmioty/Ramka_Gif.gif"
                bootCharacter.style.backgroundImage = "url(" + boot.src + ")";

                $(document).ready(function(){
                    $("#boot").load("../php/ekwipunek/put_items/put4.php", {number:i});
                });
            }
        }
    }
    if (id == "Naszyjnik") {
        if(profesionPlayer == profesionBp[i-1] || "all" == profesionBp[i-1]){
            if (necklaceSource == "../Przedmioty/Ramka_Gif.gif") {
                necklaceSource = itemSourceTable[i - 1];
                necklace.src = itemSourceTable[i - 1];
                itemSourceTable[i - 1] = "../Przedmioty/Ramka_Gif.gif"
                necklaceCharacter.style.backgroundImage = "url(" + necklace.src + ")";

                $(document).ready(function(){
                    $("#necklace").load("../php/ekwipunek/put_items/put5.php", {number:i});
                });
            }
        }
    }
    if (id == "Miecz") {
        if(profesionPlayer == profesionBp[i-1] || "all" == profesionBp[i-1]){
            if (swordSource == "../Przedmioty/Ramka_Gif.gif") {
                swordSource = itemSourceTable[i - 1];
                sword.src = itemSourceTable[i - 1];
                itemSourceTable[i - 1] = "../Przedmioty/Ramka_Gif.gif";

                $(document).ready(function(){
                    $("#sword").load("../php/ekwipunek/put_items/put6.php", {number:i});
                });
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
            }
        }
    }
    if (id == "Tarcza") {
        if(profesionPlayer == profesionBp[i-1] || "all" == profesionBp[i-1]){
            if (shieldSource == "../Przedmioty/Ramka_Gif.gif") {
                shieldSource = itemSourceTable[i - 1];
                shield.src = itemSourceTable[i - 1];
                itemSourceTable[i - 1] = "../Przedmioty/Ramka_Gif.gif";

                $(document).ready(function(){
                    $("#shield").load("../php/ekwipunek/put_items/put7.php", {number:i});
                });
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
            }
        }
    }
    if (id == "Rekawice") {
        if(profesionPlayer == profesionBp[i-1] || "all" == profesionBp[i-1]){
            if (glovesSource == "../Przedmioty/Ramka_Gif.gif") {
                glovesSource = itemSourceTable[i - 1];
                gloves.src = itemSourceTable[i - 1];
                itemSourceTable[i - 1] = "../Przedmioty/Ramka_Gif.gif"

                $(document).ready(function(){
                    $("#gloves").load("../php/ekwipunek/put_items/put8.php", {number:i});
                });

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
            }
        }
    }
    if (i == 1 && something != itemSourceTable[i - 1]) {
        item1.src = "../Przedmioty/Ramka_Gif.gif";
        itemSource1 = "../Przedmioty/Ramka_Gif.gif";
    }
    if (i == 2 && something != itemSourceTable[i - 1]) {
        item2.src = "../Przedmioty/Ramka_Gif.gif";
        itemSource2 = "../Przedmioty/Ramka_Gif.gif";
    }
    if (i == 3 && something != itemSourceTable[i - 1]) {
        item3.src = "../Przedmioty/Ramka_Gif.gif";
        itemSource3 = "../Przedmioty/Ramka_Gif.gif";
    }
    if (i == 4 && something != itemSourceTable[i - 1]) {
        item4.src = "../Przedmioty/Ramka_Gif.gif";
        itemSource4 = "../Przedmioty/Ramka_Gif.gif";
    }
    if (i == 5 && something != itemSourceTable[i - 1]) {
        item5.src = "../Przedmioty/Ramka_Gif.gif";
        itemSource5 = "../Przedmioty/Ramka_Gif.gif";
    }
    if (i == 6 && something != itemSourceTable[i - 1]) {
        item6.src = "../Przedmioty/Ramka_Gif.gif";
        itemSource6 = "../Przedmioty/Ramka_Gif.gif";
    }
    if (i == 7 && something != itemSourceTable[i - 1]) {
        item7.src = "../Przedmioty/Ramka_Gif.gif";
        itemSource7 = "../Przedmioty/Ramka_Gif.gif";
    }
    if (i == 8 && something != itemSourceTable[i - 1]) {
        item8.src = "../Przedmioty/Ramka_Gif.gif";
        itemSource8 = "../Przedmioty/Ramka_Gif.gif";
    }
    if (i == 9 && something != itemSourceTable[i - 1]) {
        item9.src = "../Przedmioty/Ramka_Gif.gif";
        itemSource9 = "../Przedmioty/Ramka_Gif.gif";
    }
}

</script>
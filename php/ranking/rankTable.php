<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
 
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

    $getRank="SELECT player.Login, player.Level, player.Rank, player.Id FROM player ORDER BY player.Rank DESC";
    $getRankQuery = mysqli_query($connection, $getRank);
    $i = 0;
    if (mysqli_num_rows($getRankQuery) > 0) {
        while ($row = mysqli_fetch_assoc($getRankQuery)) {
            $id[] = $row['Id'];
            $nick2[] = $row['Login'];
            $level2[] = $row['Level'];
            $rank2[] = $row['Rank'];
            $i++;
        }
    }

    $getPlayerId="SELECT player.Id FROM player WHERE player.Login='$user_check'";
    $getPlayerIdQuery = mysqli_query($connection, $getPlayerId);
    if (mysqli_num_rows($getPlayerIdQuery) > 0) {
        $row = mysqli_fetch_assoc($getPlayerIdQuery);
        $idPlayer = $row['Id'];
    }

    $getPlayer = "SELECT Profesion FROM playerCharacter";
    $getPlayerQuery = mysqli_query($connection, $getPlayer);
    if(mysqli_num_rows($getPlayerQuery) > 0){
        while ($row = mysqli_fetch_assoc($getPlayerQuery)) {
            $profesion[] = $row['Profesion'];
        }
    }

    // Ustawienie liczby walk na przycisku
    $getNumberFight = "SELECT rankingFight.Date, rankingFight.Value FROM rankingFight 
    INNER JOIN player ON player.Id=rankingFight.IdRankingFight WHERE player.Login='$user_check'";
    $getNumberFightQuery = mysqli_query($connection, $getNumberFight);
    if(mysqli_num_rows($getNumberFightQuery) > 0){
        $row = mysqli_fetch_assoc($getNumberFightQuery);
        $date = $row['Date'];
        $value = $row['Value'];
    }

    //Sprawdzenie daty 
    $current = date("Y-m-d");
    $currentDate = strtotime($current);
    $dateFromDatabase = strtotime($date);
    $different = $currentDate-$dateFromDatabase;
    //echo "<script> console.log('".$currentDate." != ".$dateFromDatabase." = ".$different."')</script>";
    if($different != 0){
        $value = 10;
        $setNumberFight = "UPDATE rankingFight INNER JOIN player ON player.Id=rankingFight.IdRankingFight 
        SET rankingFight.Value='$value', rankingFight.Date='$current' WHERE player.Login='$user_check'";
        $setNumberFightQuery = mysqli_query($connection, $setNumberFight);
        if(mysqli_num_rows($setNumberFightQuery) > 0){
            $row = mysqli_fetch_assoc($setNumberFightQuery);
            $date = $row['Date'];
            $value = $row['Value'];
        }
    }

    mysqli_close($connection);
?>

<script>

    var count = "<?php echo $i ?>";
    // skopiowanie tablicy z php do tablicy js
    var id = <?php echo json_encode($id); ?>;
    var nick = <?php echo json_encode($nick2); ?>;
    var level = <?php echo json_encode($level2); ?>;
    var rank = <?php echo json_encode($rank2); ?>;
    var profesion = <?php echo json_encode($profesion); ?>;

    var playerObject = {};

    // stworzenie objetku 
    for( let i=0; i<count; i++){
        playerObject[i] = {idPlayer: id[i], nickPlayer: nick[i], profesionPlayer: profesion[i], levelPlayer: level[i], rankPlayer: rank[i]};
    }

    // zbudowanie tabeli i wyświetlenie wszystkich graczy
    for(let i=0; i<count; i++){
        var object = playerObject[i];
        document.getElementById("body").innerHTML += "<div class='line' onclick='loadStat("+object['idPlayer']+")'>" + "<div>"+object['nickPlayer']+
        "</div>" + "<div>"+ object['profesionPlayer']+"</div>" + "<div>"+object['levelPlayer']+"</div>" + "<div>"+object['rankPlayer']+"</div>" + 
        "<div>"+(i+1)+"</div>" + "</div>";
    }
    var sortLevel=sortNick=sortRank=1;

    document.querySelector("#head>div:nth-child(4)").innerHTML = "<div class='fas fa-arrow-down'></div> Punkty";

    document.querySelector("#head>div:nth-child(3)").addEventListener("click", function(){ sortLevelF() });
    document.querySelector("#head>div:nth-child(4)").addEventListener("click", function(){ sortRankF() });

    function sortLevelF(){
        document.getElementById("body").innerHTML = "";
        document.querySelector("#head>div:nth-child(4)").innerHTML = "Punkty";
        var sortedObject;
        if(sortLevel == 1){
            // sortowanie objektu
            sortedObject = Object.keys( playerObject ).sort(function( a, b ) {
                return playerObject[ b ].levelPlayer - playerObject[ a ].levelPlayer;
            }).map(function( sortedKey ) {
                return playerObject[ sortedKey ];
            });
            document.querySelector("#head>div:nth-child(3)").innerHTML = "<div class='fas fa-arrow-down'></div> Poziom";
            sortLevel = 2;
        } else if(sortLevel == 2){
            sortedObject = Object.keys( playerObject ).sort(function( a, b ) {
                return playerObject[ a ].levelPlayer - playerObject[ b ].levelPlayer;
            }).map(function( sortedKey ) {
                return playerObject[ sortedKey ];
            });
            document.querySelector("#head>div:nth-child(3)").innerHTML = "<div class='fas fa-arrow-up'></div> Poziom";
            sortLevel = 1;
        }
        for(let i=0; i<count; i++){
            var object = sortedObject[i];
            document.getElementById("body").innerHTML += "<div class='line' onclick='loadStat("+object['idPlayer']+")'>" + "<div>"+object['nickPlayer']+
            "</div>" + "<div>"+ object['profesionPlayer']+"</div>" + "<div>"+object['levelPlayer']+"</div>" + "<div>"+object['rankPlayer']+"</div>" + 
            "<div>"+(i+1)+"</div>" + "</div>";
        }
    }

    function sortRankF(){
        document.getElementById("body").innerHTML = "";
        document.querySelector("#head>div:nth-child(3)").innerHTML = "Poziom";
        var sortedObject;
        if(sortLevel == 1){
            // sortowanie objektu
            sortedObject = Object.keys( playerObject ).sort(function( a, b ) {
                return playerObject[ b ].rankPlayer - playerObject[ a ].rankPlayer;
            }).map(function( sortedKey ) {
                return playerObject[ sortedKey ];
            });
            document.querySelector("#head>div:nth-child(4)").innerHTML = "<div class='fas fa-arrow-down'></div> Punkty";
            sortLevel = 2;
        } else if(sortLevel == 2){
            sortedObject = Object.keys( playerObject ).sort(function( a, b ) {
                return playerObject[ a ].rankPlayer - playerObject[ b ].rankPlayer;
            }).map(function( sortedKey ) {
                return playerObject[ sortedKey ];
            });
            document.querySelector("#head>div:nth-child(4)").innerHTML = "<div class='fas fa-arrow-up'></div> Punkty";
            sortLevel = 1;
        }
        for(let i=0; i<count; i++){
            var object = sortedObject[i];
            document.getElementById("body").innerHTML += "<div class='line' onclick='loadStat("+object['idPlayer']+")'>" + "<div>"+object['nickPlayer']+
            "</div>" + "<div>"+ object['profesionPlayer']+"</div>" + "<div>"+object['levelPlayer']+"</div>" + "<div>"+object['rankPlayer']+"</div>" + 
            "<div>"+(i+1)+"</div>" + "</div>";
        }
    }

    let numberPlayerStat;
    let playerId = "<?php echo $idPlayer ?>";

    function loadStat(number) {
        numberPlayerStat = number;
        document.getElementById("right").style.visibility = "visible";
        $(document).ready(function(){
            $("#nothing").load("../php/ranking/rankStat.php", {loadIndex: number});
        });
    }

    // Ustawienie rankingu na zalogowanego gracza
    var i = 1;
    var line = 1;
    let userName = "<?php echo $user_check ?>";
    while(document.body.contains(document.querySelector(".line:nth-child("+i+")>div"))){
        if(userName == document.querySelector(".line:nth-child("+i+")>div").innerHTML){
            line = i;
            break;
        }
        i++;
    }
    document.querySelector(".line:nth-child("+line+")>div").scrollIntoView({behavior: "auto", block: "center", inline: "nearest"});
    document.querySelector(".line:nth-child("+line+")").style.textShadow = "0 0 4px yellow";

    // Przycisk walka
    var fightNumber = "<?php echo $value ?>";
    document.getElementById("numberFights").innerHTML = fightNumber +"/10";

    document.getElementById("fight").addEventListener("click", function(){ openFight(numberPlayerStat)});

    function openFight(numberEnemy){
        numberPlayerStat--;
        if(playerId != numberEnemy){
            if(fightNumber > 0){
                document.cookie = "number=" + numberEnemy;
                document.cookie = "reload=0";
                window.open("fight.php", "_self");
            } else {
                document.getElementById("fight").style.boxShadow = "0 0 7px 4px red";
                setTimeout(() => {
                    document.getElementById("fight").style.boxShadow = "none";
                }, 1500);
            }
        }  else {
            document.getElementById("fight").style.boxShadow = "0 0 7px 4px red";
            setTimeout(() => {
                document.getElementById("fight").style.boxShadow = "none";
            }, 1500);
        }
    }

</script>
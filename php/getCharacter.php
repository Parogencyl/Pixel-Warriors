<?php
    $selectCharacter = "SELECT Login, Level, Experience, Rubins, Monets FROM player WHERE player.Login='$user_check'";
    $getCharacter = mysqli_query($connection, $selectCharacter);
    if(mysqli_num_rows($getCharacter) > 0){
        $row = mysqli_fetch_assoc($getCharacter);
        $nick = $row['Login'];
        $experience = $row['Experience'];
        $rubins = $row['Rubins'];
        $monet = $row['Monets'];
    }

    mysqli_close($connection);
?>

<script>
    document.querySelector("#rubin").innerHTML = "<img src='../projekt_grafika/Inne/rubin.gif'> " + "<?php echo $rubins ?>";
    document.querySelector("#monet").innerHTML = "<img src='../projekt_grafika/Inne/money.png'> " + "<?php echo $monet ?>";
    document.querySelector("#nick").innerHTML = "<?php echo $nick ?>";
</script>
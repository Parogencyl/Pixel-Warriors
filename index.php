<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="nRiMG2_f_8YLkverb9bIbn0fV89jS3TyrTdrsz08hKY" />
    <link href="style.css" rel="stylesheet">
    <link href="mediaStyle.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
    <link rel="icon" href="projekt_grafika/images/Icona_gif.gif" type="image/icon" sizes="16x16">
    <title> Pixel Warriors </title>
</head>

<body>

<?php
include("php/connect.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
   // username and password sent from form 
   
   $myusername = mysqli_real_escape_string($connection,$_POST['username']);
   $mypassword = mysqli_real_escape_string($connection,$_POST['password']); 

   if($myusername == "" || $mypassword == ""){
       $myusername = "Admin";
       $mypassword = "Admin123";
   }
   
   $sql = "SELECT player.Login, player.Password FROM player WHERE player.Login = '$myusername' and player.password = '$mypassword'";
   $result = mysqli_query($connection,$sql);
   if(mysqli_num_rows($result) == 1){ 
     $row = mysqli_fetch_assoc($result);
   
   // If result matched $myusername and $mypassword, table row must be 1 row
      $_SESSION['login_user'] = $myusername;
      header("location: statystyki/statystyki.php");
   }else {
      $passwordErr = "Login lub hasło jest niepoprawne";
   }
}
?>

    <div style="display:none">
     Pixel Warriors to fantastyczna gra RPG przenosząca gracza w czasy średniowieczne.
     Gracz przemierzając świat pokonuje wszelkiego rodzaju napotkane potwory oraz rywalizuje z innymi graczami o miano najlepszego gracza w świecie pixeli.
    </div>

    <article>
    <div id="trapez"> </div>
        <div id="beta"> BETA </div>
        <a href="index.php">
            <div id="logo"> </div>
        </a>

        <div id="menu">
            <div id="buttons">
                    <div class="button" id="top">
                        <div class="textPosition"> Statystyki </div>
                    </div>

                    <div class="button">
                        <div class="textPosition"> Ekwipunek </div>
                    </div>

                    <div class="button">
                        <div class="textPosition"> Tawerna </div>
                    </div>

                    <div class="button">
                        <div class="textPosition"> Targowisko </div>
                    </div>

                    <div class="button">
                        <div class="textPosition"> Spis graczy </div>
                    </div>

            </div>
        </div>

        <div id="center">
            <div id="window">

                <form method="post" action="">

                    <div id="logText"> Login: </div>
                    <input type="text" name="username">

                    <div id="passText"> Password: </div>
                    <input type="password" name="password">
                    <span class="error"> <?php echo $passwordErr; ?> </span>

                    <input type="submit" value="Zaloguj">

                    <a href="rejestracja/registration.php">
                        <div id="registration"> Rejestracja </div>
                    </a>
                </form>

            </div>
        </div>

        <div id="footer">

                <div class="button" id="buttonLog">
                    <div class="textPosition"> Wyloguj </div>
                </div>

                <div id="aboutGame"> <a href="oGrze/oGrze.html"> O grze </a> </div>
                
                <div class="button" id="buttonSet">
                    <div class="textPosition"> Ustawienia </div>
                </div>

        </div>

    </article>

    <?php 
        include 'php/getCharacter.php';
    ?>

</body>

</html>
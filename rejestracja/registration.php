<!DOCTYPE html>
<html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="nRiMG2_f_8YLkverb9bIbn0fV89jS3TyrTdrsz08hKY" />
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="../projekt_grafika/images/Icona_gif.gif" type="image/icon" sizes="16x16">
    <title> Pixel Warriors - rejestracja</title>
</head>

<body>
    <article>
        <section id="registration">
            <!--<div id="logo"></div> -->
            <form id="registrationForm" method="POST" action="createCharacter.php">
                <div id="container">
                    <h2 id="title"> Rejestracja </h2>
                    <p> Wypełnij poniższe pola, aby założyć konto w grze <b>Pixel Warriors</b></p>
                    <hr>

                    <div id="badLogin"> </div>
                    <label for="login"><b>Login</b></label>
                    <input type="text" placeholder="Login/Nazwa gracza" name="login" id="loginInput" required>

                    <div id="badPassword"></div>
                    <label for="psw"><b>Hasło</b></label>
                    <input type="password" placeholder="Hasło" name="psw" id="pass" required>

                    <div id="badRepeatPassword"></div>
                    <label for="psw-repeat"><b>Powtórz hasło</b></label>
                    <input type="password" placeholder="Powtórz hasło" name="psw-repeat" id="pass2" required>

                    <!-- Pokazanie hasła -->
                    <input type="checkbox" onclick="myFunction()"><span style="font-size:1.1vw; color: #581919">Pokaż hasło</span><br>

                    <div id="badEmail"></div>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Email" name="email" id="emailInput" required>

                    <div id="profesionBox">
                        <label for="profesion" style="color:#581919"><b> Profesja </b></label><br>
                        <input type="radio" name="profesion" value="warrior" id="warrior" checked> Wojownik <br>
                        <input type="radio" name="profesion" value="mag" id="mag" disabled> Mag <br>
                        <input type="radio" name="profesion" value="hunter" id="hunter" disabled> Łucznik <br>
                    </div>

                    <div id="genderBox">
                        <label for="gender" style="color:#581919"><b> Płeć postaci </b></label> <br>
                        <input type="radio" name="gender" value="male" id="wojownik" required> Rycerz <br>
                        <input type="radio" name="gender" value="female" id="wojowniczka"> Rycerka <br>
                    </div>

                    <div id="gender"> /\ Nie wybrano płci /\</div>

                    <div id="hairColorBox">
                        <label for="hairColor" style="color:#581919"><b> Kolor włosów </b></label> <br>
                        <input type="radio" name="hairColor" value="brown" id="brown" checked> Brązowe <br>
                        <input type="radio" name="hairColor" value="blond" id="blond"> Blond <br>
                        <input type="radio" name="hairColor" value="black" id="black"> Czarne <br>
                    </div>

                    <div id="empty"></div>
                    <hr>
                    <span style="padding: 2% 0; font-size: 1.1vw;">Tworząc konto wyrażasz zgodę na <a href="#">Warunki & Prywatność</a>.</span>

                    <button type="submit" class="registerbtn">Zarejestruj</button>
                </div>

                <div class="container signin" style="padding: 2% 0; font-size: 1.1vw;">
                    <span>Masz już konto? <a href="../index.php">Zaloguj się</a>.</span>
                </div>
            </form>

            <div id="characterImage"></div>
        </section>
    </article>


    <?php
        include "validation.php";
        include "characterImage.php";
    ?>

</body>

</html>
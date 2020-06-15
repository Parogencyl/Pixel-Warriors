<!-- zdejmowanie przedmiotu -->

<script>
function dropItem(id, name) {
    for (let i = 0; i < 9; i++) {
        if (itemSourceTable[i] == "../Przedmioty/Ramka_Gif.gif") {

            if (id == "helmet") {
                itemSourceTable[i] = helmetSource;
                helmetSource = "../Przedmioty/Ramka_Gif.gif";
                helmetCharacter.style.backgroundImage = "";
                document.querySelector(name + '1').style.visibility = 'hidden';

                $(document).ready(function(){
                    $("#helmet").load("../php/ekwipunek/drop_items/drop1.php");
                });
            }

            if (id == "armor") {
                itemSourceTable[i] = armorSource;
                armorSource = "../Przedmioty/Ramka_Gif.gif";
                armorCharacter.style.backgroundImage = "";
                document.querySelector(name + '2').style.visibility = 'hidden';

                $(document).ready(function(){
                    $("#armor").load("../php/ekwipunek/drop_items/drop2.php");
                });
            }

            if (id == "legs") {
                itemSourceTable[i] = legsSource;
                legsSource = "../Przedmioty/Ramka_Gif.gif";
                legsCharacter.style.backgroundImage = "";
                document.querySelector(name + '3').style.visibility = 'hidden';

                $(document).ready(function(){
                    $("#legs").load("../php/ekwipunek/drop_items/drop3.php");
                });
            }

            if (id == "boot") {
                itemSourceTable[i] = bootSource;
                bootCharacter.style.backgroundImage = "";
                bootSource = "../Przedmioty/Ramka_Gif.gif";
                document.querySelector(name + '4').style.visibility = 'hidden';

                $(document).ready(function(){
                    $("#boot").load("../php/ekwipunek/drop_items/drop4.php");
                });
            }

            if (id == "necklace") {
                itemSourceTable[i] = necklaceSource;
                necklaceCharacter.style.backgroundImage = "";
                necklaceSource = "../Przedmioty/Ramka_Gif.gif";
                document.querySelector(name + '5').style.visibility = 'hidden';

                $(document).ready(function(){
                    $("#necklace").load("../php/ekwipunek/drop_items/drop5.php");
                });
            }

            if (id == "sword") {
                itemSourceTable[i] = swordSource;
                swordCharacter.style.backgroundImage = "";
                swordSource = "../Przedmioty/Ramka_Gif.gif";
                document.querySelector(name + '6').style.visibility = 'hidden';

                $(document).ready(function(){
                    $("#sword").load("../php/ekwipunek/drop_items/drop6.php");
                });
            }

            if (id == "shield") {
                itemSourceTable[i] = shieldSource;
                shieldCharacter.style.backgroundImage = "";
                shieldSource = "../Przedmioty/Ramka_Gif.gif";
                document.querySelector(name + '7').style.visibility = 'hidden';

                $(document).ready(function(){
                    $("#shield").load("../php/ekwipunek/drop_items/drop7.php");
                });
            }

            if (id == "gloves") {
                itemSourceTable[i] = glovesSource;
                glovesCharacter.style.backgroundImage = "";
                glovesSource = "../Przedmioty/Ramka_Gif.gif";
                document.querySelector(name + '8').style.visibility = 'hidden';

                $(document).ready(function(){
                    $("#gloves").load("../php/ekwipunek/drop_items/drop8.php");
                });
            }

            if (i + 1 == 1) {
                item1.src = itemSourceTable[i];
                itemSource1 = itemSourceTable[i];
            }
            if (i + 1 == 2) {
                item2.src = itemSourceTable[i];
                itemSource2 = itemSourceTable[i];
            }
            if (i + 1 == 3) {
                item3.src = itemSourceTable[i];
                itemSource3 = itemSourceTable[i];
            }
            if (i + 1 == 4) {
                item4.src = itemSourceTable[i];
                itemSource4 = itemSourceTable[i];
            }
            if (i + 1 == 5) {
                item5.src = itemSourceTable[i];
                itemSource5 = itemSourceTable[i];
            }
            if (i + 1 == 6) {
                item6.src = itemSourceTable[i];
                itemSource6 = itemSourceTable[i];
            }
            if (i + 1 == 7) {
                item7.src = itemSourceTable[i];
                itemSource7 = itemSourceTable[i];
            }
            if (i + 1 == 8) {
                item8.src = itemSourceTable[i];
                itemSource8 = itemSourceTable[i];
            }
            if (i + 1 == 9) {
                item9.src = itemSourceTable[i];
                itemSource9 = itemSourceTable[i];
            }
            document.getElementById(id).src = "../Przedmioty/Ramka_Gif.gif";
            break;
        }
    }
}

</script>

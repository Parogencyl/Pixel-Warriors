
<script>

    document.getElementById("searchButton").addEventListener("click", function() { search() });
    document.getElementById("searchInput").addEventListener("keyup", function() { searchKeypress(event) });

    function search(){
        var name = document.getElementById("searchInput").value;
        if(name != ""){
            var line = 0;
            var i=1;
            var number = parseInt(name, 10);
            if(Number.isInteger(number)){
            // Przeszukiwanie dopóki nie znajdzie wiersza w kolumnie pozycji z podaną wartością
                while(document.body.contains(document.querySelector(".line:nth-child("+i+")>div:nth-child(5)"))){
                    if(name == document.querySelector(".line:nth-child("+i+")>div:nth-child(5)").innerHTML){
                        line = i;
                        break;
                    }
                    i++;
                }
            }else{
            // Przeszukiwanie dopóki nie znajdzie wiersza z podaną nazwą
                while(document.body.contains(document.querySelector(".line:nth-child("+i+")>div"))){
                    if(name == document.querySelector(".line:nth-child("+i+")>div").innerHTML){
                        line = i;
                        break;
                    }
                    i++;
                }
            }
            // Wyświetlenie statystyk i przesunięcie do wybranej postaci, jeśli wcześniej znalazło odpowiednią linie
            if(line != 0){
                document.getElementById("right").style.visibility = "visible";
                document.querySelector(".line:nth-child("+line+")>div").scrollIntoView({behavior: "smooth", block: "center", inline: "nearest"});
                $(document).ready(function(){
                    $("#nothing").load("../php/ranking/rankStat.php", {loadIndex: line});
                });
                // Zapalanie na chwilę znalezionego wiersza
                document.querySelector(".line:nth-child("+line+")").style.color = "red"; 
                setTimeout(() => {
                    document.querySelector(".line:nth-child("+line+")").style.color = "white"; 
                }, 3000);
            } else {
                document.getElementById("searchInput").style.border = "2px solid red";
                setTimeout(function() {
                    document.getElementById("searchInput").style.border = "2px solid gray";
                }, 1500);
            }
        }
    }

    // Przeszukiwanie po wciśnięciu entera
    function searchKeypress(event){
        if(event.which == 13 || event.keyCode == 13){
            var name = document.getElementById("searchInput").value;
            var line = 0;
            var i=1;
            var number = parseInt(name, 10);
            if(Number.isInteger(number)){
            // Przeszukiwanie dopóki nie znajdzie wiersza w kolumnie pozycji z podaną wartością
                while(document.body.contains(document.querySelector(".line:nth-child("+i+")>div:nth-child(5)"))){
                    if(name == document.querySelector(".line:nth-child("+i+")>div:nth-child(5)").innerHTML){
                        line = i;
                        break;
                    }
                    i++;
                }
            }else{
            // Przeszukiwanie dopóki nie znajdzie wiersza z podaną nazwą
                while(document.body.contains(document.querySelector(".line:nth-child("+i+")>div"))){
                    if(name == document.querySelector(".line:nth-child("+i+")>div").innerHTML){
                        line = i;
                        break;
                    }
                    i++;
                }
            }
            if(line != 0){
                document.getElementById("right").style.visibility = "visible";
                document.querySelector(".line:nth-child("+line+")>div").scrollIntoView({behavior: "smooth", block: "center", inline: "nearest"});
                $(document).ready(function(){
                    $("#nothing").load("../php/ranking/rankStat.php", {loadIndex: line});
                });
                // Zapalanie na chwilę znalezionego wiersza
                document.querySelector(".line:nth-child("+line+")").style.color = "red"; 
                setTimeout(() => {
                    document.querySelector(".line:nth-child("+line+")").style.color = "white"; 
                }, 3000);
            } else {
                document.getElementById("searchInput").style.border = "2px solid red";
                setTimeout(function() {
                    document.getElementById("searchInput").style.border = "2px solid gray";
                }, 1500);
            }
        }
    }

</script>
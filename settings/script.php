<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    
<script>

function soundOnOff() {
    let sound = document.getElementById("soundImg").style.backgroundImage;
    if (sound == 'url("../projekt_grafika/Inne/music_on.gif")') {
        document.getElementById("soundImg").style.backgroundImage = "url(../projekt_grafika/Inne/music_off.gif)";
        var i = 1;
        $(document).ready(function() {
            $("#soundImg").load("settingsQuery.php", {onOff:i});
        });
    } else if (sound == 'url("../projekt_grafika/Inne/music_off.gif")') {
        document.getElementById("soundImg").style.backgroundImage = "url(../projekt_grafika/Inne/music_on.gif)";
        var j = 2;
        $(document).ready(function() {
            $("#soundImg").load("settingsQuery.php", {onOff:j});
        });
    }
}

document.getElementById("soundImg").addEventListener('click', function(){ soundOnOff(); });

</script>
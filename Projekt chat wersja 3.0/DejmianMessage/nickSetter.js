function setNick() {

    nick = document.getElementById('nickname').value;
    if ( nick.length != 0 ) {
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert("Nick został ustawiony");
                hide(document.getElementById('setNick'));
                hide(document.getElementById('nickname'));
                hide(document.getElementById('room'));
                document.getElementById('nick').innerHTML = "Nick: " + nick;
                wybierzChat(1);
            }
        };
        xhttp.open("GET", "./nickSetter.php?nick=" + nick, true);
        xhttp.send();
    } else {

        alert("Nie podano nicku");

    }
}
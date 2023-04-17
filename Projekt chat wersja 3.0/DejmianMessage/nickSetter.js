function setNick(nick) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert("Nick został ustawiony");
            hide(document.getElementById('setNick'));
            hide(document.getElementById('nickname'));
            hide(document.getElementById('room'));
            document.getElementById('nick').innerHTML = "Nick: " + nick;
        }
    };
    xhttp.open("GET", "./nickSetter.php?nick=" + nick, true);
    xhttp.send();
}
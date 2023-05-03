function chatSend(msg,nick) {
    var xhttp = new XMLHttpRequest();
    document.getElementById('messageInput').value = "";
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat").innerHTML = this.responseText;
            document.getElementById("chat").lastElementChild.scrollIntoView()
        }
    };
    xhttp.open("GET", "./chat.php?chat=" + msg + "&nick=" + nick, true);
    xhttp.send();
}

function chatRefresh() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "./chat.php", true);
    xhttp.send();
};
setInterval(chatRefresh, 1000);

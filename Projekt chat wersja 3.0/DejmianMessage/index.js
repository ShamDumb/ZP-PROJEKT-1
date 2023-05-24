function chatSend() {
    
    var msg = document.getElementById('messageInput').value;
    var nick = document.getElementById('nickname').value; 
    if ( msg.length != 0 && nick.length != 0 ){
        var xhttp = new XMLHttpRequest();
        document.getElementById('messageInput').value = "";
        var chatid = document.getElementById('chatId').value;
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("chat").innerHTML = this.responseText;
                document.getElementById("chat").lastElementChild.scrollIntoView()
            }
        };
        xhttp.open("GET", "./chat.php?chat=" + msg + "&nick=" + nick + "&chatroom=" + chatid, true);
        xhttp.send();
    }
}

function chatRefresh() {
    var xhttp = new XMLHttpRequest();
    var chatid = document.getElementById('chatId').value;
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "./chat.php?chatroom=" + chatid, true);
    xhttp.send();
};
setInterval(chatRefresh, 1000);


document.addEventListener("keypress", function(event) {

  if (event.key === "Enter") {
    
    event.preventDefault();
    chatSend();

  }
});
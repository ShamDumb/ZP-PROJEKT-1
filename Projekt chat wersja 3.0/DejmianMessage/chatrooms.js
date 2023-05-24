function dodajChat(chatroom,nick) {
    var xhttp = new XMLHttpRequest();
    document.getElementById('newChatName').value = "";
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chatName").innerHTML = this.responseText;
            chatroomRefresh();
        }
    };
    xhttp.open("GET", "./chatroom.php?chatroom=" + chatroom + "&nick=" + nick, true);
    xhttp.send();
}

function showUsers() {
    var chatroomId = document.getElementById('chatId').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('users').innerHTML = this.responseText;
            chatRefresh();
        }
    };
    xhttp.open("GET", "./users.php?chatroom=" + chatroomId, true);
    xhttp.send();
}

function wybierzChat(chatroomId) {

    document.getElementById('chatId').value = chatroomId;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('chatName').innerHTML = this.responseText;
            chatRefresh();
        }
    };
    xhttp.open("GET", "./chatroomName.php?chatroom=" + chatroomId, true);
    xhttp.send();

}

function chatroomRefresh() {
    var xhttp = new XMLHttpRequest();
    var nick = document.getElementById('nickname').value;
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chatrooms").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "./chatroom.php?nick=" + nick, true);
    xhttp.send();
    showUsers()
};
setInterval(chatroomRefresh, 1000);

<?php
include('./config.php');

if ( isset($_REQUEST['chatroom'])) {

    $link = mysqli_connect($host, $user, $pass, $database);
    $chatroom_id = $_REQUEST['chatroom'];
    $sel_chatName = "SELECT * FROM `chatroom` WHERE `idchatroom`='$chatroom_id' ";
    $q_sel_chatName = mysqli_query($link, $sel_chatName);

    if ($chatName = mysqli_fetch_row($q_sel_chatName)) {

        echo $chatName[1];
        
    }

    mysqli_close($link);
}

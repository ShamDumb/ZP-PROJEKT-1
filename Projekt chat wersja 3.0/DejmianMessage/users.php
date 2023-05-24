<?php
include('./config.php');

if ( isset($_REQUEST['chatroom'])) {

    $link = mysqli_connect($host, $user, $pass, $database);
    $chatroom_id = $_REQUEST['chatroom'];
    $sel_chatName = "SELECT * FROM `user_has_chatroom` WHERE `chatroom_idchatroom`='$chatroom_id' ";
    $q_sel_chatName = mysqli_query($link, $sel_chatName);
    
    while ($chatName = mysqli_fetch_array($q_sel_chatName)) {
        
        $sel_users = "SELECT * FROM `user` WHERE `user_id`=".$chatName['user_user_id'];
        $q_sel_users = mysqli_query($link, $sel_users);

        if ($q_sel_users = mysqli_fetch_row($q_sel_users)) {

            echo "<h5>".$q_sel_users[1]."</h5>";

        }
        
    }

    mysqli_close($link);
}

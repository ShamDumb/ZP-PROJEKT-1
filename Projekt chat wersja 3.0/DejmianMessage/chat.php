<?php
$to_write = array();
$chat = "";
$time = time();
$nick = "";

include('./config.php');
// $ip_user = $_SERVER['REMOTE_ADDR'];

if ( isset($_REQUEST['nick']) ) {

    $nick = $_REQUEST['nick'];

}

$link = mysqli_connect($host, $user, $pass, $database);

$sel_users = "SELECT * FROM `user` WHERE `nick`='$nick' ";
$q_sel_users = mysqli_query($link, $sel_users);

if (!$current_user = mysqli_fetch_row($q_sel_users)) {

    $ins_user = "INSERT INTO `user`(`user_id`,`nick`) VALUES ( default,'".$nick."')";

    if($q_ins_user = mysqli_query($link, $ins_user)){

        $sel_users = "SELECT * FROM `user` WHERE `nick`='$nick' ";
        $q_sel_users = mysqli_query($link, $sel_users);

        if ($current_user = mysqli_fetch_row($q_sel_users)) {

            $nick = $current_user['nick'];

        }

    }
}

$sel_chat_history = "SELECT * FROM `chat_user`";
$q_sel_chat_history = mysqli_query($link, $sel_chat_history);

while ($chat_history = mysqli_fetch_array($q_sel_chat_history)) {

    $chat .= "<span class='chatText'>". $chat_history['nick'] .":" . $chat_history['message'] . "</span><br/>";

}

if (isset($_GET['chat'])&&isset($_GET['nick'])) {

    $sel_users = "SELECT `user_id` FROM `user` WHERE `nick`='$nick' ";
    $q_sel_users = mysqli_query($link, $sel_users);

    if ($current_user = mysqli_fetch_row($q_sel_users)) {

        $ins_chat_history = "INSERT INTO `chat`(`chat_id`,`user_user_id`,`message`) VALUES ( default,'".$current_user[0]."','".$_GET['chat']."')";
    
        $q_ins_chat_history = mysqli_query($link, $ins_chat_history);
        $chat .= $nick . ": <span class='chatText' >" . $_GET['chat'] . "</span>";

    }
} else if (isset($_GET['chat'])) {

    $chat .= "Nie wolno być anonimowym, jeżeli chcesz coś wysłać na tę stronę";

}

mysqli_close($link);
// $to_write = implode('&', $to_write);
// $online_fp = fopen('chat.txt', 'w+');
// flock($online_fp, LOCK_EX);
// fwrite($online_fp, $to_write);
// fclose($online_fp);

echo $chat;
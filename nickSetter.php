<?php
// $ip_user = $_SERVER['REMOTE_ADDR'];
include('./config.php');

if (isset($_GET['nick']) && $_GET['nick'] != "") {

    $nick = $_GET['nick'];
    
    if ( isset($_REQUEST['nick']) ) {

        $nick = $_REQUEST['nick'];

    }

    $link = mysqli_connect($host, $user, $pass, $database);

    $sel_users = "SELECT * FROM `user` WHERE `nick`='$nick' ";
    $q_sel_users = mysqli_query($link, $sel_users);

    if (!$current_user = mysqli_fetch_row($q_sel_users)) {

        $ins_user = "INSERT INTO `user`(`user_id`,`nick`) VALUES ( default,'".$nick."')";
        $q_ins_user = mysqli_query($link, $ins_user);

    }

    mysqli_close($link);
    echo $nick;
}
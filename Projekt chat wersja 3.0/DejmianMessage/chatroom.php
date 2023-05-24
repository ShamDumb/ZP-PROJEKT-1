<?php
// $ip_user = $_SERVER['REMOTE_ADDR'];
include('./config.php');
$chatrooms = "";

$link = mysqli_connect($host, $user, $pass, $database);

if (isset($_GET['nick']) && $_GET['nick'] != "" && !isset($_GET['chatroom'])) {
    
    $nick = $_GET['nick'];
    
    
    $sel_users = "SELECT * FROM `user` WHERE `nick`='$nick' ";
    $q_sel_users = mysqli_query($link, $sel_users);
    
    if ($current_user = mysqli_fetch_row($q_sel_users)) {
        
        $sel_user_has_chatroom1 = "SELECT * FROM `user_has_chatroom` WHERE `user_user_id`=".$current_user[0];
        $q_sel_user_has_chatroom1 = mysqli_query($link, $sel_user_has_chatroom1);
        
        if(!$q_sel_user_has_chatroom = mysqli_fetch_row($q_sel_user_has_chatroom1)){
            
            $ins_user_has_chatroom = "INSERT INTO `user_has_chatroom` (`user_user_id`, `chatroom_idchatroom`) VALUES ( ".$current_user[0]." , 1 )";
            $q_ins_user_has_chatroom = mysqli_query($link, $ins_user_has_chatroom);
            
        }
        
        $q_sel_user_has_chatroom1 = mysqli_query($link, $sel_user_has_chatroom1);
        
        while ($chatrooms_from_user = mysqli_fetch_array($q_sel_user_has_chatroom1)) {
            
            $sel_chatroom = "SELECT * FROM `chatroom` WHERE `idchatroom`=".$chatrooms_from_user['chatroom_idchatroom'];
            $q_sel_chatroom = mysqli_query($link, $sel_chatroom);
            
            if ($chatroom = mysqli_fetch_row($q_sel_chatroom)) {
                
                $chatrooms .= "<div class='chatroom_preview'  onclick='wybierzChat(".$chatroom[0].")'>".$chatroom[1]."</div>";
            }

        }        
    }
    echo $chatrooms;

}

if (isset($_GET['chatroom']) && $_GET['chatroom'] != "" && isset($_GET['nick']) && $_GET['nick'] != "") {

    
    $chatroom = $_GET['chatroom'];
    $nick = $_GET['nick'];
    
    $sel_users = "SELECT * FROM `user` WHERE `nick`='$nick' ";
    $q_sel_users = mysqli_query($link, $sel_users);
    
    $sel_chatroom = "SELECT * FROM `chatroom` WHERE `chatname`='".$chatroom."';";
    $q_sel_chatroom = mysqli_query($link, $sel_chatroom);
    
    if ($chatroom_row = mysqli_fetch_row($q_sel_chatroom)) {
        if ( $current_user = mysqli_fetch_row($q_sel_users)) {
            
            //chat istnieje
            $sel_user_has_chatroom2 = "SELECT * FROM `user_has_chatroom` WHERE `user_user_id`=".$current_user[0]." AND `chatroom_idchatroom`=".$chatroom_row[0]." ;";
            $q_sel_user_has_chatroom2 = mysqli_query($link, $sel_user_has_chatroom2);
            
            if(!$user_has_chatroom = mysqli_fetch_row($q_sel_user_has_chatroom2)){
                
                //połączenie nie istnieje
                $ins_user_has_chatroom = "INSERT INTO `user_has_chatroom` (`user_user_id`, `chatroom_idchatroom`) VALUES ( ".$current_user[0]." , ".$chatroom_row[0]." )";
                $q_ins_user_has_chatroom = mysqli_query($link, $ins_user_has_chatroom);
                
            }        
        }
            
    } else {

        //chat nie istnieje
        $chatroom = $_GET['chatroom'];
        $ins_chatroom = "INSERT INTO `chatroom` (`idchatroom`, `chatname`) VALUES ( default , '".$chatroom."' )";

        if ($q_ins_chatroom = mysqli_query($link, $ins_chatroom)) {
    
            $nick = $_GET['nick'];

            $sel_users = "SELECT * FROM `user` WHERE `nick`='".$nick."' ";
            $q_sel_users = mysqli_query($link, $sel_users);

            $sel_chatroom = "SELECT * FROM `chatroom` WHERE `chatname`='".$chatroom."';";
            $q_sel_chatroom = mysqli_query($link, $sel_chatroom);

            if ($chatroom_row = mysqli_fetch_row($q_sel_chatroom)) {
                if ($current_user = mysqli_fetch_row($q_sel_users)) {
                    
                    //połaczenie nie istnieje
                    $ins_user_has_chatroom = "INSERT INTO `user_has_chatroom` (`user_user_id`, `chatroom_idchatroom`) VALUES ( ".$current_user[0]." , ".$chatroom_row[0]." )";
                    $q_ins_user_has_chatroom = mysqli_query($link, $ins_user_has_chatroom);
                    
                }
            }
        }

    }

    echo $chatroom;

}

mysqli_close($link);

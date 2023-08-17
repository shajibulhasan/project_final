<?php 
    include 'connection.php';
    $userid = $_REQUEST['userid'];
    $s = "UPDATE users set status=true where id=$userid";
    if(mysqli_query($conn, $s)){
        header('Location: pending_users.php');
    }
?>
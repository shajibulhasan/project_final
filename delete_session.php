<?php include 'connection.php'; ?>
<?php 
   $session_id =  $_REQUEST['session_id'];
   $s = "delete from session where id=$session_id";
   if(mysqli_query($conn, $s)){
    header('Location: all_session.php');
   }
?>
<?php include 'connection.php'; ?>
<?php 
   $off_id =  $_REQUEST['off_id'];
   $s = "delete from offer_course where id=$off_id";
   if(mysqli_query($conn, $s)){
    header('Location: all_offer_course.php');
   }
?>
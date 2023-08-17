<?php include 'connection.php'; ?>
<?php 
   $batch_id =  $_REQUEST['course_id'];
   $s = "delete from batch where id=$batch_id";
   if(mysqli_query($conn, $s)){
    header('Location: all_batch.php');
   }
?>
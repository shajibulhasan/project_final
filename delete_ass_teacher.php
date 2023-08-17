<?php include 'connection.php'; ?>
<?php 
   $ass_id =  $_REQUEST['ass_id'];
   $s = "delete from assign_teacher where id=$ass_id";
   if(mysqli_query($conn, $s)){
    header('Location: all_ass_teacher.php');
   }
?>
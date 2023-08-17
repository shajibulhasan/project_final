<?php include 'connection.php'; ?>
<?php 
   $sec_id =  $_REQUEST['sec_id'];
   $s = "delete from section where id=$sec_id";
   if(mysqli_query($conn, $s)){
    header('Location: all_section.php');
   }
?>
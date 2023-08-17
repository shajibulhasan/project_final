<?php include 'connection.php'; ?>
<?php 
   $rid =  $_REQUEST['rid'];
   $s = "delete from admin where id=$rid";
   if(mysqli_query($conn, $s)){
    header('Location: all_dept_admin.php');
   }
?>
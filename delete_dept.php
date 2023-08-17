<?php include 'connection.php'; ?>
<?php 
   $dept_id =  $_REQUEST['dept_id'];
   $s = "delete from department where id=$dept_id";
   if(mysqli_query($conn, $s)){
    header('Location: all_department.php');
   }
?>
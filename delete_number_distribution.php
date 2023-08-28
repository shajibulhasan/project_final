<?php include 'connection.php'; ?>
<?php 
   $ndis_id =  $_REQUEST['ndis_id'];
   $s = "delete from number_distribution where id= $ndis_id ";
   if(mysqli_query($conn, $s)){
    header('Location: all_number_distribution.php');
   }
?>
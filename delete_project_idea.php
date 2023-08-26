<?php include 'connection.php'; ?>
<?php 
   $idea_id =  $_REQUEST['idea_id'];
   $s = "delete from project_idea where id=$idea_id";
   if(mysqli_query($conn, $s)){
    header('Location: status_project_idea.php');
   }
?>
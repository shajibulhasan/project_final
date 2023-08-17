<?php include 'connection.php'; ?>
<?php 
   $course_id =  $_REQUEST['course_id'];
   $s = "delete from course where id=$course_id";
   if(mysqli_query($conn, $s)){
    header('Location: all_course.php');
   }
?>
<?php 
    include 'connection.php';
    $p_id = $_REQUEST['project_id'];
    $s = "update project_idea set status=1 WHERE id = $p_id";
    if(mysqli_query($conn, $s)){
        header('Location: approved_project_idea.php');
    }
?>
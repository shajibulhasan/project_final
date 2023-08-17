<?php 
    include 'connection.php';
    $uid = $_REQUEST['uid'];
    $s = "SELECT * FROM `users` WHERE id = $uid";
    $q = mysqli_query($conn, $s);
    $r = mysqli_fetch_assoc($q);
    $name = $r['name'];
    $email = $r['email'];
    $password = $r['password'];
    $dept = $r['dept_id'];
    $role = 'Department Admin';
    $s1 = "INSERT INTO admin(name, email, role, dept_id, password) VALUES ('".$name."','".$email."','".$role."','".$dept."','".$password."')";
    if(mysqli_query($conn, $s1)){
        echo 'Create Admin';
        header('Location: all_dept_admin.php');
    }
?>
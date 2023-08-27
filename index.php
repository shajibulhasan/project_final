<?php include 'connection.php' ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="dashboard_super.php"><img src="img/puc.png" alt="logo" style="width:50px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login_admin.php">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="m-5">
            <h2>User Login</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" id="">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" id="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btnLogin">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['btnLogin'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']); 
        $s = "Select * from users where email='".$email."' 
              AND password='".$password."'";
        $q = mysqli_query($conn, $s);        
        $row = mysqli_fetch_assoc($q);

        if($row){
            $is_approved = $row['status'];
            if($is_approved){
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_role'] = $row['role'];
                $_SESSION['user_dept'] = $row['dept_id'];
                $_SESSION['user_id'] = $row['id'];
                if($row['role']=='Teacher'){
                    header('Location: dashboard_teach.php');
                }
                elseif($row['role']=='Student'){
                    header('Location: dashboard.php');
                }    
            }
            else{
                echo 'Not Approved';
            }
        }
        else{
            echo 'Not registered';
        }
    }
?>
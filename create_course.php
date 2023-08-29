<?php
    include 'connection.php';
?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php
    $dept = $_SESSION['user_dept'];
    $name = $_SESSION['user_name'];
    if($_SESSION['user_role']=='Teacher'){
        header('location: dashboard_teach.php');
    }
    if($_SESSION['user_role']=='Student'){
        header('location: dashboard.php');
    }
    if($_SESSION['user_role']=='Super Admin'){
        header('location: dashboard_super.php');
    }      

?>
<?php 
    $s = "SELECT * FROM department WHERE id=$dept";
    $q = mysqli_query($conn, $s);
    $row = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Create Course</title>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="dashboard_dept.php"><img src="img/puc.png" alt="logo" style="width:50px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="pending_users.php">Pending Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dept_register.php">Register</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Course
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="create_course.php">Create Course</a>
                            <a class="dropdown-item" href="all_course.php">All Course</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Session
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="create_session.php">Create Session</a>
                            <a class="dropdown-item" href="all_session.php">All Session</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Section
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="create_section.php">Create Section</a>
                            <a class="dropdown-item" href="all_section.php">All Section</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Offer Course
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="offer_course.php">Create Offer Course</a>
                            <a class="dropdown-item" href="all_offer_course.php">All Offer Course</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Assign Teacher
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="ass_teacher.php">Create Assign Teacher</a>
                            <a class="dropdown-item" href="all_ass_teacher.php">All Assign Teacher</a>
                        </div>
                    </li>
                    <li class="nav-item float-right">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="m-5">
            <h2>Name: <?php echo $name ?></h2>
            <h4>Department: <?php echo $row['name'] ?> </h4> 
            <br><br> 
            <h4>Create Course</h4>
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">Course Title:</label>
                    <input type="text" class="form-control" value="" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="code">Course Code:</label>
                    <input type="text" class="form-control" value="" id="code" name="code">
                </div>
                <div class="form-group">
                    <label for="">Course Credit: </label>
                    <select name="credit" id="" class="form-control">
                        <option value="">Select Course Credit</option>
                        <option value="1.00">1.00</option>
                        <option value="1.50">1.50</option>
                        <option value="2.00">2.00</option>
                        <option value="3.00">3.00</option>
                        <option value="4.00">4.00</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btnCreate">Create Course</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['btnCreate'])){
        $title = $_POST['title'];
        $code = $_POST['code'];
        $credit = $_POST['credit'];
        $s = "Insert into course(course_title, course_code, credit) 
                values ('".$title."','".$code."', '".$credit."')";
        if(mysqli_query($conn, $s)){
            echo 'Successfully Create Course.';
        }
    }
?>
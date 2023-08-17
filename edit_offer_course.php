<?php include 'connection.php'; ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php
    if($_SESSION['user_role']=='Student'){
        header('location: dashboard.php');
    }
    if($_SESSION['user_role']=='Teacher'){
        header('location: dashboard_teach.php');
    }
?> 
<?php 
    $off_id = $_REQUEST['off_id'];
    $s = "select * from offer_course where id=$off_id";
    $q = mysqli_query($conn, $s);
    $r = mysqli_fetch_assoc($q);
?>

<?php 
    $s1 = "Select * from department";
    $q1 = mysqli_query($conn, $s1);
?>

<?php 
    $s2 = "Select * from course";
    $q2 = mysqli_query($conn, $s2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Offer Course</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
                            Batch
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="create_batch.php">Create Batch</a>
                            <a class="dropdown-item" href="all_batch.php">All Batch</a>
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
        <h2>Edit Offer Course</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Department</label>
                <select name="department" id="" class="form-control">
                    <option value="">Select Department</option>
                    <?php 
                        while($row = mysqli_fetch_assoc($q1)){ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php  }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Semester</label>
                <select name="semester" id="" class="form-control">
                    <option value="">Select Semester</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
                    <option value="4th">4th</option>
                    <option value="5th">5th</option>                    
                    <option value="6th">6th</option>                    
                    <option value="7th">7th</option>                    
                    <option value="8th">8th</option>                
                </select>
            </div>
            <div class="form-group">
                <label for="">Course</label>
                <select name="course" id="" class="form-control">
                    <option value="">Select Course</option>
                    <?php 
                        while($row2 = mysqli_fetch_assoc($q2)){ ?>
                            <option value="<?php echo $row2['id'] ?>"><?php echo $row2['course_title'] ?></option>
                        <?php  }
                    ?>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="submitBtn">Update</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['submitBtn'])){
        $dept = $_POST['department'];
        $course = $_POST['course'];
        $semester = $_POST['semester'];
        $str = "update offer_course set  semester='".$semester."', dept_id='".$dept."', course_id='".$course."' where id= $off_id";
        if(mysqli_query($conn, $str)){
           header('Location: all_offer_course.php');
        }
    }
?>
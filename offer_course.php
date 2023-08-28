<?php include 'connection.php'; ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php
    $dept = $_SESSION['user_dept'];
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
    $s1 = "Select * from session";
    $q1 = mysqli_query($conn, $s1);
?>
<?php 
    $s4 = "Select * from course";
    $q4 = mysqli_query($conn, $s4);
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
    <title>Offer Course</title>
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
            <h2>Offer Course</h2>
            <form action="" method="post">
            <div class="form-group">
                <label for="">Session</label>
                <select name="session" id="" class="form-control">
                    <option value="">Select Session</option>
                    <?php 
                        while($row1 = mysqli_fetch_assoc($q1)){ ?>
                            <option value="<?php echo $row1['id'] ?>"><?php echo $row1['session'] ?></option>
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
            <label for="course">Course: </label>
            <?php 
                while($row4 = mysqli_fetch_assoc($q4)){ ?>
            <div class="form-check">
                <label class="form-check-label" for="check1">
                    <input type="checkbox" class="form-check-input" name="course[]" value="<?php echo $row4['id'] ?>"><?php echo $row4['course_title'] ?>
                </label>
            </div>
            <?php  }
                ?>  
            <div>
                <button type="submit" class="btn btn-primary mt-2" name="submitBtn">Save</button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['submitBtn'])){
        $session = $_POST['session'];
        $semester = $_POST['semester'];
        $course = $_POST['course'];
        for($i=0;$i<sizeof($course);$i++){
            $str = "INSERT INTO offer_course(course_id,dept_id, semester, session_id)
                 VALUES ('".$course[$i]."', '".$dept."', '".$semester."', '".$session."')";
                 $n = mysqli_query($conn, $str);
            }
        if($n){
            echo 'Successfully Inserted';
        }
    }
?>
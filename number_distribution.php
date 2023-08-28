<?php include 'connection.php' ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php $id = $_SESSION['user_id']; ?>
<?php $name = $_SESSION['user_name']; ?>
<?php $dept = $_SESSION['user_dept']; ?>
<?php
    $s1 = "select * from session";
    $q1 = mysqli_query($conn, $s1);
?>
<?php
    $s2 = "Select * from department where id=$dept";
    $q2 = mysqli_query($conn, $s2);
    $r2=mysqli_fetch_assoc($q2);
?>
<?php 
$s3="select c.id as id, c.course_title as course from assign_teacher as at INNER JOIN course as c on at.course = c.id where at.teacher_id=$id";
$q3= mysqli_query($conn,$s3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Distribution</title>
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
                        <a class="nav-link" href="running_course.php">Running Course</a>
                    </li>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                          Number Distribution
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="number_distribution.php">Student Course Number Distribution</a>
                            <a class="dropdown-item" href="all_number_distribution.php">All Course Number Distribution</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                          Project Idea
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="approved_project_idea.php">Approved</a>
                            <a class="dropdown-item" href="pending_project_idea.php">Pending</a>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="m-5">
            <h2>User Name: <?php echo $name ?> </h2>
            <h5>Department: <?php echo $r2['name'] ?> </h5>
            <form action="" method="get">
                <div class="form-group d-block float-left mx-2">
                    <label for="">Session</label>
                    <select name="session" id="" class="form-control">
                        <option value="">Select Session</option>
                        <?php 
                            while($row2 = mysqli_fetch_assoc($q1)){ ?>
                                <option value="<?php echo $row2['id'] ?>"><?php echo $row2['session'] ?></option>
                            <?php  }
                        ?>
                    </select>
                </div>
                <div class="form-group d-block float-left mx-2">
                    <label for="">Course</label>
                    <select name="course" id="" class="form-control">
                        <option value="">Select Course</option>
                        <?php 
                            while($row1 = mysqli_fetch_assoc($q3)){ ?>
                                <option value="<?php echo $row1['id'] ?>"><?php echo $row1['course'] ?></option>
                            <?php  }
                        ?>
                    </select>
                </div>
                <div class="form-group d-block float-left mx-2">
                    <label class="d-block" for="">Student ID</label>
                    <input type="number" name="num" class="form-control" placeholder="Student ID">
                </div>
                <div class="form-group mx-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;" name="btnSearch">Search</button>
                </div>
            </form>
            <?php 

            if (isset($_GET['btnSearch'])){
                $session = $_GET['session'];
                $course =  $_GET['course'];
                $s_id = $_GET['num'];
                $s="select u.name as name, e.user_id as u_id from enroll as e INNER JOIN users as u on e.user_id = u.id where e.session_id= $session and e.course_id = $course and e.user_id=$s_id";
                $q= mysqli_query($conn, $s);
                $r=mysqli_fetch_array($q);
                if($r['name']){?>
                <h2 class="mt-4">Number Distribution</h2>
                <form action="" method="post">
                    <div>
                        <table class="table table-striped">
                            <thead>
                                <th>Name</th>
                                <th>ID</th>
                                <th>CT</th>
                                <th>MID</th>
                                <th>ASSIGNMENT</th>
                                <th>Attendance</th>
                                <th>Final</th>
                            </thead>
                            <tbody>                            
                                <tr>
                                    <td><?php echo $r['name']; ?></td>
                                    <td><?php echo $r['u_id'] ?></td>
                                    <td><input type="number" name="ct"> </td>
                                    <td><input type="number" name="mid"> </td>
                                    <td><input type="number" name="ass"> </td>
                                    <td><input type="number" name="att"> </td>
                                    <td><input type="number" name="final"> </td>
                                </tr>                
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2" name="submitBtn">Submit</button>
                    </div>
                </form>
            <?php }
        else{ 
            echo 'Information not found';
        }    
        }                    
                    ?>
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['submitBtn'])){
        $ct = $_POST['ct'];
        $mid = $_POST['mid'];
        $ass = $_POST['ass'];        
        $att = $_POST['att'];        
        $final = $_POST['final'];       
        $str = "INSERT INTO number_distribution(student_id, course_id, session_id, ct, mid, assignment, attendance, final)
            VALUES ('".$s_id."','".$course."', '".$session."', '".$ct."', '".$mid."', '".$ass."', '".$att."', '".$final."')";
        if(mysqli_query($conn, $str)){
            echo 'Successfully Inserted';
        }
    }
?>
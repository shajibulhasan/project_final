<?php include 'connection.php' ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php $dept = $_SESSION['user_dept']; ?>
<?php $id = $_SESSION['user_id']; ?>
<?php $name = $_SESSION['user_name']; ?>
<?php
    if($_SESSION['user_role']=='Super Admin'){
        header('location: dashboard_super.php');
    }
    if($_SESSION['user_role']=='Teacher'){
        header('location: dashboard_teach.php');
    }
    if($_SESSION['user_role']=='Department Admin'){
        header('location: dashboard_dept.php');
    }
?>
<?php 
    $sp = "SELECT * FROM department WHERE id=$dept";
    $qp = mysqli_query($conn, $sp);
    $rp = mysqli_fetch_assoc($qp);
?>
<?php 
$s1= "select * from session";
$q1 = mysqli_query($conn, $s1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project Idea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="dashboard.php"><img src="img/puc.png" alt="logo" style="width:50px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                          Enrollment
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="enroll.php">Create Enrollment</a>
                            <a class="dropdown-item" href="all_enroll.php">All Enrollment</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                          Project Idea
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="create_project_idea.php">Create Project Idea</a>
                            <a class="dropdown-item" href="status_project_idea.php">Status Project Idea</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="m-5">
        
        <h2>Name: <?php echo $name ?></h2>
        <h4>Department: <?php echo $rp['name'] ?> </h4> 
        <br><br>
        <form action="" method="get">
            <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Session</label>
                            <select name="session" id="" class="form-control">
                                <option value="">Select session</option>
                                <?php 
                                    while($row1 = mysqli_fetch_assoc($q1)){ ?>
                                        <option value="<?php echo $row1['id'] ?>"><?php echo $row1['session'] ?></option>
                                    <?php  }
                                ?>
                            </select>
                        </div>
                 </div>
                 <div class="col-md-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px;" name="btnSearch">Search</button>
                </div>
            </div>
            </div>
            </form>
            <?php
                if (isset($_GET['btnSearch'])){ 

                $session = $_GET['session'];
                $s = "select c.id as id, c.course_title as course_title from enroll as e INNER JOIN course as c on e.course_id = c.id  where user_id=$id and session_id = $session";
                $q=mysqli_query($conn,$s); ?>

                <h4>Create Project Idea</h4>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Course:</label>
                        <select name="course" id="" class="form-control">
                            <option value="">Select Course</option>
                            <?php 
                                while($row1 = mysqli_fetch_assoc($q)){ ?>
                            <option value="<?php echo $row1['id'] ?>"><?php echo $row1['course_title'] ?></option>
                            <?php  }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Project Idea</label>
                        <textarea class="form-control" name="idea" rows="5" id="comment"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Group Number</label>
                        <input type="number" name="number" class="form-control">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2" name="submitBtn">Submit</button>
                    </div>
                </form>
             <?php }
            ?> 
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['submitBtn'])){
        $course = $_POST['course'];
        $idea = $_POST['idea'];
        $number = $_POST['number'];        
        $str = "INSERT INTO project_idea(user_id,course_id, session_id, group_number, idea)
                 VALUES ('".$id."','".$course."', '".$session."', '".$number."', '".$idea."')";

        if(mysqli_query($conn, $str)){
            echo 'Successfully Inserted';
        }
    }
?>
<?php include 'connection.php' ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php $id = $_SESSION['user_id']; ?>
<?php $name = $_SESSION['user_name']; ?>
<?php $dept = $_SESSION['user_dept']; ?>
<?php
    if($_SESSION['user_role']=='Super Admin'){
        header('location: dashboard_super.php');
    }
    if($_SESSION['user_role']=='Student'){
        header('location: dashboard.php');
    }
    if($_SESSION['user_role']=='Department Admin'){
        header('location: dashboard_dept.php');
    }
?>
<?php
    $s1 = "select * from session";
    $q1 = mysqli_query($conn, $s1);
?>
<?php
    $s2 = "Select * from department where id=$dept";
    $q2 = mysqli_query($conn, $s2);
    $r2=mysqli_fetch_assoc($q2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Running Course</title>
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
        <h3>User Name: <?php echo $name ?> </h3>
        <h5>Department: <?php echo $r2['name'] ?> </h5>
        <br><br>      
            <form action="" method="get">
                <div class="form-row">
                    <div class="col-lg-3">
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
                    <div class="col-lg-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px;" name="btnSearch">Search</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                if (isset($_GET['btnSearch'])){
                    $session = $_GET['session'];
                    $s = "select c.course_title as course, at.semester as semester, at.section as section from assign_teacher as at INNER JOIN course as c ON at.course=c.id where at.teacher_id=$id and at.session_id = $session"; 
                    $q = mysqli_query($conn, $s);
                    ?>
                <h2>Running Course</h2>
                <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Semester</th>
                    <th>Section</th>                                       
                </thead>
                <tbody>
                    <?php
                    $n=1;
                        while($r = mysqli_fetch_array($q)) { ?>
                            <tr>
                                <td><?php echo $n++ ?></td>
                                <td><?php echo $r['course']?></td>
                                <td><?php echo $r['semester']?></td>
                                <td><?php echo $r['section']?></td>
                            </tr>
                        <?php }
                    ?>
                </tbody>
            </table>

              <?php  }
            ?>
        </div>
    </div>
</body>
</html>
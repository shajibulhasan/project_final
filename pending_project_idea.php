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
    <title>Pending Project idea</title>
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
                <div class="form-group mx-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;" name="btnSearch">Search</button>
                </div>
            </form>
            <?php
                if (isset($_GET['btnSearch'])){
                    $session = $_GET['session'];
                    $course =  $_GET['course'];
                    $s = "select pi.id as id, c.course_title as course, pi.idea as idea, pi.group_number as gnum from project_idea as pi INNER JOIN course as c ON pi.course_id=c.id where pi.session_id=$session and pi.course_id = $course and status=0";
                    $q = mysqli_query($conn, $s); ?>
                    <h2 class="m-4">Pending Project Idea</h2>
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Course</th>
                            <th>Group Number</th>
                            <th>Idea</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $n=1;
                            while($r=mysqli_fetch_array($q)){?>                                
                            <tr>
                                <td><?php echo $n++; ?></td>
                                <td><?php echo $r['course']; ?></td>
                                <td><?php echo $r['gnum']; ?></td>
                                <td><?php echo $r['idea']; ?></td>
                                <td>
                                    <a href="approved_idea.php?project_id=<?php echo $r['id']; ?>">Approved</a>
                                </td>
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
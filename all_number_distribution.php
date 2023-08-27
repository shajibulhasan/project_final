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
    <title>All Number Distribution</title>
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
                $s = "select nb.id as id, c.course_title as course, u.name as name, nb.ct as ct, nb.mid as mid, nb.assignment as ass, nb.attendance as att, nb.final as final from number_distribution as nb INNER JOIN course as c ON nb.course_id=c.id INNER JOIN users as u ON nb.student_id=u.id where nb.course_id=$course and nb.session_id=$session and nb.student_id=$s_id";
                $q=mysqli_query($conn, $s);
                $r = mysqli_fetch_array($q); ?>
                <h2 class="mt-4">Number Distribution</h2>
                <form action="" method="post">
                    <div>
                        <table class="table table-striped">
                            <thead>
                                <th>NAME</th>
                                <th>COURSE NAME</th>
                                <th>CT</th>
                                <th>MID</th>
                                <th>ASSIGNMENT</th>
                                <th>ATTENDANCE</th>
                                <th>FINAL</th>
                                <th>ACTION</th>
                            </thead>
                            <tbody>                            
                                <tr>
                                    <td><?php echo $r['name']; ?></td>                                    
                                    <td><?php echo $r['course']; ?></td>                                  
                                    <td><?php echo $r['ct']; ?></td>                                  
                                    <td><?php echo $r['mid']; ?></td>                                  
                                    <td><?php echo $r['ass']; ?></td>                                  
                                    <td><?php echo $r['att']; ?></td>                                  
                                    <td><?php echo $r['final']; ?></td>
                                    <td>
                                        <a class="btn btn-secondary" href="edit_number_distribution.php?ndis_id=<?php echo $r['id'] ?>">Update</a>
                                        <a class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $r['id'] ?>" >Delete</a>
                                        <div class="modal" id="myModal<?php echo $r['id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Confirmation</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        Are you sure you want to delete <?php echo $r['name'] ?>
                                                    </div>
                                                
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="delete_number_distribution.php?ndis_id=<?php echo $r['id'] ?>" class="btn btn-danger">Yes</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>                                
                                </tr>                
                            </tbody>
                        </table>
                    </div>
                </form>
           <?php }
            ?>
        </div>
    </div>
</body>
</html>
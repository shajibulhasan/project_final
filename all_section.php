<?php
    include 'connection.php';
?>
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
    $s1 = "select * from session";
    $q1 = mysqli_query($conn, $s1)
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
    <title>All Section</title>
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
            <h2>Search Section</h2>
            <form action="" method="get">
                <div class="form-group d-block float-left mx-3">
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
                <div class="form-group d-block float-left mx-3">
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
                <div class="form-group mx-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;" name="btnSearch">Search</button>
                </div>
            </form>
            <?php
                if(isset($_GET['btnSearch'])){
                    $session = $_GET['session'];
                    $semester = $_GET['semester'];
                    $s = "SELECT * FROM section WHERE semester = '$semester' AND session_id=$session AND dept_id=$dept";
                    $q = mysqli_query($conn, $s);
                    ?>
                    <h2 class="d-block">All Section</h2>
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Section</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        <?php
                            $n=1;
                            while($r = mysqli_fetch_array($q)) { ?>
                                <tr>
                                    <td><?php echo $n++ ?></td>
                                    <td><?php echo $r['section']?></td>
                                    <td>
                                        <a class="btn btn-secondary" href="edit_section.php?sec_id=<?php echo $r['id'] ?>">Update</a>
                                        <a class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $r['id'] ?>" >Delete</a>
                                        <div class="modal" id="myModal<?php echo $r['id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Confirmation</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        Are you sure you want to delete section <?php echo $r['section'] ?>
                                                    </div>
                                                
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="delete_section.php?sec_id=<?php echo $r['id'] ?>" class="btn btn-danger">Yes</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        ?>
                    </tbody>
                    </table>
                <?php
                }
            ?>
        </div>
    </div>
</body>
</html>
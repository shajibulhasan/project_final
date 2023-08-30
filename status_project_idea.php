<?php include 'connection.php' ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>

<?php $dept = $_SESSION['user_dept']; ?>
<?php $name = $_SESSION['user_name']; ?>
<?php $id = $_SESSION['user_id']; ?>
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
$s2="select * from department where id= $dept";
$q2= mysqli_query($conn,$s2);
$r2=mysqli_fetch_array($q2);
?>
<?php 
$s="select * from session";
$q= mysqli_query($conn,$s);
?>
<?php 
$s1="select c.id as id, c.course_title as course from enroll  as e INNER JOIN course as c on e.course_id=c.id  where user_id=$id ";
$q1= mysqli_query($conn,$s1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All project Idea</title>
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
            <h2>User name: <?php echo $name ?> </h2>
            <h5>Department: <?php echo $r2['name'] ?> </h5>
            <form action="" method="get">
                <div class="form-group d-block float-left mx-3">
                    <label for="">Session</label>
                    <select name="session" id="" class="form-control">
                        <option value="">Select Session</option>
                        <?php 
                            while($row2 = mysqli_fetch_assoc($q)){ ?>
                                <option value="<?php echo $row2['id'] ?>"><?php echo $row2['session'] ?></option>
                            <?php  }
                        ?>
                    </select>
                </div>
                <div class="form-group d-block float-left mx-3">
                    <label for="">Course</label>
                    <select name="course" id="" class="form-control">
                        <option value="">Select Course</option>
                        <?php 
                            while($row1 = mysqli_fetch_assoc($q1)){ ?>
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
                if(isset($_GET['btnSearch'])){
                    $session = $_GET['session'];
                    $course =  $_GET['course'];
                    $s4 = "select s.session as session, c.course_title as course, pi.id as id, pi.group_number as gnum, pi.status as status, pi.idea as idea from project_idea as pi INNER JOIN course as c on pi.course_id = c.id INNER JOIN session as s on pi.session_id = s.id where pi.user_id = $id and pi.session_id = $session and pi.course_id = $course";
                    $q3 = mysqli_query($conn, $s4);
                    ?>
                    <h2 style="margin-top: 32px;">Project Idea:</h2>
                    <table class="table table-striped">
                        <thead>
                            <th>Course Name</th>
                            <th>Session</th>
                            <th>Group Number</th>
                            <th>Idea</th> 
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                                while($r3= mysqli_fetch_array($q3)) { ?>
                                    <tr>
                                        <td><?php echo $r3['course']?></td>                            
                                        <td><?php echo $r3['session']?></td>                                
                                        <td><?php echo $r3['gnum']?></td>
                                        <td class="text-justify"><?php echo $r3['idea']?></td>
                                        <td><?php 
                                        if ($r3['status'] == 1)                                        
                                            echo 'Approved';
                                        else
                                            echo 'Not Approved';                                        
                                        ?></td>
                                        <td>
                                    <a class="btn btn-secondary m-2" href="edit_project_idea.php?idea_id=<?php echo $r3['id'] ?>">Update</a>
                                    <a class="btn btn-danger m-2" data-toggle="modal" data-target="#myModal<?php echo $r3['id'] ?>" >Delete</a>
                                    <div class="modal" id="myModal<?php echo $r3['id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Confirmation</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                    Are you sure you want to delete <?php echo $r3['course'] ?>
                                                </div>
                                            
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <a href="delete_project_idea.php?idea_id=<?php echo $r3['id'] ?>" class="btn btn-danger">Yes</a>
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

                <?php }
            ?>
        </div>
    </div>
</body>
</html>
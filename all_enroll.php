<?php include 'connection.php' ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php $dept = $_SESSION['user_dept']; ?>
<?php $id = $_SESSION['user_id']; ?>
<?php $name = $_SESSION['user_name']; ?>

<?php
    $s1 = "Select * from department where id=$dept";
    $q1 = mysqli_query($conn, $s1);
    $r1=mysqli_fetch_assoc($q1);
?>
<?php 
    $s2 = "select * from session";
    $q2 = mysqli_query($conn, $s2)
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Studnt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="dashboard_dept.php"><img src="img/puc.png" alt="logo" style="width:50px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_enroll.php">All-Enrollment</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="m-5">
            <h2>User name: <?php echo $name ?> </h2>
            <h5>Department: <?php echo $r1['name'] ?> </h5>
            <form action="" method="get">
                <div class="form-group d-block float-left mx-3">
                    <label for="">Session</label>
                    <select name="session" id="" class="form-control">
                        <option value="">Select Session</option>
                        <?php 
                            while($row2 = mysqli_fetch_assoc($q2)){ ?>
                                <option value="<?php echo $row2['id'] ?>"><?php echo $row2['session'] ?></option>
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
                    $s = "select e.id as id, s.section as section, c.course_title as course, e.semester as semester, e.types as types from enroll as e INNER JOIN section as s ON e.section_id=s.id INNER JOIN course as c ON e.course_id=c.id where e.session_id = $session AND e.dept_id = $dept AND e.user_id = $id";
                    $q = mysqli_query($conn, $s);
                    ?>
                    
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Section</th>
                            <th>Semester</th>
                            <th>Type</th>
                            <th>Action</th>                    
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                                while($r = mysqli_fetch_array($q)) { ?>
                                    <tr>
                                        <td><?php echo $n++ ?></td>
                                        <td><?php echo $r['course']?></td>                            
                                        <td><?php echo $r['section']?></td>                                
                                        <td><?php echo $r['semester']?></td>
                                        <td><?php echo $r['types']?></td>

                                        <td>
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
                                                            <a href="delete_dept.php?dept_id=<?php echo $r['id'] ?>" class="btn btn-danger">Yes</a>
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
</body>
</html>
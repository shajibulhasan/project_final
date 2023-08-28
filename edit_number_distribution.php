<?php include 'connection.php' ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php $id = $_SESSION['user_id']; ?>
<?php $name = $_SESSION['user_name']; ?>
<?php $dept = $_SESSION['user_dept']; ?>

<?php
  $ndis_id= $_REQUEST['ndis_id'];
  $s = "select * from number_distribution where id=$ndis_id";
  $q = mysqli_query($conn, $s);
  $r = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h2 class="mt-4">Edit Number Distribution</h2>
                <form action="" method="post">
                    <div>
                        <table class="table table-striped">
                            <thead>
                                <th>CT</th>
                                <th>MID</th>
                                <th>ASSIGNMENT</th>
                                <th>Attendance</th>
                                <th>Final</th>
                            </thead>
                            <tbody>                            
                                <tr>
                                    <td><input type="number" value="<?php echo $r['ct'];?>" name="ct"> </td>
                                    <td><input type="number" value="<?php echo $r['mid'];?>" name="mid"> </td>
                                    <td><input type="number" value="<?php echo $r['assignment'];?>" name="ass"> </td>
                                    <td><input type="number" value="<?php echo $r['attendance'];?>" name="att"> </td>
                                    <td><input type="number" value="<?php echo $r['final'];?>" name="final"> </td>
                                </tr>                
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2" name="submitBtn">Update</button>
                    </div>
               </form>
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
        $str = "update number_distribution set ct='".$ct."', mid='".$mid."', assignment='".$ass."', attendance='".$att."', final='".$final."'";

        if(mysqli_query($conn, $str)){
           echo 'Successfully Update';
           
        }
    }
?>
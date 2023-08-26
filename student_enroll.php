<?php include 'connection.php' ?>

<?php 
    $s1 = "Select * from session";
    $q1 = mysqli_query($conn, $s1);
?>
<?php 
    $s2 = "SELECT * FROM course, section;";
    $q2 = mysqli_query($conn, $s2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enroll</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="dashboard_super.php"><img src="img/puc.png" alt="logo" style="width:50px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    
                <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
    </nav>
    <div class="m-5">
        <h2>Enrollment</h2>
        <form action=""method="post">
        <div class="form-group">
                <label for="">Session</label>
                <select name="department" id="" class="form-control">
                    <option value="">Select Session</option>
                    <?php 
                        while($row1 = mysqli_fetch_assoc($q1)){ ?>
                            <option value="<?php echo $row1['id'] ?>"><?php echo $row1['session'] ?></option>
                        <?php  }
                    ?>
                </select>
            </div>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label pr-2" for="">Section</label>
            <?php 
                while($row2 = mysqli_fetch_assoc($q2)){ ?>
                <label class="form-check-label pr-2">
                    <input type="checkbox" class="form-check-input" value="<?php echo $row2['id'] ?>"><?php echo $row2['section'] ?>
                </label>
                <?php  }
            ?>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['submitBtn'])){
        $session = $_POST['session_id'];
        $dept = $_POST['dept_id'];
        $batch = $_POST['batch_id'];
        $sec = $_POST['sec_id'];
        $str = "INSERT INTO course(course_name, dept_id, batch_id, sec_id)
                 VALUES ('".$course."',$dept,$batch,$sec)";
        
        if(mysqli_query($conn, $str)){
            echo 'Successfully Inserted';
        }
    }
?>
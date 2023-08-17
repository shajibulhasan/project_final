<?php include 'connection.php'; ?>
<?php 
    $department_id = $_REQUEST['dept_id'];
    $s = "select * from department where id=$department_id";
    $q = mysqli_query($conn, $s);
    $r = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="#">
                        <img src="img/puc.png" alt="logo" style="width:50px;">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_register.php">Register</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Department
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="create_dept.php">Create Department</a>
                        <a class="dropdown-item" href="all_department.php">All Department</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Department Admin
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="create_dept_admin.php">Create Department Admin</a>
                        <a class="dropdown-item" href="all_dept_admin.php">All Department Admin</a>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>
        <div class="m-5">
            <h2>Edit Department</h2>
            <form action=""  method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" value="<?php echo $r['name'] ?>" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="short_name">Short Name</label>
                    <input type="text" value="<?php echo $r['short_name'] ?>" class="form-control" name="short_name" id="short_name">
                </div>
                <div class="form-group">
                    <label for="estAt">Established</label>
                    <input type="date" value="<?php echo $r['established'] ?>" class="form-control" name="estAt" id="estAt">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="submitBtn">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['submitBtn'])){
        $dept_name = $_POST['name'];
        $dept_short_name = $_POST['short_name'];
        $dept_estAt = $_POST['estAt'];
        $str = "update department set name='".$dept_name."', short_name='".$dept_short_name."', 
                established='".$dept_estAt."' where id= $department_id";
        if(mysqli_query($conn, $str)){
           header('Location: all_department.php');
        }
    }
?>
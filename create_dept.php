<?php
    include 'connection.php';
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
    <title>Create Department</title>
</head>
<body>
    <div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="dashboard_super.php"><img src="img/puc.png" alt="logo" style="width:50px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
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
            </div>
        </nav>
        <div class="m-5">
            <h2>Create Department</h2>
            <form action="" method="post" >
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="short_name">Short Name</label>
                    <input type="text" class="form-control" name="short_name" id="short_name">
                </div>
                <div class="form-group">
                    <label for="estAt">Established</label>
                    <input type="date" class="form-control" name="estAt" id="estAt">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="submitBtn">Save</button>
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
        $str = "INSERT INTO department(name, short_name, established)
                 VALUES ('".$dept_name."', '".$dept_short_name."', '".$dept_estAt."')";
        if(mysqli_query($conn, $str)){
            echo 'Successfully Create Department';
        }
    }
?>
<?php
    include 'connection.php';
?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php
    $s = "select a.id as id, a.name as name, d.name as dept from admin as a INNER JOIN department as d ON a.role='Department Admin' and a.dept_id=d.id";
    $q = mysqli_query($conn, $s);
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
    <title>All Department Admin</title>
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
            <h2>All Department Admin</h2>
            <table class="table table-striped">
                <thead>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        while($r = mysqli_fetch_array($q)){ ?>
                            <tr>
                                <td><?php echo $r['name'] ?></td>
                                <td><?php echo $r['dept'] ?></td>
                                <td>
                                    <a href="remove_dept_admin.php?rid=<?php echo $r['id'] ?>">Remove Admin</a>
                                </td>
                            </tr>
                    <?php    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
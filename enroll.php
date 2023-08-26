<?php include 'connection.php' ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php $dept = $_SESSION['user_dept']; ?>
<?php $id = $_SESSION['user_id']; ?>

<?php 
    $s1 = "Select * from session";
    $q1 = mysqli_query($conn, $s1);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Student</title>
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
            <h2>Enrollment</h2>

            <form action="" method="get">
            <div class="form-row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Session</label>
                            <select name="session" id="" class="form-control">
                                <option value="">Select session</option>
                                <?php 
                                    while($row1 = mysqli_fetch_assoc($q1)){ ?>
                                        <option value="<?php echo $row1['id'] ?>"><?php echo $row1['session'] ?></option>
                                    <?php  }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
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
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px;" name="btnSearch">Search</button>
                        </div>
                    </div>
                </div>
            </form>
            
            <?php
                if (isset($_GET['btnSearch'])) {

                    $session = $_GET['session'];
                    $semester = $_GET['semester'];

                    $s = "Select DISTINCT oc.id as id, c.course_title as course_title from offer_course as oc INNER JOIN course as c ON oc.course_id = c.id where semester = '$semester' and session_id = $session";
                    $q = mysqli_query($conn, $s);

                    $s2 = "select DISTINCT * from section where dept_id = $dept and session_id = $session and semester = '$semester'";
                    $q2 = mysqli_query($conn, $s2);
                    ?>
                    <form action="" method="post">
                    <label for="course">Course: </label>
                    <?php 
                        while($row = mysqli_fetch_assoc($q)){ ?>
                        <div class="form-check">
                            <label class="form-check-label" for="check1">
                                <input type="checkbox" class="form-check-input" name="course[]" value="<?php echo $row['id'] ?>" ><?php echo $row['course_title'] ?>
                            </label>
                        </div>
                    <?php  }
                        ?>
                        <div class="form-group">
                            <label for="">Section</label>
                            <select name="section" id="" class="form-control">
                                <option value="">Select section</option>
                                <?php 
                                    while($r2 = mysqli_fetch_assoc($q2)){ ?>
                                        <option value="<?php echo $r2['id'] ?>"><?php echo $r2['section'] ?></option>
                                    <?php  }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Course Type</label>
                            <select name="type" id="" class="form-control">
                                <option value="">Select Type</option>
                                <option value="Regular">Regular</option>
                                <option value="Retake">Retake</option>
                                <option value="Recourse">Recourse</option>               
                            </select>
                        </div>  
                        <div>
                            <button type="submit" class="btn btn-primary mt-2" name="submitBtn">Enroll</button>
                        </div>
                    </form>
            <?php }
            ?>
        </div>
</div>
</body>
</html>
<?php 
    if(isset($_POST['submitBtn'])){
        $course = $_POST['course'];
        $section = $_POST['section'];
        $type = $_POST['type'];

        for($i=0;$i<sizeof($course);$i++){
            $str = "INSERT INTO enroll(course_id, dept_id, semester, session_id, section_id, types, user_id)
                 VALUES ('".$course[$i]."', '".$dept."', '".$semester."', '".$session."', '".$section."', '".$type."', '".$id."')";
                 $n = mysqli_query($conn, $str);
            }
        if($n){
            echo 'Successfully Inserted';
        }
    }
?>

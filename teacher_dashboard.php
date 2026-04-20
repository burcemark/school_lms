<?php
session_start();
include 'config.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != "teacher"){
    header("Location: teacher_login.php");
    exit();
}

$teacherName = $_SESSION['teacher_name'] ?? "Teacher";
?>

<!DOCTYPE html>
<html>
<head>
<title>Teacher Dashboard</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background: lightblue;
}


.sidebar{
    position:fixed;
    left:0;
    top:0;
    width:220px;
    height:100%;
    background:#2f3542;
    color:white;
    padding-top:20px;
}

.sidebar h3{
    text-align:center;
    margin-bottom:20px;
}

.sidebar a{
    display:block;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    transition:0.3s;
}

.sidebar a:hover{
    background:#57606f;
    padding-left:25px;
}


.main{
    margin-left:220px;
    padding:20px;
}

.topbar{
    background:white;
    padding:15px;
    border-radius:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.logout{
    background:#ff4757;
    color:white;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
}

.stats{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap:15px;
    margin-top:20px;
}

.stat-box{
    background:white;
    padding:20px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}

.stat-box:hover{
    transform:translateY(-5px);
}

.stat-box h2{
    margin:0;
    color:#667eea;
}


.cards{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap:15px;
    margin-top:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:12px;
    text-align:center;
    text-decoration:none;
    color:#333;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}

.card:hover{
    background:#667eea;
    color:white;
    transform:translateY(-5px);
}
</style>

</head>

<body>

<div class="sidebar">
    <h3> Teacher Panel</h3>
    <a href="#"> Dashboard</a>
    <a href="add_announcement.php"> Announcements</a>
    <a href="add_assignment.php"> Assignments</a>
    <a href="add_grade.php"> Grades</a>
    <a href="attendance.php"> Attendance</a>
    <a href="view_submissions.php"> Submissions</a>
    <a href="view_students.php"> Students</a>
    <a href="logout.php"> Logout</a>
</div>


<div class="main">

    <div class="topbar">
        <h2>Welcome, <?php echo $teacherName; ?> </h2>
    </div>

    <div class="stats">

        <div class="stat-box">
            <?php
            $students = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='student'");
            $studentCount = $students->fetch_assoc()['total'];
            ?>
            <h2><?php echo $studentCount; ?></h2>
            <p>Students</p>
        </div>

        <div class="stat-box">
            <?php
            $assignments = $conn->query("SELECT COUNT(*) as total FROM assignments");
            $assignmentCount = $assignments->fetch_assoc()['total'];
            ?>
            <h2><?php echo $assignmentCount; ?></h2>
            <p>Assignments</p>
        </div>

        <div class="stat-box">
            <?php
            $classes = $conn->query("SELECT COUNT(DISTINCT section) as total FROM grades");
            $classCount = $classes->fetch_assoc()['total'];
            ?>
            <h2><?php echo $classCount; ?></h2>
            <p>Classes</p>
        </div>

    </div>

    <h3 style="margin-top:25px;">Quick Actions</h3>

    <div class="cards">

        <a href="add_announcement.php" class="card"> Add Announcement</a>
        <a href="add_assignment.php" class="card"> Add Assignment</a>
        <a href="add_grade.php" class="card"> Add Grade</a>
        <a href="attendance.php" class="card"> Attendance</a>

    </div>
</div>

</body>
</html>
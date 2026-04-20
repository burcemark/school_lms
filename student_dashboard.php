<?php
session_start();
include 'config.php';

if(!isset($_SESSION['id'])){
    header("Location: student_login.php");
    exit;
}

$studentName = $_SESSION['name'] ?? 'Student';
$studentId = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Portal</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background: skyblue;
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
    background:#e74c3c;
    color:white;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
}

.welcome{
    margin-top:20px;
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
    padding:20px;
    border-radius:12px;
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
    <h3> Student Panel</h3>
    <a href="#"> Dashboard</a>
    <a href="view_announcements.php"> Announcements</a>
    <a href="view_assignments.php"> Assignments</a>
    <a href="view_grades.php"> Grades</a>
    <a href="submit_assignment.php"> Submit Work</a>
    <a href="logout.php"> Logout</a>
</div>

<div class="main">

    <div class="topbar">
        <h2>Welcome, <?php echo $studentName; ?> </h2>
    </div>

    <div class="welcome">
        <h3>Student Learning Portal</h3>
        <p>Access your classes, assignments, and grades anytime.</p>
    </div>

    <div class="stats">


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
            $ann = $conn->query("SELECT COUNT(*) as total FROM announcements");
            $annCount = $ann->fetch_assoc()['total'];
            ?>
            <h2><?php echo $annCount; ?></h2>
            <p>Announcements</p>
        </div>

        <div class="stat-box">
            <?php
            $grades = $conn->query("SELECT COUNT(*) as total FROM grades WHERE student_id='$studentId'");
            $gradeCount = $grades->fetch_assoc()['total'];
            ?>
            <h2><?php echo $gradeCount; ?></h2>
            <p>Grades</p>
        </div>

    </div>

    <h3 style="margin-top:25px;">Quick Access</h3>

    <div class="cards">

        <a href="view_announcements.php" class="card">Announcements</a>
        <a href="view_assignments.php" class="card">Assignments</a>
        <a href="view_grades.php" class="card">Grades</a>
        <a href="submit_assignment.php" class="card">Submit Work</a>

    </div>

</div>

</body>
</html>
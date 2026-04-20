<?php
session_start();
include 'config.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != "teacher"){
    header("Location: teacher_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Submissions</title>

<style>
body{
    font-family:Arial;
    background:#f1f2f6;
    margin:0;
}

.header{
    background:#2f3542;
    color:white;
    padding:15px;
    text-align:center;
}

.container{
    padding:20px;
}

h2{
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

th, td{
    padding:12px;
    text-align:center;
}

th{
    background:#667eea;
    color:white;
}

tr:nth-child(even){
    background:#f1f2f6;
}

a.download{
    background:#2ed573;
    color:white;
    padding:6px 10px;
    border-radius:5px;
    text-decoration:none;
}

a.download:hover{
    background:#1eae60;
}

.back{
    display:inline-block;
    margin-bottom:15px;
    background:#3742fa;
    color:white;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
}
</style>

</head>

<body>

<div class="header">
    <h2>Teacher - Student Submissions</h2>
</div>

<div class="container">

    <a href="teacher_dashboard.php" class="back">⬅ Back to Dashboard</a>

    <table>
        <tr>
            <th>Student Name</th>
            <th>Assignment</th>
            <th>File</th>
            <th>Date Submitted</th>
        </tr>

        <?php
    
        $query = "SELECT * FROM submissions ORDER BY submitted_at DESC";
        $result = $conn->query($query);

        if(!$result){
            die("SQL Error: " . $conn->error);
        }

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>
                        <td>{$row['student_id']}</td>
                        <td>{$row['assignment_title']}</td>
                        <td>
                            <a class='download' href='uploads/{$row['file']}' target='_blank'>View</a>
                        </td>
                        <td>{$row['submitted_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No submissions yet</td></tr>";
        }
        ?>
    </table>

</div>

</body>
</html>
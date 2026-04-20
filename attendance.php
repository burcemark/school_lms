<?php
session_start();
include 'config.php';

$msg = "";

if(isset($_POST['mark'])){

    $id = $_POST['student_id'];
    $status = $_POST['status'];

    $conn->query("INSERT INTO attendance(student_id, date, status)
    VALUES('$id', CURDATE(), '$status')");

    $msg = "✅ Attendance saved!";
}

$res = $conn->query("
    SELECT a.*, u.name 
    FROM attendance a 
    JOIN users u ON a.student_id = u.id
    WHERE a.date = CURDATE()
    ORDER BY a.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    margin:0;
}

.container{
    width:700px;
    margin:30px auto;
}

.card{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    margin-bottom:15px;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.back{
    background:#6c757d;
    color:white;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
}

select, input{
    width:100%;
    padding:10px;
    margin:6px 0;
    border:1px solid #ccc;
    border-radius:8px;
}

button{
    width:100%;
    padding:12px;
    background:#28a745;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#218838;
}

.msg{
    padding:10px;
    background:#d4edda;
    color:#155724;
    border-radius:8px;
    margin-bottom:10px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
}

th{
    background:#667eea;
    color:white;
}
</style>

</head>

<body>

<div class="container">

<div class="header">
    <h2> Attendance System</h2>
    <a href="teacher_dashboard.php" class="back">← Back</a>
</div>

<?php if($msg) echo "<div class='msg'>$msg</div>"; ?>

<div class="card">

<form method="POST">

<select name="student_id" required>
    <option value="">Select Student</option>
    <?php
    $s = $conn->query("SELECT id, name FROM users WHERE role='student'");
    while($r = $s->fetch_assoc()){
        echo "<option value='{$r['id']}'>{$r['name']}</option>";
    }
    ?>
</select>

<select name="status" required>
    <option value="Present">Present</option>
    <option value="Absent">Absent</option>
</select>

<button name="mark">Save Attendance</button>

</form>

</div>

<div class="card">
    <h3>Today Attendance</h3>

    <table>
        <tr>
            <th>Student</th>
            <th>Status</th>
        </tr>

        <?php while($row = $res->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php } ?>
    </table>

</div>

</div>

</body>
</html>
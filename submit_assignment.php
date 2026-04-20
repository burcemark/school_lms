<?php
session_start();
include 'config.php';

/* CHECK LOGIN */
if(!isset($_SESSION['id']) || $_SESSION['role'] != 'student'){
    header("Location: student_login.php");
    exit();
}

$msg = "";

/* SUBMIT ASSIGNMENT */
if(isset($_POST['submit'])){

    $id = $_SESSION['id'];
    $title = $_POST['title'];

    $file = $_FILES['file']['name'];
    $tmp  = $_FILES['file']['tmp_name'];

    $allowed = ['pdf','doc','docx','jpg','png'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if(in_array($ext, $allowed)){

        $newFile = time() . "_" . $file;
        move_uploaded_file($tmp, "uploads/" . $newFile);

        $conn->query("INSERT INTO submissions(student_id, assignment_title, file, submitted_at)
        VALUES('$id','$title','$newFile',CURDATE())");

        $msg = "Assignment submitted successfully!";
    } else {
        $msg = " Invalid file type!";
    }
}

$id = $_SESSION['id'];
$res = $conn->query("SELECT * FROM submissions WHERE student_id='$id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Submit Assignment</title>

<style>
body{
    font-family: Arial;
    margin:0;
    background:#f2f6ff;
    padding:20px;
}

.container{
    max-width:800px;
    margin:auto;
}

.card{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    margin-bottom:15px;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.back{
    text-decoration:none;
    background:#ddd;
    padding:6px 10px;
    border-radius:6px;
    color:#333;
}

input{
    width:100%;
    padding:10px;
    margin:8px 0;
    border:1px solid #ccc;
    border-radius:8px;
}

button{
    width:100%;
    padding:12px;
    background:#4facfe;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#00c6ff;
}

.msg{
    padding:10px;
    margin-bottom:10px;
    border-radius:8px;
    text-align:center;
}

.success{background:#d4edda;color:#155724;}
.error{background:#f8d7da;color:#721c24;}

.sub{
    padding:10px;
    border-bottom:1px solid #eee;
}

.file{
    color:#4facfe;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<div class="header">
    <h2>Submit Assignment</h2>
    <a class="back" href="student_dashboard.php">← Back</a>
</div>

<?php if($msg != "") { ?>
    <div class="msg <?php echo (strpos($msg,'')!==false?'success':'error'); ?>">
        <?php echo $msg; ?>
    </div>
<?php } ?>

<!-- AI -->
<div class="card">
    <form method="POST" enctype="multipart/form-data">

        <input name="title" placeholder="Assignment Title" required>

        <input type="file" name="file" required>

        <button name="submit">Upload Assignment</button>

    </form>
</div>
<!-- AI -->
<div class="card">
    <h3>My Submissions</h3>

    <?php if($res->num_rows > 0){ ?>
        <?php while($row = $res->fetch_assoc()){ ?>
            <div class="sub">
                <b><?php echo $row['assignment_title']; ?></b><br>
                <span class="file"> <?php echo $row['file']; ?></span><br>
                <small><?php echo $row['submitted_at']; ?></small>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No submissions yet.</p>
    <?php } ?>

</div>

</div>

</body>
</html>
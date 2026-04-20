<?php
include 'config.php';

if(isset($_POST['add'])){

    $title = $_POST['title'];
    $desc  = $_POST['desc'];
    $deadline = $_POST['deadline'];

    $fileName = "";

    if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){

        $fileName = time() . "_" . $_FILES['file']['name']; 
        $tmpName  = $_FILES['file']['tmp_name'];
        $target   = "uploads/" . $fileName;

        move_uploaded_file($tmpName, $target);
    }


    $conn->query("INSERT INTO assignments(title,description,deadline,file)
    VALUES('$title','$desc','$deadline','$fileName')");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Assignment</title>

<style>
body{
    font-family: Arial;
    background-color: lightblue;
}

.card{
    width:420px;
    background:#fff;
    margin:80px auto;
    padding:25px;
    border-radius:12px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
    margin-bottom:20px;
    color:#333;
}

label{
    font-weight:bold;
    font-size:14px;
}

input, textarea{
    width:100%;
    padding:12px;
    margin:8px 0 15px;
    border-radius:6px;
    border:1px solid #ccc;
    font-size:14px;
}

textarea{
    resize:none;
    height:100px;
}

.upload-box{
    border:2px dashed #aaa;
    padding:15px;
    text-align:center;
    border-radius:6px;
    margin-bottom:15px;
    font-size:14px;
}

button{
    width:100%;
    padding:12px;
    background:#667eea;
    color:#fff;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#5a67d8;
}

.back{
    text-align:center;
    margin-top:15px;
}

.back a{
    text-decoration:none;
    color:#667eea;
    font-weight:bold;
}
</style>

</head>

<body>

<div class="card">

<h2> Add Assignment</h2>

<form method="POST" enctype="multipart/form-data">

<label>Assignment Title</label>
<input name="title" placeholder="Enter title" required>

<label>Description</label>
<textarea name="desc" placeholder="Assignment details..." required></textarea>

<label>Deadline</label>
<input type="date" name="deadline" required>

<label>Upload Assignment (PDF / Image)</label>
<div class="upload-box">
<input type="file" name="file" accept=".pdf,.png,.jpg,.jpeg">
</div>

<button name="add"> Publish Assignment</button>

</form>

<div class="back">
<a href="teacher_dashboard.php">← Back to Dashboard</a>
</div>

</div>

</body>
</html>
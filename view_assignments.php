<?php 
include 'config.php';
$res = $conn->query("SELECT * FROM assignments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Assignments</title>

<style>
body{
    font-family: Arial;
    background: #f4f6f9;
    margin:0;
    padding:0;
}

.header{
    background: linear-gradient(135deg,#667eea,#764ba2);
    color:white;
    padding:20px;
    text-align:center;
    font-size:22px;
    font-weight:bold;
}

.back-btn{
    position:absolute;
    left:20px;
    top:20px;
    background:#fff;
    color:#667eea;
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
    box-shadow:0 2px 5px rgba(0,0,0,0.2);
}

.container{
    width:80%;
    margin:40px auto;
}

.card{
    background:white;
    padding:20px;
    margin-bottom:20px;
    border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
    border-left:5px solid #667eea;
}

.card h3{
    margin:0;
    color:#333;
}

.card p{
    color:#555;
    margin:8px 0;
}

.deadline{
    font-size:13px;
    color:#e74c3c;
    font-weight:bold;
}

.download{
    display:inline-block;
    margin-top:10px;
    padding:8px 12px;
    background:#667eea;
    color:white;
    text-decoration:none;
    border-radius:5px;
    font-size:13px;
}

.download:hover{
    background:#5a67d8;
}

.no-file{
    font-size:13px;
    color:#999;
    margin-top:10px;
}
</style>

</head>

<body>

<div class="header">
    Published Assignments
    <a href="student_dashboard.php" class="back-btn">← Back</a>
</div>

<div class="container">

<?php while($r = $res->fetch_assoc()){ ?>

<div class="card">

    <h3><?php echo $r['title']; ?></h3>

    <p><?php echo $r['description']; ?></p>

    <div class="deadline">
        Deadline: <?php echo $r['deadline']; ?>
    </div>

    <?php if(!empty($r['file'])){ ?>
        <a class="download" href="uploads/<?php echo $r['file']; ?>" download>
            Download File
        </a>
    <?php } else { ?>
        <div class="no-file">No file uploaded</div>
    <?php } ?>

</div>

<?php } ?>

</div>

</body>
</html>
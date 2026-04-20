<?php
session_start();

/* SAVE ROLE BEFORE DESTROY */
$role = $_SESSION['role'] ?? null;

/* CLEAR SESSION */
$_SESSION = [];
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<title>Logging out...</title>

<style>
body{
    margin:0;
    font-family:Arial;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(135deg,#667eea,#764ba2);
    color:white;
}

.box{
    text-align:center;
    background:rgba(255,255,255,0.1);
    padding:30px;
    border-radius:12px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.spinner{
    width:50px;
    height:50px;
    border:5px solid #fff;
    border-top:5px solid transparent;
    border-radius:50%;
    margin:0 auto 15px;
    animation:spin 1s linear infinite;
}

@keyframes spin{
    0%{transform:rotate(0deg);}
    100%{transform:rotate(360deg);}
}

p{
    margin-top:10px;
}
</style>

</head>

<body>

<div class="box">

<div class="spinner"></div>

<h2>Logging out...</h2>
<p>Please wait</p>

</div>

<script>
setTimeout(function(){

    let role = "<?php echo $role; ?>";

    if(role === "teacher"){
        window.location.href = "teacher_login.php";
    } else if(role === "student"){
        window.location.href = "student_login.php";
    } else {
        window.location.href = "index.html";
    }

}, 1500);
</script>

</body>
</html>
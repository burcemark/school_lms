<?php
session_start();
include 'config.php';

$error = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    $q = $conn->query("SELECT * FROM users WHERE email='$email' AND role='teacher'");

    if($q && $q->num_rows > 0){

        $u = $q->fetch_assoc();

        if(password_verify($pass, $u['password'])){

            $_SESSION['id'] = $u['id'];
            $_SESSION['teacher_name'] = $u['name'];
            $_SESSION['role'] = 'teacher';

            header("Location: teacher_dashboard.php");
            exit();

        } else {
            $error = " Wrong password!";
        }

    } else {
        $error = " Account not found!";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
<title>Teacher Login</title>

<style>

    body{
        font-family: Arial;
        margin: 0;
        height: 100vh;
        display:flex;
        align-items:center;
        justify-content:center;
        background-color: skyblue;
    }

    h2{
    text-align:center;
    margin-bottom:20px;
    color:#333;
}
</style>

</head>

<body>

<div class="box">


<h2> Teacher Login</h2>

<?php if($error != "") { ?>
    <div class="error"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

</form>

<div class="register-box">

    <div class="small-text">Don’t have a teacher account?</div>

    <a href="teacher_register.php" class="register-btn">
         Create Account
    </a>
</div>

</div>

</body>
</html>
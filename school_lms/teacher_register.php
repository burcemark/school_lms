<?php
include 'config.php';

$error = "";
$success = "";

if(isset($_POST['register'])){

    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $number = $_POST['number'];
    $email = $_POST['email'];

    $pass = $_POST['password'];
    $repass = $_POST['repassword'];


    if($pass != $repass){
        $error = " Password do not match!";
    } else {

        $hashed = password_hash($pass, PASSWORD_DEFAULT);

        $conn->query("INSERT INTO users 
        (name,email,password,role)
        VALUES(
            '$fname $mname $lname',
            '$email',
            '$hashed',
            'teacher'
        )");

        $success = " Account created successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Teacher Register</title>



</head>

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


<body>

<div class="box">

<h2> Teacher Register</h2>

<?php if($error) echo "<div class='error'>$error</div>"; ?>
<?php if($success) echo "<div class='success'>$success</div>"; ?>

<form method="POST">

<div class="row">
    <input name="fname" placeholder="First Name" required>
    <input name="mname" placeholder="Middle Name (optional)">
</div>

<input name="lname" placeholder="Last Name" required>

<input name="number" placeholder="Phone Number" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<input type="password" name="repassword" placeholder="Re-type Password" required>

<button name="register">Create Account</button>

</form>

<div class="login-box">
    Already have an account?
    <br>
    <a href="teacher_login.php" class="login-btn">
         Go to Login
    </a>
</div>

</div>

</body>
</html>
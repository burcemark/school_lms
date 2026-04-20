<?php
include 'config.php';

$error = "";

if(isset($_POST['register'])){

    $fname = trim($_POST['fname']);
    $mname = trim($_POST['mname']);
    $lname = trim($_POST['lname']);
    $number = trim($_POST['number']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];

    if($pass != $cpass){
        $error = "Passwords do not match!";
    } else {

        $hashed = password_hash($pass, PASSWORD_DEFAULT);

        $conn->query("INSERT INTO users 
        (name, email, password, role) 
        VALUES 
        ('$fname $mname $lname', '$email', '$hashed', 'student')");

        header("Location: student_login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Register</title>

<style>
body{
    font-family: Arial;
    margin:0;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background-image: url("bg.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

.box{
    width:420px;
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    position:relative;
}

.back{
    position:absolute;
    top:15px;
    left:15px;
    text-decoration:none;
    background:#eee;
    padding:6px 10px;
    border-radius:6px;
    font-size:13px;
    color:#333;
}

h2{
    text-align:center;
    margin-bottom:15px;
}

input{
    width:100%;
    padding:12px;
    margin:6px 0;
    border:1px solid #ccc;
    border-radius:8px;
    outline:none;
}

input:focus{
    border-color:#38f9d7;
    box-shadow:0 0 5px rgba(56,249,215,0.5);
}

button{
    width:100%;
    padding:12px;
    background:#00c6ff;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    margin-top:10px;
    transition:0.3s;
}

button:hover{
    background:#2bd6b8;
    transform:scale(1.02);
}

.error{
    background:#ffe5e5;
    color:#b30000;
    padding:10px;
    border-radius:8px;
    text-align:center;
    margin-bottom:10px;
}

.login-link{
    text-align:center;
    margin-top:10px;
    font-size:14px;
}

.login-link a{
    color:#38f9d7;
    font-weight:bold;
    text-decoration:none;
}
</style>

</head>

<body>

<div class="box">


<h2>Student Register</h2>
<h2>ACT 2-B</h2>

<?php if($error != "") { ?>
    <div class="error"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input name="fname" placeholder="First Name" required>

<input name="mname" placeholder="Middle Name (Optional)">

<input name="lname" placeholder="Last Name" required>

<input name="number" placeholder="Phone Number" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<input type="password" name="cpassword" placeholder="Retype Password" required>

<button name="register">Create Account</button>

</form>

<div class="login-link">
    Already have an account? <a href="student_login.php">Login here</a>
</div>

</div>

</body>
</html>
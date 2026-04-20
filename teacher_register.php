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
    width:380px;
    background:#fff;
    padding:30px;
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
    margin-bottom:20px;
    color:#333;
}

input{
    width:100%;
    padding:12px;
    margin:8px 0;
    border:1px solid #ccc;
    border-radius:8px;
    outline:none;
}

input:focus{
    border-color:#4facfe;
    box-shadow:0 0 5px rgba(79,172,254,0.5);
}

button{
    width:100%;
    padding:12px;
    background:#4facfe;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#00c6ff;
    transform:scale(1.02);
}

.error{
    background:#ffe5e5;
    color:#b30000;
    padding:10px;
    border-radius:8px;
    margin-bottom:10px;
    text-align:center;
}

.register{
    text-align:center;
    margin-top:15px;
    font-size:14px;
}

.register a{
    color:#4facfe;
    font-weight:bold;
    text-decoration:none;
}

.register a:hover{
    text-decoration:underline;
}
.login-box {
text-align: center;
padding-top: 20px;
}
</style>


<body>

<div class="box">

<h2> Teacher Register</h2>
<h2>ACT 2-B</h2>

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
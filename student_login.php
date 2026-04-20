<?php
session_start();
include 'config.php';

$error = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $q = $conn->query("SELECT * FROM users WHERE email='$email' AND role='student'");

    if($q && $q->num_rows > 0){
        $u = $q->fetch_assoc();

        if(password_verify($pass, $u['password'])){

            $_SESSION['id']   = $u['id'];
            $_SESSION['name'] = $u['name'];
            $_SESSION['role'] = 'student';

            header("Location: student_dashboard.php");
            exit;

        } else {
            $error = "❌ Wrong password!";
        }

    } else {
        $error = "❌ Account not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Login</title>

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
</style>

</head>

<body>

<div class="box">
<h2>Student Login</h2>
<h2>ACT 2-B </h2>

<?php if($error != "") { ?>
    <div class="error"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

</form>

<div class="register">
    Don’t have an account? <br>
    <a href="student_register.php">Create Student Account</a>
</div>

</div>

</body>
</html>
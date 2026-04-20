<?php
include 'config.php';
session_start();

$id = $_SESSION['id'] ?? 0;

if(!$id){
    echo "Please login first";
    exit;
}

$res = $conn->query("SELECT * FROM grades 
    WHERE student_id='$id'
    ORDER BY term ASC, subject ASC");

$total = 0;
$count = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>My Grades</title>

<meta http-equiv="refresh" content="5">

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    margin:0;
}

.header{
    background: linear-gradient(135deg,#667eea,#764ba2);
    color:white;
    padding:20px;
    text-align:center;
    position:relative;
}

.back-btn{
    position:absolute;
    left:20px;
    top:20px;
    background:white;
    color:#667eea;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}

.print-btn{
    position:absolute;
    right:20px;
    top:20px;
    background:#ff9800;
    color:white;
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
}

.card{
    width:80%;
    margin:30px auto;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:12px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#667eea;
    color:white;
}

.avg{
    text-align:center;
    font-size:18px;
    margin-top:15px;
    font-weight:bold;
}

.honor{
    text-align:center;
    font-size:22px;
    margin-top:10px;
    font-weight:bold;
}

.pass{ color:green; }
.fail{ color:red; }

@media print {
    body * {
        visibility: hidden;
    }
    #printArea, #printArea * {
        visibility: visible;
    }
    #printArea {
        position:absolute;
        left:0;
        top:0;
        width:100%;
    }
}
</style>

</head>

<body>

<div class="header">
<a href="student_dashboard.php" class="back-btn">← Back</a>

<h2>My Grade Report Card</h2>

<button class="print-btn" onclick="printReport()">🖨 Print</button>

</div>

<div class="card" id="printArea">

<table>
<tr>
<th>Subject</th>
<th>Grade</th>
<th>Term</th>
</tr>

<?php 
while($r = $res->fetch_assoc()){ 

$total += $r['grade'];
$count++;

$color = ($r['grade'] < 75) ? "fail" : "pass";
?>

<tr>
<td><?= $r['subject']; ?></td>
<td class="<?= $color ?>"><?= $r['grade']; ?></td>
<td><?= $r['term']; ?></td>
</tr>

<?php } ?>

</table>

<?php
if($count > 0){

    $avg = $total / $count;

    if($avg >= 97){
        $honor = " PRESIDENT LISTER";
    } elseif($avg >= 94){
        $honor = " VICE PRESIDENT LISTER";
    } elseif($avg >= 90){
        $honor = " DEAN LISTER";
    } elseif($avg >= 75){
        $honor = " KEEP UP THE GOOD WORK";
    } else {
        $honor = " FAILED";
    }

    echo "<div class='avg'>Average: ".number_format($avg,2)."</div>";
    echo "<div class='honor'>$honor</div>";
}
?>

</div>

<script>
function printReport(){
    //AI 
    window.print();
}
</script>

</body>
</html>
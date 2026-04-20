<?php
include 'config.php';

$msg = "";
$result = "";

$subjects = ["ART-APP","PATHFIT","MULTIMEDIA","SYSTEM-ANALYSIS"];

$sid = $_POST['student_id'] ?? '';
$section = $_POST['section'] ?? '';
$term = strtoupper($_POST['term'] ?? 'PRELIM');


$studentName = "";

if($sid){
    $res = $conn->query("SELECT name FROM users WHERE id='$sid'");
    if($res && $res->num_rows > 0){
        $studentName = $res->fetch_assoc()['name'];
    }
}


$locked = false;

if($sid && $section && $term){
    $chk = $conn->query("SELECT * FROM grades 
        WHERE student_id='$sid' 
        AND section='$section'
        AND term='$term'");
        
    if($chk->num_rows > 0){
        $locked = true;
    }
}

$allowInput = true;

if($term == "MIDTERM"){
    $chk = $conn->query("SELECT * FROM grades 
        WHERE student_id='$sid' AND term='PRELIM'");
    if($chk->num_rows == 0){
        $allowInput = false;
    }
}

if($term == "FINALS"){
    $chk = $conn->query("SELECT * FROM grades 
        WHERE student_id='$sid' AND term='MIDTERM'");
    if($chk->num_rows == 0){
        $allowInput = false;
    }
}

// AI
if(isset($_POST['save']) && !$locked && $allowInput){

    foreach($subjects as $sub){

        $a = $_POST['attendance'][$sub];
        $b = $_POST['activity'][$sub];
        $c = $_POST['quiz'][$sub];
        $d = $_POST['recitation'][$sub];

        $grade = ($a + $b + $c + $d) / 4;

        $conn->query("INSERT INTO grades 
        (student_id,subject,attendance,activity,quiz,recitation,grade,section,term)
        VALUES('$sid','$sub','$a','$b','$c','$d','$grade','$section','$term')
        ON DUPLICATE KEY UPDATE
        attendance='$a',
        activity='$b',
        quiz='$c',
        recitation='$d',
        grade='$grade'");
    }

    $msg = "Grades saved and LOCKED!";
    $locked = true;
}
// 

$data = [];

if($sid){
    $res = $conn->query("SELECT * FROM grades 
        WHERE student_id='$sid' 
        AND section='$section'
        AND term='$term'");

    while($row = $res->fetch_assoc()){
        $data[$row['subject']] = $row;
    }
}


if(isset($_POST['calculate']) || isset($_POST['print'])){

    $res = $conn->query("SELECT subject, grade FROM grades 
        WHERE student_id='$sid' 
        AND section='$section'
        AND term='$term'");

    $total = 0;
    $count = 0;
    // AI
    $result .= "<div id='printArea'>";
    $result .= "<h2>$term Grade Report</h2>";
    $result .= "<p><b>ID:</b> $sid</p>";
    $result .= "<p><b>Name:</b> $studentName</p>";
    $result .= "<p><b>Section:</b> $section</p>";

    $result .= "<table border='1' width='100%'>
    <tr><th>Subject</th><th>Final Grade</th></tr>";
    //

    while($row = $res->fetch_assoc()){

        $g = floatval($row['grade']);

        $result .= "<tr>
            <td>{$row['subject']}</td>
            <td>$g</td>
        </tr>";

        $total += $g;
        $count++;
    }

    $result .= "</table>";

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

        $result .= "<h2>Average: ".number_format($avg,2)."</h2>";
        $result .= "<h2>$honor</h2>";

    } else {
        $result .= "<p style='color:red;'>No data found</p>";
    }

    $result .= "</div>";

    if(isset($_POST['print'])){
        $result .= "<script>window.onload = () => window.print();</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Grade System</title>

<style>

body{font-family:Arial;background:skyblue;}
.card{width:700px;margin:30px auto;background:white;padding:20px;border-radius:10px;}
input,select{width:100%;padding:3px;margin:5px 0;}
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
th{background:#667eea;color:white;}
button{width:100%;padding:10px;margin-top:5px;border:none;color:white;}
.save{background:#667eea;}
.calc{background:#28a745;}
.print{background:#ff9800;}

.back-btn{
    display:inline-block;
    padding:8px 12px;
    background:#6c757d;
    color:white;
    text-decoration:none;
    border-radius:6px;
    margin-bottom:10px;
}

.back-btn:hover{
    background:#5a6268;
}

@media print {
    body * { visibility:hidden; }
    #printArea, #printArea * { visibility:visible; }
    #printArea { position:absolute; top:0; left:0; width:100%; }
}
</style>
</head>

<body>

<div class="card"> <a href="teacher_dashboard.php" 
   style="
   display:inline-block;
   padding:8px 12px;
   background:#6c757d;
   color:#fff;
   text-decoration:none;
   border-radius:6px;
   margin-bottom:10px;
   ">
   ← Back to Dashboard
</a>

<?php if($msg) echo "<p style='color:green'>$msg</p>"; ?>

<form method="POST">

<select name="student_id" required>
<option value="">Select Student</option>
<?php
$res = $conn->query("SELECT id, name FROM users");
while($row = $res->fetch_assoc()){
    $selected = ($sid == $row['id']) ? "selected" : "";
    echo "<option value='{$row['id']}' $selected>
    {$row['id']} - {$row['name']}
    </option>";
}
?>
</select>

<select name="section">
<option <?= $section=='ACT 2-A'?'selected':'' ?>>ACT 2-A</option>
<option <?= $section=='ACT 2-B'?'selected':'' ?>>ACT 2-B</option>
<option <?= $section=='ACT 2-B'?'selected':'' ?>>ACT 2-C</option>
<option <?= $section=='ACT 2-B'?'selected':'' ?>>ACT 2-D</option>
</select>

<select name="term">
<option <?= $term=='PRELIM'?'selected':'' ?>>Prelim</option>
<option <?= $term=='MIDTERM'?'selected':'' ?>>Midterm</option>
<option <?= $term=='FINALS'?'selected':'' ?>>Finals</option>
</select>

<?php if(!$allowInput): ?>
<p style="color:red;">⚠ Finish previous term first!</p>
<?php endif; ?>

<table>
<tr>
<th>Subject</th>
<th>Attendance</th>
<th>Activity</th>
<th>Quiz</th>
<th>Recitation</th>
</tr>

<?php
foreach($subjects as $sub){

$d = $data[$sub] ?? [];
$ro = ($locked || !$allowInput) ? "readonly" : "";

echo "<tr>
<td>$sub</td>
<td><input type='number' name='attendance[$sub]' value='".($d['attendance'] ?? '')."' $ro required></td>
<td><input type='number' name='activity[$sub]' value='".($d['activity'] ?? '')."' $ro required></td>
<td><input type='number' name='quiz[$sub]' value='".($d['quiz'] ?? '')."' $ro required></td>
<td><input type='number' name='recitation[$sub]' value='".($d['recitation'] ?? '')."' $ro required></td>
</tr>";
}
?>

</table>

<button class="save" name="save">Save Grades</button>
<button class="calc" name="calculate">Calculate</button>
<button class="print" name="print">Print</button>

</form>

</div>

<?= $result ?>

</body>
</html>
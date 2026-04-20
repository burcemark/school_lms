<?php
include 'config.php';

if (isset($_POST['add'])) {
    $msg = trim($_POST['message']);

    if (!empty($msg)) {
        $stmt = $conn->prepare("INSERT INTO announcements (message, created_at) VALUES (?, CURDATE())");
        $stmt->bind_param("s", $msg);
        $stmt->execute();
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM announcements WHERE id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Announcements</title>

<style>
body {
    font-family: Arial;
    background: lightblue;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: auto;
}

.card {
    background: white;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

textarea {
    width: 100%;
    padding: 7px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    padding: 10px;
    width: 100%;
    margin-top: 10px;
    border: none;
    border-radius: 8px;
    background: #007bff;
    color: white;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}

.btn {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    color: white;
    margin-right: 5px;
}

.delete {
    background: red;
}

.print {
    background: green;
}

.back {
    background: gray;
}

.top-actions {
    margin-bottom: 10px;
}
</style>
</head>

<body>

<div class="container">

<h2>Announcements</h2>

<div class="top-actions">
    <a href="teacher_dashboard.php" class="btn back"> Back</a>
    <button class="btn print" onclick="window.print()"> Print</button>
</div>


<div class="card">
    <form method="POST">
        <textarea name="message" placeholder="Write announcement..." required></textarea>
        <button name="add">Post Announcement</button>
    </form>
</div>

<?php
$result = $conn->query("SELECT * FROM announcements ORDER BY id DESC");

while ($row = $result->fetch_assoc()) {
?>
    <div class="card">
        <p><?php echo htmlspecialchars($row['message']); ?></p>
        <small> <?php echo $row['created_at']; ?></small><br><br>

        <a class="btn delete" href="?delete=<?php echo $row['id']; ?>"
           onclick="return confirm('Delete this announcement?')">Delete</a>
    </div>
<?php } ?>

</div>

</body>
</html>
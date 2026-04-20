<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>View Announcements</title>

<style>
body {
    font-family: Arial;
    background: skyblue;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: auto;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

h2 {
    margin: 0;
}

.btn {
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    color: white;
    font-size: 14px;
}

.print {
    background: green;
}

.back {
    background: gray;
}

.card {
    background: white;
    padding: 15px;
    margin-bottom: 12px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: 0.2s;
}

.card:hover {
    transform: scale(1.01);
}

.message {
    font-size: 16px;
    margin-bottom: 8px;
}

.date {
    font-size: 12px;
    color: #777;
}

@media print {
    .header {
        display: none;
    }
    body {
        background: white;
    }
}
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>Announcements</h2>

        <div>
            <a href="student_dashboard.php" class="btn back">Back</a>
            <button onclick="window.print()" class="btn print">Print</button>
        </div>
    </div>

    <?php
    $res = $conn->query("SELECT * FROM announcements ORDER BY id DESC");

    if ($res->num_rows > 0) {
        while ($r = $res->fetch_assoc()) {
    ?>
        <div class="card">
            <div class="message">
                <?php echo htmlspecialchars($r['message']); ?>
            </div>
            <div class="date">
                <?php echo $r['created_at']; ?>
            </div>
        </div>
    <?php
        }
    } else {
        echo "<p>No announcements available.</p>";
    }
    ?>

</div>

</body>
</html>
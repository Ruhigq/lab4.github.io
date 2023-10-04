<?php

include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="lux-dashboard">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p>You are now in the user dashboard page.</p>
        <a href="logout.php" class="lux-button">Logout</a>
        <p><a href="form.php">Go to Form</a></p>

    </div>
</body>
</html>

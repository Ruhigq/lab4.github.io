<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>You are now in the user dashboard.</p>
        <p><a href="logout.php">Logout</a></p>

        
        <h2>User Menu</h2>
        <form method="post" action="form_process.php">
            <input type="submit" name="display_data" value="Display Data" class="login-button" />
        </form>

        <?php
        require('db.php');

        
        if (isset($_POST['delete_user'])) {
            $user_id = $_POST['user_id'];
            $query = "DELETE FROM `users` WHERE id=$user_id";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo "<p>User with ID $user_id has been deleted.</p>";
            } else {
                echo "<p>Error: " . mysqli_error($con) . "</p>";
            }
        }

        if (isset($_POST['display_data'])) {
            $username = $_SESSION['username'];
            
         
            $query = "SELECT * FROM `users` WHERE username='$username'";
            $result = mysqli_query($con, $query);

            if ($result) {
                $data = mysqli_fetch_assoc($result);
                if ($data) {
                    $decodedData = json_decode($data['data_column_name'], true); 

                    echo "<h2>Your Data:</h2>";
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Actions</th></tr>";
                    
                    foreach ($decodedData as $row) {
                        $user_id = $row['id'];
                        echo "<tr>";
                        echo "<td>" . $user_id . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td><form method='post' action=''><input type='hidden' name='user_id' value='$user_id' /><input type='submit' name='delete_user' value='Delete' class='delete-button' /></form></td>";
                        echo "</tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "<p>no </p>";
                }
            } else {
                echo "<p>error: " . mysqli_error($con) . "</p>";
            }

            mysqli_close($con);
        }
        ?>
    </div>
</body>
</html>

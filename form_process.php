<?php
session_start();
require('db.php');


if (isset($_POST['display_data'])) {
    $username = $_SESSION['username'];
    
  
    $query = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            
            $user_data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $user_data[] = $row;
            }
            echo json_encode($user_data);
        } else {
            echo "No data found.";
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
}


if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $query = "DELETE FROM `users` WHERE id=$user_id";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "User with ID $user_id has been deleted.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

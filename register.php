


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    
    if (isset($_REQUEST['username'])) {
        
        $username = mysqli_real_escape_string($con, stripslashes($_REQUEST['username']));
        $email    = mysqli_real_escape_string($con, stripslashes($_REQUEST['email']));
        $password = mysqli_real_escape_string($con, stripslashes($_REQUEST['password']));
        $firstname = mysqli_real_escape_string($con, stripslashes($_REQUEST['firstname']));
        $lastname = mysqli_real_escape_string($con, stripslashes($_REQUEST['lastname']));
        
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT INTO `users` (firstname, lastname, username, password, email, create_datetime)
                     VALUES ('$firstname', '$lastname', '$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
            header("Location: login.php"); 
            exit();
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="firstname" placeholder="First Name" required />
        <input type="text" class="login-input" name="lastname" placeholder="Last Name" required />
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Address" required />
        <input type="password" class="login-input" name="password" placeholder="Password" required />
        <input type="submit" name="submit" value="Register" class="login-button" />
        <p class="link">Already have an account? <a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>

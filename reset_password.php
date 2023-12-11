<?php

?>
<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 50%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-image: url('f.jpg');
            background-repeat: no-repeat;
            background-position: center;
        }

        .container {
            background-size: 920px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }

        .reset-form {
            margin-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .container form {
            padding: 0 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Reset Password</h2>

      <?php
include('connec.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    $username_email = $_POST["username_email"];
    $new_password = $_POST["new_password"];

    $sql = "SELECT id, username, email FROM login WHERE username='$username_email' OR email='$username_email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE login SET password='$hashed_password' WHERE id=$user_id";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "<p class='text-success text-center'>Password reset successful!</p>";
        } else {
            echo "<p class='text-danger text-center'>Error resetting password. Please try again later.</p>";
        }
    } else {
        echo "<p class='text-danger text-center'>Username or email not found.</p>";
    }
}
?>


        <form action="reset_password.php" method="POST" class="reset-form">
            <div class="form-group">
                <label for="username">Username or Email:</label>
                <input type="text" class="form-control" id="username" name="username_email" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="reset_password" value="Reset Password">
            </div>
        </form>
        <div class="text-center">
             <a href="login.php">Back To Login<i class="fa-solid fa-arrow-left"></i></a>
        </div>
    </div>
</body>

</html>
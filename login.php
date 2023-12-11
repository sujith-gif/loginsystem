<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            background-image: url('f2.jpg');
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
        label {
            font-weight: bold;
        }


        .login-form {
            margin-top: 20px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Login</h2>
        <form action="" method="POST" class="login-form">
        <div class="form-group">
        <label for="email">Username or Email:</label>
        <input type="text" class="form-control" id="email" name="email">
    </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="login" value="Login">
            </div>
        </form>
        <div class="text-center">
            <a href="reset_password.php">Forgot Password?</a>
        </div>
        <?php
        if (isset($_GET['login']) && $_GET['login'] == 'success') {
            echo "<p class='text-success text-center'>Login successful!</p>";
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<p class='text-danger text-center'>Invalid email or password</p>";
        }
        ?>
        <div class="text-center">
            <p>Not registered yet? <a href="register.php">Sign Up</a></p>
        </div>
    </div>
</body>

</html>
<?php
include('connec.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = $_POST["username"];
    $username_email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT username, email, password FROM login WHERE username='$username_email' OR email='$username_email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // echo " $password";
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $row['username'];

            header("Location: user_details.php?login=success");
            exit();
        }
    }
    
}
?>
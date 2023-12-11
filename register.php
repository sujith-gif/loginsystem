<?php
include('validate.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
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
    background-image: url('f1.jpg');
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
    #message {
        margin-top: 10px;
        padding: 10px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }

    #message.success {
        color: green;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    #message.error {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

 
</style>

<body>
    <div class="container mt-5" >
        <h2 style="text-align: center;"><u>USER REGISTRATION</u></h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname">
                <span class="text-danger" id="firstnameError"><?php echo $firstnameErr; ?></span>
            </div>

            <div class="form-group">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname">
                <span class="text-danger" id="lastnameError"><?php echo $lastnameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="username" class="form-label">User Name:</label>
                <input type="text" class="form-control" id="username" name="username">
                <span class="text-danger" id="usernameError"><?php echo $usernameErr; ?></span>

            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
                <span class="text-danger" id="emailError"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger"><?php echo $passwordErr; ?></span>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                <span class="text-danger"><?php echo $passwordErr; ?></span>

            </div>

            <div class="form-group">
                <label for="file_upload" class="form-label">Upload Profile Picture:</label>
                <input type="file" class="form-control-file" id="file_upload" name="file_upload">
                <span class="text-danger"><?php echo $fileErr; ?></span>
            </div>
            <button type="submit" value="save" class="btn btn-primary">Register</button>

        </form> 
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        <div class="mt-3 text-center">
            <p>Already registered? <a href="login.php">Sign In</a></p>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
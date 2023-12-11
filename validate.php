
<?php

include('connec.php');
$usernameErr = $emailErr = $firstnameErr = $lastnameErr = $fileErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {








    if (empty($_POST["firstname"])) {
        $firstnameErr = "First Name is required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $firstnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["lastname"])) {
        $lastnameErr = "Last Name is required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $lastnameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["username"])) {
        $usernameErr = "User Name is required";
    } else {
        $username = test_input($_POST["username"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $usernameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($password)) {
        $passwordErr = "Password is required";
    } elseif (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $passwordErr = "Password must contain at least one uppercase letter";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $passwordErr = "Password must contain at least one lowercase letter";
    } elseif (!preg_match('/\d/', $password)) {
        $passwordErr = "Password must contain at least one number";
    } elseif (!preg_match('/[\W_]/', $password)) {
        $passwordErr = "Password must contain at least one special character";
    } elseif ($password !== $confirmPassword) {
        $passwordErr = "Passwords do not match";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    $uploadDir = "/opt/lampp/htdocs/loginsystem/Profile/";

    if (isset($_FILES["file_upload"]) && $_FILES["file_upload"]["error"] == UPLOAD_ERR_OK) {
        $fileSize = $_FILES["file_upload"]["size"];
        $fileType = $_FILES["file_upload"]["type"];
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];

        if ($fileSize > 5 * 1024 * 1024) {
            $fileErr = "File size exceeds the limit of 5MB.";
        }
        elseif (!in_array(pathinfo($_FILES["file_upload"]["name"], PATHINFO_EXTENSION), $allowedExtensions)) {
            $fileErr = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        } else {
            // File is valid, process the upload
            $fileDestination = $uploadDir . basename($_FILES["file_upload"]["name"]);
            if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $fileDestination)) {
                $file = "http://localhost/loginsystem/Profile/" . basename($_FILES["file_upload"]["name"]);
            } else {
                $fileErr = "File upload failed!";
            }
        }
    } else {
        $fileErr = "Invalid file upload!";
    }

    if (empty($firstnameErr) && empty($lastnameErr) && empty($usernameErr) && empty($emailErr) && empty($fileErr) && empty($passwordErr)) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



        $sql = "INSERT INTO login (firstname, lastname, username, email, password, profile_picture) 
                        VALUES ('$firstname', '$lastname', '$username', '$email', '$hashedPassword', '$file')";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Registred succesfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

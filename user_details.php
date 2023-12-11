<!DOCTYPE html>
<html>

<head>
    <title>User Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 60%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            text-align: center;

        }

        .profile-img {
            max-width: 200px;
            margin-top: 20px;
            border: 3px solid #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            display: flex;
        }

        .details {
            display: flex;
            flex-direction: column;
            align-items: self-end;
            margin-top: -131px;
        }

        .details p {
            font-size: 20px;
            margin-bottom: 10px;
            color: #555;
        }

        h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .btn {
            margin-top: 20px;
        }

        .btn-danger {
            color: #fff;
            background-color: blue;
            border-color: #dc3545;
            padding: 10px 20px;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">User Details</h2>
        <div class="details-container">
            <?php
            include('connec.php');

            session_start();
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo "<h2 class='text-center'>Welcome, $username!</h2>";

                $sql = "SELECT * FROM login WHERE username='$username'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<div class='profile-img-container'>";
                    if (!empty($row['profile_picture'])) {
                        echo "<img src='" . $row['profile_picture'] . "' alt='Profile Picture' class='profile-img'>";
                    } else {
                        echo "<p>No profile picture available.</p>";
                    }
                    echo "</div>";
                    echo "<div class='details'>";
                    echo "<p><strong>Username:</strong> " . $row['username'] . "</p>";
                    echo "<p><strong>First Name:</strong> " . $row['firstname'] . "</p>";
                    echo "<p><strong>Last Name:</strong> " . $row['lastname'] . "</p>";
                    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                    echo "</div>";
                }
            }
            ?>
        </div>
        <a href="login.php" class="btn btn-danger mt-3">Logout</a>
       
    </div>


</body>

</html>
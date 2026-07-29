<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "student_db");

if (!$conn) {
    die("Koneksyon nabigo: " . mysqli_connect_error());
}

$error_message = "";


if (isset($_POST['login_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Maling Username o Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Information System - Login</title>
</head>
<body>

    <h2>Student Information System</h2>
    <h3>Login Form</h3>

    <?php if ($error_message != ""): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div>
            <label>Username:</label><br>
            <input type="text" name="username" required>
        </div>
        <br>
        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit" name="login_btn">Login</button>
    </form>

</body>
</html>
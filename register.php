<?php
session_start();
require_once 'core/dbConfig.php'; 

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        $sql = "SELECT * FROM Users WHERE username = ? OR email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            $error_message = "Username or Email already taken.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);


            $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$username, $email, $hashed_password]);

            if ($result) {
                $success_message = "Registration successful! You can now log in.";
            } else {
                $error_message = "An error occurred. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: url('https://funplus.com/wp-content/uploads/2023/07/DC-background-animated-smaller.gif') no-repeat center center fixed;
        background-size: cover;
    }

    .container, .centered-container {
        width: 40%;
        margin: auto;
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        box-shadow: inset 0 0 0 .1vw #ffe600, 0 0 1.5vw 0 #ffcc00, 0 0 1.5vw 0 #ffe600;
        margin-top: 50px;
        backdrop-filter: blur(10px); 
        border: 1px solid rgba(255, 255, 255, 0.3);
        text-align: center;
        color: #ffffff;
    }

    h1 {
        text-align: center;
        color: black;
        text-shadow: 0 0 5px #ffe600, 0 0 10px #ff04de, 0 0 15px #d422cc;
        animation: glow 1.5s ease-in-out infinite alternate;
    }

    input[type="text"], input[type="password"], input[type="email"], input[type="submit"], button {
        padding: 10px;
        margin: 10px 0;
        width: 80%;
        max-width: 400px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: inset 0 0 0 .1vw #ffe600, 0 0 1.5vw 0 #ffcc00, 0 0 1.5vw 0 #ffe600;

    }

    input[type="submit"], button {
        background-color: #28a745;
        color: white;
        border: none;
        cursor: pointer;
        animation: glow 1s ease-in-out infinite alternate;
        text-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 15px #ffffff;
    }

    input[type="submit"]:hover, button:hover {
        background-color: #218838;
    }

    p {
        text-align: center;
        margin: 10px 0;
        color: black;
        text-shadow: 0 0 5px #ffe600, 0 0 10px #ffe600, 0 0 15px #ffe600, 0 0 20px #ffe600;

    }

    .error {
        color: red;
        text-align: center;
    }

    .success {
        color: green;
        text-align: center;
    }

    table {
        width: 90%;
        max-width: 1200px;
        margin-top: 30px;
        border-collapse: collapse;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 15px rgba(212, 34, 204, 0.5);
        margin-bottom: 50px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background-color: #007BFF;
        color: white;
        padding: 12px;
        text-align: center;
        text-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 15px #ffffff;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e1e1e1;
        transition: background-color 0.3s;
    }

    @keyframes glow {
    from {
        text-shadow: 0 0 5px #ffe600, 0 0 10px #ff04de, 0 0 15px #d422cc;
    }
    to {
        text-shadow: 0 0 20px #ffd700, 0 0 30px #ff04de, 0 0 40px #d422cc;
    }
}
</style>

</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="register.php" method="POST">
            <p>Username:  <input type="text" name="username" placeholder="Username" required></p>
            <p>Email: <input type="email" name="email" placeholder="Email" required></p>
            <p>Password: <input type="password" name="password" placeholder="Password" required></p>
            <p>Confirm Password: <input type="confirm_password" name="confirm_password" placeholder="Confirm Password" required></p>
            <button type="submit">Register</button>
            <?php if ($error_message): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <?php if ($success_message): ?>
                <p class="success"><?php echo $success_message; ?></p>
            <?php endif; ?>
        </form>
        <p><a href="login.php">Already have an account? Login here</a></p>
    </div>
</body>
</html>

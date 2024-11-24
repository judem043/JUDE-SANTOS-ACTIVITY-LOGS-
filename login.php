<?php
session_start();
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM Users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {

        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email']; 
            $_SESSION['expertise'] = $user['expertise']; 

            header("Location: index.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: url('https://funplus.com/wp-content/uploads/2023/07/DC-background-animated-smaller.gif') no-repeat center center fixed;
        background-size: cover;
    }

    .container {
        width: 40%;
        margin: auto;
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        box-shadow: inset 0 0 0 .1vw #ffe600, 0 0 1.5vw 0 #ffcc00, 0 0 1.5vw 0 #ffe600;
        margin-top: 50px;
        backdrop-filter: blur(10px); 
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    h1 {
        text-align: center;
        color: black;
        text-shadow: 0 0 5px #ffe600, 0 0 10px #ffe600, 0 0 15px #ffe600, 0 0 20px #ffe600;
        animation: glow 1s ease-in-out infinite alternate;
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
        color:yellow;
    }

    p {
        text-align: center;
        color: black;
        margin: 10px 0;
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

    .glow {
        text-shadow: 0 0 10px #ffffff, 0 0 20px #ffffff, 0 0 30px #ffffff;
        color: #black;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .glow:hover {
        color: #e60073;
    }

    @keyframes glow {
        from {
            text-shadow: 0 0 5px #ffe600, 0 0 10px #ff04de, 0 0 15px #d422cc;
        }
        to {
            text-shadow: 0 0 20px #ffd700, 0 0 30px #ff04de, 0 0 40px #d422cc;
        }
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

    button {
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
    animation: glow 1s ease-in-out infinite alternate;
    width: 80%;
    max-width: 400px;
    display: block;
    margin-left: auto; 
    margin-right: auto; 
}

button:hover {
    background-color: #218838;
}

</style>

</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <p>Username: <input type="text" name="username" placeholder="Username" required></p>
            <p>Password: <input type="password" name="password" placeholder="Password" required></p>
            <button type="submit">Login</button>
            <?php if ($error_message): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </form>
        <p><a href="register.php" class="glow" color="black">Don't have an account? Register here</a></p>
    </div>
</body>
</html>

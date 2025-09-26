<?php
session_start();

// Set your admin password here
$adminPassword = "aucse";
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    if ($password === $adminPassword) {
        $_SESSION["is_admin"] = true;
        header("Location: view.php");
        exit;
    } else {
        $msg = "❌ Wrong password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        body {
            background: #1a1a1a;
            color: #f4f4f4;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #000;
            padding: 30px;
            border: 2px solid gold;
            border-radius: 15px;
            text-align: center;
        }
        h2 {
            color: gold;
        }
        input[type=password] {
            padding: 10px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid gold;
            margin-bottom: 15px;
        }
        button {
            background: gold;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: darkgoldenrod;
        }
        .msg {
            margin-top: 10px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>🔐 Admin Login</h2>
        <form method="POST">
            <input type="password" name="password" placeholder="Enter Admin Password" required><br>
            <button type="submit">Login</button>
        </form>
        <?php if ($msg): ?>
            <p class="msg"><?php echo $msg; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

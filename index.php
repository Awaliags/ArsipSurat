<?php
session_start();
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #d0d0d0;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 300px;
            margin: 100px auto;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px gray;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid gray;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #3a494c;
            color: white;
            border: none;
            margin-top: 15px;
            cursor: pointer;
        }
        .reset-link {
            text-align: right;
            margin-top: 5px;
            font-size: 12px;
        }
        .reset-link a {
            color: #2d6cdf;
            text-decoration: none;
        }
        .popup {
            background-color: #39686b;
            color: white;
            padding: 15px;
            border-radius: 8px;
            width: 300px;
            margin: 20px auto;
            text-align: center;
        }
        .popup a {
            color: #9fd3ff;
            font-size: 12px;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php if (!empty($error)): ?>
<div class="popup">
    <strong><?php echo $error['title']; ?></strong>
    <p><?php echo $error['message']; ?></p>
    <a href="index.php">Oke</a>
</div>
<?php endif; ?>

<div class="login-container">
    <h2>LOGIN</h2>
    <form method="POST" action="proses_login.php">
        <input type="text" name="username" placeholder="Username or email" required>
        <input type="password" name="password" placeholder="Password" required>
        <div class="reset-link">
            <a href="reset_password.php">Reset password</a>
        </div>
        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>

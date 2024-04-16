<?php

$user = [];
$user['username'] = $_POST['username'] ?? '';
$user['password'] = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    $stmt = $pdo->prepare("
        SELECT * FROM users
        WHERE username = :username;
    ");

    $stmt->execute([
        'username' => $_POST['username'],
    ]);

    $user_from_db = $stmt->fetch();
   
    if ($user_from_db) {
        if (password_verify($_POST['password'], $user_from_db["password"])) {
            
            $_SESSION['user_id'] = $user_from_db['id'];
            header('Location: http://localhost/SETTIMANA2/EsercizioLogin//index.php');
         
        };
    }


    $errors['credentials'] = 'Credenziali non valide';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(https://e1.pxfuel.com/desktop-wallpaper/646/773/desktop-wallpaper-login-page-login.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        h2 {
            text-align: center;
            color: #007bff; 
            margin-bottom: 30px;
            text-transform: uppercase; 
            font-size: 36px; 
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555; 
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da; 
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>

















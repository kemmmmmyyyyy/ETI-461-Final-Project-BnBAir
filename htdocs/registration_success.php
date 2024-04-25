<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            background: white;
            padding: 50px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            border-radius: 10px; 
        }
        h1 {
            color: #333; 
        }
        button {
            background-color: #ff5a5f; 
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #e53e3e; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account creation successful. You can now log in.</h1>
        <a href="signin.php"><button>Login</button></a>
    </div>
</body>
</html>

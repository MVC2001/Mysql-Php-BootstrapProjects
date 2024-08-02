<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest User Card</title>
    <style>
        .card {
            width: 300px;
            margin: 50px auto;
            border: 1px solid #0F5091;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            background-color: #0F5091;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .card-body {
            background-color: white;
            color: #0F5091;
            padding: 20px;
            text-align: center;
            font-size: 16px;
        }
        .card-body p {
            margin: 20px 0;
        }
        .card-body a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0F5091;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .card-body a:hover {
            background-color: #0C3D6E;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-header">
            Guest User
        </div>
        <div class="card-body">
            <p>You are a guest user, contact with admin for account activation.</p>
            <a href="index.php">Go to Home</a>
        </div>
    </div>

</body>
</html>

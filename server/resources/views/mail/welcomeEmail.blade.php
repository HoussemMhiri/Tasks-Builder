<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .header img {
            max-width: 150px;
            height: auto;
        }
        .main-content {
            padding: 20px;
        }
        .main-content h1 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .main-content p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .footer {
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 10px;
            border-radius: 0 0 8px 8px;
        }
        .footer p {
            font-size: 14px;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://logowik.com/content/uploads/images/google-tasks7052.logowik.com.webp" alt="Company Logo">
        </div>
        <div class="main-content">
            <h1>Welcome, {{ $user->name }}!</h1>
            <p>Thank you for joining our platform. We're excited to have you with us.</p>
           
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

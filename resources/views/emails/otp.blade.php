<!DOCTYPE html>
<html>
<head>
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 40px auto;
            border-radius: 8px;
        }
        .header {
            background-color: #007BFF;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content p {
            font-size: 18px;
            color: #333333;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }
        .footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #f4f4f4;
            text-align: center;
            color: #777777;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your OTP Code</h1>
        </div>
        <div class="content">
            <p>Your OTP code is:</p>
            <p class="otp-code">{{ $otp }}</p>
        </div>
        <div class="footer">
            <p>If you did not request this code, please ignore this email.</p>
            <p>Thank you, <br></p>
            <p><a href="https://yourcompanywebsite.com">Visit our website</a></p>
        </div>
    </div>
</body>
</html>

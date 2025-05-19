<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>
<body>
    <h2>Verify Your Email</h2>
    <p>Hello {{ $alumni->fullname }},</p>
    <p>Thank you for registering with us. Please click the button below to verify your email address:</p>
    <p>
        <a href="{{ $verificationLink }}" style="display: inline-block; padding: 10px 20px; background-color: #1016c4; color: white; text-decoration: none; border-radius: 5px;">
            Verify Email
        </a>
    </p>
    <p>If you did not sign up for an account, please ignore this email.</p>
    <p>Best regards,</p>
    <p>ACLC College of Mandaue</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Subscription Expired</title>
</head>
<body>
    <h2>Hello {{ $user->name ?? $user->email }},</h2>
    <p>Your subscription has expired. Please resubscribe to continue using all features of our website.</p>

    <p>
        <a href="{{ url('/subscribe') }}" style="background-color:#4CAF50;color:white;padding:10px 20px;text-decoration:none;">
            Renew Subscription
        </a>
    </p>

    <p>Thank you,<br>Team</p>
</body>
</html>

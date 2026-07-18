<!DOCTYPE html>
<html>
<head>
    <title>Subscription Expiring Soon</title>
</head>
<body>
    <h1>Hello {{ $subscription->user->name }},</h1>

    <p>Your subscription will expire in 2 days (on {{ \Carbon\Carbon::parse($subscription->ends_at)->format('F j, Y') }}).</p>
    <p>To continue enjoying our services, please renew your subscription.</p>

    <p>Thank you,<br>
    {{ config('app.name') }}</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>New Plan Created</title>
</head>
<body>
    <h2>New Subscription Plan Created</h2>

    <p>Hello Admin,</p>
    <p>A new subscription plan has been created:</p>

    <ul>
        <li><strong>Name:</strong> {{ $plan->name }}</li>
        <li><strong>Price:</strong> ${{ number_format($plan->price, 2) }}</li>
        <li><strong>Billing Cycle:</strong> {{ ucfirst($plan->billing_cycle) }}</li>
    </ul>

    <p>Login to your admin panel for more details.</p>

    <p>Thanks,<br>Team</p>
</body>
</html>

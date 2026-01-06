<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CuraSys Login Credentials</title>
</head>
<body>
    <h2>Hello <?php echo e($name); ?>,</h2>

    <p>Welcome to <strong>CuraSys</strong>! Your user account has been created successfully.</p>

    <p><strong>Login Details:</strong></p>
    <ul>
        <li><strong>Username (Email):</strong> <?php echo e($email); ?></li>
        <li><strong>Password:</strong> <?php echo e($password); ?></li>
    </ul>

    <p>You can log in to the system using your credentials. Please keep this information secure.</p>

    <br>
    <p>Best regards,</p>
    <p><strong>The CuraSys Team</strong></p>
</body>
</html>
<?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/management/user/new_user_credentials.blade.php ENDPATH**/ ?>
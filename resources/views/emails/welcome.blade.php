<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Bharat 5G Labs</title>
</head>
<body>
    <h2>Welcome to Bharat 5G Labs!</h2>
    
    <p>Dear {{ $registration->person_name }},</p>
    
    <p>Your lab registration has been approved. We are pleased to welcome you to Bharat 5G Labs.</p>
    
    <p>Your account has been created with the following credentials:</p>
    <ul>
        <li>Email: {{ $registration->email_id }}</li>
        <li>Password: {{ $password }}</li>
    </ul>
    
    <p>Please login to your account and change your password immediately for security purposes.</p>
    
    <p>You can access your account by visiting our website and clicking on the login button.</p>
    
    <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
    
    <p>Best regards,<br>Bharat 5G Labs Team</p>
</body>
</html> 
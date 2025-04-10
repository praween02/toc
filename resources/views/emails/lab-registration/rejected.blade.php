<!DOCTYPE html>
<html>
<head>
    <title>Lab Registration Rejected</title>
</head>
<body>
    <h2>Lab Registration Application Rejected</h2>
    <p>Dear {{ $registration->person_name }},</p>
    <p>We regret to inform you that your lab registration application has been rejected.</p>
    <p><strong>Reason for rejection:</strong> {{ $registration->reject_reason }}</p>
    <p>If you have any questions, please feel free to contact us.</p>
    <p>Thank you for your interest.</p>
</body>
</html> 
<!DOCTYPE html>
<html>
<head>
    <title>Job Status Update</title>
</head>
<body>
    <p>Dear {{ $job->alumni->fullname ?? 'User' }},</p>
    
    <p>Your job posting for <strong>{{ $job->position }}</strong> at <strong>{{ $job->company_name }}</strong> has been updated.</p>

    <p><strong>New Status:</strong> {{ ucfirst($job->status) }}</p>

    <p>If you have any questions, feel free to contact us.</p>

    <p>Best regards,</p>
    <p>ACLC College of Mandaue</p>
</body>
</html>

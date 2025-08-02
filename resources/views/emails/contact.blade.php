<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #f9d342;
            padding: 20px;
            text-align: center;
            color: #333;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .footer {
            padding: 10px 20px;
            font-size: 12px;
            text-align: center;
            color: #666;
            background-color: #f1f1f1;
        }
        .message-box {
            background-color: #fff;
            border-left: 4px solid #f9d342;
            padding: 15px;
            margin: 20px 0;
        }
        .label {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Form Submission</h1>
    </div>
    
    <div class="content">
        <p>You have received a new message from the contact form on your website.</p>
        
        <div class="message-box">
            <p class="label">Name:</p>
            <p>{{ $name }}</p>
            
            <p class="label">Email:</p>
            <p>{{ $email }}</p>
            
            <p class="label">Subject:</p>
            <p>{{ $subject }}</p>
            
            <p class="label">Message:</p>
            <p>{{ $messageContent }}</p>
        </div>
        
        <p>You can reply directly to this email to respond to the sender.</p>
    </div>
    
    <div class="footer">
        <p>This email was sent from the contact form on {{ config('app.name') }} website.</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html>

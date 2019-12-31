<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Your booking has been made</h3>
    <p>Hi {{ $emailData['username'] }}</p>
    <p>I look forward to seeing you for your session</p>
    <h5>Session Details:</h5>
    <p>Booked in with Christopher Shannon @ {{ $emailData['time'] }} - {{ $emailData['date'] }}</p>
</body>
</html>

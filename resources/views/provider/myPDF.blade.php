<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<br><br>
<div style="text-align: center;">
    <img src="{{ public_path('images/logo.jpg') }}" style="display: block;width: 25%;margin: auto;">
</div>
<br><br>

<h1 style="text-align: center; font-size: 30px; text-transform: capitalize;">{{ $title }}</h1>
<p style="text-align: center;font-size: 20px;">{{ $date }}</p>
<p style="text-align: center; font-size: 22px;">Cook Master is honored to present this certification to our talented student</p>
<p style="text-align: center; font-size: 22px;color: #6f42c1;">{{ $first_name }}  {{ $last_name }}</p>
<p style="text-align: center; font-size: 22px;">with heartfelt appreciation and congratulations.</p>

<br>

<p style="text-align: center; font-size: 15px;"><i>"{{ $description }}"</i></p><br><br>

<p style="text-align: right; font-size: 15px;padding-right: 40px;">Cook Master's Team</p>
<div style="text-align: right;padding-right: 40px;">
    <img src="{{ public_path('images/signature.jpg') }}" style="display: block;width: 18%;margin: auto;">
</div>

</body>
</html>
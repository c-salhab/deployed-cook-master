<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="container">

    <img class="bg-image" src="{{ public_path('images/bg.png') }}">

    <div style="text-align: center;padding-top: 100px;">
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

    <p style="text-align: right; font-size: 15px;padding-right: 50px;">Cook Master's Team</p>
    <div style="text-align: right;padding-right: 50px;">
        <img src="{{ public_path('images/signature.jpg') }}" style="display: block;width: 18%;margin: auto;">
    </div>

</div>

<style>
    @page {
        size: A4;
        margin: 0;
    }

    body {
        margin: 0;
    }

    .container {
        position: relative;
        width: 210mm;
        height: 297mm;
        overflow: hidden;
    }

    .bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

</body>
</html>

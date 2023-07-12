<!DOCTYPE html>
<html>
<head>
    <title>Event Notification</title>
</head>
<body>
<h1>New Event</h1>

<p>You registered to the following event !</p>

<h2>{{ $event->name }}</h2>
<p>Description : {{ $event->description }}</p>
<p>Start Time : {{ date('Y-m-d', strtotime($event->start_time)) }}</p>
<p>End Time : {{ date('Y-m-d', strtotime($event->end_time)) }}</p>
<p>Address : {{ $event->address }}</p>
</body>
</html>

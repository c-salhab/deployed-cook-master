@component('mail::message')
    # Event Reminder

    Hello {{ $user->name }},

    This is a reminder for the event "{{ $event->name }}" scheduled to end on {{ $event->end_time }}. Please make sure to return the items you borrowed for the event.

    Instructions for returning the items you took.

    Thank you for your cooperation.

    Regards,
    Cook Master
@endcomponent

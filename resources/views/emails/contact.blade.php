@component('mail::message')
    @component('mail::panel')
        <h2>Someone has sent you a message in your website. </h2>
    @endcomponent

    Firstname: {{ $message->first_name }}

    Lastname: {{ $message->last_name }}

    Email: {{ $message->email }}

    Subject: {{ $message->subject }}

    Message: {{ $message->message }}


    @component('mail::button', ['url' => ''])
        View Message
    @endcomponent
@endcomponent

<x-mail::message>
    # New Contact Message

    **Name:** {{ $name }}

    **Email:** {{ $email }}

    **Message:**

    {{ $userMessage }}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
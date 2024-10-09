<x-mail::message>
    # Reset Password Confirmation

    Your password has been reset successfully. Here are your new login credentials:

    **Email:** {{ $email }}
    **New Password:** {{ $newPassword }}

    If you didn't request this, please ignore this email.

    Thanks,
    {{ GlobalHelper::setting('author') }}
</x-mail::message>

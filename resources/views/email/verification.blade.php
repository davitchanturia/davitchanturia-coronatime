<x-email-layout>

    <x-slot name="header">
        Confirmation email
    </x-slot>
    
    <x-slot name="text">
        click this button to verify your email
    </x-slot>
    
    <x-slot name="buttonLink">{{"http://localhost:3000/confirmed/".$user->email_verification_token}}</x-slot>
    
    <x-slot name="buttonText">
        VERIFY EMAIL
    </x-slot>
    
</x-email-layout>
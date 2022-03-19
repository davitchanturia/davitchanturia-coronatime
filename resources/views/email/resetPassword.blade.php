<x-email-layout>

    <x-slot name="header">
        Recover password
    </x-slot>
    
    <x-slot name="text">
        click this button to recover a password
    </x-slot>
    
    <x-slot name="buttonLink">
        {{"http://localhost:3000/update-password/".$token}}</x-slot>
    
    <x-slot name="buttonText">
        RECOVER PASSWORD
    </x-slot>
    
</x-email-layout>

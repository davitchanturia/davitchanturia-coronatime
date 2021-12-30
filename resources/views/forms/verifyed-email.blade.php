<x-layout>
    <div class="px-2">
        <div class="py-10">
            <img class="mx-auto" src="{{ asset('img/logo.png') }}" alt="">
        </div>
        
        <div class="w-80 mx-auto">
            <div class="w-14 h-14 mt-36 mx-auto rounded-full bg-greenIconBack border flex justify-center items-center">
                <svg class="h-6 w-6 text-greenIcon font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <p class="text-center mt-4">Your account is confirmed, you can sign in</p>
    
            <button class="w-full mt-6 text-white py-3 rounded-md bg-greenButton font-bold">
                <a href="{{ route('login', App::getLocale()) }}">{{__('login.button')}}</a>
            </button>
    
        </div>
       
    </div>
</x-layout>

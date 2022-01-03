<x-layout>
    <div class="px-2">
        <div class="py-10">
            <img class="mx-auto" src="{{ asset('img/logo.png') }}" alt="">
        </div>
        
        <div class="mt-36 w-full">
            <h1 class="font-bold text-darkBlack text-2xl text-center">Reset Password</h1>

            <form method='post' action='{{ route('update.password', App::getLocale()) }}' class="w-99 mx-auto">
                @csrf
                @method('PUT')
                <input type="hidden" name="email" value="{{ $email }} "/>

                <div class="mt-6">
                    <label for="email font-bold">New password</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input class="outline-none w-full" type="password" name="password" 
                            placeholder="Enter new password">
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="email font-bold">Repeat password</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input class="outline-none w-full" type="password" name="password_confirmation" 
                            placeholder="Repeat password">
                    </div>
                </div>


               
                <button type='submit' class="w-full mt-14 text-white py-3 bg-greenButton font-bold rounded-md uppercase">save changes</button>
            </form>
        </div>
    </div>
    
</x-layout>
<div class="relative w-full">
    <div class="w-full xl:w-336 px-4 mx-auto">
        <div class="w-full lg:w-96">
            <div class="pt-10">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </div>
    
            <div class="mt-14">
                <h1 class="font-bold text-2xl">{{__('register.welcome')}}</h1>
                <p class="text-sm sm:text-xl text-grey mt-4">{{__('register.filltheform')}}</p>
            </div>
    
            <form wire:submit.prevent="registerUser" method='POST' class="md:px-4 lg:px-0">
                @csrf
                <div class="mt-6">
                    <label for="username">{{__('register.username')}}</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="username" class="outline-none w-full" 
                            type="text" name="username" 
                            placeholder="{{__('register.usernameplaceholder')}}">
                    </div>
                    <p class="text-grey text-sm mt-1">{{__('register.userinfo')}}</p>
                    @error('username') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror

                </div>

                <div class="mt-6">
                    <label for="email">{{__('register.email')}}</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="email" class="outline-none w-full"
                            type="email" name="email" 
                            placeholder="{{__('register.emailplaceholder')}}">
                    </div>
                    @error('email') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
    
                <div class="mt-6">
                    <label for="password">{{__('register.password')}}</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="password" class="outline-none w-full" 
                            type="password" name="password" 
                            placeholder="{{__('register.passwordplaceholder')}}">
                    </div>
                    @error('password') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div> 


                <div class="mt-6">
                    <label for="password_confirmation">{{__('register.confirmpassword')}}</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="password_confirmation" class="outline-none w-full" 
                            type="password" name="password_confirmation" 
                            placeholder="{{__('register.confirmpasswordplaceholder')}}">
                    </div>
                    @error('password_confirmation') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between mt-6">
                    <div>
                        <input wire:model="remember" type="checkbox" name="remember" id="">
                        <label for="remember">{{__('register.remember')}}</label>
                    </div>
                </div>
               
               
                <button type='submit' class="w-full mt-6 text-white py-3 bg-greenButton font-bold">{{__('register.button')}}</button>
            
                <div class="mt-6">
                    <p class="text-grey text-sm sm:text-lg text-center">{{__('register.alreadyhave')}}<a href="{{ route('login', ['lang' => App::getLocale()]) }}" class="font-bold">{{__('register.login')}}</a> </p>
                </div>
    
            </form>
    
        </div>

    </div>
    <img src="{{ asset('img/loginFoto.png') }}" alt=""
            class="absolute top-0 right-0 lg:w-1/2 xl:w-2/5 h-screen object-cover hidden lg:inline-block"
     >
</div>

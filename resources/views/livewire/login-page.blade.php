<div class="relative w-full">
    <div class="w-full xl:w-336 px-4 mx-auto">
        <div class="w-full lg:w-96">
            <div class="pt-10">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </div>
    
            <div class="mt-14">
                <h1 class="font-bold text-2xl">Welcome back</h1>
                <p class="text-sm sm:text-xl text-grey mt-4">Welcome back! please enter your details</p>
            </div>
    
            <form wire:submit.prevent="loginUser" method='POST' class="md:px-4 lg:px-0">
                @csrf
                <div class="mt-6">
                    <label for="username">Username</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="username" class="outline-none w-full" type="text" name="username" 
                            placeholder="Enter unique username or email">
                    </div>
                    @error('username') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
    
                <div class="mt-6">
                    <label for="password">Password</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="password" class="outline-none w-full" type="password" name="password" 
                            placeholder="fill in password">
                    </div>
                    @error('password') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
    
                <div class="flex flex-col sm:flex-row sm:justify-between mt-6">
                    <div>
                        <input type="checkbox" name="remember" id="">
                        <label for="remember">Remember this device</label>
                    </div>
                    <a href="#" class="text-forgotPas mt-2 sm:mt-0">Forgot password?</a>
                </div>
               
               
                <button type='submit' class="w-full mt-6 text-white py-3 bg-greenButton font-bold">LOG IN</button>
            
                <div class="mt-6">
                    <p class="text-grey text-sm sm:text-lg text-center">Don't have an account? <a href="{{ route('register') }}" class="font-bold">Sign up for free</a> </p>
                </div>
    
            </form>
    
        </div>

    </div>
    <img src="{{ asset('img/loginFoto.png') }}" alt=""
            class="absolute top-0 right-0 lg:w-1/2 xl:w-2/5 h-screen object-cover hidden lg:inline-block"
     >
</div>

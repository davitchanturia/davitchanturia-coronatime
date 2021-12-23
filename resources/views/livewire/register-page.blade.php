<div class="relative w-full">
    <div class="w-full xl:w-336 px-4 mx-auto">
        <div class="w-full lg:w-96">
            <div class="pt-10">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </div>
    
            <div class="mt-14">
                <h1 class="font-bold text-2xl">Welcome to Coronatime</h1>
                <p class="text-sm sm:text-xl text-grey mt-4">Please enter required info to sign up</p>
            </div>
    
            <form wire:submit.prevent="registerUser" method='POST' class="md:px-4 lg:px-0">
                @csrf
                <div class="mt-6">
                    <label for="username">Username</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="username" class="outline-none w-full" 
                            type="text" name="username" 
                            placeholder="Enter unique username">
                    </div>
                    <p class="text-grey text-sm mt-1">Username should be unique, min 3 symbols</p>
                    @error('username') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror

                </div>

                <div class="mt-6">
                    <label for="email">Email</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="email" class="outline-none w-full"
                            type="email" name="email" 
                            placeholder="Enter your email">
                    </div>
                    @error('email') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
    
                <div class="mt-6">
                    <label for="password">Password</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="password" class="outline-none w-full" 
                            type="password" name="password" 
                            placeholder="fill in password">
                    </div>
                    @error('password') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div> 


                <div class="mt-6">
                    <label for="password_confirmation">Repeat password</label> <br>
                    <div class="w-full border border-gray-200 inline-block py-2 px-3 mt-2">
                        <input wire:model="password_confirmation" class="outline-none w-full" 
                            type="password" name="password_confirmation" 
                            placeholder="Repeat password">
                    </div>
                    @error('password_confirmation') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between mt-6">
                    <div>
                        <input wire:model="remember" type="checkbox" name="remember" id="">
                        <label for="remember">Remember this device</label>
                    </div>
                </div>
               
               
                <button type='submit' class="w-full mt-6 text-white py-3 bg-greenButton font-bold">SIGN UP</button>
            
                <div class="mt-6">
                    <p class="text-grey text-sm sm:text-lg text-center">Already have an account? <a href="{{ route('login') }}" class="font-bold">Log in</a> </p>
                </div>
    
            </form>
    
        </div>

    </div>
    <img src="{{ asset('img/loginFoto.png') }}" alt=""
            class="absolute top-0 right-0 lg:w-1/2 xl:w-2/5 h-screen object-cover hidden lg:inline-block"
     >
</div>
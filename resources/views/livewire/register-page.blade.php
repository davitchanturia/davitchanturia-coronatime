<div class="relative w-full">
    <div class="w-full xl:w-336 px-4 mx-auto">
        <div class="w-full md:w-137 md:mx-auto lg:w-96 lg:mx-0">
            <div class="flex flex-col sm:flex-row items-center justify-between">

                <div class="pt-10">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </div>

                <div class="pt-10">
                    <x-language-change>
                        @foreach (Config::get('app.available_locales') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <a 
                                    href="{{ route('register', $lang) }}" @click="show = !show"
                                    class="block text-center hover:bg-blue-600 hover:text-white cursor-pointer">
                                    {{ $language['name'][App::getLocale()] }}
                                </a>
                            @endif
                        @endforeach
                    </x-language-change>
                </div>
            </div>


            <div class="mt-14">
                <h1 class="font-bold text-2xl">{{ __('register.welcome') }}</h1>
                <p class="text-sm sm:text-xl text-grey mt-4">{{ __('register.filltheform') }}</p>
            </div>

            <form wire:submit.prevent="registerUser" method='POST' class="sm:px-4 lg:px-0">
                @csrf
                <div class="mt-6">
                    <label for="username">{{ __('register.username') }}</label> <br>
                    <div class="w-full relative border rounded-md inline-block py-2 px-3 mt-2
                    @if($username)
                        @error('username') border-red-700 
                        @else border-green-500
                        @enderror
                        @else border-gray-200
                    @endif
                    ">
                        <input wire:model="username" class="outline-none w-full" type="text" name="username"
                            placeholder="{{ __('register.usernameplaceholder') }}">
                            <div class="absolute right-3 top-3
                                @if($username)
                                    @error('username') hidden 
                                    @else inline-block
                                    @enderror
                                @else hidden
                                @endif
                            ">
                                <img src="{{ asset('img/success.svg') }}" alt="">
                            </div>
                    </div>
                    <p class="text-grey text-sm mt-1">{{ __('register.userinfo') }}</p>

                    <div class="h-1 mt-1">
                        @error('username')
                            <div class="flex items-center">
                                <img src="{{ asset('img/warning.svg') }}" alt="">
                                <span class="error text-xs text-red-700 ml-2">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mt-6">
                    <label for="email">{{ __('register.email') }}</label> <br>
                    <div class="w-full relative border rounded-md inline-block py-2 px-3 mt-2
                    @if($email)
                        @error('email') border-red-700 
                        @else border-green-500
                        @enderror
                    @else border-gray-200
                    @endif
                    ">
                        <input wire:model="email" class="outline-none w-full" type="email" name="email"
                            placeholder="{{ __('register.emailplaceholder') }}">
                            <div class="absolute right-3 top-3
                                @if($email)
                                    @error('email') hidden 
                                    @else inline-block
                                    @enderror
                                @else hidden
                                @endif
                            ">
                            <img src="{{ asset('img/success.svg') }}" alt="">
                            </div>

                    </div>
                    <div class="h-1 mt-1">
                        @error('email')
                            <div class="flex items-center">
                                <img src="{{ asset('img/warning.svg') }}" alt="">
                                <span class="error text-xs text-red-700 ml-2">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="password">{{ __('register.password') }}</label> <br>
                    <div class="w-full relative border rounded-md inline-block py-2 px-3 mt-2
                    @if($password)
                        @error('password') border-red-700 
                        @else border-green-500
                        @enderror
                    @else border-gray-200
                    @endif
                    ">
                        <input wire:model="password" class="outline-none w-full" type="password" name="password"
                            placeholder="{{ __('register.passwordplaceholder') }}">
                            <div class="absolute right-3 top-3
                                @if($password)
                                    @error('password') hidden 
                                    @else inline-block
                                    @enderror
                                @else hidden
                                @endif
                            ">
                                <img src="{{ asset('img/success.svg') }}" alt="">
                            </div>

                    </div>
                    <div class="h-1 mt-1">
                        @error('password')
                            <div class="flex items-center">
                                <img src="{{ asset('img/warning.svg') }}" alt="">
                                <span class="error text-xs text-red-700 ml-2">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>


                <div class="mt-6">
                    <label for="password_confirmation">{{ __('register.confirmpassword') }}</label> <br>
                    <div class="w-full relative border rounded-md inline-block py-2 px-3 mt-2
                    @if($password_confirmation)
                        @error('password_confirmation') border-red-700 
                        @else border-green-500
                        @enderror
                    @else border-gray-200
                    @endif
                    ">
                        <input wire:model="password_confirmation" class="outline-none w-full" type="password"
                            name="password_confirmation" placeholder="{{ __('register.confirmpasswordplaceholder') }}">
                            <div class="absolute right-3 top-3
                                @if($password_confirmation)
                                    @error('password_confirmation') hidden 
                                    @else inline-block
                                    @enderror
                                @else hidden
                                @endif
                            ">
                                <img src="{{ asset('img/success.svg') }}" alt="">
                            </div>
                    </div>
                    <div class="h-1 mt-1">
                        @error('password_confirmation')
                            <div class="flex items-center">
                                <img src="{{ asset('img/warning.svg') }}" alt="">
                                <span class="error text-xs text-red-700 ml-2">{{ $message }}</span>
                            </div> 
                        @enderror
                    </div> 
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between mt-6">
                    <div>
                        <input wire:model="remember" type="checkbox" name="remember" id="">
                        <label for="remember">{{ __('register.remember') }}</label>
                    </div>
                </div>


                <button type='submit'
                    class="w-full mt-6 text-white py-3 bg-greenButton font-bold">{{ __('register.button') }}</button>

                <div class="mt-6">
                    <p class="text-grey text-sm sm:text-lg text-center">{{ __('register.alreadyhave') }}<a
                            href="{{ route('login', ['lang' => App::getLocale()]) }}"
                            class="font-bold">{{ __('register.login') }}</a> </p>
                </div>

            </form>

        </div>

    </div>
    <img src="{{ asset('img/loginFoto.png') }}" alt=""
        class="absolute top-0 right-0 lg:w-1/2 xl:w-2/5 h-screen object-cover hidden lg:inline-block">
</div>

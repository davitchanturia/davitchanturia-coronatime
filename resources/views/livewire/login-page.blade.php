<div class="relative w-full">
    <div class="w-full xl:w-336 px-4 mx-auto">
        <div class="w-full lg:w-96">
            <div class="flex flex-col sm:flex-row items-center justify-between">

                <div class="pt-10">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </div>

                <div class="pt-10">
                    <x-language-change>
                        @foreach (Config::get('app.available_locales') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <a 
                                    href="{{ route('login', $lang) }}" @click="show = !show"
                                    class="block text-center hover:bg-blue-600 hover:text-white cursor-pointer">
                                    {{ $language['name'][App::getLocale()] }}
                                </a>
                            @endif
                        @endforeach
                    </x-language-change>
                </div>
            </div>

            <div class="mt-14">
                <h1 class="font-bold text-2xl">{{ __('login.welcome') }}</h1>
                <p class="text-sm sm:text-xl text-grey mt-4">{{ __('login.filltheform') }}</p>
            </div>

            <form wire:submit.prevent="loginUser" method='POST' class="md:px-4 lg:px-0">
                @csrf
                <div class="mt-6">
                    <label for="username">{{ __('login.username') }}</label> <br>
                    <div
                        class="w-full relative border rounded-md  inline-block py-2 px-3 mt-2
                        @if ($username)
                            @error('username') border-red-700 
                            @else border-green-500
                            @enderror
                        @else border-gray-200
                        @endif">
                        <input wire:model="username" class="outline-none w-full" type="text" name="username"
                            placeholder="{{ __('login.usernameplaceholder') }}">

                        <div
                            class="absolute right-3 top-3
                            @if ($username)
                                @error('username') hidden 
                                @else inline-block
                                @enderror
                            @else hidden
                            @endif
                        ">
                            <img src="{{ asset('img/success.svg') }}" alt="">
                        </div>

                    </div>
                    <div class="h-1 mt-2">
                        @error('username')
                            <div class="flex items-center">
                                <img src="{{ asset('img/warning.svg') }}" alt="">
                                <span class="error text-xs text-red-700 ml-2">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mt-5">
                    <label for="password">{{ __('login.password') }}</label> <br>
                    <div
                        class="w-full relative border rounded-md border-gray-200 inline-block py-2 px-3 mt-2
                    @if ($password)
                        @error('username') border-red-700 
                        @else border-green-500
                        @enderror
                    @else border-gray-200
                    @endif                        ">
                        <input wire:model="password" class="outline-none w-full" type="password" name="password"
                            placeholder="{{ __('login.passwordplaceholder') }}">
                        <div
                            class="absolute right-3 top-3
                            @if ($password)
                                @error('password') hidden 
                                @else inline-block
                                @enderror
                            @else hidden
                            @endif
                        ">
                            <img src="{{ asset('img/success.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="h-1 mt-2">
                        @error('password')
                            <div class="flex items-center">
                                <img src="{{ asset('img/warning.svg') }}" alt="">
                                <span class="error text-xs text-red-700 ml-2">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="h-1 -mt-2">
                        <input name="notFound" type="hidden">
                        @error('notFound') <span class="error text-xs text-red-700">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row sm:justify-between mt-7">
                        <div>
                            <input wire:model="remember" type="checkbox" name="remember" value="1">
                            <label for="remember">{{ __('login.remember') }}</label>
                        </div>
                        <a href="{{ route('reset.password', App::getLocale()) }}"
                            class="text-forgotPas mt-2 sm:mt-0">{{ __('login.forgotpassword') }}</a>
                    </div>


                    <button type='submit'
                        class="w-full mt-6 text-white py-3 bg-greenButton font-bold">{{ __('login.button') }}</button>

                    <div class="mt-6">
                        <p class="text-grey text-sm sm:text-lg text-center">{{ __('login.alreadyhave') }}
                            <a href="{{ route('register', ['lang' => App::getLocale()]) }}"
                                class="font-bold">{{ __('login.regiser') }}</a>
                        </p>
                    </div>

            </form>

        </div>

    </div>
    <img src="{{ asset('img/loginFoto.png') }}" alt=""
        class="absolute top-0 right-0 lg:w-1/2 xl:w-2/5 h-screen object-cover hidden lg:inline-block">
</div>

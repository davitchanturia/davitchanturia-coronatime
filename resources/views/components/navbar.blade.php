<header>
    <nav class="border-b border-gray-100">
        <div class="w-full md:w-336 px-4 mx-auto">
            <div class="w-full flex-col md:flex-row py-4">
                <div class="flex items-center justify-between flex-col md:flex-row">
                    <a href="#">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </a>

                    <div class="flex items-center mt-2 md:mt-0">
                        <ul class="flex text-sm text-headText">
                            <li>
                                <x-language-change>
                                    @foreach (Config::get('app.available_locales') as $lang => $language)
                                        @if ($lang != App::getLocale())
                                            <a 
                                                href="{{ route('home', $lang) }}" @click="show = !show"
                                                class="block text-center hover:bg-blue-600 hover:text-white cursor-pointer">
                                                {{ $language['name'][App::getLocale()] }}
                                            </a>
                                        @endif
                                    @endforeach
                                </x-language-change>
                            </li>

                            <li class="ml-4 hidden sm:inline-block">
                                <livewire:name-and-button />
                            </li>

                            <li class="ml-4 inline-block sm:hidden">
                                <x-burger-show />
                            </li>

                        </ul>
                    </div>
                        
                </div>
            </div>
    
        </div>
    </nav>
  
</header>
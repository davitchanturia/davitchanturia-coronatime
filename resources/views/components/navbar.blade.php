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
                            <li class="ml-4">
                                <div class="flex">
                                    <div class="border-r-2 border-gray-100 px-3 font-bold">
                                        {{ auth()->user()->username }}
                                    </div>
                                    <div class="px-3">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit">{{__('text.logout')}}</button> 
                                        </form>
                                    </div>
                                </div>
                              
                            </li>
                        </ul>
                    </div>
                        
                </div>
            </div>
    
        </div>
    </nav>
  
</header>
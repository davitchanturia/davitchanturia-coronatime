<div>
    <div x-data="{ show: false}"
         class="relative">
        <button @click="show = !show" 
            class="flex justify-center items-center">

            {{ Config::get('app.available_locales')[App::getLocale()]['name'][App::getLocale()] }}

            <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div 
            x-cloak 
            x-show="show" 
            @click.away="show = false"
            class="w-24 absolute -bottom-6 right-0 border border-gray-200 bg-gray-400">
            @foreach (Config::get('app.available_locales') as $lang => $language)
                @if ($lang != App::getLocale())
                    <a 
                    href="{{ route('home', $lang) }}"
                        @click="show = !show"
                        class="block text-center hover:bg-blue-600 hover:text-white cursor-pointer">{{ $language['name'][App::getLocale()] }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>

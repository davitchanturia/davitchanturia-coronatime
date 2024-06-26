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
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            x-show="show" 
            @click.away="show = false"
            class="w-24 absolute -bottom-6 right-0 border border-gray-200 bg-gray-300 mt-1">
            {{ $slot }}
        </div>
    </div>
</div>

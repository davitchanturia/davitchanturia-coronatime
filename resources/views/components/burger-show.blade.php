<div 
    x-data="{ open:false }"
    class="relative ">
    <div 
        @click="open = !open"
        class="cursor-pointer">
        <img src="{{ asset('img/burger-menu.svg') }}" alt="">
    </div>

    <div 
        x-cloak 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        x-show="open" 
        @click.away="open = false"
        class="w-20 absolute -bottom-12 -left-14 border border-gray-200 bg-gray-300 px-2  mt-1">

        <livewire:name-and-button />
    </div>
</div>


<div>
    <div x-data="{
        openTab: 1,
        activeClasses: 'active',
        inactiveClasses: 'font-normal'
    }"
    class="w-full md:w-336 px-4 mx-auto">

        <div>

            <div class="mt-10">
                <h1 class="text-2xl font-bold" >
                    {{$text}}
                </h1>
            </div>

        </div>

        <div class="flex justify-start space-x-16 w-full mt-10 pb-4 border-b border-gray-100">
            <a wire:click="changeText(1)"
                @click="openTab = 1"
                 :class="openTab === 1 ? activeClasses : inactiveClasses">
                {{ __('text.Worldwide') }}
            </a>
            <a wire:click="changeText(2)"
                @click="openTab = 2" 
                :class="openTab === 2 ? activeClasses : inactiveClasses">
                {{ __('text.Bycountry') }}
            </a>
        </div>

        <div class="content mt-10">
            <div x-show="openTab === 1">
                <livewire:world-wide-stats />
            </div>
            <div x-cloak x-show="openTab === 2">
                <livewire:by-country-stats />
            </div>
        </div>

    </div>
</div>

<x-layout>

    <x-navbar />

    <div 
        x-data="{
            openTab: 1,
            activeClasses: 'active font-bold',
            inactiveClasses: 'font-normal'
        }"
        class="w-full md:w-336 px-4 mx-auto"
    >

        <div class="mt-10">
            <h1 class="text-2xl font-bold">{{__('text.Worldwidestatistics')}}</h1>
        </div>

        <div class="flex justify-start space-x-16 w-full mt-10 pb-4 border-b border-gray-100">
            <a @click="openTab = 1" :class="openTab === 1 ? activeClasses : inactiveClasses"
                class="element active" href="#">{{__('text.Worldwide')}}</a>
            <a @click="openTab = 2" :class="openTab === 2 ? activeClasses : inactiveClasses"
                class="element " href="#">{{__('text.Bycountry')}}</a>
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
</x-layout>

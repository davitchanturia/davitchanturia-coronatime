<div>
    <div class="w-full md:w-64 flex text-gray-200 border border-gray-200 rounded-lg px-3 py-1 relative overflow-hidden">
        {{-- <svg class="h-6 w-6 z-50 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg> --}}

        <input wire:model="search" type="search" placeholder="{{__('text.search')}}"
            class="w-full rounded-xl bg-white text-gray-400 px-4 py-2 pl-10 outline-none border-none placeholder-gray-200">

        <div class="absolute top-0 flex items-center h-full ml-1">
            <svg class="w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col mt-10 h-137">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <h1 class="align-middle">
                                            {{__('text.location')}}
                                        </h1>
                                        <div class="icons ml-2">
                                            <button wire:click="up('name')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                </svg>
                                            </button>
                                            
                                            <button wire:click="down('name')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <h1>
                                            {{__('text.Newcases')}}
                                        </h1>
                                        <div class="icons ml-2">
                                            <button wire:click="up('confirmed')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                </svg>
                                            </button>
                                            
                                            <button wire:click="down('confirmed')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <h1>
                                            {{__('text.Critical')}}
                                        </h1>
                                        <div class="icons ml-2">
                                            <button wire:click="up('critical')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                </svg>
                                            </button>
                                            
                                            <button wire:click="down('critical')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <h1>
                                            {{__('text.Death')}}
                                        </h1>
                                        <div class="icons ml-2">
                                            <button wire:click="up('death')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                </svg>
                                            </button>
                                            
                                            <button wire:click="down('death')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <h1>
                                            {{__('text.Recovered')}}
                                        </h1>
                                        <div class="icons ml-2">
                                            <button wire:click="up('recovered')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                </svg>
                                            </button>
                                            
                                            <button wire:click="down('recovered')" class="block">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($countries as $country)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-darkBlack">
                                    {{ $country->getTranslation('name', App::getlocale() )}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-darkBlack">
                                    {{ $country->confirmed}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-darkBlack">
                                    {{ $country->critical}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-darkBlack">
                                    {{ $country->deaths}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-darkBlack">
                                    {{ $country->recovered}}
                                </td>
                            </tr>
                            @endforeach
                                <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

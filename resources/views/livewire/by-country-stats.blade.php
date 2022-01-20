<div>
    {{-- search --}}
    <div class="w-full md:w-64 flex text-gray-200 border border-gray-200 rounded-lg px-3 py-1 relative overflow-hidden">
        <input wire:model="search" type="search" placeholder="{{__('text.search')}}"
            class="w-full rounded-xl bg-white text-gray-400 px-4 py-2 pl-10 outline-none border-none placeholder-gray-200">

        <div class="absolute top-0 flex items-center h-full ml-1">
            <svg class="w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    @if($countries->count() > 0)
    {{-- table --}}
    <div class="flex flex-col mt-10">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="text-left w-full">
                        <thead class="bg-gray-50 w-full">
                            <tr class="flex w-full">
                                <th class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider w-1/4">
                                        <div class="flex items-center">
                                            <h1>
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
                                <th class="px-4 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider w-1/4">
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
                               
                                <th class="px-3 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider w-1/4">
                                        <div class="flex items-center">
                                            <h1>
                                                {{__('text.Death')}}
                                            </h1>
                                            <div class="icons ml-2">
                                                <button wire:click="up('deaths')" class="block">
                                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                    </svg>
                                                </button>
                                                
                                                <button wire:click="down('deaths')" class="block">
                                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider w-1/4">
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
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 @if($search) h-auto @endif h-128 flex flex-col items-center justify-between overflow-y-scroll w-full" >
                            @foreach ($countries as $country) 
                            <tr class="flex w-full">
                                <td class="px-6 py-4 w-1/4 whitespace-nowrap text-sm font-medium text-darkBlack">{{ $country->getTranslation('name', App::getlocale() )}}</td>
                                <td class="px-6 py-4 w-1/4 whitespace-nowrap text-sm text-darkBlack">{{ $country->confirmed }}</td>
                                {{-- <td class="px-6 py-4 w-1/4 whitespace-nowrap text-sm text-darkBlack">{{ $country->critical}}</td> --}}
                                <td class="px-6 py-4 w-1/4 whitespace-nowrap text-sm text-darkBlack">{{ $country->deaths}}</td>
                                <td class="px-6 py-4 w-1/4 whitespace-nowrap text-sm text-darkBlack">{{ $country->recovered}}</td>
                            </tr>
                            {{-- @empty
                            <p class="text-center text-lg mt-28">Statistics were not found, try later!</p> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else 
    <p class="text-center text-lg mt-28">Statistics were not found, try later!</p>
    @endif

</div>

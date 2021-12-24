<div>
    <div class="w-full md:w-64 flex text-gray-200 border border-gray-200 rounded-lg px-3 py-1 relative overflow-hidden">
        {{-- <svg class="h-6 w-6 z-50 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg> --}}

        <input type="search" placeholder="{{__('text.search')}}"
            class="w-full rounded-xl bg-white text-gray-400 px-4 py-2 pl-10 outline-none border-none placeholder-gray-200">

        <div class="absolute top-0 flex items-center h-full ml-1">
            <svg class="w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col mt-10">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider">
                                    {{__('text.location')}}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider">
                                    {{__('text.Newcases')}}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider">
                                    {{__('text.Death')}}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-darkBlack uppercase tracking-wider">
                                    {{__('text.Recovered')}}
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-darkBlack">
                                    Albania
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-darkBlack">
                                    9,747,000
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-darkBlack">
                                    66,591
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-darkBlack">
                                    5,803,905
                                </td>
                            </tr>

                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

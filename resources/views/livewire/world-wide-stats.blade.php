<div class="grid gap-4 grid-cols-2 md:grid-cols-3 text-center">
    <div class="col-span-3 md:col-span-1 card bg-newCases py-10 rounded-lg">
        <img
            class="w-24 mx-auto h-12" 
            src="{{ asset('img/newCases.png') }}" alt=""
        >
        <h4 class="mt-5">{{__('text.Newcases')}}</h4>
        <h1 class="text-newCasesNum text-4xl font-black mt-4">
            {{ $newCases }}
        </h1>
    </div>
    <div class="card bg-recovered py-10 rounded-lg">
        <img
            class="w-24 mx-auto" 
            src="{{ asset('img/recovered.png') }}" alt=""
        >
        <h4 class="mt-8">{{__('text.Recovered')}}</h4>
        <h1 class="text-recoveredNum text-4xl font-black mt-6">
            {{ $recovered }}
        </h1>
    </div>
    <div class="card bg-death py-10 rounded-lg">
        <img
            class="w-24 mx-auto" 
            src="{{ asset('img/death.png') }}" alt=""
        >
        <h4 class="mt-6">{{__('text.Death')}}</h4>
        <h1 class="text-deathNum text-4xl font-black mt-5">
            {{ $death }}
        </h1>
    </div>
</div>
<div>
    <div class="flex flex-col sm:flex-row">
        <div class="sm:border-r-2 sm:border-gray-100 px-3 font-bold">
            {{ auth()->user()->username }}
        </div>
        <div class="sm:px-3">
            <a 
                wire:click="sendEvent()"
                class="cursor-pointer">
                Log Out
            </a>
        </div>
    </div>
</div>

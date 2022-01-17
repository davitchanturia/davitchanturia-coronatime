<div>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="inline-block m-auto" type="submit">{{__('text.logout')}}</button> 
    </form>
</div>
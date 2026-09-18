
@if (auth()->user()->role->is_vertical_menu == "1")
    @include('layouts.app-vertical')
@else
    @include('layouts.app-horizontal')
@endif
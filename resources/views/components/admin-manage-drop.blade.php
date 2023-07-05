@if(Auth::user()->hasRole('administrator') || Auth::user()->hasRole('manager'))
    <div class="block px-4 py-2 text-xs text-blue-300">
    Manage website
    </div>
    @if(Auth::user()->hasRole('administrator'))
        <x-administration-drop></x-administration-drop>
    @endif
    <x-management-drop></x-management-drop>
@endif


@if(Auth::user()->hasRole('administrator') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('provider'))
    <div class="block px-4 py-2 text-xs text-blue-300">
    Manage website
    </div>
    @if(Auth::user()->hasRole('administrator'))
        <x-administration-drop></x-administration-drop>
        <x-management-drop></x-management-drop>
        <x-provider-drop></x-provider-drop>
    @elseif(Auth::user()->hasRole('manager'))
        <x-management-drop></x-management-drop>
    @elseif(Auth::user()->hasRole('provider'))
        <x-provider-drop></x-provider-drop>
    @endif
@endif


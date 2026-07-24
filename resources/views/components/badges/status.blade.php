@if ($active)

    <x-badges.success>
        Active
    </x-badges.success>

@else

    <x-badges.danger>
        Inactive
    </x-badges.danger>

@endif

@switch($event)

    @case('created')
        <x-badges.success>
            Created
        </x-badges.success>
        @break

    @case('updated')
        <x-badges.warning>
            Updated
        </x-badges.warning>
        @break

    @case('deleted')
        <x-badges.danger>
            Deleted
        </x-badges.danger>
        @break

    @default
        <x-badges.info>
            {{ ucfirst($event) }}
        </x-badges.info>

@endswitch

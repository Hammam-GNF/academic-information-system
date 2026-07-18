<div class="flex items-center gap-2">

    <a
        href="{{ route('admin.users.edit', $user) }}"
        class="btn btn-primary"
    >
        Edit
    </a>

    <a
        href="{{ route('admin.users.change-password', $user) }}"
        class="btn btn-secondary"
    >
        Password
    </a>

    @if(auth()->id() !== $user->id)
        <button
            type="button"
            class="btn btn-danger delete-user-btn"
            data-url="{{ route('admin.users.destroy', $user) }}"
        >
            Delete
        </button>
    @endif

</div>

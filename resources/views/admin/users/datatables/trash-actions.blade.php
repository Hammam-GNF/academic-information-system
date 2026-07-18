<div class="flex items-center gap-2">

    <button
        type="button"
        class="btn btn-secondary restore-user-btn"
        data-url="{{ route('admin.users.restore', $user) }}"
    >
        Restore
    </button>

    <button
        type="button"
        class="btn btn-danger force-delete-btn"
        data-url="{{ route('admin.users.force-delete', $user) }}"
    >
        Force Delete
    </button>

</div>

<div class="flex items-center gap-2">

    @can('update', $subject)

        <a
            href="{{ route('admin.subjects.edit', $subject) }}"
            class="btn btn-sm btn-warning"
        >
            Edit
        </a>

    @endcan


    @can('delete', $subject)

        <button
            type="button"
            class="btn btn-sm btn-danger delete-subject-btn"
            data-url="{{ route('admin.subjects.destroy', $subject) }}"
        >
            Delete
        </button>

    @endcan

</div>

<div class="flex items-center gap-2">

    @can('update', $semester)

        <a
            href="{{ route('admin.semesters.edit', $semester) }}"
            class="btn btn-sm btn-warning"
        >
            Edit
        </a>

    @endcan

    @can('delete', $semester)

        <button
            type="button"
            class="btn btn-sm btn-danger delete-semester-btn"
            data-url="{{ route('admin.semesters.destroy', $semester) }}"
        >
            Delete
        </button>

    @endcan

</div>

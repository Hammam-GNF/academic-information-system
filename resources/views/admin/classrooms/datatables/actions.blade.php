<div class="flex items-center gap-2">

    @can('update', $classroom)

        <a
            href="{{ route('admin.classrooms.edit', $classroom) }}"
            class="btn btn-sm btn-secondary"
        >
            Edit
        </a>

    @endcan

    @can('delete', $classroom)

        <button
            type="button"
            class="btn btn-sm btn-danger delete-classroom-btn"
            data-url="{{ route('admin.classrooms.destroy', $classroom) }}"
        >
            Delete
        </button>

    @endcan

</div>

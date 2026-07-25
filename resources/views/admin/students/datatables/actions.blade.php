<div class="flex items-center gap-2">

    @can('update', $student)

        <a
            href="{{ route('admin.students.edit', $student) }}"
            class="btn btn-primary"
        >
            Edit
        </a>

    @endcan

    @can('delete', $student)

        <button
            type="button"
            class="btn btn-danger delete-student-btn"
            data-url="{{ route('admin.students.destroy', $student) }}"
        >
            Delete
        </button>

    @endcan

</div>

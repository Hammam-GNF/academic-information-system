<div class="flex items-center gap-2">

    @can('update', $grade)

        <a
            href="{{ route('admin.grades.edit', $grade) }}"
            class="btn btn-primary"
        >
            Edit
        </a>

    @endcan

    @can('delete', $grade)

        <button
            type="button"
            class="btn btn-danger delete-grade-btn"
            data-url="{{ route('admin.grades.destroy', $grade) }}"
        >
            Delete
        </button>

    @endcan

</div>

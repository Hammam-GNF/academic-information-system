<div class="flex items-center gap-2">

    @can('update', $academicYear)

        <a
            href="{{ route('admin.academic-years.edit', $academicYear) }}"
            class="btn btn-sm btn-warning"
        >
            Edit
        </a>

    @endcan

    @can('delete', $academicYear)

        <button
            type="button"
            class="btn btn-sm btn-danger delete-academic-year-btn"
            data-url="{{ route('admin.academic-years.destroy', $academicYear) }}"
        >
            Delete
        </button>

    @endcan

</div>

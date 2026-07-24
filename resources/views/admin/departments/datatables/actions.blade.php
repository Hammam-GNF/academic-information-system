<div class="flex items-center gap-2">

    @can('update', $department)

        <a
            href="{{ route('admin.departments.edit', $department) }}"
            class="btn btn-sm btn-warning"
        >
            Edit
        </a>

    @endcan


    @can('delete', $department)

        <button
            type="button"
            class="btn btn-sm btn-danger delete-department-btn"
            data-url="{{ route('admin.departments.destroy', $department) }}"
        >
            Delete
        </button>

    @endcan

</div>

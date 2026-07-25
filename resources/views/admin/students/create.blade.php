<x-app-layout>

    <x-slot name="header">
        Create Student
    </x-slot>

    <x-crud.form-page
        title="Create Student"
        description="Register a new student into the academic information system."
    >

        <x-crud.form-card>

            <x-students.form
                :action="route('admin.students.store')"
                method="POST"
                :classrooms="$classrooms"
            />

        </x-crud.form-card>

    </x-crud.form-page>

</x-app-layout>

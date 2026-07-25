<x-app-layout>

    <x-slot name="header">
        Edit Student
    </x-slot>

    <x-crud.form-page
        title="Edit Student"
        description="Update student information in the academic information system."
    >

        <x-crud.form-card>

            <x-students.form
                :action="route('admin.students.update', $student)"
                method="PUT"
                :student="$student"
                :classrooms="$classrooms"
            />

        </x-crud.form-card>

    </x-crud.form-page>

</x-app-layout>

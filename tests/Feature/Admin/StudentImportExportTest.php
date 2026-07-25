<?php

use App\Exports\StudentsExport;
use App\Exports\StudentTemplateExport;
use App\Imports\StudentsImport;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;

beforeEach(function () {

    Excel::fake();

    $admin = User::factory()->create();

    $admin->assignRole('admin');

    $this->actingAs($admin);

});

it('admin can export students', function () {

    $response = $this->get(
        route('admin.students.export')
    );

    $response->assertOk();

    Excel::assertDownloaded(
        'students-'.now()->format('Y-m-d').'.xlsx',
        function (StudentsExport $export) {

            return true;

        }
    );

});

it('admin can download student import template', function () {

    $response = $this->get(
        route('admin.students.import-template')
    );

    $response->assertOk();

    Excel::assertDownloaded(
        'student-import-template.xlsx',
        function (StudentTemplateExport $export) {

            return true;

        }
    );

});

it('admin can import students', function () {

    $file = UploadedFile::fake()->create(
        'students.xlsx'
    );

    $response = $this->post(
        route('admin.students.import'),
        [
            'file' => $file,
        ]
    );

    $response
        ->assertRedirect(route('admin.students.index'));

    Excel::assertImported(
        'students.xlsx',
        function (StudentsImport $import) {

            return true;

        }
    );

});

it('import requires excel file', function () {

    $file = UploadedFile::fake()->image(
        'students.png'
    );

    $this->post(
        route('admin.students.import'),
        [
            'file' => $file,
        ]
    )
        ->assertSessionHasErrors('file');

});

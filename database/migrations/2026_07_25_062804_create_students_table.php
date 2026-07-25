<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('student_number', 30)->unique();
            $table->string('nisn', 20)->nullable()->unique();

            $table->foreignId('classroom_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name');

            $table->enum('gender', [
                'male',
                'female',
            ]);

            $table->string('birth_place');
            $table->date('birth_date');

            $table->string('phone', 25)->nullable();
            $table->string('email')->nullable();

            $table->text('address')->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

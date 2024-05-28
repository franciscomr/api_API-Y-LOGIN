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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unique(array('name', 'first_surname', 'second_surname'));
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('position_id')->constrained();
            $table->string('name', 32);
            $table->string('first_surname', 32);
            $table->string('second_surname', 32);
            $table->string('identifier')->nullable()->unique();
            $table->date('hire_date');
            $table->boolean('is_active')->default(true);
            $table->string('created_by', 32);
            $table->string('updated_by', 32);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

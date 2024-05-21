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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32)->unique();
            $table->string('business_name', 64)->unique();
            $table->string('address', 64);
            $table->string('city', 32);
            $table->string('state', 32);
            $table->tinyInteger('postal_code');
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
        Schema::dropIfExists('companies');
    }
};

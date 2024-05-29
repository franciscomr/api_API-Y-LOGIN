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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('employee_id')->after('id')->constrained();
            $table->string('email')->unique(false)->change();
            $table->string('username')->unique()->after('email_verified_at');
            $table->string('is_active')->boolean()->default(true)->after('remember_token');
            $table->string('created_by')->after('is_active');
            $table->string('updated_by')->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

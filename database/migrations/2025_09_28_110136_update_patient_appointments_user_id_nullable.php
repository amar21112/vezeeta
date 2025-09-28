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
        Schema::table('patient_appointments', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['user_id']);
            
            // Make user_id nullable
            $table->unsignedBigInteger('user_id')->nullable()->change();
            
            // Add the foreign key constraint back with ON DELETE SET NULL
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_appointments', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);
            
            // Make user_id non-nullable
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            
            // Add the original foreign key constraint back
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
};

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
        // Add email field to admin table
        Schema::table('admin', function (Blueprint $table) {
            $table->string('email')->unique()->after('name');
            $table->string('phone')->nullable()->change();
        });
        
        // Rename table from admin to admins
        Schema::rename('admin', 'admins');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('admins', 'admin');
        Schema::table('admin', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->string('phone')->nullable(false)->change();
        });
    }
};

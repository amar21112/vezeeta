<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Add status field with enum values
            $table->enum('status', ['available', 'booked', 'cancelled', 'completed'])
                  ->default('available')
                  ->after('availability');
        });

        // Migrate existing data
        DB::statement('
            UPDATE appointments 
            SET status = CASE 
                WHEN availability = 1 THEN "available" 
                ELSE "booked" 
            END
        ');

        Schema::table('appointments', function (Blueprint $table) {
            // Add date and time columns, extracting from appointment_date
            $table->date('date')->nullable()->after('id');
            $table->time('time')->nullable()->after('date');
        });

        // Migrate appointment_date data to separate date and time fields
        DB::statement('
            UPDATE appointments 
            SET 
                date = DATE(appointment_date),
                time = TIME(appointment_date)
            WHERE appointment_date IS NOT NULL
        ');

        // Now make date and time non-nullable and drop old columns
        Schema::table('appointments', function (Blueprint $table) {
            $table->date('date')->nullable(false)->change();
            $table->time('time')->nullable(false)->change();
            $table->dropColumn(['appointment_date', 'availability']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dateTime('appointment_date')->after('id');
            $table->boolean('availability')->default(true)->after('appointment_date');
        });

        // Restore data
        DB::statement('
            UPDATE appointments 
            SET 
                appointment_date = CONCAT(date, " ", time),
                availability = CASE 
                    WHEN status = "available" THEN 1 
                    ELSE 0 
                END
        ');

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['date', 'time', 'status']);
        });
    }
};

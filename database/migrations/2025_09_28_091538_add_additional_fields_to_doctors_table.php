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
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('image')->nullable()->after('about');
            $table->decimal('rating', 2, 1)->default(4.0)->after('image');
            $table->integer('reviews_count')->default(0)->after('rating');
            $table->decimal('fees', 8, 2)->default(200.00)->after('reviews_count');
            $table->integer('waiting_time')->default(15)->after('fees'); // in minutes
            $table->decimal('call_cost', 8, 2)->default(16676.00)->after('waiting_time');
            $table->boolean('telehealth_available')->default(false)->after('call_cost');
            $table->string('hospital_name')->nullable()->after('telehealth_available');
            $table->text('symptoms_services')->nullable()->after('hospital_name'); // JSON or comma-separated
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn([
                'image', 'rating', 'reviews_count', 'fees', 'waiting_time', 
                'call_cost', 'telehealth_available', 'hospital_name', 'symptoms_services'
            ]);
        });
    }
};

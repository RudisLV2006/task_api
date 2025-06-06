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
        Schema::create('task_statuses', function (Blueprint $table) {
            $table->id();
            $table->string("status")->unique();
            $table->timestamps();
        });

        DB::table('task_statuses')->insert([
            ['status' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'In Progress', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Completed', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_statuses');
    }
};

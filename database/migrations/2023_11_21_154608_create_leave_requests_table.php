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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('leave_type')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->string('file')->nullable();
            $table->integer('status')->nullable();
            $table->text('leave_reason')->nullable();

            $table->integer('created_by_id')->nullable();
            $table->string('created_by_username')->nullable();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('leave_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};

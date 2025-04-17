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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('method')->nullable();
            $table->integer('status')->nullable();
            $table->text('note')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->string('created_by_username')->nullable();
            $table->timestamps();

            $table->index('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};

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
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->integer('status')->nullable();
            $table->text('note')->nullable();

            $table->integer('created_by_id')->nullable();
            $table->string('created_by_username')->nullable();
            $table->timestamps();

            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};

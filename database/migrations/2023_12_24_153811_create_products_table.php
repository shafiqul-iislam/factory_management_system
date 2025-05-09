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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->nullable();
            $table->string('category')->nullable();
            $table->string('name')->nullable();
            $table->integer('status')->nullable();
            $table->text('note')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->string('created_by_username')->nullable();
            $table->timestamps();

            // need to add brands field

            // need to add units module

            // stock count -> follow slaes pro inventory application 

            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

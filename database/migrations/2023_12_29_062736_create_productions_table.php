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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('product_category')->nullable();
            $table->string('production_target')->nullable();
            $table->string('total_production')->nullable();
            $table->integer('supervisor_id')->nullable();
            $table->integer('status')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();


            // product delivey module
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};

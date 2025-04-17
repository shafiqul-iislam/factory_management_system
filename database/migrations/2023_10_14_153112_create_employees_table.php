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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->date('dob')->nullable(); // date of birth
            $table->integer('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('department_id')->nullable();
            $table->date('joining_date')->nullable();
            $table->integer('designation')->nullable();
            $table->string('office_shift')->nullable();
            $table->integer('status')->nullable();            
            $table->text('note')->nullable();   

            $table->integer('created_by_id')->nullable();
            $table->string('created_by_username')->nullable();
            $table->timestamps();

            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

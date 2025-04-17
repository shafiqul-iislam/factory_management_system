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
        Schema::table('productions', function (Blueprint $table) {            
            $table->integer('office_shift')->nullable()->after('supervisor_id');
            $table->integer('created_by_id')->nullable()->after('note');
            $table->string('created_by_username')->nullable()->after('created_by_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productions', function (Blueprint $table) {
            //
        });
    }
};

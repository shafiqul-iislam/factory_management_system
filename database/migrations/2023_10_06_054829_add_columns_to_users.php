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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('updated_at');
            $table->integer('profile_type')->nullable()->after('username');
            $table->integer('profile_status')->nullable()->after('profile_type');
            $table->string('phone')->nullable()->after('profile_status');
            $table->string('nid')->nullable()->after('phone');
            $table->string('address')->nullable()->after('nid');
            $table->integer('role')->nullable()->after('address');
            $table->string('city')->nullable()->after('role');
            $table->string('country')->nullable()->after('city');
            $table->string('photo')->nullable()->after('country');

            $table->integer('created_by_id')->nullable();
            $table->string('created_by_username')->nullable();

            $table->index('name');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->string('no_telepon', 20)->change();
            $table->string('no_telepon_orangtua', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->string('no_telepon')->change();
            $table->string('no_telepon_orangtua')->change();
        });
    }
};
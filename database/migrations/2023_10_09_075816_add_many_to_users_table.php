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
            //
            $table->string('user_icon_path')->after('name')->default('default_icon');
            $table->foreignId('family_id')->after('user_icon_path')->nullable()->constrained()->cascadeOnDelete();
            $table->string('family_name')->after('family_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['family_id']);
            $table->dropColumn(['family_id']);
            $table->dropColumn(['user_icon_path']);
            $table->dropColumn(['family_name']);
        });
    }
};

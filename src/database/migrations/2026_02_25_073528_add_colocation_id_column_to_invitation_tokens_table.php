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
        Schema::table('invitation_tokens', function (Blueprint $table) {
            $table->foreignId('colocation_id')->constrained('colocations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitation_tokens', function (Blueprint $table) {
            $table->dropColumn('colocation_id');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->string('category')->nullable()->after('image_url');
            $table->timestamps();
            $table->dropColumn('uploaded_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->timestamp('uploaded_at')->nullable();
            $table->dropTimestamps();
            $table->dropColumn(['description', 'category']);
        });
    }
};

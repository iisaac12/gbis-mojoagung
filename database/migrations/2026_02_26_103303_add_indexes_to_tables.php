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
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->index('date');
        });

        Schema::table('hero_images', function (Blueprint $table) {
            $table->index('page_name');
            $table->index('sort_order');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index('date');
            $table->index('language');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex(['date']);
        });

        Schema::table('hero_images', function (Blueprint $table) {
            $table->dropIndex(['page_name']);
            $table->dropIndex(['sort_order']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['date']);
            $table->dropIndex(['language']);
        });
    }
};

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
        Schema::create('announcements', function (Blueprint $row) {
            $row->id();
            $row->string('title');
            $row->text('content');
            $row->string('type')->default('info'); // info, warning, success, etc.
            $row->boolean('is_active')->default(true);
            $row->boolean('is_pinned')->default(false);
            $row->timestamp('expires_at')->nullable();
            $row->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};

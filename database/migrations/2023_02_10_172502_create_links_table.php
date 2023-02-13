<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create(config('linky.db.prefix') . 'links', function (Blueprint $table) {
            $table->id();
            $table->string('url', 2048);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('linky.db.prefix') . 'links');
    }
};

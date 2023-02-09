<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public static function up(): void
    {
        Schema::create(config('linky.db.prefix') . 'contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public static function down(): void
    {
        Schema::dropIfExists(config('linky.db.prefix') . 'contents');
    }
};

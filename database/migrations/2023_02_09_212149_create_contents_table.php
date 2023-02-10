<?php

use Illegal\Linky\Enums\ContentStatus;
use Illegal\Linky\Enums\ContentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public static function up(): void
    {
        Schema::create(config('linky.db.prefix') . 'contents', function (Blueprint $table) {
            $table->id();
            $table->string('type', 10)->default(ContentType::Link->value);
            $table->string('status', 10)->default(ContentStatus::Draft->value);
            $table->string('slug')->index()->unique();
            $table->string('title');
            $table->text('description');
            $table->morphs('contentable');
            $table->timestamps();
        });
    }

    public static function down(): void
    {
        Schema::dropIfExists(config('linky.db.prefix') . 'contents');
    }
};

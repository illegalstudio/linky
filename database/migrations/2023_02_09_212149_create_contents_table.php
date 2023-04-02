<?php

use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create(Content::getTableName(), static function (Blueprint $table) {
            $table->id();
            $table->string('type', 10)->default(ContentType::Link->value);
            $table->boolean('public');
            $table->string('slug')->index()->unique();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->morphs('contentable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Content::getTableName());
    }
};

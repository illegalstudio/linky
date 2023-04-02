<?php

use Illegal\Linky\Models\Contentable\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create(Page::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->longText('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Page::getTableName());
    }
};

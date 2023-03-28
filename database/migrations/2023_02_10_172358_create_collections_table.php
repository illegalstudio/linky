<?php

use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create(Collection::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Collection::getTableName());
    }
};

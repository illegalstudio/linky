<?php

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create(Collection::getCollectionContentsTable(), function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(Collection::class, 'collection_id')
                ->constrained(Collection::getTableName());
            $table
                ->foreignIdFor(Content::class, 'content_id')
                ->constrained(Content::getTableName());

            $table->integer('position')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(Collection::getCollectionContentsTable());
    }
};

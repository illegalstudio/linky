<?php

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create(config('linky.db.prefix') . 'collection_content', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(Collection::class, 'collection_id')
                ->constrained(Collection::getTableName())
                ->cascadeOnDelete()
            ;
            $table
                ->foreignIdFor(Content::class, 'content_id')
                ->constrained(Content::getTableName())
                ->cascadeOnDelete()
            ;

            $table->integer('position')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('linky.db.prefix') . 'collection_content');
    }
};

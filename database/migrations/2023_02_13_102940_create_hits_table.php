<?php

use Illegal\Linky\Models\Content;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(config('linky.db.prefix') . 'hits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Content::class)->constrained(Content::getTableName())->cascadeOnDelete();
            $table->string('url')->nullable();
            $table->string('scheme')->nullable();
            $table->string('host')->nullable();
            $table->string('path')->nullable();
            $table->string('method')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('referer')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('timezone')->nullable();
            $table->string('continent')->nullable();
            $table->string('currency')->nullable();
            $table->string('languages')->nullable();
            $table->string('asn')->nullable();
            $table->string('org')->nullable();
            $table->string('isp')->nullable();
            $table->string('connection_type')->nullable();
            $table->string('device')->nullable();
            $table->string('os')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->json('headers')->nullable();
            $table->json('get')->nullable();
            $table->json('post')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('linky.db.prefix') . 'hits');
    }
};

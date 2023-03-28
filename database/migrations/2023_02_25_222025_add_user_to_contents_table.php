<?php

use Illegal\InsideAuth\Models\User;
use Illegal\Linky\Models\Content;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table(Content::getTableName(), static function (Blueprint $table) {
            $table->foreignIdFor(User::class)->nullable()->after('id')->constrained(User::getTableName());
        });
    }

    public function down(): void
    {
        Schema::table(Content::getTableName(), static function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(User::class);
        });
    }
};

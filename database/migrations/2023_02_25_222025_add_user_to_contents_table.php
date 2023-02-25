<?php

use Illegal\Linky\Models\Auth\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table(config('linky.db.prefix') . 'contents', static function (Blueprint $table) {
            $table->foreignIdFor(User::class)->nullable()->after('id')->constrained(User::getTableName());
        });
    }

    public function down(): void
    {
        Schema::table(config('linky.db.prefix') . 'contents', static function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
        });
    }
};

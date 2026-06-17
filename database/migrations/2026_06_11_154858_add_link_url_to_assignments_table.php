<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('assignments', function (Blueprint $table) {
        // Menambahkan kolom link_url setelah kolom description
        $table->string('link_url')->nullable()->after('description');
    });
}

public function down(): void
{
    Schema::table('assignments', function (Blueprint $table) {
        $table->dropColumn('link_url');
    });
}
};

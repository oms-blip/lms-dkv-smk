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
    Schema::table('modules', function (Blueprint $table) {
        // Hapus 'after' supaya aman
        $table->string('materi_pdf')->nullable();
        $table->string('video_link')->nullable();
    });
}

public function down()
{
    Schema::table('modules', function (Blueprint $table) {
        $table->dropColumn(['materi_pdf', 'video_link']);
    });
}
};

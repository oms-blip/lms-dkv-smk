<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            // Menambahkan 2 kolom baru setelah kolom deskripsi
            $table->string('materi_pdf')->nullable()->after('description');
            $table->string('video_link')->nullable()->after('materi_pdf');
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['materi_pdf', 'video_link']);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('assignments', function (Blueprint $table) {
            // Tambahkan baris ini untuk membuat kolom file_path
            $table->string('file_path')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('assignments', function (Blueprint $table) {
            // Untuk menghapus kolom jika di-rollback
            $table->dropColumn('file_path');
        });
    }
};

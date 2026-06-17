<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            // Kita buatin laci 'score' untuk nyimpen nilai
            if (!Schema::hasColumn('submissions', 'score')) {
                $table->integer('score')->nullable()->default(0);
            }
            
            // Jamal tambahin laci 'nilai' juga buat jaga-jaga karena sistem Guru bosku pakai kata 'nilai'
            if (!Schema::hasColumn('submissions', 'nilai')) {
                $table->integer('nilai')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (Schema::hasColumn('submissions', 'score')) {
                $table->dropColumn('score');
            }
            if (Schema::hasColumn('submissions', 'nilai')) {
                $table->dropColumn('nilai');
            }
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            // Kita tambahkan laci 'feedback' yang tipenya text (biar bisa panjang)
            if (!Schema::hasColumn('submissions', 'feedback')) {
                $table->text('feedback')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (Schema::hasColumn('submissions', 'feedback')) {
                $table->dropColumn('feedback');
            }
        });
    }
};
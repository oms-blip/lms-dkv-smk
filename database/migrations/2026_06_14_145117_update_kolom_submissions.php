<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            // Cek apakah kolom status belum ada, jika belum maka buatkan
            if (!Schema::hasColumn('submissions', 'status')) {
                $table->string('status')->default('Menunggu')->after('user_id');
            }
            
            // Cek apakah kolom link_url belum ada, jika belum maka buatkan
            if (!Schema::hasColumn('submissions', 'link_url')) {
                $table->string('link_url')->nullable();
            }

            // file_path tidak kita masukkan lagi ke sini karena sudah terbukti ada di databasemu
        });
    }

    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (Schema::hasColumn('submissions', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('submissions', 'link_url')) {
                $table->dropColumn('link_url');
            }
        });
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Mengecek apakah kolom 'kelas' SUDAH ADA atau BELUM
        if (!Schema::hasColumn('users', 'kelas')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('kelas')->nullable()->after('role');
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('kelas');
        });
    }
};
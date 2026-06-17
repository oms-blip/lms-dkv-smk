<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Sudah bersih dari kata 'PHP ' yang bikin error tadi bro
        Schema::table('courses', function (Blueprint $table) {
            // Menambahkan kolom status dengan bawaan (default) bernilai 'active'
            $table->string('status')->default('active')->after('title'); 
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
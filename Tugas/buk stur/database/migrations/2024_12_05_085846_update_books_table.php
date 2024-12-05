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
        Schema::table('books', function (Blueprint $table) {
            // Tambahkan kolom yang hilang
            if (!Schema::hasColumn('books', 'image')) {
                $table->string('image')->nullable();
            }
    
            // Periksa atau ubah struktur kolom lainnya jika perlu
        });
    }
    
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            // Hapus kolom tambahan jika diperlukan
            if (Schema::hasColumn('books', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
    
};

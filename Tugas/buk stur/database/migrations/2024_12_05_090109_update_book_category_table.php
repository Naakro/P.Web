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
        Schema::table('book_category', function (Blueprint $table) {
            $table->bigInteger('book_id')->change(); // Ubah kolom book_id menjadi bigInteger agar sesuai dengan kolom id di tabel books
        });
    }
    
    public function down()
    {
        Schema::table('book_category', function (Blueprint $table) {
            $table->integer('book_id')->change(); // Kembalikan tipe data jika perlu
        });
    }
    
};

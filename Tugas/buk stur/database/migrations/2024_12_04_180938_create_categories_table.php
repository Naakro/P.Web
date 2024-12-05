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
        Schema::create('book_category', function (Blueprint $table) {
            $table->id(); // Kolom ID untuk tabel book_category
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade'); // Pastikan foreignId sesuai
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key untuk category_id
            $table->timestamps();
        });
    }
    

    
    public function down()
    {
        Schema::dropIfExists('categories');
    }
    
};

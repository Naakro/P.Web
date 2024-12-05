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
        if (!Schema::hasTable('books')) { // Pengecekan keberadaan tabel
            Schema::create('books', function (Blueprint $table) {
                $table->id(); // kolom id (auto increment)
                $table->string('book_name'); // kolom nama buku
                $table->string('creator'); // kolom nama creator
                $table->decimal('price', 10, 2); // kolom harga buku
                $table->text('description')->nullable(); // kolom deskripsi buku
                $table->string('image')->nullable(); // kolom image buku
                $table->foreignId('category_id')->constrained()->onDelete('cascade'); // kolom category_id, menghubungkan dengan kategori
                $table->timestamps(); // kolom created_at dan updated_at
            });
        }
    }
    
    
    public function down()
    {
        Schema::dropIfExists('books');
    }
    
};

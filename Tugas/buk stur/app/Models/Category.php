<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'description', // Menambahkan kolom description
    ];

    // Accessor untuk category_name
    public function getCategoryNameAttribute($value)
    {
        return ucfirst($value); // Mengubah kategori menjadi huruf kapital pertama
    }

    // Accessor untuk description
    public function getDescriptionAttribute($value)
    {
        return ucfirst($value); // Mengubah deskripsi menjadi huruf kapital pertama
    }

    // Relasi ke Books
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}





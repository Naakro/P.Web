<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book_name' => 'required|string|max:255',
            'creator' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validatedData->errors(),
            ], 400);
        }

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            // Mengambil file yang diunggah dan menyimpannya
            $imagePath = $request->file('image')->store('books/images', 'public');
        } else {
            $imagePath = null;
        }

        // Menyimpan data buku ke database
        $book = Book::create([
            'image' => $imagePath,
            'book_name' => $request->book_name,
            'creator' => $request->creator,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully!',
            'data' => $book,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        // Log semua data yang diterima dari request untuk debugging
        Log::info('Request data:', $request->all());
    
        $book = Book::find($id);
    
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
            ], 404);
        }
    
        // Validasi input
        $validatedData = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book_name' => 'required|string|max:255',
            'creator' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);
    
        // Periksa apakah validasi gagal
        if ($validatedData->fails()) {
            // Log error validasi
            Log::error('Validation failed:', $validatedData->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => $validatedData->errors(),
            ], 400);
        }
    
        // Cek dan simpan gambar baru jika ada
        if ($request->hasFile('image')) {
            if ($book->image && Storage::exists('public/' . $book->image)) {
                Storage::delete('public/' . $book->image);
            }
            $imagePath = $request->file('image')->store('books/images', 'public');
        } else {
            $imagePath = $book->image; // Gunakan gambar lama
        }
    
        // Update data buku
        $book->update([
            'image' => $imagePath,
            'book_name' => $request->get('book_name'),
            'creator' => $request->get('creator'),
            'price' => $request->get('price'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully!',
            'data' => $book,
        ]);
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
            ], 404);
        }

        // Hapus gambar jika ada
        if ($book->image && Storage::exists('public/' . $book->image)) {
            Storage::delete('public/' . $book->image);
        }

        // Hapus buku
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully!',
        ]);
    }
}

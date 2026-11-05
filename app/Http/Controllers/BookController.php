<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    // Pembatasan akses dilakukan di routes/web.php lewat middleware permission.

    public function index(Request $request): View
    {
        $books = Book::query()
            ->when($request->q, function ($query, $q) {
                $query->where('judul', 'like', "%{$q}%")
                      ->orWhere('penulis', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('books.index', compact('books'));
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Book::create($this->validated($request));

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book): View
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $book->update($this->validated($request));

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'judul'        => ['required', 'string', 'max:255'],
            'penulis'      => ['required', 'string', 'max:255'],
            'penerbit'     => ['nullable', 'string', 'max:255'],
            'tahun_terbit' => ['nullable', 'integer', 'between:1000,' . date('Y')],
            'deskripsi'    => ['nullable', 'string', 'max:2000'],
        ]);
    }
}

@csrf

<div>
    <x-input-label for="judul" value="Judul" />
    <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full"
        :value="old('judul', $book->judul ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('judul')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="penulis" value="Penulis" />
    <x-text-input id="penulis" name="penulis" type="text" class="mt-1 block w-full"
        :value="old('penulis', $book->penulis ?? '')" required />
    <x-input-error :messages="$errors->get('penulis')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="penerbit" value="Penerbit" />
    <x-text-input id="penerbit" name="penerbit" type="text" class="mt-1 block w-full"
        :value="old('penerbit', $book->penerbit ?? '')" />
    <x-input-error :messages="$errors->get('penerbit')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="tahun_terbit" value="Tahun Terbit" />
    <x-text-input id="tahun_terbit" name="tahun_terbit" type="number" class="mt-1 block w-full"
        :value="old('tahun_terbit', $book->tahun_terbit ?? '')" />
    <x-input-error :messages="$errors->get('tahun_terbit')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="deskripsi" value="Deskripsi" />
    <textarea id="deskripsi" name="deskripsi" rows="4"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $book->deskripsi ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
</div>

<div class="mt-6 flex items-center gap-3">
    <x-primary-button>Simpan</x-primary-button>
    <a href="{{ route('books.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
</div>

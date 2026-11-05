<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Buku</h2>

            @can('tambah buku')
                <a href="{{ route('books.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-xs font-semibold uppercase rounded-md hover:bg-gray-700">
                    + Tambah Buku
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('books.index') }}" class="mb-4 flex gap-2">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul atau penulis..."
                        class="w-full sm:w-72 border-gray-300 rounded-md shadow-sm text-sm">
                    <button class="px-3 py-2 bg-indigo-600 text-white text-sm rounded-md">Cari</button>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-3 py-2">#</th>
                                <th class="px-3 py-2">Judul</th>
                                <th class="px-3 py-2">Penulis</th>
                                <th class="px-3 py-2">Penerbit</th>
                                <th class="px-3 py-2">Tahun</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr class="border-b">
                                    <td class="px-3 py-2">{{ $books->firstItem() + $loop->index }}</td>
                                    <td class="px-3 py-2 font-medium">{{ $book->judul }}</td>
                                    <td class="px-3 py-2">{{ $book->penulis }}</td>
                                    <td class="px-3 py-2">{{ $book->penerbit ?? '-' }}</td>
                                    <td class="px-3 py-2">{{ $book->tahun_terbit ?? '-' }}</td>
                                    <td class="px-3 py-2">
                                        <div class="flex items-center gap-3">
                                            @can('edit buku')
                                                <a href="{{ route('books.edit', $book) }}" class="text-indigo-600 hover:underline">Edit</a>
                                            @endcan

                                            @can('hapus buku')
                                                <form method="POST" action="{{ route('books.destroy', $book) }}"
                                                      onsubmit="return confirm('Hapus buku ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 hover:underline">Hapus</button>
                                                </form>
                                            @endcan

                                            @cannot('edit buku')
                                                @cannot('hapus buku')
                                                    <span class="text-gray-400">Hanya lihat</span>
                                                @endcannot
                                            @endcannot
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-3 py-6 text-center text-gray-500">Belum ada data buku.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $books->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>

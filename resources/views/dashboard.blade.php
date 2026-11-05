<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-800">
                    Halo, <strong>{{ auth()->user()->name }}</strong>.
                    Role Anda: <strong>{{ auth()->user()->getRoleNames()->first() ?? '-' }}</strong>.
                </p>

                <div class="mt-4 flex gap-3">
                    @can('lihat buku')
                        <a href="{{ route('books.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">Lihat Buku</a>
                    @endcan
                    @can('kelola role')
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">Kelola Role</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
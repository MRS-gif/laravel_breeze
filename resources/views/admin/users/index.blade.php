<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Role Pengguna</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800 text-sm">{{ session('error') }}</div>
            @endif
            @error('role')
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800 text-sm">{{ $message }}</div>
            @enderror

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-3 py-2">Nama</th>
                                <th class="px-3 py-2">Email</th>
                                <th class="px-3 py-2">Role Saat Ini</th>
                                <th class="px-3 py-2">Ubah Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b">
                                    <td class="px-3 py-2 font-medium">{{ $user->name }}</td>
                                    <td class="px-3 py-2">{{ $user->email }}</td>
                                    <td class="px-3 py-2">
                                        <span class="px-2 py-1 text-xs rounded bg-indigo-100 text-indigo-800">
                                            {{ $user->getRoleNames()->first() ?? 'Tanpa role' }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2">
                                        <form method="POST" action="{{ route('admin.users.role', $user) }}" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="border-gray-300 rounded-md text-sm">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}" @selected($user->hasRole($role->name))>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button class="px-3 py-1.5 bg-gray-800 text-white text-xs rounded-md">Simpan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>

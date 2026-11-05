<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (['lihat buku', 'tambah buku', 'edit buku', 'hapus buku', 'kelola role'] as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $dosen = Role::firstOrCreate(['name' => 'Dosen', 'guard_name' => 'web']);
        $mhs   = Role::firstOrCreate(['name' => 'Mahasiswa', 'guard_name' => 'web']);

        $admin->syncPermissions(Permission::all());
        $dosen->syncPermissions(['lihat buku', 'tambah buku', 'edit buku']);
        $mhs->syncPermissions(['lihat buku']);

        $akun = [
            ['Admin Uji',     'admin@test.com',     'Admin'],
            ['Dosen Uji',     'dosen@test.com',     'Dosen'],
            ['Mahasiswa Uji', 'mahasiswa@test.com', 'Mahasiswa'],
        ];

        foreach ($akun as [$nama, $email, $role]) {
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $nama, 'password' => bcrypt('password'), 'email_verified_at' => now()]
            );
            $user->syncRoles($role);
        }

        // Data buku contoh
        if (Book::count() === 0) {
            Book::insert([
                ['judul' => 'Pemrograman Web dengan Laravel', 'penulis' => 'Andi Wijaya', 'penerbit' => 'Informatika', 'tahun_terbit' => 2023, 'deskripsi' => 'Dasar-dasar Laravel.', 'created_at' => now(), 'updated_at' => now()],
                ['judul' => 'Basis Data Relasional', 'penulis' => 'Siti Rahma', 'penerbit' => 'Andi Offset', 'tahun_terbit' => 2021, 'deskripsi' => 'Konsep MySQL dan normalisasi.', 'created_at' => now(), 'updated_at' => now()],
                ['judul' => 'Keamanan Aplikasi Web', 'penulis' => 'Budi Santoso', 'penerbit' => 'Gramedia', 'tahun_terbit' => 2022, 'deskripsi' => 'OWASP dan praktik aman.', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}

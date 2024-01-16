<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'desc' => 'hiduplah dengan bahagia'
        ]);


        User::create([
            'name' => 'anjasmara',
            'email' => 'anjas@example.com',
            'password' => bcrypt('password'),
            'desc' => 'hidup seperti larry'
        ]);

        User::create([
            'name' => 'Budi Setiawan',
            'email' => 'budi@example.com',
            'password' => bcrypt('password'),
            'desc' => 'Hiduplah dengan penuh semangat'
        ]);

        User::create([
            'name' => 'Ani Kartini',
            'email' => 'ani@example.com',
            'password' => bcrypt('password'),
            'desc' => 'Selalu bersyukur dalam setiap langkah'
        ]);

        User::create([
            'name' => 'Iwan Santoso',
            'email' => 'iwan@example.com',
            'password' => bcrypt('password'),
            'desc' => 'Mengejar impian dengan tekad yang kuat'
        ]);

        User::create([
            'name' => 'Dewi Kurniawati',
            'email' => 'dewi@example.com',
            'password' => bcrypt('password'),
            'desc' => 'Menjadi sumber inspirasi bagi orang di sekitar'
        ]);

        User::create([
            'name' => 'Agus Wijaya',
            'email' => 'agus@example.com',
            'password' => bcrypt('password'),
            'desc' => 'Mengatasi ketakutan untuk mencapai impian'
        ]);

        User::create([
            'name' => 'Siti Nurhayati',
            'email' => 'siti@example.com',
            'password' => bcrypt('password'),
            'desc' => 'Semangat dan kegigihan adalah kunci kesuksesan'
        ]);

        User::create([
            'name' => 'Hendra Pratama',
            'email' => 'hendra@example.com',
            'password' => bcrypt('password'),
            'desc' => 'Menyadari keberkahan dalam setiap langkah'
        ]);

        User::create([
            'name' => 'Diana Ramadhani',
            'email' => 'diana@example.com',
            'password' => bcrypt('password'),
            'desc' => 'Percaya pada diri sendiri untuk mencapai tujuan'
        ]);

    }
}

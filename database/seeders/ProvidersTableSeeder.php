<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [];
        $users = User::all();
        
        for ($i = 1; $i <= 20; $i++) {
            $randomUser = $users->random();
            $companies[] = [
                'name' => 'Company ' . $i,
                'address' => 'Address ' . $i,
                'phone' => 'Phone ' . $i,
                'note' => 'Note ' . $i,
                'user_id' => $randomUser->id,
            ];
        }

        DB::table('providers')->insert($companies);
    }
}

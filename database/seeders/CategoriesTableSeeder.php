<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $categories = [];

        $users = User::all();

        for ($i = 1; $i <= 50; $i++) {
            $randomUser = $users->random();

            $categories[] = [
            
                
                'name' => 'Category ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => $randomUser->id,
            ];
        }

        DB::table('categories')->insert($categories);
    }
}

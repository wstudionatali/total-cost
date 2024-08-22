<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

     //   User::factory()->create([
      //      'name' => 'Test User',
       //     'email' => 'test@example.com',
       // ]);

        DB::table('products')->insert([
            ['name' => 'Fruit tee',
            'code' => 'FR1',
            'price' => '3.11'],
            ['name' => 'Strawberries',
            'code' => 'SR1',
            'price' => '5.00'],
            ['name' => 'Coffee',
            'code' => 'SF1',
            'price' => '11.23'],
        ]);
    }
}

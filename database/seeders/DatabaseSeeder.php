<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name'  => 'ibnu',
        //     'email' => 'ibnu@email.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(SupplierSeeder::class);
        // $this->call(ProductSeeder::class);
    }
}

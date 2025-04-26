<?php
namespace Database\Seeders;

use App\Models\Products;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Supplier::factory()->count(5)->create();

        Supplier::factory()->count(10)->create()
            ->each(function ($supplier) {
                Products::factory()
                    ->count(3) // Create 3 products per supplier
                    ->create(['supplier_id' => $supplier->id]);
            });
    }
}

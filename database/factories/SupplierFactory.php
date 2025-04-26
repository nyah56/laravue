<?php
namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Supplier::class;
    public function definition(): array
    {
        return [
            //
            'name'         => $this->faker->company(),
            'company_logo' => $this->faker->imageUrl(),
            'address'      => $this->faker->city(),
            'contacts'     => json_encode(["key1" => $this->faker->randomNumber()]),
        ];
    }
}

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
            'name'     => $this->faker->company(),
            'address'  => $this->faker->city(),
            'contacts' => ['phone' => $this->faker->numerify('08#########'), 'email' => $this->faker->email()],
        ];
    }
}

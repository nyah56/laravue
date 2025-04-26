<?php
namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Products::class;
    public function definition(): array
    {
        return [
            //
            'name'          => 'Shoes by ' . $this->faker->company(),
            'supplier_id'   => $this->faker->randomNumber(),
            'product_image' => $this->faker->imageUrl(),
            'price'         => $this->faker->randomNumber(),
            'properties'    => json_encode(["size" => $this->faker->randomNumber(2), "color" => $this->faker->colorName()]),
        ];
    }
}

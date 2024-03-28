<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'company_id' => Company::factory(),
            'status' => $this->faker->randomElement(['new', 'preparing', 'done', 'delivered', 'finished' ,'cancelled']),
            'total' => $this->faker->randomFloat(2, 1, 1000),
            'order_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}

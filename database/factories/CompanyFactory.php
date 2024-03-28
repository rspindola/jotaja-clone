<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'department_id' => \App\Models\Department::factory(),
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'email' => $this->faker->unique()->safeEmail,
            'cnpj' => $this->faker->numerify('##############'),
            'phone' => $this->faker->phoneNumber,
            'phone_alternative' => $this->faker->optional()->phoneNumber,
            'whatsapp' => $this->faker->optional()->phoneNumber,
        ];
    }
}

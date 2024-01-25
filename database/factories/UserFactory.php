<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jambNo = '2023' . $this->faker->numerify('########') . $this->faker->lexify('??');

        return [
            'account_id' => $this->faker->unique()->randomNumber(),
            'surname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'm_name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'p_number' => $this->faker->unique()->phoneNumber,
            'password' => bcrypt('password'),
            'vpassword' => bcrypt('password'),
            'complate' => 0,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
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
        $users = array(
            ['phone' => '31987324565', 'name' => 'Thiago Augusto', 'email' => 'thiago.digitalfront@gmail.com'],
            ['phone' => '31986435111', 'name' => 'Daniel Nunes', 'email' => 'danielpnunes@gmail.com'],
            ['phone' => '31998420055', 'name' => 'José Ricardo', 'email' => 'jrer@uol.com.br']
        );
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
        }
        return [];
    }
}

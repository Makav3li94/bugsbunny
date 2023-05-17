<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'name' => 'isbug',
            'email' => 'info@isbug.com',
            'mobile' => '09356766574',
            'password' => Hash::make('Isbug@123456'),
            'remember_token' => Str::random(10),
        ];
    }
}

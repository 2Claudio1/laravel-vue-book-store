<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    private $numberOfCustomers = 100;
    private $numberOfFuncionarios = 5;

    public function run()
    {
        DB::table('users')->truncate();

        $faker = Factory::create('pt_PT');
        for ($i = 1; $i <= $this->numberOfFuncionarios; ++$i) {
            DB::table('users')->insert($this->fakeUser($faker, $i, 'Employee'));
        }
        for ($i = 1; $i <= $this->numberOfCustomers; ++$i) {
            DB::table('users')->insert($this->fakeUser($faker, $i, 'Customer'));
        }
    }

    private function fakeUser(Generator $faker, $idx, $type = 'Customer')
    {
        static $password;
        $createdAt = Carbon::now()->subDays(30);
        $updatedAt = $faker->dateTimeBetween($createdAt);
        $emailPrefix = $type == 'Customer' ? 'c' : 'e';
        return [
            'name' => ($type == 'Customer' ? 'Customer ' : 'Employee ') . $idx,
            'email' => $emailPrefix . $idx . '@mail.pt',
            'type' => $type,
            'password' => $password ?: $password = bcrypt('123'),
            'remember_token' => Str::random(10),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}

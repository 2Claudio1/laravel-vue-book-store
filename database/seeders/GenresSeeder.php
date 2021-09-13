<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line("");
        $this->command->line("##################################################################################");
        $this->command->line("A criar Genres");
        $this->command->line("##################################################################################");

        DB::table('genres')->truncate();
        DB::table('genres')->insert([
            [
                'code'  => 'ARC',
                'name'  => 'Architecture'
            ],
            [
                'code'  => 'SFL',
                'name'  => 'Self-Learning'
            ],
            [
                'code'  => 'DES',
                'name'  => 'Design'
            ],
            [
                'code'  => 'ROM',
                'name'  => 'Romance'
            ],
            [
                'code'  => 'SC',
                'name'  => 'Science'
            ],
            [
                'code'  => 'PHOTO',
                'name'  => 'Photography'
            ],
            [
                'code'  => 'COOK',
                'name'  => 'Cook'
            ],
            [
                'code'  => 'SF',
                'name'  => 'Science Fiction'
            ],
            [
                'code'  => 'O',
                'name'  => 'Others'
            ],
        ]);
    }
}

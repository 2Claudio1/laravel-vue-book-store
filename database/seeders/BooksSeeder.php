<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Generator;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BooksSeeder extends Seeder
{
    static function books()
    {
        return [
            ['21st-Century-Architecture.jpg', 10, '21st Century Architecture ', false, 'ARC', 49.99],
            ['A-Home-in-Heels.jpg', 1, 'A Home in Heels ', false, 'ROM', 12.00],
            ['Adrift-on-a-Stollen-Moon.jpg', 3, 'Adrift on a Stollen Moon ', true, 'SF', 10.00],
            ['Appetite-for-Precision.jpg', 4, 'Appetite for Precision ', false, 'COOK', 9.99],
            ['Behind-the-Lens-Image-of-a-Woman.jpg', 2, 'Behind the Lens Image of a Woman ', false, 'PHOTO', 67.49],
            ['Big-Words-Little-Actions.jpg', 0, 'Big Words Little Actions ', false, 'ROM', 21.00],
            ['Caked-and-Bakes.jpg', 0, 'Caked and Bakes ', false, 'COOK', 43.00],
            ['Cats-and-Trends.jpg', 1, 'Cats and Trends ', false, 'O', 12.10],
            ['Contemporary-Architecture.jpg', 3, 'Contemporary Architecture ', false, 'ARC', 59.44],
            ['Deeper-Into-Dreams.jpg', 7, 'Deeper Into Dreams ', false, 'SFL', 32.12],
            ['Diving-Deep-Into-the-Red-Planet.jpg', 3, 'Diving Deep Into the Red Planet ', false, 'SF', 19.99],
            ['Ember-of-the-Children.jpg', 0, 'Ember of the Children ', false, 'ROM', 8.99],
            ['European-Architecture.jpg', 2, 'European Architecture ', true, 'ARC', 99.99],
            ['Fight-or-Flight.jpg', 1, 'Fight or Flight ', false, 'SF', 42.10],
            ['Flying-Without-Wings.jpg', 1, 'Flying Without Wings ', false, 'ROM', 21.99],
            ['Food-Journal.jpg', 2, 'Food Journal ', false, 'COOK', 45.99],
            ['Get-Your-Act-Together.jpg', 4, 'Get Your Act Together ', false, 'SFL', 5.99],
            ['Guide-to-Architecture.jpg', 3, 'Guide to Architecture ', false, 'ARC', 76.99],
            ['Hara-Juku.jpg', 1, 'Hara Juku ', false, 'DES', 31.11],
            ['History-of-the-Future.jpg', 2, 'History of the Future ', false, 'DES', 43.00],
            ['Home-in-a-Hundred-Countries.jpg', 1, 'Home in a Hundred Countries ', false, 'PHOTO', 78.99],
            [null, 1, 'Uncovered Story', false, 'PHOTO', 18.60],
            ['Its-a-Millenial-Thing.jpg', 1, 'Its a Millenial Thing', false, 'ROM', 28.21],
            ['Mind-Blown-Unleashing-Creativity.jpg', 2, 'Mind Blown Unleashing Creativity ', false, 'DES', 10.00],
            ['Modern-Architecture.jpg', 1, 'Modern Architecture ', false, 'ARC', 60.00],
            ['Modern-High-Rise.jpg', 3, 'Modern High Rise ', false, 'ARC', 45.00],
            ['Modern-Spaces.jpg', 1, 'Modern Spaces ', false, 'ARC', 44.00],
            ['My-Spiritual-Journey.jpg', 1, 'My Spiritual Journey ', false, 'SFL', 16.99],
            ['Our-Every-Step-a-Different-State.jpg', 2, 'Our Every Step a Different State ', false, 'ROM', 9.88],
            ['Photographic-Journey-of-Vietnam.jpg', 1, 'Photographic Journey of Vietnam ', false, 'PHOTO', 45.80],
            ['Return-to-Earth-One.jpg', 4, 'Return to Earth One ', false, 'SF', 34.99],
            ['Sendind-Some-Love.jpg', 0, 'Sending Some Love ', true, 'ROM', 24.55],
            ['Shooting-Portraits-in-Black-and-White.jpg', 1, 'Shooting Portraits in Black and White ', false, 'PHOTO', 98.00],
            ['Slowly-Falling-for-the-School-Bully.jpg', 1, 'Slowly Falling for the School Bully ', false, 'ROM', 12.30],
            ['Swap.jpg', 1, 'Swap ', false, 'DES', 4.99],
            ['The-Beasts-of-the-Black-Hole.jpg', 1, 'The Beasts of the Black Hole ', false, 'SC', 23.78],
            ['The-Girls-Playground.jpg', 1, 'The Girls Playground ', false, 'ROM', 9.77],
            ['The-History-of-Beaux-Arts-Architecture.jpg', 1, 'The History of Beaux Arts Architecture ', false, 'ARC', 68.11],
            ['The-New-Architecture-Modern-Designs.jpg', 2, 'The New Architecture Modern Designs ', false, 'ARC', 110.50],
            ['The-Poetry-of-Architecture.jpg', 1, 'The Poetry of Architecture ', false, 'ARC', 129.99],
            ['The-Red-Planet.jpg', 9, 'The Red Planet ', false, 'SF', 14.99],
            ['The-Sound-of-Sleeping-Planets.jpg', 2, 'The Sound of Sleeping Planets ', false, 'SF', 14.99],
            ['The-Stroke-Academy.jpg', 1, 'The Stroke Academy ', false, 'DES', 13.99],
            ['The-Way-We-Get-By.jpg', 1, 'The Way We Get By ', false, 'ROM', 11.99],
            ['The-World-of-Abstract-Art.jpg', 1, 'The World of Abstract Art ', false, 'DES', 99.99],
            ['Thirteen-Reasons-to-Forget-You.jpg', 3, 'Thirteen Reasons to Forget You ', false, 'ROM', 9.10],
            ['Through-the-Lens.jpg', 11, 'Through the Lens ', false, 'PHOTO', 89.67],
            ['Typography-for-Kids.jpg', 0, 'Typography for Kids ', false, 'DES', 65.50],
            ['When-the-Stars-Align.jpg', 1, 'When the Stars Align ', false, 'SF', 35.80],
            ['Where-is-Cecilia.jpg', 1, 'Where is Cecilia', false, 'ROM', 12.99],
            [null, 2, 'Brave Little Heart', false, 'ROM', 11.99],
            [null, 1, 'Brave Little Kid', false, 'ROM', 11.99],
            [null, 1, 'Miss Spealing Everything', false, 'O', 9.99],
        ];
    }

    private $coverPath = 'public/capas';
    private $faker = null;
    private $contadorGlobal = 0;

    public function run()
    {
        $this->command->line("");
        $this->command->line("##################################################################################");
        $this->command->line("A criar Books");
        $this->command->line("##################################################################################");

        DB::table('books')->truncate();

        Storage::deleteDirectory($this->coverPath);
        Storage::makeDirectory($this->coverPath);
        $this->copiaImagemCapa('sem_capa.png', 'sem_capa.png');
        $this->faker = Factory::create('pt_PT');
        foreach (BooksSeeder::books() as $book) {
            $this->addBook($this->faker, $book);
        }
    }

    private function copiaImagemCapa($filename, $newFileName = null)
    {
        $targetDir = storage_path('app/' . $this->coverPath);

        if (!$newFileName) {
            $newFileName = Str::random(16) . ".jpg";
        }

        File::copy(database_path('seeders/cover_photos') . "/$filename", $targetDir . '/' . $newFileName);
        return $newFileName;
    }

    private function addBook(Generator $faker, $bookInfo)
    {
        $newFileName = null;
        if ($bookInfo[0]) {
            $newFileName = $this->copiaImagemCapa($bookInfo[0]);
        }
        $createdAt = Carbon::now()->subDays(600);

        $book = [
            'title' => $bookInfo[2],
            'description' => $faker->realText(200),
            'cover_img' => $newFileName,
            //'stock' => $bookInfo[1],
            'price' => $bookInfo[5],
            'genre' => $bookInfo[4],
            'created_at' => $createdAt,
            'updated_at' => $faker->dateTimeBetween($createdAt),
            'deleted_at' => $bookInfo[3] ? $this->faker->dateTimeBetween($createdAt) : null,
        ];

        $this->contadorGlobal++;
        DB::table('books')->insert($book);
        $this->command->info("Book criado {$this->contadorGlobal}: " . $book['title']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


class PurchasesSeeder extends Seeder
{
    private $contadorPurchases = 0;
    public function run()
    {
        $this->command->line("");
        $this->command->line("##################################################################################");
        $this->command->line("A criar purchases");
        $this->command->line("##################################################################################");

        DB::table('book_purchase')->truncate();
        DB::table('purchases')->truncate();

        $faker = Factory::create('pt_PT');

        $day = Carbon::now()->subDays(60);
        $day2 = Carbon::now()->subDays(5);
        for ($i = 0; $i < 58; $i++) {
            $day = $day->addDays(1);
            $totalDay = rand(2, 6);
            $this->command->info("A criar $totalDay purchases para o dia {$day->format('Y-m-d')}");
            for ($j = 0; $j < $totalDay; $j++) {
                $this->criarUmaPurchase($faker, $this->getRandomCustomer(), $day, $day >= $day2);
            }
        }
    }

    private function criarUmaPurchase(Generator $faker, $customer, $day, $latestDays)
    {
        $createdAt = $day->copy();
        $start = $faker->dateTimeBetween($createdAt->format('Y-m-d H:i:s'),  $createdAt->addDays(1)->format('Y-m-d H:i:s'));
        $d1 = (new Carbon($start->format(DATE_ISO8601)))->addMinutes(100);
        $d2 = (new Carbon($start->format(DATE_ISO8601)))->addMinutes(2800);

        $end = $faker->dateTimeBetween($d1->format('Y-m-d H:i:s'), $d2->format('Y-m-d H:i:s'));
        $d1 = (new Carbon($end->format(DATE_ISO8601)))->addMinutes(1);
        $d2 = (new Carbon($end->format(DATE_ISO8601)))->addMinutes(100);
        $updated_at = $faker->dateTimeBetween($d1->format('Y-m-d H:i:s'), $d2->format('Y-m-d H:i:s'));

        $now = now();
        $createdAt = $createdAt > $now ? $now : $createdAt;
        $start = $start > $now ? $now : $start;
        $end = $end > $now ? $now : $end;
        $updated_at = $updated_at > $now ? $now : $updated_at;

        $randomNumber = rand(1, 60);
        $estado = $latestDays && $randomNumber > 20 ? 'P' : 'D';
        $estado = $randomNumber < 4 ? 'C' : $estado;

        $purchase = [
            'customer_id' => $customer,
            'date' => $day->format('Y-m-d'),
            'total' => 0,
            'status' => $estado,
            'created_at' => $createdAt,
            'updated_at' => $updated_at
        ];
        $newIDPurchase = DB::table('purchases')->insertGetId($purchase);
        $totalBooks = Arr::random([1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 4, 4, 4, 5, 5, 6, 7, 8]);
        $arrayBooks = $this->getRandomBooks($totalBooks);
        $total = 0;
        $book_purchases = [];
        foreach ($arrayBooks as $book) {
            $qtd = Arr::random([1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 3, 3, 4, 5]);
            $unit_price = round($book->price, 2);
            $total += round($qtd * $unit_price, 2);
            $book_purchases[] = [
                'purchase_id' => $newIDPurchase,
                'book_id' => $book->id,
                'qty' => $qtd,
                'unit_price' => $unit_price
            ];
        }
        DB::table('book_purchase')->insert($book_purchases);
        DB::table('purchases')->where('id', $newIDPurchase)->update(['total' => $total]);
    }

    private function getRandomCustomer()
    {
        static $customers;
        $customers = $customers != null ? $customers : DB::table('users')->where('type', 'Customer')->pluck('id');
        return $customers->random();
    }

    private function getRandomBooks($totalBooks)
    {
        static $books;
        $books = $books != null ? $books : DB::table('books')->whereNull('deleted_at')->get();
        return $books->random($totalBooks);
    }
}

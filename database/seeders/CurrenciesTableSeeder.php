<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        Schema::disableForeignKeyConstraints();
        Currency::truncate();
        Schema::enableForeignKeyConstraints();
        
        //$faker = \Faker\Factory::create();
        
        // And now, let's create currencies in our database:
        Currency::create([ 'symbol' => 'EUR', 'quantity' => 1 ]);
        Currency::create([ 'symbol' => 'USD', 'quantity' => 1 ]);
        Currency::create([ 'symbol' => 'GBP', 'quantity' => 1 ]);


    }
}

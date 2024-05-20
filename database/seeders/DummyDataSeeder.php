<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::factory(10)->create();

        $users->each(function ($user) {
            $custmers = Customer::factory(5)->create([
                'user_id' => $user->id
            ]);

            $products = Product::factory(10)->create(['user_id' => $user->id]);

            Invoice::factory(4)->create([
                'user_id' => $user->id,
                'customer_id' => $custmers->pluck('id')->random()
            ])->each(function (Invoice $inv) use ($products) {
                $inv->products()->attach(
                    $products->shuffle()->take(3)->pluck('id'),
                    ['quantity' => 1, 'price' => rand(10, 100)]
                );
            });
        });
    }
}

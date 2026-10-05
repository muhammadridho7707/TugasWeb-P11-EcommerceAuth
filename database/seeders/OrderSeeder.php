<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        User::where('role', User::ROLE_USER)->each(function (User $user) use ($products) {
            $address = Address::create([
                'user_id'     => $user->id,
                'label'       => 'Rumah',
                'recipient'   => $user->name,
                'phone'       => '08' . fake()->numerify('##########'),
                'street'      => fake()->streetAddress(),
                'city'        => 'Medan',
                'province'    => 'Sumatera Utara',
                'postal_code' => fake()->numerify('20###'),
                'is_default'  => true,
            ]);

            // 2 order per user
            foreach (range(1, 2) as $i) {
                $order = Order::factory()->create([
                    'user_id'    => $user->id,
                    'address_id' => $address->id,
                ]);

                $total = 0;
                foreach ($products->random(rand(1, 4)) as $product) {
                    $qty = rand(1, 3);
                    $order->items()->create([
                        'product_id' => $product->id,
                        'quantity'   => $qty,
                        'price'      => $product->price,
                    ]);
                    $total += $qty * $product->price;
                }
                $order->update(['total' => $total]);
            }

            // 3 review per user
            foreach ($products->random(3) as $product) {
                Review::create([
                    'user_id'    => $user->id,
                    'product_id' => $product->id,
                    'rating'     => rand(3, 5),
                    'comment'    => fake()->sentence(10),
                ]);
            }
        });
    }
}
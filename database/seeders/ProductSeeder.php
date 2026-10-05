<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // kategori => [nama produk => harga (Rp)]  -> total 54 produk
        $catalog = [
            'Elektronik' => [
                'Samsung Galaxy A55 5G 256GB' => 6499000,
                'Xiaomi Redmi Note 13 Pro' => 4299000,
                'Apple AirPods Pro 2' => 3999000,
                'Logitech MX Master 3S Wireless Mouse' => 1499000,
                'Keychron K2 Mechanical Keyboard' => 1350000,
                'Anker PowerCore 20000mAh' => 599000,
                'JBL Flip 6 Bluetooth Speaker' => 1999000,
                'Xiaomi Smart Band 8' => 549000,
                'TP-Link Archer AX23 WiFi 6 Router' => 699000,
            ],
            'Fashion Pria' => [
                'Kaos Polos Cotton Combed 30s' => 89000,
                'Kemeja Flannel Lengan Panjang' => 199000,
                'Celana Chino Slim Fit' => 249000,
                'Jaket Bomber Waterproof' => 329000,
                'Hoodie Zipper Fleece' => 275000,
                'Celana Jeans Slim Straight' => 299000,
                'Sepatu Sneakers Canvas Pria' => 359000,
                'Jam Tangan Digital Casio F-91W' => 249000,
                'Topi Baseball Cap Polos' => 59000,
            ],
            'Fashion Wanita' => [
                'Blouse Satin Lengan Panjang' => 169000,
                'Dress Midi Floral' => 229000,
                'Rok Plisket Panjang' => 139000,
                'Cardigan Rajut Oversize' => 189000,
                'Hijab Pashmina Ceruty Premium' => 79000,
                'Tas Selempang Kulit Sintetis' => 259000,
                'Sepatu Flat Shoes Wanita' => 199000,
                'Celana Kulot Highwaist' => 159000,
                'Gamis Syari Polos' => 289000,
            ],
            'Rumah Tangga' => [
                'Rice Cooker Miyako 1.8L' => 449000,
                'Blender Philips HR2221' => 749000,
                'Air Fryer Digital 4L' => 799000,
                'Set Panci Stainless 5 Pcs' => 549000,
                'Dispenser Air Galon Bawah' => 1299000,
                'Setrika Uap Philips' => 399000,
                'Sprei Katun Jepang King Size' => 275000,
                'Lampu LED Philips 14W (4 Pack)' => 129000,
                'Vacuum Cleaner Handheld' => 599000,
            ],
            'Olahraga' => [
                'Matras Yoga TPE 6mm' => 129000,
                'Dumbbell Vinyl Set 10kg' => 249000,
                'Sepatu Lari Ortuseight Jogosurya' => 459000,
                'Bola Futsal Molten' => 349000,
                'Raket Badminton Yonex Astrox' => 1250000,
                'Jersey Sepeda Dry-Fit' => 189000,
                'Botol Minum Tumbler 1 Liter' => 99000,
                'Resistance Band Set 5 Level' => 89000,
                'Skipping Rope Speed' => 59000,
            ],
            'Buku & Alat Tulis' => [
                'Novel Laskar Pelangi' => 95000,
                'Atomic Habits (Edisi Indonesia)' => 108000,
                'Filosofi Teras' => 98000,
                'Clean Code - Robert C. Martin' => 450000,
                'Notebook Hardcover A5 Dotted' => 59000,
                'Pulpen Gel Pilot G2 0.5 (12 pcs)' => 135000,
                'Highlighter Stabilo Boss Set 6 Warna' => 69000,
                'Pemrograman Web dengan Laravel' => 125000,
                'Pensil Mekanik Rotring 600' => 389000,
            ],
        ];

        foreach ($catalog as $categoryName => $products) {
            $category = Category::create([
                'name'        => $categoryName,
                'slug'        => Str::slug($categoryName),
                'description' => "Koleksi produk {$categoryName} pilihan.",
            ]);

            foreach ($products as $name => $price) {
                Product::factory()->create([
                    'category_id' => $category->id,
                    'name'        => $name,
                    'slug'        => Str::slug($name),
                    'price'       => $price,
                ]);
            }
        }
    }
}
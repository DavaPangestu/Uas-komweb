<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                "name" => "Caramel Latte",
                "description" => "Caramel, Americano, England Milk, (kopi mahasiswa)",
                "price" => 12000,
                "image" => "gambarKopiGaota.jpg",
                "best_seller" => true,
                "category" => "Coffee",
            ],
            [
                "name" => "Butterscotch Coffee",
                "description" => "Double shots espresso dari Crema Espresso, Dripp Butterscotch Syrup, Dripp Caramel Syrup",
                "price" => 50000,
                "image" => "butterscouthkopii.jpg",
                "best_seller" => true,
                "category" => "Coffee",
            ],
            [
                "name" => "Avocado Frappe",
                "description" => "Avocado, milk or non-dairy milk, sweetener, and ice",
                "price" => 45000,
                "image" => "gambarAvocadoFreeze.jpg",
                "best_seller" => true,
                "category" => "Frappe",
            ],
            [
                "name" => "Cookies And Cream",
                "description" => "Milkshake are milk, Ice cream, and Oreos",
                "price" => 35000,
                "image" => "gambarCookiesAndCreamMilkshake.jpeg",
                "best_seller" => true,
                "category" => "Frappe",
            ],
            [
                "name" => "Nutella Blast",
                "description" => "Nutella Ganache, Chocolate Topping, Milk",
                "price" => 54000,
                "image" => "nuttelaMinum.jpg",
                "best_seller" => true,
                "category" => "Non Coffee",
            ],
            [
                "name" => "Taro Cookies",
                "description" => "Milk, Ice, and Taro",
                "price" => 41000,
                "image" => "TaroMIlkshake.png",
                "best_seller" => false,
                "category" => "Non Coffee",
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
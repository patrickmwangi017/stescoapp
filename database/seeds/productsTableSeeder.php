<?php

use Illuminate\Database\Seeder;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product =new\App\Product([
            'Picture'=>'C:\xampp\htdocs\shoppingcart\images\1.png',
            'productName'=>'first product',
            'Description'=>'the very best of them',
            'Price'=>20,
            'quantity_available'=>299
        ]);
        $product->save();
    }
}

<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    protected $products = [[
            'title' => 'Americano',
            'description' => 'Coffee prepared by adding hot water to espresso, giving a similar strength to but different flavor from brewed coffee' 
        ],[
            'title' => 'Ristretto',
            'description' => 'Short shot of espresso made with the normal amount of ground coffee but extracted with about half the amount of water'
        ],[
            'title' => 'Latte',
            'description' => 'An espresso and steamed milk, generally in a 1:3 to 1:5 ratio of espresso to milk, with a little foam on top'     
        ],[
            'title' => 'Cappuccino',
            'description' => 'Coffee-based drink prepared with espresso, hot milk, and steamed milk foam.'
        ],[
            'title' => 'Moka',
            'description' => 'Coffee brewed with a moka pot, a stovetop coffee maker which produces coffee by passing hot water pressurized by steam through ground coffee at a lower pressure than an espresso maker'
        ],[
            'title' => 'Turkish coffee',
            'description' => 'Preparation consists of immersing the coffee grounds in water and heating until it just boils'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->products as $product) {
            factory(App\Product::class)->create($product);
        }
    }
}

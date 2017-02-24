<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    protected $products = [[
            'title' => 'Espesso',
            'description' => 'Coffee brewed by forcing a small amount of nearly boiling water under pressure through finely ground coffee beans',
            'image' => '/image/espresso.png'
        ],[
            'title' => 'Ristretto',
            'description' => 'Short shot of espresso made with the normal amount of ground coffee but extracted with about half the amount of water',
            'image' => '/image/ristretto.png'
        ],[
            'title' => 'Americano',
            'description' => 'Coffee prepared by adding hot water to espresso, giving a similar strength to but different flavor from brewed coffee',
            'image' => '/image/americano.png'
        ],[
            'title' => 'Macchiato',
            'description' => 'An espresso coffee drink with a small amount of milk, usually foamed',
            'image' => '/image/macchiato.png'
        ],[
            'title' => 'Latte',
            'description' => 'An espresso and steamed milk, generally in a 1:3 to 1:5 ratio of espresso to milk, with a little foam on top',
            'image' => '/image/latte.png'
        ],[
            'title' => 'Cappuccino',
            'description' => 'Coffee-based drink prepared with espresso, hot milk, and steamed milk foam.',
            'image' => '/image/cappuccino.png'
        ],[
            'title' => 'Mocha',
            'description' => 'Based on espresso and hot milk, but with added chocolate, typically in the form of sweet cocoa powder, although many varieties use chocolate syrup',
            'image' => '/image/mocha.png'
        ],[
            'title' => 'Turkish coffee',
            'description' => 'Preparation consists of immersing the coffee grounds in water and heating until it just boils',
            'image' => '/image/turkish_coffee.png'
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

<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            [
                'name'       => 'Tribun Timur',
                'color'      => 'Persib vs Persija',
                'price'      => 75000,
                'stock'      => 10,
                'created_at' => '2016-10-12 12:00:00',
                'updated_at' => '2016-10-12 12:00:00'
            ];

        DB::table('products')->insert($data);
    }
}

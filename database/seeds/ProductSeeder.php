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
                'name'       => 'kissproof seri 1',
                'color'      => 'merah',
                'price'      => 25000,
                'stock'      => 0,
                'created_at' => '2016-10-12 12:00:00',
                'updated_at' => '2016-10-12 12:00:00'
            ];

        DB::table('products')->insert($data);
    }
}

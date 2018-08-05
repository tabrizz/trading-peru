<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            'name' => 'Lays STAX',
            'description' => '163gr x 17',
            'stock' => 0,
        ]);
        DB::table('products')->insert([
            'name' => 'Lays Clásica',
            'description' => '180gr x 13',
            'stock' => 0,
        ]);
        DB::table('products')->insert([
            'name' => 'Piqueo Snax',
            'description' => '225gr x 10',
            'stock' => 0,
        ]);
        DB::table('products')->insert([
            'name' => 'Doritos QA',
            'description' => '200gr x 18',
            'stock' => 0,
        ]);
        DB::table('products')->insert([
            'name' => 'Chizitos Fiesta',
            'description' => '200gr x 8',
            'stock' => 0,
        ]);
        DB::table('products')->insert([
            'name' => 'Lays AL HILO',
            'description' => '155gr x 12',
            'stock' => 0,
        ]);
        DB::table('products')->insert([
            'name' => 'Lays STAX',
            'description' => '40gr x 14',
            'stock' => 0,
        ]);
    }
}

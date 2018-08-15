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
            'price' => 6.70
        ]);
        DB::table('products')->insert([
            'name' => 'Lays Clásica',
            'description' => '180gr x 13',
            'stock' => 0,
            'price' => 5.80
        ]);
        DB::table('products')->insert([
            'name' => 'Piqueo Snax',
            'description' => '225gr x 10',
            'stock' => 0,
            'price' => 5.80
        ]);
        DB::table('products')->insert([
            'name' => 'Doritos QA',
            'description' => '200gr x 18',
            'stock' => 0,
            'price' => 5.80
        ]);
        DB::table('products')->insert([
            'name' => 'Chizitos Fiesta',
            'description' => '200gr x 8',
            'stock' => 0,
            'price' => 4.20
        ]);
        DB::table('products')->insert([
            'name' => 'Lays AL HILO',
            'description' => '155gr x 12',
            'stock' => 0,
            'price' => 3.50
        ]);
        DB::table('products')->insert([
            'name' => 'Lays STAX',
            'description' => '40gr x 14',
            'stock' => 0,
            'price' => 2.90
        ]);
        DB::table('products')->insert([
            'name' => 'Lays Clásica',
            'description' => '76gr x 32',
            'stock' => 0,
            'price' => 2.50
        ]);
        DB::table('products')->insert([
            'name' => 'Piqueo SNAX',
            'description' => '93gr x 20',
            'stock' => 0,
            'price' => 2.50
        ]);
        DB::table('products')->insert([
            'name' => 'Doritos Q/A',
            'description' => '85gr x 48',
            'stock' => 0,
            'price' => 2.50
        ]);
        DB::table('products')->insert([
            'name' => 'Camote',
            'description' => '90gr x 32',
            'stock' => 0,
            'price' => 2.50
        ]);
        DB::table('products')->insert([
            'name' => 'Chicharrón',
            'description' => '43gr x 60',
            'stock' => 0,
            'price' => 2.50
        ]);
        DB::table('products')->insert([
            'name' => 'Cheetos',
            'description' => '74gr x 32',
            'stock' => 0,
            'price' => 2.50
        ]);
        DB::table('products')->insert([
            'name' => 'Lays al Hilo',
            'description' => '42gr x 92',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Piqueo SNAX PICANTE',
            'description' => '51gr x 63',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Piqueo SNAX',
            'description' => '49gr x 63',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Piqueo Power Muslitos',
            'description' => '45gr x 66',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Piqueo Power Aros',
            'description' => '45gr x 66',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Doritos Ruleta',
            'description' => '45gr x 80',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Doritos Fuego',
            'description' => '45gr x 80',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Doritos Q/a',
            'description' => '163gr x 90',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Tortees Picante',
            'description' => '64gr x 63',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Tortees Natural',
            'description' => '64gr x 63',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Camote',
            'description' => '36gr x 60',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Chicharrón',
            'description' => '21gr x 96',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Tortees Picante',
            'description' => '64gr x 63',
            'stock' => 0,
            'price' => 1.00
        ]);
        DB::table('products')->insert([
            'name' => 'Lays Clásicas',
            'description' => '33gr x 66',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Lays Onda Picante',
            'description' => '36gr x 70',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Lays Onda Natural',
            'description' => '36gr x 70',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Lays Pollo a la Brasa',
            'description' => '30gr x 63',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Chizitos',
            'description' => '41gr x 48',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Cheetos Picante',
            'description' => '36gr x 48',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Cheetos Natural',
            'description' => '34gr x 54',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Cheetos Canchita',
            'description' => '38gr x 36',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Cheese Triss',
            'description' => '43gr x 96',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Galletas Chokis',
            'description' => '40gr x 96',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Galletas Quaker',
            'description' => '30gr x 96',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Galletas MAMUT',
            'description' => '13gr x 42',
            'stock' => 0,
            'price' => 14.0
        ]);
        DB::table('products')->insert([
            'name' => 'Lays Clásica',
            'description' => '19gr x 108',
            'stock' => 0,
            'price' => 0.583
        ]);
        DB::table('products')->insert([
            'name' => 'Piqueo SNAX',
            'description' => '24gr x 108',
            'stock' => 0,
            'price' => 0.583
        ]);
        DB::table('products')->insert([
            'name' => 'Doritos Q/A',
            'description' => '25gr x 108',
            'stock' => 0,
            'price' => 0.583
        ]);
        DB::table('products')->insert([
            'name' => 'Tortees Picante',
            'description' => '30gr x 144',
            'stock' => 0,
            'price' => 0.583
        ]);
        DB::table('products')->insert([
            'name' => 'Tortees Natural',
            'description' => '30gr x 144',
            'stock' => 0,
            'price' => 0.583
        ]);
        DB::table('products')->insert([
            'name' => 'Chizitos',
            'description' => '16gr x 98',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Cheetos Picante',
            'description' => '15gr x 140',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Cheetos Natural',
            'description' => '15gr x 140',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Cheetos Canchita',
            'description' => '17gr x 80',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Cheese Triss',
            'description' => '72gr x 55',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Picante',
            'description' => '100gr x 42',
            'stock' => 0,
            'price' => 2.00
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Salado',
            'description' => '100gr x 42',
            'stock' => 0,
            'price' => 2.00
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Clásico',
            'description' => '100gr x 42',
            'stock' => 0,
            'price' => 2.00
        ]);
        DB::table('products')->insert([
            'name' => 'Habas',
            'description' => '100gr x 42',
            'stock' => 0,
            'price' => 2.00
        ]);
        DB::table('products')->insert([
            'name' => 'Maní con Pasas',
            'description' => '39gr x 48',
            'stock' => 0,
            'price' => 1.25
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Picante',
            'description' => '39gr x 48',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Salado',
            'description' => '39gr x 48',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Clásico',
            'description' => '39gr x 48',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Confitado',
            'description' => '39gr x 48',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Habas',
            'description' => '39gr x 72',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Chifles',
            'description' => '42gr x 144',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Cuates Picante',
            'description' => '75gr x 54',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Rancheritos',
            'description' => '75gr x 54',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Cuates Natural',
            'description' => '75gr x 54',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Cuates Twist',
            'description' => '72gr x 54',
            'stock' => 0,
            'price' => 0.833
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Picante',
            'description' => '20gr x 192',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Salado',
            'description' => '20gr x 192',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Maní Clásico',
            'description' => '20gr x 192',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Habas',
            'description' => '18gr x 168',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Chifles',
            'description' => '19gr x 288',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Cuates Picante',
            'description' => '33gr x 144',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Rancheritos',
            'description' => '33gr x 96',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Cuates Natural',
            'description' => '33gr x 144',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Cuates Twist',
            'description' => '32gr x 108',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Free Papas Picantes',
            'description' => '16gr x 144',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Free Papas Mayonesa',
            'description' => '15gr x 108',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Chizitos Picante',
            'description' => '18gr x 98',
            'stock' => 0,
            'price' => 0.417
        ]);
        DB::table('products')->insert([
            'name' => 'Cheese Triss Picante',
            'description' => '16gr x 182',
            'stock' => 0,
            'price' => 0.417
        ]);
    }
}

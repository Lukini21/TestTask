<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!DB::table('products')->count()) {
            $insertData = [];

            if (($handle = fopen(public_path('property-data.csv'), "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $insertData[] = [
                        'name' => $data[0],
                        'price' => $data[1],
                        'bedrooms' => $data[2],
                        'bathrooms' => $data[3],
                        'storeys' => $data[4],
                        'garages' => $data[5]
                    ];
                }
                fclose($handle);
            }
            unset($insertData[0]);

            DB::table('products')->insert($insertData);
        }
    }
}

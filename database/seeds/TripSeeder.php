<?php

use App\Models\Trip;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trips = [
            [
                'id'    => 1,
                'name_ar' => 'رحلة اسوان', 
                'name_en' => 'Aswan Trip',
                'description_ar' => 'رحلة ترفيهية لزيارة الأماكن السياحية في أسوان',
                'description_en' => 'A Trip For Visiting Places in Aswan',
                'price' => '500',
                'currency_type' => 'EGP',
                'guide_id' => 1,
                'car' => '1', 
            ], 
            [
                'id'    => 2,
                'name_ar' => 'رحلة الأقصر', 
                'name_en' => 'Auxor Trip',
                'description_ar' => 'رحلة ترفيهية لزيارة الأماكن السياحية في الأقصر',
                'description_en' => 'A Trip For Visiting Places in Auxor',
                'price' => '600',
                'currency_type' => 'EGP',
                'guide_id' => 1,
                'car' => '1', 
            ], 
            [
                'id'    => 3,
                'name_ar' => 'رحلة الأسكندرية', 
                'name_en' => 'Alex Trip',
                'description_ar' => 'رحلة ترفيهية لزيارة الأماكن السياحية في الأسكندرية',
                'description_en' => 'A Trip For Visiting Places in Alex',
                'price' => '300',
                'currency_type' => 'EGP',
                'guide_id' => 1,
                'car' => '1', 
            ], 
        ];

        Trip::insert($trips);
    }
}

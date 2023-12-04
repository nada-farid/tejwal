<?php

use App\Models\TripCategory;
use Illuminate\Database\Seeder;

class TripCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tripcategories = [
            [
                'id'    => 1,
                'name_ar' => 'رحلات بحرية',
                'name_en' => 'Sea Trips',
            ],
            [
                'id'    => 2,
                'name_ar' => 'رحلات ترفيهية',
                'name_en' => 'Fun Trips',
            ],
            [
                'id'    => 3,
                'name_ar' => 'رحلات علاجية',
                'name_en' => 'Treatment Trips',
            ],
            [
                'id'    => 4,
                'name_ar' => 'رحلات الثقافية',
                'name_en' => 'Cultural Trips',
            ],
            [
                'id'    => 5,
                'name_ar' => 'الرحلات الشاطئية',
                'name_en' => 'Beach Trips',
            ],
            [
                'id'    => 6,
                'name_ar' => 'رحلات المغامرات',
                'name_en' => 'Adventures Trips',
            ],
            [
                'id'    => 7,
                'name_ar' => 'رحلات الأعمال',
                'name_en' => 'Business Trips',
            ],
            [
                'id'    => 8,
                'name_ar' => 'رحلات التخييم',
                'name_en' => 'Camping Trips',
            ],
            [
                'id'    => 9,
                'name_ar' => 'رحلات زراعية',
                'name_en' => 'Agricultural Trips',
            ],
        ];

        TripCategory::insert($tripcategories);
    }
}

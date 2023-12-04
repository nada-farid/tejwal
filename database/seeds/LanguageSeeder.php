<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $languages = [
            [
                'id'    => 1,
                'name_ar' => 'العربيه',
                'name_en' => 'Arabic',
            ],
            [
                'id'    => 2,
                'name_ar' => 'الأنجليزية',
                'name_en' => 'English',
            ],
            [
                'id'    => 3,
                'name_ar' => 'الفرنسية',
                'name_en' => 'French',
            ],
        ];

        Language::insert($languages);
    }
}

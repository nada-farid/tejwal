<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;
        $country_id = 188;
        $cities = [
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'ابها',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'ابو عريش',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'مكة المكرمة',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الدمام',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الدوادمي',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الدلم',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الدرعية',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'عفيف',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'احد المسارحة',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'احد رفيده',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'البكيرية'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الغاط'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الخبراء'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الخفجي'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'حائل'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الحريق'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الخرج'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الخبر'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الهفوف'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الخرمة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الجبيل'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الجموم'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'ليلى'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'مدينة الملك عبد الله الاقتصادية'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'المجاردة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'المجمعة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'المذنب'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'المزاحمية'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'القطيف'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'القنفذة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'القريات'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'القويعية'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الوجه'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'عنك'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'النعيرية'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'عرعر'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الرس'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'السليل'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الطائف'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الظهران'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الزلفي'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'بدر'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'بيشة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'بقيق'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'بريدة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'ضبا'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'حفر البطن'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'خميس مشيط'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'حوطه بنى تميم'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'خيبر'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'جدة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'محايل'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'رابغ'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'رفحاء'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'صفوى'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'سكاكا'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'صامطة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'شقراء'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'شروره'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'سيهات'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الشنان'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'ثادق'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'قريه العليا'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'صبيا'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'صفوى',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'سكاكا',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'صامطة',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'شقراء',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'شروره',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'سيهات',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الشنان',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'ثادق',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'بللسمر',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'راس تنورة',
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'تاروت'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'تثليث'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'تربه'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'طريف'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'ثول'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'عنيزة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الشماسية'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'ينبع'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الباحة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'المدينة المنورة'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'جازان'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'نجران'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الرياض'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'تبوك'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'الجندل'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'أملج'
            ],
            [
                'id' => $i++,
                'country_id' => $country_id,
                'name' => 'البدائع'
            ],
        ];
        City::insert($cities);
    }
}

<?php

use App\Models\Guide;
use App\Models\User;
use Illuminate\Database\Seeder;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ahmed',
            'last_name' => 'Mohamed',
            'email' => 'ahmed@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '01011122233',
            'country_id' => 63,
            'city' => 'Aswan',
            'dob' => '01/01/1990',
            'gender' => 'male',
            'naitev_language_id' => 1,
            'user_type' => 'guide',
            'approved' => 1,
        ]);

        Guide::create([
            'brief_intro' => 'Iam ready to guide you',
            'driving_licence' => '1',
            'car' => '1',
            'degree' => 'graduate',
            'major' => 'سياحة وفنادق',
            'user_id' => $user->id,
            'cost' => '50', 
            'organization_id' => 1,
        ]);
    }
}

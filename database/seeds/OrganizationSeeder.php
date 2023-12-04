<?php

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ali',
            'last_name' => 'Mohamed',
            'email' => 'ali@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '01011122233',
            'country_id' => 63,
            'city' => 'Alex',
            'dob' => '01/01/1990',
            'gender' => 'male',
            'naitev_language_id' => 1,
            'user_type' => 'organization',
            'approved' => 1,
        ]);

        
        $organization = Organization::create([ 
            'user_id' => $user->id,
            'organization_name' => 'SKu',
            'commerical_record' => '2314124',
            'activites' => 'activites',
            'website' => 'website',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            CountriesTableSeeder::class,
            CitySeeder::class,
            LanguageSeeder::class,
            OrganizationSeeder::class,
            GuideSeeder::class,
            TripCategorySeeder::class,
            TripSeeder::class,
        ]);
    }
}

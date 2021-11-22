<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'general_seeting_access',
            ],
            [
                'id'    => 20,
                'title' => 'language_create',
            ],
            [
                'id'    => 21,
                'title' => 'language_edit',
            ],
            [
                'id'    => 22,
                'title' => 'language_show',
            ],
            [
                'id'    => 23,
                'title' => 'language_delete',
            ],
            [
                'id'    => 24,
                'title' => 'language_access',
            ],
            [
                'id'    => 25,
                'title' => 'guide_create',
            ],
            [
                'id'    => 26,
                'title' => 'guide_edit',
            ],
            [
                'id'    => 27,
                'title' => 'guide_show',
            ],
            [
                'id'    => 28,
                'title' => 'guide_delete',
            ],
            [
                'id'    => 29,
                'title' => 'guide_access',
            ],
            [
                'id'    => 30,
                'title' => 'experience_create',
            ],
            [
                'id'    => 31,
                'title' => 'experience_edit',
            ],
            [
                'id'    => 32,
                'title' => 'experience_show',
            ],
            [
                'id'    => 33,
                'title' => 'experience_delete',
            ],
            [
                'id'    => 34,
                'title' => 'experience_access',
            ],
            [
                'id'    => 35,
                'title' => 'following_create',
            ],
            [
                'id'    => 36,
                'title' => 'following_edit',
            ],
            [
                'id'    => 37,
                'title' => 'following_show',
            ],
            [
                'id'    => 38,
                'title' => 'following_delete',
            ],
            [
                'id'    => 39,
                'title' => 'following_access',
            ],
            [
                'id'    => 40,
                'title' => 'ratting_create',
            ],
            [
                'id'    => 41,
                'title' => 'ratting_edit',
            ],
            [
                'id'    => 42,
                'title' => 'ratting_show',
            ],
            [
                'id'    => 43,
                'title' => 'ratting_delete',
            ],
            [
                'id'    => 44,
                'title' => 'ratting_access',
            ],
            [
                'id'    => 45,
                'title' => 'trip_category_create',
            ],
            [
                'id'    => 46,
                'title' => 'trip_category_edit',
            ],
            [
                'id'    => 47,
                'title' => 'trip_category_show',
            ],
            [
                'id'    => 48,
                'title' => 'trip_category_delete',
            ],
            [
                'id'    => 49,
                'title' => 'trip_category_access',
            ],
            [
                'id'    => 50,
                'title' => 'trip_create',
            ],
            [
                'id'    => 51,
                'title' => 'trip_edit',
            ],
            [
                'id'    => 52,
                'title' => 'trip_show',
            ],
            [
                'id'    => 53,
                'title' => 'trip_delete',
            ],
            [
                'id'    => 54,
                'title' => 'trip_access',
            ],
            [
                'id'    => 55,
                'title' => 'post_create',
            ],
            [
                'id'    => 56,
                'title' => 'post_edit',
            ],
            [
                'id'    => 57,
                'title' => 'post_show',
            ],
            [
                'id'    => 58,
                'title' => 'post_delete',
            ],
            [
                'id'    => 59,
                'title' => 'post_access',
            ],
            [
                'id'    => 60,
                'title' => 'booking_create',
            ],
            [
                'id'    => 61,
                'title' => 'booking_edit',
            ],
            [
                'id'    => 62,
                'title' => 'booking_show',
            ],
            [
                'id'    => 63,
                'title' => 'booking_delete',
            ],
            [
                'id'    => 64,
                'title' => 'booking_access',
            ],
            [
                'id'    => 65,
                'title' => 'favorite_create',
            ],
            [
                'id'    => 66,
                'title' => 'favorite_edit',
            ],
            [
                'id'    => 67,
                'title' => 'favorite_show',
            ],
            [
                'id'    => 68,
                'title' => 'favorite_delete',
            ],
            [
                'id'    => 69,
                'title' => 'favorite_access',
            ],
            [
                'id'    => 70,
                'title' => 'tourist_create',
            ],
            [
                'id'    => 71,
                'title' => 'tourist_edit',
            ],
            [
                'id'    => 72,
                'title' => 'tourist_show',
            ],
            [
                'id'    => 73,
                'title' => 'tourist_delete',
            ],
            [
                'id'    => 74,
                'title' => 'tourist_access',
            ],
            [
                'id'    => 75,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 76,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 77,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 78,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 79,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}

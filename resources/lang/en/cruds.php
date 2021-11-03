<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'First Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'phone'                    => 'Phone',
            'phone_helper'             => ' ',
            'last_name'                => 'Last Name',
            'last_name_helper'         => ' ',
            'country'                  => 'Country',
            'country_helper'           => ' ',
            'city'                     => 'City',
            'city_helper'              => ' ',
            'dob'                      => 'Dob',
            'dob_helper'               => ' ',
            'gender'                   => 'Gender',
            'gender_helper'            => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
            'naitev_language'          => 'Naitev Language',
            'naitev_language_helper'   => ' ',
            'speaking_language'        => 'Speaking Language',
            'speaking_language_helper' => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'generalSeeting' => [
        'title'          => 'General Seeting',
        'title_singular' => 'General Seeting',
    ],
    'language' => [
        'title'          => 'Language',
        'title_singular' => 'Language',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'Name Ar',
            'name_ar_helper'    => ' ',
            'name_en'           => 'Name En',
            'name_en_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'icon'              => 'Icon',
            'icon_helper'       => ' ',
        ],
    ],
    'guide' => [
        'title'          => 'Guide',
        'title_singular' => 'Guide',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'brief_intro'            => 'Brief Intro',
            'brief_intro_helper'     => ' ',
            'driving_licence'        => 'Driving Licence',
            'driving_licence_helper' => ' ',
            'car'                    => 'Car',
            'car_helper'             => ' ',
            'degree'                 => 'Degree',
            'degree_helper'          => ' ',
            'major'                  => 'Major',
            'major_helper'           => ' ',
            'user'                   => 'User',
            'user_helper'            => ' ',
            'cost'                   => 'Cost',
            'cost_helper'            => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'experience' => [
        'title'          => 'Experience',
        'title_singular' => 'Experience',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'city'                       => 'City',
            'city_helper'                => ' ',
            'years_of_experience'        => 'Years Of Experience',
            'years_of_experience_helper' => ' ',
            'guide'                      => 'Guide',
            'guide_helper'               => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'following' => [
        'title'          => 'Following',
        'title_singular' => 'Following',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'guide'             => 'Guide',
            'guide_helper'      => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'ratting' => [
        'title'          => 'Ratting',
        'title_singular' => 'Ratting',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'rate'              => 'Rate',
            'rate_helper'       => ' ',
            'guide'             => 'Guide',
            'guide_helper'      => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'tripCategory' => [
        'title'          => 'Trip Category',
        'title_singular' => 'Trip Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'Name Ar',
            'name_ar_helper'    => ' ',
            'name_en'           => 'Name En',
            'name_en_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'trip' => [
        'title'          => 'Trips',
        'title_singular' => 'Trip',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'price'                => 'Price',
            'price_helper'         => ' ',
            'photo'                => 'Photo',
            'photo_helper'         => ' ',
            'guide'                => 'Guide',
            'guide_helper'         => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'trip_category'        => 'Trip Category',
            'trip_category_helper' => ' ',
        ],
    ],
    'post' => [
        'title'          => 'Posts',
        'title_singular' => 'Post',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'booking' => [
        'title'          => 'Booking',
        'title_singular' => 'Booking',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'start_time'        => 'Start Time',
            'start_time_helper' => ' ',
            'end_time'          => 'End Time',
            'end_time_helper'   => ' ',
            'companions'        => 'Companions',
            'companions_helper' => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'trip'              => 'Trip',
            'trip_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'favorite' => [
        'title'          => 'Favorite',
        'title_singular' => 'Favorite',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'trip'              => 'Trip',
            'trip_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'tourist' => [
        'title'          => 'Tourist',
        'title_singular' => 'Tourist',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];

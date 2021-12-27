<?php

return [
    'userManagement' => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission' => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
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
        'title'          => 'المجموعات',
        'title_singular' => 'مجموعة',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'الصلاحيات',
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
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'الأسم الأول',
            'name_helper'              => ' ',
            'email'                    => 'البريد الإلكتروني',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'كلمة المرور',
            'password_helper'          => ' ',
            'roles'                    => 'الأدوار',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'phone'                    => 'رقم الهاتف',
            'phone_helper'             => ' ',
            'last_name'                => 'الأسم الأخير ',
            'last_name_helper'         => ' ',
            'country'                  => 'البلد',
            'country_helper'           => ' ',
            'city'                     => 'المدينه',
            'city_helper'              => ' ',
            'dob'                      => 'تاريخ الميلاد',
            'dob_helper'               => ' ',
            'gender'                   => 'الجنس',
            'gender_helper'            => ' ',
            'photo'                    => 'الصورة الشخصيه',
            'photo_helper'             => ' ',
            'naitev_language'          => 'اللغة الأم ',
            'naitev_language_helper'   => ' ',
            'speaking_language'        => 'لغات التحدث ',
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
        'title'          => 'الأعدادات عامة',
        'title_singular' => ' اعدادات عامة ',
    ],
    'language' => [
        'title'          => 'اللغات',
        'title_singular' => 'اللغة',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => ' الأسم باللغة العربية',
            'name_ar_helper'    => ' ',
            'name_en'           => ' الأسم باللغة الأنجليزية',
            'name_en_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'icon'              => 'رمز اللغة',
            'icon_helper'       => ' ',
        ],
    ],
    'guide' => [
        'title'          => 'المرشد السياحي',
        'title_singular' => 'المرشد السياحي',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'brief_intro'            => 'نبذة تعريفية ',
            'brief_intro_helper'     => ' ',
            'driving_licence'        => 'رخصة قيادة ',
            'driving_licence_helper' => ' ',
            'car'                    => 'سيارة',
            'car_helper'             => ' ',
            'degree'                 => ' الدرجة العلمية',
            'degree_helper'          => ' ',
            'major'                  => 'التخصص',
            'major_helper'           => ' ',
            'user'                   => ' المستخدم',
            'user_helper'            => ' ',
            'cost'                   => 'التكلفة',
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
        'title'          => 'الخبرة العملية',
        'title_singular' => 'خبرة العملية',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'city'                       => 'المدينة',
            'city_helper'                => ' ',
            'years_of_experience'        => 'سنوات الخبرة ',
            'years_of_experience_helper' => ' ',
            'guide'                      => 'المرشد السياحي',
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
        'title'          => 'المتابعة',
        'title_singular' => 'متابعة',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'guide'             => 'المرشد السياحي',
            'guide_helper'      => ' ',
            'user'              => ' المستخدم',
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
        'title'          => 'التقييم',
        'title_singular' => 'تقييم',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'rate'              => 'التقييم',
            'rate_helper'       => ' ',
            'guide'             => 'المرشد السياحي',
            'guide_helper'      => ' ',
            'user'              => 'السائح',
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
        'title'          => 'فئة الرحلة ',
        'title_singular' => ' فئة الرحلة ',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => ' الأسم باللغة العربيه',
            'name_ar_helper'    => ' ',
            'name_en'           =>  ' الأسم باللغة الأنجليزية',
            'name_en_helper'    => ' ',
            'icon'           => 'الأيقونة',
            'icon_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'trip' => [
        'title'          => 'الرحلات',
        'title_singular' => 'الرحلة',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'description'          => 'وصف الرحلة',
            'description_helper'   => ' ',
            'price'                => 'سعر الرحلة',
            'price_helper'         => ' ',
            'photo'                => 'صور الأماكن السياحية',
            'photo_helper'         => ' ',
            'guide'                => 'المرشد السياحي',
            'guide_helper'         => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'trip_category'        => 'فئة الرحلة ',
            'trip_category_helper' => ' ',
            'car'                  => 'السيارة',
            'car_helper'           => ' ',
        ],
    ],
    'post' => [
        'title'          => 'المنشورات',
        'title_singular' => 'المنشور',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'price'             => 'سعر الرحلة',
            'price_helper'      => ' ',
            'user'              => 'السائح',
            'user_helper'       => ' ',
            'start_date'              => ' تاريخ البدء',
            'start_date_helper'       => ' ',
            'end_date'              => ' تاريخ الأنتهاء',
            'end_date_helper'       => ' ',
            'description'              => 'وصف الرحلة',
            'description_helper'       => ' ',
            'lang'              => ' لغة المرشد',
            'lang_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'booking' => [
        'title'          => 'الحجوزات',
        'title_singular' => 'الحجز',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'start_date'        => 'تاريخ بدءالرحلة',
            'start_date_helper' => ' ',
            'end_date'          => ' تاريخ انتهاء الرحلة',
            'end_date_helper'   => ' ',
            'companions'        => 'الصحبة',
            'companions_helper' => ' ',
            'user'              => 'السائح',
            'user_helper'       => ' ',
            'trip'              => 'الرحلة',
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
        'title'          => 'المفضلة',
        'title_singular' => 'المفضلة',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'السائح',
            'user_helper'       => ' ',
            'trip'              => 'الرحلة',
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
        'title'          => 'السائح',
        'title_singular' => 'سائح',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'المستخدم',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => ' تنبيهات المستخدمين',
        'title_singular' => ' تنبيهات المستخدمين',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => ' نص التنبيه',
            'alert_text_helper' => ' ',
            'alert_link'        => ' رابط التنبيه',
            'alert_link_helper' => ' ',
            'user'              => 'المستخدم',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'charts'=>[
        'booking'=>'عدد الحجوزات ',
        'trips'=>'عدد الرحلات ',
        'posts'=>'عدد المنشورات ',
        'tourists'=>'عدد السائحين ',
        'trip_report'=>' تقرير الرحلات',
        'post_report'=>'تقرير المنشورات',
        'last_tourist'=>'أخر 5 سائحين',
        'last_guide'=>'أخر 5 مرشدين',

    ],
];

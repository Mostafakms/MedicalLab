<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    public function run()
    {
        DB::table('tests')->insert([
            [
                'name' => 'صورة الدم الكاملة',
                'price' => 150.00,
                'normal_range' => '4.5-11.0 x10^9/L',
                'family' => 'دم'
            ],
            [
                'name' => 'تحليل سكر الدم',
                'price' => 50.00,
                'normal_range' => '70-110 mg/dL',
                'family' => 'دم'
            ],
            [
                'name' => 'تحليل وظائف الكبد',
                'price' => 200.00,
                'normal_range' => 'ALT: 7-56 U/L, AST: 10-40 U/L',
                'family' => 'كيمياء حيوية'
            ],
            [
                'name' => 'تحليل وظائف الكلى',
                'price' => 180.00,
                'normal_range' => 'Creatinine: 0.6-1.3 mg/dL',
                'family' => 'كيمياء حيوية'
            ],
            [
                'name' => 'تحليل فيتامين د',
                'price' => 500.00,
                'normal_range' => '20-50 ng/mL',
                'family' => 'هرموني'
            ],
            [
                'name' => 'البروفايل الدهني',
                'price' => 120.00,
                'normal_range' => 'Total Cholesterol: <200 mg/dL',
                'family' => 'كيمياء حيوية'
            ],
            [
                'name' => 'لوحة الغدة الدرقية',
                'price' => 250.00,
                'normal_range' => 'TSH: 0.4-4.0 mIU/L',
                'family' => 'هرموني'
            ],
            [
                'name' => 'تحليل الحمل',
                'price' => 180.00,
                'normal_range' => 'Negative',
                'family' => 'بول'
            ],
            [
                'name' => 'تحليل البول',
                'price' => 70.00,
                'normal_range' => 'Varies',
                'family' => 'بول'
            ],
            [
                'name' => 'زراعة البول',
                'price' => 110.00,
                'normal_range' => 'No growth',
                'family' => 'بول'
            ],
            [
                'name' => 'تحليل البراز',
                'price' => 120.00,
                'normal_range' => 'Negative',
                'family' => 'براز'
            ],
            [
                'name' => 'فحص الدم الخفي في البراز',
                'price' => 130.00,
                'normal_range' => 'Negative',
                'family' => 'براز'
            ],
            [
                'name' => 'لوحة الإلكتروليت',
                'price' => 90.00,
                'normal_range' => 'Sodium: 135-145 mEq/L',
                'family' => 'كيمياء حيوية'
            ],
            [
                'name' => 'لوحة التخثر',
                'price' => 110.00,
                'normal_range' => 'PT: 11-13.5 seconds',
                'family' => 'دم'
            ],
            [
                'name' => 'تحليل بروتين سي التفاعلي (CRP)',
                'price' => 130.00,
                'normal_range' => '< 10 mg/L',
                'family' => 'التهاب'
            ],
            [
                'name' => 'تحليل الهيموغلوبين السكري (HbA1c)',
                'price' => 160.00,
                'normal_range' => '4-5.6%',
                'family' => 'دم'
            ],
            [
                'name' => 'زمن البروثرومبين (PT)',
                'price' => 100.00,
                'normal_range' => '11-13.5 seconds',
                'family' => 'دم'
            ],
            [
                'name' => 'دراسات الحديد',
                'price' => 140.00,
                'normal_range' => 'Ferritin: 30-300 ng/mL',
                'family' => 'دم'
            ],
            [
                'name' => 'لوحة الفحص العائلي',
                'price' => 300.00,
                'normal_range' => 'Varies',
                'family' => 'عائلي'
            ],
        ]);
    }
}

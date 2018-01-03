<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // folder::/uploads/poster/
        // site options
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'site_url',
            'label' => 'آدرس سایت',
            'description' => 'آدرس سایت',
            'value' => 'azmoonm.ir',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'site_name_fa',
            'label' => 'نام سایت به فارسی',
            'description' => 'نام سایت به فارسی',
            'value' => 'سامانه ثبت نام آزمون مشترك مدارس و مراكز فقهي',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'site_name_en',
            'label' => 'نام سایت به انگلیسی',
            'description' => 'نام سایت به انگلیسی',
            'value' => 'Azmoon Mushtarak',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'site_title',
            'label' => 'عنوان سایت',
            'description' => 'عنوان سایت',
            'value' => 'سامانه ثبت نام آزمون مشترك مدارس و مراكز فقهي',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'site_description',
            'label' => 'توضیحات سایت',
            'description' => 'توضیحات سایت',
            'value' => 'سامانه ثبت نام آزمون مشترك مدارس و مراكز فقهي',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'site_keywords',
            'label' => 'کلمات کلیدی سایت',
            'description' => 'کلمات کلیدی سایت',
            'value' => 'سامانه ثبت نام آزمون مشترک, فقه, فقیه, آزمون, مرکز فقهی',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'copyright',
            'label' => 'کپی رایت',
            'description' => 'کپی رایت',
            'value' => '© ۱۳۹۶ آزمون مشترک - azmoonm.ir',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'address',
            'label' => 'نشانی',
            'description' => 'نشانی',
            'value' => 'قم',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'phone',
            'label' => 'تلفن',
            'description' => 'تلفن',
            'value' => '۰۲۵۳۲۶۱۷۳۶۷',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'default_email',
            'label' => 'پست الکترونیک پیشفرض',
            'description' => 'پست الکترونیک پیشفرض',
            'value' => 'info@azmoonm.ir',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'register_email',
            'label' => 'پست الکترونیک ثبت نام',
            'description' => 'پست الکترونیک ثبت نام',
            'value' => 'info@azmoonm.ir',
        ]);
        DB::table('options')->insert([
            'type' => 'site',
            'name' => 'designer',
            'label' => 'طراح',
            'description' => 'طراح',
            'value' => 'qaim.ir',
        ]);

        // uploads
        DB::table('options')->insert([
            'type' => 'files',
            'name' => 'poster',
            'label' => 'پوستر',
            'description' => 'پوستر',
            'value' => 'poster.jpg',
        ]);
        DB::table('options')->insert([
            'type' => 'files',
            'name' => 'instructions',
            'label' => 'دفترچه راهنما',
            'description' => 'دفترچه راهنما',
            'value' => 'exam_instructions.pdf',
        ]);

        // logo options
        DB::table('options')->insert([
            'type' => 'images',
            'name' => 'favicon',
            'label' => 'فاویکون',
            'description' => 'فاویکون',
            'value' => 'favicon.ico',
        ]);
        DB::table('options')->insert([
            'type' => 'images',
            'name' => 'logo',
            'label' => 'آرم',
            'description' => 'آرم',
            'value' => 'logo.png',
        ]);
        DB::table('options')->insert([
            'type' => 'images',
            'name' => 'logo_bw',
            'label' => 'آرم سیاه و سفید',
            'description' => 'آرم سیاه و سفید',
            'value' => 'logo_bw.png',
        ]);

        // social options
        DB::table('options')->insert([
            'type' => 'social',
            'name' => 'instagram',
            'label' => 'Instagram',
            'description' => 'http://instagram.com/<your_instagram_id>',
            'value' => 'http://instagram.com/azmoonm.ir',
        ]);
        DB::table('options')->insert([
            'type' => 'social',
            'name' => 'telegram',
            'label' => 'Telegram',
            'description' => 'http://telegram.me/<your_telegram_id>',
            'value' => 'http://telegram.me/azmoonmir',
        ]);
        DB::table('options')->insert([
            'type' => 'social',
            'name' => 'skype',
            'label' => 'Skype',
            'description' => 'skype:<your_skype_id>?call',
            'value' => 'skype:azmoonm?call',
        ]);

        // card options
        DB::table('options')->insert([
            'type' => 'card',
            'name' => 'exam_name',
            'label' => 'نام آزمون',
            'description' => 'نام آزمون',
            'value' => 'آزمون ورودی سال 96-97',
        ]);
        DB::table('options')->insert([
            'type' => 'card',
            'name' => 'exam_date',
            'label' => 'تاریخ آزمون',
            'description' => 'تاریخ آزمون',
            'value' => '2017-04-28',
        ]);
        DB::table('options')->insert([
            'type' => 'card',
            'name' => 'exam_arrive',
            'label' => 'ساعت حضور داوطلب',
            'description' => 'ساعت حضور داوطلب',
            'value' => '16:00',
        ]);
        DB::table('options')->insert([
            'type' => 'card',
            'name' => 'exam_start',
            'label' => 'ساعت شروع آزمون',
            'description' => 'ساعت شروع آزمون',
            'value' => '16:30',
        ]);
        DB::table('options')->insert([
            'type' => 'card',
            'name' => 'exam_address',
            'label' => 'نشانی',
            'description' => 'نشانی آزمون',
            'value' => 'قم - بلوار امین - بین کوچه ١٥-١٧ - مسجد المهدی',
        ]);
        DB::table('options')->insert([
            'type' => 'card',
            'name' => 'card_notes',
            'label' => 'نکته ها',
            'description' => 'نکته ها',
            'value' => '۱. نیم ساعت قبل از شروع آزمون در محل برگزاری حاضر باشید.<br />۲. همراه داشتن کارت ورود به جلسه الزامیست.',
        ]);

    }
}

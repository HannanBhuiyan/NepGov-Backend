<?php

namespace Database\Seeders;

use App\Models\UserSurvay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSurvaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSurvay::create([
            'logo' => 'backend/assets/uploads/template/logo.png',
            'image' => 'backend/assets/uploads/template/user_survay.png',
            'title' => 'You have been selected for a Nepgov survey',
            'short_para' => 'Your time is valuable, so you will earn points every time you complete a survey',
            'footer_title' => 'Start Survay',
            'footer_para' => 'If you cant see or click the button above, please copy and paste this link into your browser.',
            'footer_link' => 'https://staging.nepgov.com/',
            'email_address' => 'krishnabhatta@gmail.com'
        ]);
    }
}

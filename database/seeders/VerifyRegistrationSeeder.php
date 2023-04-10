<?php

namespace Database\Seeders;

use App\Models\VerifyRegistration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VerifyRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VerifyRegistration::create([
            'logo' => 'backend/assets/uploads/template/logo.png',
            'image' => 'backend/assets/uploads/template/verify_image.png',
            'title' => 'Enter this verification code to create your NepGov account',
            'token_name' => 'Token',
            'link_text' => 'You are receiving this code because your email was entered on the NepGov website at',
            'link' => 'account.nepgov.com',
            'ignore_message' => 'If this was not you, please ignore this email - no account will created'
        ]);
    }
}

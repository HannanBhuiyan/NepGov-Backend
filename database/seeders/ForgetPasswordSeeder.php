<?php

namespace Database\Seeders;

use App\Models\ForgetPassword;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForgetPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ForgetPassword::create([
            'logo' => 'backend/assets/uploads/template/logo.png',
            'title' => 'You can reset password from bellow link',
            'reset_link_text' => 'Reset Password'
        ]);
    }
}

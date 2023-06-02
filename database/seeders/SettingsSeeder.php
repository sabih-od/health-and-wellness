<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'site_title' => 'Health and Wellness',
            'company_name' => 'Health and Wellness',
            'email' => 'admin@health-and-wellness.com',
            'phone_no_1' => '(123) 456-7890',
            'address' => 'Lorem Street, Abc road',
            'paypal_env' => 'Testing',
            'paypal_client_id' => '',
            'paypal_secret_key' => '',
            'stripe_env' => 'Testing',
            'stripe_publishable_key' => '',
            'stripe_secret_key' => '',
            'authorize_env' => 'Testing',
            'authorize_merchant_login_id' => '',
            'authorize_merchant_transaction_key' => ''
        ]);
    }
}

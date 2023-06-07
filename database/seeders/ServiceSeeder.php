<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        dd((asset('images/service9.webp')));
        $health_service = Service::create([
            'name' => 'Health',
            'description' => 'Work with a registered nurse as your personal health coach for your medical concerns ',
            'pricing_detail' => '16 hr - $400 - Virtual',
        ]);

        $education_service = Service::create([
            'name' => 'Education',
            'description' => 'State-certified Medication Administration program ',
            'pricing_detail' => '45 min - Phone or video chat',
        ]);

        $wellness_service = Service::create([
            'name' => 'Wellness',
            'description' => 'Work with a Spiritual Guide for wholeness ',
            'pricing_detail' => '1 hr - Video Chat',
        ]);

        $health_service->addMedia(public_path('images/service9.webp'))->preservingOriginal()->toMediaCollection('service_images');
        $education_service->addMedia(public_path('images/service8.webp'))->preservingOriginal()->toMediaCollection('service_images');
        $wellness_service->addMedia(public_path('images/service7.webp'))->preservingOriginal()->toMediaCollection('service_images');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Faqs;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonial1 = Testimonial::create([
            'user_id' => Auth::id(),
            'name' => 'Jane Smith',
            'job_title' => 'Client',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor
                                        incididunt ut labore et dolore maecenas aliqua Quis ipsum eiusmod tempor
                                        incididunt ut labore et accumsan lacus vel facilisis Quis ipsum eiusmod tempor
                                        incididunt ut labore et accumsan lacus vel facilisis.',
        ]);

        $testimonial2 = Testimonial::create([
            'user_id' => Auth::id(),
            'name' => 'Jane Smith',
            'job_title' => 'Client',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor
                                        incididunt ut labore et dolore maecenas aliqua Quis ipsum eiusmod tempor
                                        incididunt ut labore et accumsan lacus vel facilisis Quis ipsum eiusmod tempor
                                        incididunt ut labore et accumsan lacus vel facilisis ',
        ]);

        $testimonial3 = Testimonial::create([
            'user_id' => Auth::id(),
            'name' => 'Jane Smith',
            'job_title' => 'Client',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor
                                        incididunt ut labore et dolore maecenas aliqua Quis ipsum eiusmod tempor
                                        incididunt ut labore et accumsan lacus vel facilisis Quis ipsum eiusmod tempor
                                        incididunt ut labore et accumsan lacus vel facilisis ',
        ]);

        $testimonial1->addMedia(public_path('images/user1.webp'))->preservingOriginal()->toMediaCollection('testimonial_image');
        $testimonial2->addMedia(public_path('images/user2.webp'))->preservingOriginal()->toMediaCollection('testimonial_image');
        $testimonial3->addMedia(public_path('images/user3.webp'))->preservingOriginal()->toMediaCollection('testimonial_image');
    }
}

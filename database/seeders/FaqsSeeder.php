<?php

namespace Database\Seeders;

use App\Models\Faqs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faq1 = Faqs::create([
            'user_id' => Auth::id(),
            'question' => 'How can I start working with you?',
            'answer' => 'To start your journey with us please schedule an introductory consultation session under the
                            Our service section.',
        ]);

        $faq2 = Faqs::create([
            'user_id' => Auth::id(),
            'question' => 'Do you offer group consultations or workshops?',
            'answer' => 'I offer a six weeks virtual Holistic health management group. As well as Medication
                            administration course- a state certified program. If you were looking for something
                            different from that please contact us at healthandwellnessed@gmail.com ',
        ]);

        $faq3 = Faqs::create([
            'user_id' => Auth::id(),
            'question' => 'What should I prepare for my initial consultation?',
            'answer' => 'To prepare for your initial appointment, please complete the health survey Form which was
                            sent to you after you scheduled the appointment. As this will be virtual, be prepared to be
                            on video camera- this creates better interpersonal connection as you start your journey ',
        ]);

        $faq1->addMedia(public_path('images/img1.webp'))->preservingOriginal()->toMediaCollection('faq_image');
        $faq2->addMedia(public_path('images/img2.webp'))->preservingOriginal()->toMediaCollection('faq_image');
        $faq3->addMedia(public_path('images/img3.webp'))->preservingOriginal()->toMediaCollection('faq_image');
    }
}

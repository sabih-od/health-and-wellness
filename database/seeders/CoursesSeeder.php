<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course1 = Course::create([
            'category_id' => "1",
            'course_title' => "Medication administration",
            'course_description' => "Medication administration: the direct application of a prescribed medication—whether by injection, inhalation, ingestion, or other means—to the body of the individual by an individual legally authorized to do so.",
            'time_detail' => "16 hrs. in 2 weeks",
            'price' => "400",

        ]);

        $course2 = Course::create([
            'category_id' => "2",
            'course_title' => "Health Initial",
            'course_description' => "Health is a state of complete physical, mental and social well-being and not merely the absence of disease or infirmity. The enjoyment of the highest attainable standard of health is one of the fundamental rights of every human being without distinction of race, religion, political belief, economic or social condition.",
            'time_detail' => "$75 - 30 min",
            'price' => "75",

        ]);

        $course3 = Course::create([
            'category_id' => "3",
            'course_title' => "Spiritual Offering",
            'course_description' => "It is doing what is righteous. It is spiritual conduct that honors God. When you do any righteous thing — reproving or restoring a brother, loving or helping someone, studying the Word of God, sitting under the preaching of the precious truth — it is a spiritual sacrifice in the name of Christ that glorifies God.",
            'time_detail' => "$80 - 45 min",
            'price' => "80",
        ]);
    }
}
